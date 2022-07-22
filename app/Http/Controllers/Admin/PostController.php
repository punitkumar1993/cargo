<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\PostsDataTable;
use App\Helpers\Posts;
use App\Models\Post;
use App\Models\Term;
use App\Models\TermTaxonomy;
Use App\Models\User;
use App\Services\Slug;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Mews\Purifier\Facades\Purifier;

class PostController extends Controller
{
    public $path;
    public $dimensionWidth;
    public $dimensionHeight;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->path = storage_path('app/public/images'); //Post image storage path
        $this->dimensionWidth = '640'; //image width
        $this->dimensionHeight = '426'; //image height
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(PostsDataTable $dataTable)
    {
        $this->authorize('read-posts'); //authorize view posts
        return $dataTable->render('admin.post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('add-posts'); //authorize create new post
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Slug $slug)
    {
        $this->authorize('add-posts'); //authorize create new post

        request()->validate([
            'title' => 'required', //require title
            'post_type' => 'required'
        ]);

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path); //create path if not exist
        }

        // status (draft or publish) based button submit
        $status = request()->has('draft') ? 'draft' : (request()->has('publish') ? 'publish' : NULL);

        $post = new Post;

        // if image available
        if ($request->hasFile('image')) {
            $post->post_image = Posts::postThumb($request->image);
        }
        $event_location =  strip_tags(request('event_location'));
        if (request('even_date_time')){
           $post->event_date_time = request('even_date_time');
        }
         if(request('event_location')){
            $post->event_location = request('event_location');
        }

        $post->post_title = strip_tags(request('title'));
        $post->post_name = $slug->createSlug($request->title);
        $post->post_summary = Purifier::clean(request('summary'));
        $post->post_content = Purifier::clean(request('content'), 'youtube');
        $post->meta_description = strip_tags(request('meta_description'));
        $post->meta_keyword = strip_tags(request('meta_keyword'));
        $post->post_status = $status;
        $post->post_hits = 0;
        $post->post_author = Auth::id();
        $post->post_type = request('post_type');
       
        $post->save();

        if (request()->filled('categories')) {
            foreach (request('categories') as $category) {
                $checkCategory = Term::where('id', $category)->exists();
                if ($checkCategory === TRUE) {
                    $cat_taxonomy_id = Term::find($category)->taxonomy->id;
                    $post->termtaxonomy()->attach([
                        'term_taxonomy_id' => $cat_taxonomy_id
                    ]);
                } else {
                    $new_category_taxonomy = new TermTaxonomy([
                        'taxonomy' => 'category'
                    ]);

                    $category= Term::create([
                        'name' => Str::title($category),
                        'slug' => Str::slug($category),
                    ]);

                    $get_idCategory_term = Term::find($category->id);
                    $get_idCategory_term->taxonomy()->save($new_category_taxonomy);

                    $category_taxonomy_id = Term::find($category->id)->taxonomy->id;
                    $post->termtaxonomy()->attach([
                        'term_taxonomy_id' => $category_taxonomy_id
                    ]);
                }
            }
        }

        if (request()->filled('tags')) {
            foreach (request('tags') as $tag) {

                $checkTag = Term::where('id', $tag)->exists();

                if ($checkTag === TRUE) {
                    $tag_taxonomy_id = Term::find($tag)->taxonomy->id;
                    $post->termtaxonomy()->attach([
                        'term_taxonomy_id' => $tag_taxonomy_id
                    ]);
                } else {
                    $new_tag_taxonomy = new TermTaxonomy([
                        'taxonomy' => 'tag'
                    ]);

                    $tag = Term::create([
                        'name' => Str::title($tag),
                        'slug' => Str::slug($tag, '-')
                    ]);

                    $get_idTag_term = Term::find($tag->id);
                    $get_idTag_term->taxonomy()->save($new_tag_taxonomy);

                    $tag_taxonomy_id = Term::find($tag->id)->taxonomy->id;
                    $post->termtaxonomy()->attach([
                        'term_taxonomy_id' => $tag_taxonomy_id
                    ]);
                }
            }
        }

        return redirect()->route('posts.index')->withSuccess('Saving successfully!');
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
        $this->authorize('update-posts');
        $post = Post::findOrFail($id);

        //check authorization edit
        if (Auth::User()->hasRole('superadmin')) {
            if(User::findOrFail($post->post_author)->hasRole('superadmin')){
                if((Auth::id() != $post->post_author)) {
                    $this->authorize('update-access');
                }
            }
        } else if(Auth::User()->hasRole(['admin'])) {
            if(User::findOrFail($post->post_author)->hasRole('admin')){
                if((Auth::id() != $post->post_author)) {
                    $this->authorize('update-access');
                }
            }
        } else {
            if(User::findOrFail($post->post_author)->hasRole(['superadmin', 'admin'])){
                $this->authorize('update-access');
            } else {
                if((Auth::id() != $post->post_author)) {
                    $this->authorize('update-access');
                }
            }
        }

        // check term_relationships category
        $checkCategory = is_null( Post::findOrFail($id)->termtaxonomy->where('taxonomy','category')->first() );

        if ( $checkCategory == TRUE )
        {
            $categories = array();
        }
        else
        {
            // Get Categories
            foreach ($post->termtaxonomy->where('taxonomy', 'category') as $taxonomy) {
                $taxonomyId = $taxonomy->term_id;
                $categories[] = Term::findOrFail($taxonomyId);
            }
        }

        $checkTag = is_null( Post::findOrFail($id)->termtaxonomy->where('taxonomy','tag')->first() );

        if ( $checkTag == TRUE )
        {
            $tags = array();
        }
        else
        {
            // Get tags
            foreach ($post->termtaxonomy->where('taxonomy', 'tag') as $taxonomy) {
                $taxonomyId = $taxonomy->term_id;
                $tags[] = Term::findOrFail($taxonomyId);
            }
        }

        // file
        $image = Posts::getPostThumb($post->post_image);

        return view('admin.post.edit', compact('post', 'categories', 'tags', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id, Slug $slug)
    {
        $this->authorize('update-posts');

        $request->validate([
            'title' => 'required',
        ]);

        $data = [
            'post_title' => strip_tags($request->title),
            'post_summary' => Purifier::clean($request->summary),
            'post_content' => Purifier::clean($request->content, 'youtube'),
            'post_author' => Auth::id(),
            'post_type' => 'post',
            'meta_description' => strip_tags($request->meta_description),
            'meta_keyword' => strip_tags($request->meta_keyword)
        ];

        $post = Post::findOrFail($id);

        if ($post->post_name != Str::slug($request->title)) {
            $data['post_name'] = $slug->createSlug($request->title);
        };

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path);
        }

        $data['post_status'] = $request->has('draft') ? 'draft' : ($request->has('publish') ? 'publish' : NULL);

        if (request('isimage') == "true") {
            if ($request->hasFile('image')) {
                if (!empty($post->post_image)) {
                    Storage::disk('public')->delete('images/' . $post->post_image);
                }
                $data['post_image'] = Posts::postThumb($request->image);
            }
        } else {
            if (!empty($post->post_image)) {
                Storage::disk('public')->delete('images/' . $post->post_image);
            }
        }
        if (request('even_date_time')){
           $data['event_date_time'] = request('even_date_time');
        }
         if(request('event_location')){
            $data['event_location'] = request('event_location');
        }
        $data['post_type'] = request('post_type');
        Post::where('id', $id)->update($data);

        if ($request->filled('categories') OR $request->filled('tags')) {

            if ( $request->filled('categories') ) {

                foreach ( request('categories') as $category ) {

                    $checkCategory = Term::where('id', $category)->exists();

                    if ( $checkCategory === TRUE ) {
                        $taxonomy_id[] = Term::find($category)->taxonomy->id;
                    } else {
                        $new_category_taxonomy = new TermTaxonomy([
                            'taxonomy' => 'category'
                        ]);

                        $category= Term::create([
                            'name' => strip_tags(Str::title($category)),
                            'slug' => Str::slug($category, '-')
                        ]);

                        $get_idCategory_term = Term::find($category->id);
                        $get_idCategory_term->taxonomy()->save($new_category_taxonomy);

                        $taxonomy_id[] = Term::find($category->id)->taxonomy->id;
                    }
                }
            }

            if ( $request->filled('tags') ) {
                foreach ( request('tags') as $tag ) {
                    $checkTag = Term::where('id', $tag)->exists();

                    if ( $checkTag === TRUE ) {

                        $taxonomy_id[] = Term::find($tag)->taxonomy->id;
                    } else {

                        $new_tag_taxonomy = new TermTaxonomy([
                            'taxonomy' => 'tag'
                        ]);

                        $tag = Term::create([
                            'name' => strip_tags(Str::title($tag)),
                            'slug' => Str::slug($tag, '-')
                        ]);

                        $get_idTag_term = Term::find($tag->id);
                        $get_idTag_term->taxonomy()->save($new_tag_taxonomy);

                        $taxonomy_id[] = Term::find($tag->id)->taxonomy->id;
                    }
                }
            }
        }else{
            $taxonomy_id = [];
        }

        $post->find($id)
            ->termtaxonomy()
            ->sync($taxonomy_id);

        return redirect()->route('posts.index')->withSuccess('Updating successfully!');
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
                $post = Post::findOrFail($id);
                if ($post->post_image != "noimage.png") {
                    Storage::disk('public')->delete('images/' . $post->post_image);
                }
                Post::destroy($id);
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
        $response = Gate::inspect('delete-tags');
        if ($response->allowed()) {
            $posts_id_array = $request->id;
            $posts = Post::whereIn('id', $posts_id_array)->get();

            foreach($posts as $item) {
                if ($item->post_image != "noimage.png") {
                    Storage::disk('public')->delete('images/' . $item->post_image);
                }
            }

            $post = Post::whereIn('id', $posts_id_array);
            if($post->delete()) {
                return response()->json(['success' => 'Tag deleted successfully.']);
            } else {
                return response()->json(['error' => 'Tag deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
