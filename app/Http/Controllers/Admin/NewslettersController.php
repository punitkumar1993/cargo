<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\NewslettersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Mews\Purifier\Facades\Purifier;

class NewslettersController extends Controller
{
    public $path;

    /**
     * AdvertisementController constructor.
     */
    public function __construct()
    {
        $this->path = storage_path('app/public/newsletters');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(NewslettersDataTable $dataTable)
    {
        $this->authorize('read-ad');
        return $dataTable->render('admin.newsletters.index');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $ad = Advertisement::find($request->id);
        $ad->active = $request->active;
        $ad->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeNewsStatus(Request $request)
    {
        $ad = Advertisement::find($request->id);
        $ad->news_active = $request->news_active;

        $ad->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|unique:banners|alpha_num',
            'width' => 'required',
            'height' => 'required'
        ]);

        $data = [
            'label' => Str::title($request->label),
            'active' => 'y',
            'size' => request('width') . 'x' . request('height'),
            'script' => Purifier::clean(request('script'))
        ];

        if ($request->space != 'null') {
            $data['space_id'] = $request->space;
        }

        if ($request->url != 'null') {
            $data['url'] = $request->url;
        } else {
            $data['url'] = "#";
        }

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path);
        }

        if ($request->hasFile('image')) {
            $getFileName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $getFileExtension = pathinfo($request->image->getClientOriginalExtension(), PATHINFO_FILENAME);
            $fileName = $getFileName . '-' . \Str::random(10) . '.' . $getFileExtension;
            $request->image->storeAs('ad', $fileName, 'public');
        } else {
            $fileName = 'noimage.png';
        }

        $data['image'] = $fileName;
        Advertisement::create($data);

        return redirect()->route('newsletter.index')->withSuccess('Saving successfully!');
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
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update-ad');
        $ad = Advertisement::findOrFail($id);

        if (!empty($ad->image)) {
            if ($ad->image === 'noimage.png') {
                $file = file_get_contents(public_path('img/noimage.png'));
                $type = File::mimeType(public_path('img/noimage.png'));
            } else {
                $exists = Storage::disk('public')->exists('ad/' . $ad->image);
                if ($exists) {
                    $file = Storage::get('public/ad/' . $ad->image);
                    $type = Storage::disk('public')->mimeType('ad/' . $ad->image);
                } else {
                    $ad = Advertisement::find($id);
                    $ad->update(['image'=>'noimage.png']);
                    $file = public_path('img/noimage.png');
                    $type = File::mimeType($file);
                }
            }
        } else {
            $file = file_get_contents(public_path('img/noimage.png'));
            $type = File::mimeType(public_path('img/noimage.png'));
        }

        $image = 'data:' . $type . ';base64,' . base64_encode($file);
        $size = explode('x', $ad->size);
        $width = $size[0];
        $height = $size[1];

        return view('admin.newsletters.edit', compact('ad','image','width','height'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update-ad');
        $validator = Validator::make($request->all(), [
            'label' => 'required|unique:ads|alpha_num',
            'width' => 'required',
            'height' => 'required'
        ]);

        $data = [
            'label' => Str::title($request->label),
            'active' => $request->active ? 'y' : 'n',
            'size' => request('width') . 'x' . request('height'),
            'script' => request('script')
        ];

        if ($request->url != 'null') {
            $data['url'] = $request->url;
        } else {
            $data['url'] = "#";
        }

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path);
        }

        $ad = Advertisement::findOrFail($id);

        if ($request->isimage == "true") {
            if ($request->hasFile('image')) {
                if (!empty($ad->image)) {
                    Storage::disk('public')->delete('images/' . $ad->image);
                }
                $getFileName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = pathinfo($request->image->getClientOriginalExtension(), PATHINFO_FILENAME);
                $fileName = $getFileName . '-' . \Str::random(10) . '.' . $getFileExtension;
                $data['image'] = $fileName;
                $request->image->storeAs('ad', $fileName, 'public');
            }
        } else {
            if (!empty($ad->image)) {
                Storage::disk('public')->delete('ad/' . $ad->image);
            }
            $data['image'] = 'noimage.png';
        }

        $ad->update($data);

        return redirect()->route('newsletter.index')->withSuccess('Updating successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-ad');
        if ($response->allowed()) {
                $ad = Advertisement::findOrFail($id);
                if ($ad->image != "noimage.png") {
                    Storage::disk('public')->delete('images/' . $ad->image);
                }
                Advertisement::destroy($id);
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
        $response = Gate::inspect('delete-ad');
        if ($response->allowed()) {
            $ads_id_array = $request->id;
            $ads = Advertisement::whereIn('id', $ads_id_array)->get();

            foreach($ads as $item) {
                if ($item->image != "noimage.png") {
                    Storage::disk('public')->delete('images/' . $item->image);
                }
            }

            $ad = Advertisement::whereIn('id', $ads_id_array);
            if($ad->delete()) {
                return response()->json(['success' => 'Deleted successfully.']);
            } else {
                return response()->json(['error' => 'Deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
