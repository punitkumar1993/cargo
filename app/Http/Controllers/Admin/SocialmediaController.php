<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\SocialmediaDataTable;
use App\Models\Socialmedia;
use App\Services\Slug;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SocialmediaController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $socialmedia = Socialmedia::select('id', 'name')->where("name", "LIKE", "%$keyword%")->get();
        return $socialmedia;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSocmed(Request $request)
    {
        $data = Socialmedia::find($request->id);
        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(SocialmediaDataTable $dataTable)
    {
        $this->authorize('read-social-media');
        return $dataTable->render('admin.socialmedia.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Slug $slug)
    {
        $this->authorize('add-social-media');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'url' => 'required|unique:socialmedia,url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Socialmedia::create([
            'name' => $request->name,
            'slug' => $slug->createSlug($request->name),
            'url' => $request->url,
            'icon' => $request->icon ? $request->icon : 'fab fa-globe'
        ]);

        return response()->json(['success' => 'Saving successfunlly!']);
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
        $this->authorize('update-social-media');
        $socialmedia = Socialmedia::findOrFail($id);
        return view('admin.socialmedia.edit', compact('socialmedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Slug $slug, $id)
    {
        $this->authorize('update-social-media');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'url' => 'required|unique:socialmedia,url, '. $id . ',id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $socialmedia = Socialmedia::findOrFail($id);

        $data = [
            'name' => $request->name,
            'slug' => $slug->createSlug($request->name),
            'url' => $request->url,
            'icon' => $request->icon ? $request->icon : 'fab fa-globe'
        ];

        $socialmedia->update($data);

        return response()->json(['success' => 'Updating successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-social-media');
        if ($response->allowed()) {
            Socialmedia::destroy($id);
            return response()->json(['success' => 'Social Media deleted successfully.']);
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
        $response = Gate::inspect('delete-social-media');
        if ($response->allowed()) {
            $socialmedia_id_array = $request->id;
            $socialmedia = Socialmedia::whereIn('id', $socialmedia_id_array);
            if($socialmedia->delete()) {
                return response()->json(['success' => 'Deleted successfully.']);
            } else {
                return response()->json(['error' => 'Deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
