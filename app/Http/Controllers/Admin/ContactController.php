<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(ContactsDataTable $dataTable)
    {
        $this->authorize('read-contacts');
        return $dataTable->render('admin.contact.index');
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('read-contacts');
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'read']);
        return view('admin.contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $response = Gate::inspect('delete-contacts');
        if ($response->allowed()) {
            Contact::destroy($id);
            return response()->json(['success' => 'Message Contact Deleted successfully.']);
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
        $response = Gate::inspect('delete-contacts');
        if ($response->allowed()) {
            $contacts_id_array = $request->id;
            $contacts = Contact::whereIn('id', $contacts_id_array);
            if($contacts->delete()) {
                return response()->json(['success' => 'Deleted successfully.']);
            } else {
                return response()->json(['error' => 'Deleted not successfully.']);
            }
        } else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }
    }
}
