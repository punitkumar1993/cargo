<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GalleriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(GalleriesDataTable $dataTable)
    {
        $this->authorize('read-galleries');
        return $dataTable->render('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.gallery.create');
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
        $this->authorize('add-galleries');
        $validator = Validator::make($request->all(), [
            'file' => 'required|image',
        ])->validate();

        if ($request->hasFile('file')) {
            $file = $request->file->getClientOriginalName();
            $file0 = explode('.', $file);
            $filename = head($file0);

            $mimetype = $request->file->getClientMimeType();

            $imagedetails = getimagesize($request->file);

            $width = $imagedetails[0];
            $height = $imagedetails[1];

            $request->file->storeAs('images', $file, 'public');

            $url = Storage::url('images/' . $file);

            $meta = [
                'file' => $file,
                'type' => $request->file->extension(),
                'size' => $request->file->getSize(),
                'dimension' => $width . 'x' . $height,
                'attr_image_alt' => '',
            ];

            $json = json_encode($meta);
        }

        Post::create([
            'post_title' => Str::title($filename),
            'post_name' => $filename,
            'post_mime_type' => $mimetype,
            'post_type' => 'gallery',
            'post_content' => '',
            'post_status' => 'inherit',
            'post_author' => Auth::id(),
            'post_image' => '',
            'post_guid' => $url,
            'post_image_meta' => $json,
        ]);

        return redirect()->route('galleries.index')->withSuccess('Saving successfully!');
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
        $this->authorize('update-galleries');
        $gallery = Post::findOrFail($id);
        $meta = json_decode($gallery->post_image_meta);
        return view('admin.gallery.edit', compact('gallery', 'meta'));
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
        $this->authorize('update-galleries');

        $gallery = Post::find($id);
        $meta = json_decode($gallery->post_image_meta, true);
        $update_meta = Arr::set($meta, 'attr_image_alt', strip_tags($request->alt_text));
        $newmeta = json_encode($update_meta);

        $data = [
            'post_title' => strip_tags(Str::title($request->title)),
            'post_content' => Purifier::clean($request->description),
            'post_summary' => Purifier::clean($request->caption),
            'post_image_meta' => $newmeta
        ];

        Post::where('id', $id)->update($data);

        return redirect()->route('galleries.index')->withSuccess('Updating successfully!');
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
            $gallery = Post::find($id);
            $meta = json_decode($gallery->post_image_meta);
            $filename = $meta->file;
            Storage::disk('public')->delete('images/' . $filename);
            Post::destroy($id);
            return response()->json(['success' => 'Deleted successfully.']);
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
