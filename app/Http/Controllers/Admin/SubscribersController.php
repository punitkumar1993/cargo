<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubscribersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Mews\Purifier\Facades\Purifier;

class SubscribersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(SubscribersDataTable $dataTable)
    {
        $this->authorize('read-ad');
        return $dataTable->render('admin.subscribers.index');
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $subscriber = Subscriber::find($request->id);
        $subscriber->unsubscribe = $request->unsubscribe;
        $subscriber->save();

        return response()->json(['success' => 'Subscription updated successfully.']);
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
            'email' => 'required|email|unique:newsletter_subscribes',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->route('subscriber.index')->withSuccess('Saving successfully!');
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
        $subscriber = Subscriber::findOrFail($id);
        return view('admin.subscribers.edit', compact('subscriber'));
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
            'email' => 'required|email|unique:newsletter_subscribes'.$id,
        ]);

        $data = [
            'email' => request('email')
        ];

        $subscriber = Subscriber::findOrFail($id);
        $subscriber->update($data);

        return redirect()->route('subscriber.index')->withSuccess('Updating successfully!');
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
                $ad = Subscriber::findOrFail($id);
                if ($ad->image != "noimage.png") {
                    Storage::disk('public')->delete('images/' . $ad->image);
                }
                Subscriber::destroy($id);
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
            $ads = Subscriber::whereIn('id', $ads_id_array)->get();

            foreach($ads as $item) {
                if ($item->image != "noimage.png") {
                    Storage::disk('public')->delete('images/' . $item->image);
                }
            }

            $ad = Subscriber::whereIn('id', $ads_id_array);
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
