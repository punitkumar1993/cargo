<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Helpers\Users;
use App\Http\Controllers\Controller;
use App\Models\Socialmedia;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $path;
    public $dimensions;

    /**
     * UserController constructor.
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(UsersDataTable $dataTable)
    {
        $this->authorize('read-users');
        return $dataTable->render('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('add-users');
        $role = Role::orderBy('name','ASC')->get();
        return view('admin.user.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize('add-users');
        $this->validate($request, [
            'name' => 'required|string|min:3|max:100|regex:/^[A-Za-z. \-\']+$/',
            'username' => 'required|string|min:3|max:100|unique:users,username|alpha_dash',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'required|exists:roles,name'
        ]);

        $fileName = ($request->hasFile('image')) ? $request->image->getClientOriginalName() : 'noavatar.png';

        $users = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $fileName,
            'occupation' => $request->occupation,
            'about' => $request->about,
        ]);

        $users->givePermissionTo(['update-users', 'read-posts', 'add-posts', 'update-posts', 'delete-posts']);

        $users->assignRole($request->roles);

        $user = User::find($users->id);
        if ( request()->filled('socmed') ) {
            foreach ( request('socmed') as $item ) {
                $socmed = Socialmedia::find($item);
                if(request($socmed->slug) != "") {
                    $user->socialmedia()->attach($item, [
                        'url' => request($socmed->slug)
                    ]);
                }
            }
        }

        return redirect()->route('users.index')->withSuccess('Saving successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update-users');
        $user = User::findOrFail($id);

        if (Auth::User()->hasRole(['superadmin'])) {
            if($user->getRoleNames()->first() === 'superadmin') {
                if((Auth::id() != $user->id)) {
                    $this->authorize('update-access');
                }
            }
        } else if(Auth::User()->hasRole(['admin'])) {
            if($user->getRoleNames()->first() === 'admin') {
                if((Auth::id() != $user->id)) {
                    $this->authorize('update-access');
                }
            }
        } else {
            if($user->getRoleNames()->first() === 'superadmin' OR 'admin') {
                $this->authorize('update-access');
            } else {
                if((Auth::id() != $user->id)) {
                    $this->authorize('update-access');
                }
            }
        }

        $roles = $user->roles;
        $image = Users::getAvatar($user->photo);
        $userRel = $user->socialmedia()->get();
        $checkRelSocmed = $user->socialmedia()->exists();

        return view('admin.user.edit', compact('user', 'roles', 'image', 'checkRelSocmed','userRel'));
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
        $this->authorize('update-users');
        $data = $request->validate([
            'name' => 'required|string|min:2|max:100|regex:/^[A-Za-z. \-\']+$/',
            'username' => 'required|string|min:3|max:100|unique:users,username, ' . $id . ',id|alpha_dash',
            'email' => 'required|email|unique:users,email, '. $id. ',id',
            'password' => 'nullable|min:6',
            'occupation' => 'nullable',
            'about' => 'nullable',
            'roles' => 'required',
        ]);

        $user = User::findOrFail($id);

        $data['password'] = !empty($request->password) ? Hash::make($request->password) : $user->password;

        if ($request->hasFile('image')) {
            $data['photo'] = $request->image->getClientOriginalName();
        }

        $user->update($data);
        $user->syncRoles($request->roles);
        Users::syncSocialMedia($id);

        return redirect()->route('users.index')->withSuccess('Updating successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-users');
        if ($response->allowed()) {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => 'Deleted successfully.']);
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }

    /**
     * Remove the multi resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function massdestroy(Request $request)
    {
        $response = Gate::inspect('delete-users');
        if ($response->allowed()) {
            $user_id_array = $request->id;

            $users = User::whereIn('id', $user_id_array)->get();

            foreach($users as $item) {
                if ($item->photo != "noavatar.png") {
                    Storage::disk('public')->delete('avatar/' . $item->photo);
                }
            }

            $user = User::whereIn('id', $user_id_array);
            if($user->delete()) {
                return response()->json(['success' => 'Deleted successfully.']);
            } else {
                return response()->json(['error' => 'Deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }

    /**
     * @param $filename
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function displayImageUser($filename)
    {
        if (Storage::disk('public')->exists('avatar/' . $filename)) {
            return Storage::disk('public')->response('avatar/' . $filename);
        } else {
            return response()->file(public_path('/img/noavatar.png'));
        }
    }
}
