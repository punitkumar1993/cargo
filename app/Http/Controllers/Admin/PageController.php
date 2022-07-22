<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Posts;
use App\Http\Controllers\Controller;
use App\DataTables\PagesDataTable;
use App\Models\Post;
use App\Services\Slug;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\Facades\Image;

use Mews\Purifier\Facades\Purifier;

class PageController extends Controller
{
    public $path;
    public $dimensionWidth;
    public $dimensionHeight;

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->path = storage_path('app/public/images');
        $this->dimensionWidth = '640';
        $this->dimensionHeight = '426';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(PagesDataTable $dataTable)
    {
        $this->authorize('read-pages');
        return $dataTable->render('admin.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('add-pages');
        return view('admin.page.create');
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
        $this->authorize('add-pages');
        request()->validate([
            'title' => 'required',
        ]);

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path);
        }

        $status = request()->has('draft') ? 'draft' : (request()->has('publish') ? 'publish' : NULL);

        if ($request->hasFile('image')) {
            $getFileName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $getFileExtension = pathinfo($request->image->getClientOriginalExtension(), PATHINFO_FILENAME);
            $fileName = $getFileName . '-' . \Str::random(10) . '.' . $getFileExtension;

            $img = Image::make($request->image);
            $resizeImage = $img->resize($this->dimensionWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->insert($resizeImage, 'center');
            $img->save($this->path . '/' . $fileName);
            $attr['post_image'] = $fileName;
        }

        $attr['post_title'] = strip_tags(request('title'));
        $attr['post_name'] = $slug->createSlug($request->title);
        $attr['post_summary'] = Purifier::clean(request('summary'));
        $attr['post_content'] = Purifier::clean(request('content'));
        $attr['post_status'] = $status;
        $attr['post_hits'] = 0;
        $attr['post_author'] = Auth::id();
        $attr['post_type'] = 'page';
        $attr['meta_description'] = strip_tags($request->meta_description);
        $attr['meta_keyword'] = strip_tags($request->meta_keyword);

        Post::create($attr);

        return redirect()->route('pages.index')->withSuccess('Saving successfully!');
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
        $this->authorize('update-pages');
        $page = Post::findOrFail($id);
        // file
        $image = Posts::getPostThumb($page->post_image);
        return view('admin.page.edit', compact('page','image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Slug $slug, $id)
    {
        $this->authorize('update-pages');
        $request->validate([
            'title' => 'required',
        ]);

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path);
        }

        $page = Post::findOrFail($id);

        if ($request->isimage == "true") {
            if ($request->hasFile('image')) {
                if (!empty($page->post_image)) {
                    Storage::disk('public')->delete('images/' . $page->post_image);
                }

                $getFileName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = pathinfo($request->image->getClientOriginalExtension(), PATHINFO_FILENAME);

                $fileName = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;
                $attr['post_image'] = $fileName;
                $img = Image::make($request->image);
                $resizeImage = $img->resize($this->dimensionWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->insert($resizeImage, 'center');
                $img->save($this->path . '/' . $fileName);
            }
        } else {
            if (!empty($page->post_image)) {
                Storage::disk('public')->delete('images/' . $page->post_image);
                $attr['post_image'] = null;
            }
        }

        $attr['post_title'] = strip_tags($request->title);
        if ($page->post_name != Str::slug($request->title)) {
            $attr['post_name'] = $slug->createSlug($request->title);
        };
        $attr['post_summary'] = Purifier::clean(request('summary'));
        $attr['post_content'] = Purifier::clean(request('content'));
        $attr['post_author'] = Auth::id();
        $attr['post_type'] = 'page';
        $data['post_status'] = $request->has('draft') ? 'draft' : ($request->has('publish') ? 'publish' : null);
        $attr['meta_description'] = strip_tags($request->meta_description);
        $attr['meta_keyword'] = strip_tags($request->meta_keyword);

        $page->update($attr);

        return redirect()->route('pages.index')->withSuccess('Updating successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-pages');
        if ($response->allowed()) {
            $post = Post::findOrFail($id);
            if ($post->post_image != "noimage.png") {
                Storage::disk('public')->delete('images/' . $post->post_image);
            }
            Post::destroy($id);
            return response()->json(['success' => 'Page deleted successfully.']);
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
        $response = Gate::inspect('delete-pages');
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
                return response()->json(['success' => 'Page deleted successfully.']);
            } else {
                return response()->json(['error' => 'Page deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
