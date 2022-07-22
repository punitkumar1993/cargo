<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Users;
use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public $path;
    public $dimensions;

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->path = storage_path('app/public/avatar');
        $this->dimensions = 300;
    }

    /**
     * @param $filename
     * @param $filetype
     * @return string
     */
    public function base64_encode_image($filename = string, $filetype = string)
    {
        if ($filename) {
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));
            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $roles = [];
        foreach ($user->getRoleNames() as $role) {
            $roles[] = $role;
        }
        $role = implode(' | ', $roles);

        $roles = $user->roles;
        $image = Users::getAvatar($user->photo);
        $userRel = $user->socialmedia()->get();
        $checkRelSocmed = $user->socialmedia()->exists();

        return view('admin.profile.show', compact('user','role','roles','checkRelSocmed','userRel','image'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function change_password()
    {
        return view('admin.profile.change_password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function password_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('admin/change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail(Auth::id());

        $hashedPassword = $user->password;

        if (Hash::check($request->old_password, $hashedPassword))
        {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        } else {
            return redirect('admin/change-password')
                ->withErrors(['old_password'=>'Password wrong'])
                ->withInput();
        }

        return redirect()->route('profile.index')->withSuccess('Change Password successfully!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
//        $this->authorize('update-users');
        if (Auth::user()->username == 'magazine-user') {
            $data = $request->validate(
                [
                    'name'         => 'required|string|min:2|max:100',
                    'email'        => 'required|email|unique:users,email, ' . $id . ',id',
                    'organization' => 'required',
                    'password'     => 'nullable|min:6',
                    'occupation'   => 'nullable',
                    'about'        => 'nullable',
                    'roles'        => 'required',
                ]
            );
        } else {
            $data = $request->validate(
                [
                    'name'         => 'required|string|min:2|max:100',
                    'username'     => 'required|string|min:3|max:100|unique:users,username, ' . $id . ',id',
                    'organization' => 'required',
                    'email'        => 'required|email|unique:users,email, ' . $id . ',id',
                    'password'     => 'nullable|min:6',
                    'occupation'   => 'nullable',
                    'about'        => 'nullable',
                    'roles'        => 'required',
                ]
            );
        }

        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $data['photo'] = $request->image->getClientOriginalName();
        }

        $user->update($data);
        $user->syncRoles($request->roles);
        Users::syncSocialMedia($id);

        return redirect()->route('profile.index')->withSuccess('Updating successfully!');
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = [];
        foreach ($user->getRoleNames() as $role) {
            $roles[] = $role;
        }
        $role = implode(' | ', $roles);
        $roles = $user->roles;
        return view('admin.profile.show', compact('user','role','roles'));
    }
}
