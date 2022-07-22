<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdvertisementsDataTable;
use App\DataTables\LatestEditionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;

use App\Models\LatestEdition;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Mews\Purifier\Facades\Purifier;

class LatestEditionController extends Controller
{
    public $path;

    /**
     * AdvertisementController constructor.
     */
    public function __construct()
    {
        $this->path = storage_path('app/public/edition');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(LatestEditionDataTable $dataTable)
    {
        $this->authorize('read-edition');
        return $dataTable->render('admin.edition.index');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $latestEdition = LatestEdition::find($request->id);
        $latestEdition->active = $request->active;
        $latestEdition->save();

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
        $this->authorize('update-edition');
        $latestEdition = LatestEdition::findOrFail($id);

        ini_set('memory_limit', '-1');

        if (!empty($latestEdition->image)) {
            if ($latestEdition->image === 'noimage.png') {
                $file = file_get_contents(public_path('img/noimage.png'));
                $type = File::mimeType(public_path('img/noimage.png'));
            } else {
                $exists = Storage::disk('public')->exists('edition/' . $latestEdition->image);
                if ($exists) {
                    $file = Storage::get('public/edition/' . $latestEdition->image);
                    $type = Storage::disk('public')->mimeType('edition/' . $latestEdition->image);
                } else {
                    $latestEdition = LatestEdition::find($id);
                    $latestEdition->update(['image'=>'noimage.png']);
                    $file = public_path('img/noimage.png');
                    $type = File::mimeType($file);
                }
            }
        } else {
            $file = file_get_contents(public_path('img/noimage.png'));
            $type = File::mimeType(public_path('img/noimage.png'));
        }

        $image = 'data:' . $type . ';base64,' . base64_encode($file);

        return view('admin.edition.edit', compact('latestEdition','image'));
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
        $this->authorize('update-edition');
        $validator = Validator::make($request->all(), [
            'label' => 'required|unique:ads|alpha_num',
        ]);

        $data = [
            'label' => Str::title($request->label),
//            'active' => $request->active ? 'y' : 'n',
        ];

        if ($request->url != 'null') {
            $data['url'] = $request->url;
        } else {
            $data['url'] = "#";
        }

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path);
        }

        $latestEdition = LatestEdition::findOrFail($id);

        if ($request->isimage == "true") {
            if ($request->hasFile('image')) {
                if (!empty($latestEdition->image)) {
                    Storage::disk('public')->delete('images/' . $latestEdition->image);
                }
                $getFileName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
                $getFileExtension = pathinfo($request->image->getClientOriginalExtension(), PATHINFO_FILENAME);
                $fileName = $getFileName . '-' . \Str::random(10) . '.' . $getFileExtension;
                $data['image'] = $fileName;
                $request->image->storeAs('edition', $fileName, 'public');
            }
        } else {
            if (!empty($latestEdition->image)) {
                Storage::disk('public')->delete('edition/' . $latestEdition->image);
            }
            $data['image'] = 'noimage.png';
        }

        $latestEdition->update($data);

        return redirect()->route('latest-edition.index')->withSuccess('Updating successfully!');
    }

}
