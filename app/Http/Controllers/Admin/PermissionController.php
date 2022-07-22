<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PermissionsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(PermissionsDataTable $dataTable)
    {
        $this->authorize('read-permissions');
        return $dataTable->render('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('add-permissions');
        return view('admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('add-permissions');
        $request->validate([
            'alias' => 'required|string|max:50'
        ]);

        Permission::firstOrCreate(['alias' => 'read-' . Str::slug($request->alias), 'name' => 'read-' . Str::slug($request->alias)]);
        Permission::firstOrCreate(['alias' => 'create-' . Str::slug($request->alias), 'name' => 'create' . Str::slug($request->alias)]);
        Permission::firstOrCreate(['alias' => 'update-' . Str::slug($request->alias), 'name' => 'update-' . Str::slug($request->alias)]);
        Permission::firstOrCreate(['alias' => 'delete-' . Str::slug($request->alias), 'name' => 'delete-' . Str::slug($request->alias)]);

        return redirect()->route('permissions.index')->withSuccess('Saving successfully!');
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
        $this->authorize('update-permissions');
        $permission = Permission::findOrFail($id);
        return view('admin.permission.edit', compact('permission'));
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
        $this->authorize('update-permissions');
        $request->validate([
            'alias' => 'required|string|max:50'
        ]);
        $permission = Permission::findOrFail($id);
        $permission->update([
            'alias' => $request->alias
        ]);
        return redirect()->route('permissions.index')->withSuccess('Updating successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-permissions');
        if ($response->allowed()) {
            $permission = Permission::findOrFail($id);
            $permission->delete();
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
        $response = Gate::inspect('delete-permissions');
        if ($response->allowed()) {
            $permissions_id_array = $request->id;
            $permissions = Permission::whereIn('id', $permissions_id_array);
            if($permissions->delete()) {
                return response()->json(['success' => 'Deleted successfully.']);
            } else {
                return response()->json(['error' => 'Deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
