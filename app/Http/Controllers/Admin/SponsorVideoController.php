<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SponsorVideoDataTable;
use App\Http\Controllers\Controller;
use App\Models\SponsorVideo;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Illuminate\View\View;

class SponsorVideoController extends Controller
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
     * @param SponsorVideoDataTable $dataTable
     * @return mixed
     * @throws AuthorizationException
     */
    public function index(SponsorVideoDataTable $dataTable)
    {
        $this->authorize('read-edition');

        return $dataTable->render('admin.sponsor.index');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $latestEdition = SponsorVideo::find($request->id);
        $latestEdition->active = $request->active;
        $latestEdition->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update-edition');
        $sponsorVideo = SponsorVideo::findOrFail($id);

        return view('admin.sponsor.edit', compact('sponsorVideo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update-edition');
        $validator = Validator::make($request->all(), [
            'label'        => 'required|unique:ads|alpha_num',
            'youtube_id' => 'required',
        ]);

        $data = [
            'label' => Str::title($request->label),
        ];

        if ($request->youtube_id != 'null') {
            $data['youtube_id'] = $request->youtube_id;
        } else {
            $data['youtube_id'] = "#";
        }
        $data['url'] = "#";
        $sponsorVideo = SponsorVideo::findOrFail($id);
        $sponsorVideo->update($data);

        return redirect()->route('sponsor-video.index')->withSuccess('Updating successfully!');
    }

}
