<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        if (Auth::User()->hasRole('superadmin')) {
            $roles = Role::select('id','name')->where("name", "LIKE", "%$keyword%")->get();
        } else if(Auth::User()->hasRole('admin')) {
            $roles = Role::select('id','name')
                ->whereNotIn('name', ['superadmin'])
                ->where("name", "LIKE", "%$keyword%")->get();
        } else {
            $roles = Role::select('id','name')
                ->whereNotIn('name', ['superadmin','admin'])
                ->where("name", "LIKE", "%$keyword%")->get();
        }

        return $roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(RolesDataTable $dataTable)
    {
        $this->authorize('read-roles');
        return $dataTable->render('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('add-roles');
        return view('admin.role.create');
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
        $this->authorize('add-roles');
        $this->validate($request, [
            'name' => 'required|string|unique:roles|max:50|min:2|alpha_dash'
        ]);
        Role::firstOrCreate(['name' => Str::lower($request->name)]);
        return redirect()->route('roles.index')->withSuccess('Saving successfully!');
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
        $this->authorize('update-roles');
        $role = Role::findOrFail($id);

        if(Auth::User()->hasRole('superadmin')) {
            $permissions = Permission::all()->pluck('alias', 'id');
        }else{
            $permission = Permission::all()->except([61, 62, 63, 64]);
            $permissions = $permission->pluck('alias', 'id');
        }

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        $ifCheckAll = Permission::count() === count($rolePermissions);

        return view('admin.role.edit', compact('role', 'permissions', 'rolePermissions', 'ifCheckAll'));
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
        $this->authorize('update-roles');
        $this->validate($request, [
            'name' => 'required|string|' . Rule::unique('roles')->ignore($id, 'id') .'|max:50|min:2|alpha_dash',
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->withSuccess('Updating successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-roles');
        if ($response->allowed()) {
            $role = Role::findOrFail($id);
            $role->delete();
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
        $response = Gate::inspect('delete-roles');
        if ($response->allowed()) {
            $roles_id_array = $request->id;
            $roles = Role::whereIn('id', $roles_id_array);
            if($roles->delete()) {
                return response()->json(['success' => 'Deleted successfully.']);
            } else {
                return response()->json(['error' => 'Deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
