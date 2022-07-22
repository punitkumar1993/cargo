<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TagDataTable;
use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Models\TermTaxonomy;
use App\Services\Slug;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function tagsSearch(Request $request)
    {
        $keyword = $request->get('q');
        return Term::select('id','name')->tag()->searchName($keyword)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(TagDataTable $dataTable)
    {
        $this->authorize('read-tags');
        return $dataTable->render( 'admin.tag.index' );
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
        $this->authorize('add-tags');
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $check_tag = Term::whereHas('taxonomy', function($query){
            $query->where('taxonomy','tag');
        })->where('name', $request->name)->exists();

        if($check_tag) {
            return response()->json(['error_exists' => "The name has already been taken."]);
        }

        $new_taxonomy = new TermTaxonomy([
            'taxonomy'=>'tag'
        ]);

        $terms = Term::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        $insertedId = $terms->id;
        $term = Term::find($insertedId);
        $save_term = $term->taxonomy()->save($new_taxonomy);

        return response()->json(['success' => 'Saving successfully!']);
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
        $this->authorize('update-tags');
        $tag = Term::findOrFail($id);
        $taxonomy = Term::find($id)->taxonomy;
        return view('admin.tag.edit', ['tag' => $tag, 'taxonomy'=>$taxonomy]);
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
        $this->authorize('update-tags');
        $validator = Validator::make($request->all(), [
            'name' => 'required|' . Rule::unique('terms')->ignore($id) . '|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $description = $request->description;

        $datataxonomy = [
            'taxonomy'=>'tag',
        ];

        $tag = Term::find($id);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $tag->update($data);

        TermTaxonomy::where('term_id', $id)->update($datataxonomy);
        return response()->json(['success' => 'Saving successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-tags');
        if ($response->allowed()) {
            Term::destroy($id);
            return response()->json(['success' => 'Tag deleted successfully.']);
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
        $response = Gate::inspect('delete-tags');
        if ($response->allowed()) {
            $tags_id_array = $request->id;
            TermTaxonomy::whereIn('parent',$tags_id_array)
                    ->update(['parent' => '0']);
            $tags = Term::whereIn('id', $tags_id_array);
            if($tags->delete()) {
                return response()->json(['success' => 'Tag deleted successfully.']);
            } else {
                return response()->json(['error' => 'Tag deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
