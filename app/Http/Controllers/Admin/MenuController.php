<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class MenuController extends Controller
{
    /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        return Menus::select('id', 'name')->where("name", "LIKE", "%$keyword%")->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('read-menus');
        return view('admin.menu.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return false|\Illuminate\Http\JsonResponse|string
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function createnewmenu()
    {
        $validator = Validator::make(request()->all(), [
            'menuname' => 'required|min:2|regex:/^[\pL\-#\/\s]+\s?[\pL\-0-9]*$/i'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $this->authorize('add-menus');
        $menu = new Menus();
        $menu->name = strip_tags(request("menuname"));
        $menu->save();
        return json_encode(array("resp" => $menu->id));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteitemmenu()
    {
        $menuitem = MenuItems::find(request("id"));
        $menuitem->delete();
        return response()->json(['success' => 'Deleted menu item successfully!']);
    }

    /**
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function deletemenug()
    {
        $menus = new MenuItems();
        $getall = $menus->getall(request("id"));
        if (count($getall) == 0) {
            $menudelete = Menus::find(request("id"));
            $menudelete->delete();
            return json_encode(array("resp" => "you delete this item"));
        } else {
            return json_encode(array("resp" => "You have to delete all items first", "error" => 1));
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateitem()
    {
        $arraydata = request("arraydata");
        if (is_array($arraydata)) {
            foreach ($arraydata as $value) {
                $menuitem = MenuItems::find($value['id']);
                $menuitem->label = $value['label'];
                $menuitem->link = $value['link'];
                $menuitem->class = $value['class'];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = $value['role_id'] ? $value['role_id'] : 0 ;
                }
                $menuitem->save();
            }
            return response()->json(['success' => "Update Successfully!"]);
        } else {
            $validator = Validator::make(request()->all(), [
                'label' => 'required|min:2|regex:/^[\pL\-#\/\s]+\s?[\pL\-0-9]*$/i',
                'url' => 'required|regex:/^[a-zA-Z0-9 \/\-#]+/i',
                'clases' => 'nullable|alpha_num'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $menuitem = MenuItems::find(request("id"));
            $menuitem->label = request("label");
            $menuitem->link = request("url");
            $menuitem->class = request("clases");
            if (config('menu.use_roles')) {
                $menuitem->role_id = request("role_id") ? request("role_id") : 0 ;
            }
            $menuitem->save();
            return response()->json(['success' => "Update Item Successfully!"]);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function addcustommenu()
    {
        $validator = Validator::make(request()->all(), [
            'labelmenu' => 'required|min:2|alpha_num',
            'linkmenu' => 'required|regex:/^[a-zA-Z0-9 \/\-#]+/i',
            'labelmenu' => 'required|min:2|regex:/^[\pL\-#\/\s]+\s?[\pL\-0-9]*$/i',
            'linkmenu' => 'required|regex:/^[a-zA-Z0-9 \/\-#]+/i',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $menuitem = new MenuItems();
        $menuitem->label = request('labelmenu');
        $menuitem->link = request('linkmenu');
        if (config('menu.use_roles')) {
            $menuitem->role_id = request('rolemenu') ? request('rolemenu') : 0 ;
        }
        $menuitem->menu = request('idmenu');
        $menuitem->sort = MenuItems::getNextSortRoot(request('idmenu'));
        $menuitem->save();
        return response()->json(['success' => "Add Menu successfully!"]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function generatemenucontrol()
    {
        $validator = Validator::make(request()->all(), [
            'menuname' => 'required|min:2|alpha_num'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $menu = Menus::find(request("idmenu"));
        $menu->name = request('menuname');

        $menu->save();
        if (is_array(request('arraydata'))) {
            foreach (request('arraydata') as $value) {
                $menuitem = MenuItems::find($value["id"]);
                $menuitem->parent = $value["parent"];
                $menuitem->sort = $value["sort"];
                $menuitem->depth = $value["depth"];
                if (config('menu.use_roles')) {
                    $menuitem->role_id = request("role_id");
                }
                $menuitem->save();
            }
        }
        echo json_encode(array("resp" => 1));
    }
}
