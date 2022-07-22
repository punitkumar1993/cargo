<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Models\TermTaxonomy;
use App\Services\Slug;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Search
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxSearch(Request $request){
        $keyword = strip_tags($request->get('q'));
        return Term::select('id','name')->category()->whereNotIn('name', ['News', 'Events'])->searchName($keyword)->get();
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(CategoriesDataTable $dataTable)
    {
        $this->authorize('read-categories');
        return $dataTable->render( 'admin.category.index' );
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
        $this->authorize('add-categories');
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $check_category = Term::category()->ofName($request->name)->exists();

        if ($check_category) {
            return response()->json(['error_exists' => "The name has already been taken."]);
        }

        $new_taxonomy = new TermTaxonomy([
            'taxonomy'=>'category'
        ]);

        $terms = Term::create([
            'name' => $request->name,
			'meta_title' => $request->meta_title,
			'meta_description' => $request->meta_description,
            'slug' => Str::slug($request->name)
        ]);

        $insertedId = $terms->id;
        $term = Term::find($insertedId);
        $term->taxonomy()->save($new_taxonomy);

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
        $this->authorize('update-categories');
        $term = Term::findOrFail($id);
        $taxonomy = $term->taxonomy;

        return view('admin.category.edit', compact('taxonomy'));
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
        $this->authorize('update-categories');
        $validator = Validator::make($request->all(), [
            'name' => 'required|' . Rule::unique('users')->ignore($id, 'id') .'|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $description = $request->description;

        $datataxonomy = [
            'taxonomy'=>'category'
        ];

        $category = Term::find($id);

        $data = [
            'name' => $request->name,
			'meta_title' => $request->meta_title,
			'meta_description' => $request->meta_description,
            'slug' => Str::slug($request->name)
        ];

        $category->update($data);

        TermTaxonomy::where('term_id', $id)->update($datataxonomy);

        return response()->json(['success' => "Updating successfully!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-categories');
        if ($response->allowed()) {
            if (TermTaxonomy::whereParent($id)->exists()) {
                $TermTaxonmy = TermTaxonomy::whereParent($id)->first();
                $TermTaxonmy->parent = 0;
                $TermTaxonmy->save();
            }
            $termId = TermTaxonomy::whereTermId($id)->first()->id;
            TermTaxonomy::find($termId)->post()->detach();
            Term::destroy($id);
            return response()->json(['success' => 'Category deleted successfully.']);
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
        $response = Gate::inspect('delete-categories');
        if ($response->allowed()) {
            $categories_id_array = $request->id;
            TermTaxonomy::whereIn('parent',$categories_id_array)
                    ->update(['parent' => '0']);
            $categories = Term::whereIn('id', $categories_id_array);

            $termtaxonomy = TermTaxonomy::whereIn('term_id',$categories_id_array)->get();

            foreach($termtaxonomy as $term){
                TermTaxonomy::find($term->id)->post()->detach();
            }

            if($categories->delete()) {
                return response()->json(['success' => 'Category deleted successfully.']);
            } else {
                return response()->json(['error' => 'Category deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
