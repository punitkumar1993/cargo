<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MagazinesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\Post;

use App\Models\Setting;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;


class MagazineController extends Controller
{
    public $path;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->path = storage_path('app/public/magazines'); //magazine pdf storage path
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index(MagazinesDataTable $dataTable)
    {
        $getSettings = Setting::where('name', 'Default Magazine')->get();
        $defaultMagazine = $getSettings->first()->value;

//        $this->authorize('read-magazines');
        return $dataTable->render('admin.magazine.index', compact('defaultMagazine'));
    }

    /**
     * Update magazine accessibility
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $status = isset($request->status) && $request->status == "true" ? 1 : 0;

        // Update status to magazine setting
        $setting = Setting::updateOrCreate(
            ['name' => 'Default Magazine'],
            ['value' => $status]
        );

        if ($setting) {
            return response()->json([
                'message' => 'Status Updated Successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Error on updating status',
        ], 500);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.magazine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
//        $this->authorize('add-magazines');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'required|mimes:pdf',
            'image' => 'required|mimes:png,jpg,jpeg',
            'hightlight_one' => 'required|string|min:3|max:30',
            'hightlight_two' => 'required|string|min:3|max:30',
            'hightlight_three' => 'required|string|min:3|max:30',
            'hightlight_four' => 'required|string|min:3|max:30',
            'hightlight_five' => 'required|string|min:3|max:30',
            'hightlight_six' => 'required|string|min:3|max:30'
        ])->validate();

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path); //create path if not exist
        }

        $magazine = new Magazine();
        // if image available
        if ($request->hasFile('file')) {
            $magazine->file = Magazine::uploadPdfFile($request, 'file');
        }
        if ($request->hasFile('image')) {
            $magazine->image = Magazine::uploadPdfFile($request, 'image');
        }
        $magazine->name = $request->name;
        //$magazine->description = $request->description;
        $magazine->hightlight_one = $request->hightlight_one;
        $magazine->hightlight_two = $request->hightlight_two;
        $magazine->hightlight_three = $request->hightlight_three;
        $magazine->hightlight_four = $request->hightlight_four;
        $magazine->hightlight_five = $request->hightlight_five;
        $magazine->hightlight_six = $request->hightlight_six;
        $magazine->save();

        //$result = Post::sendMagazineLetter($request->name,$magazine->image);

        return redirect()->route('magazines.index')->withSuccess('Saving successfully!');
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
        //$this->authorize('update-ad');
        $magazine = Magazine::findOrFail($id);

        if (!empty($magazine->image)) {
            if ($magazine->image === 'noimage.png') {
                $file = file_get_contents(public_path('img/noimage.png'));
                $type = File::mimeType(public_path('img/noimage.png'));
            } else {
                $exists = Storage::disk('public')->exists('magazines/' . $magazine->image);
                if ($exists) {
                    $file = Storage::get('public/magazines/' . $magazine->image);
                    $type = Storage::disk('public')->mimeType('magazines/' . $magazine->image);
                } else {
                    $magazine = Magazine::find($id);
                    $magazine->update(['image'=>'noimage.png']);
                    $file = public_path('img/noimage.png');
                    $type = File::mimeType($file);
                }
            }
        } else {
            $file = file_get_contents(public_path('img/noimage.png'));
            $type = File::mimeType(public_path('img/noimage.png'));
        }

        $image = 'data:' . $type . ';base64,' . base64_encode($file);

        return view('admin.magazine.edit', compact('magazine','image'));
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
        //$this->authorize('add-magazines');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'hightlight_one' => 'required|string|min:3|max:30',
            'hightlight_two' => 'required|string|min:3|max:30',
            'hightlight_three' => 'required|string|min:3|max:30',
            'hightlight_four' => 'required|string|min:3|max:30',
            'hightlight_five' => 'required|string|min:3|max:30',
            'hightlight_six' => 'required|string|min:3|max:30'
        ])->validate();

        if (!File::exists($this->path)) {
            File::makeDirectory($this->path); //create path if not exist
        }
        
        $magazine = Magazine::findOrFail($id);

        // if image available
        if ($request->hasFile('file')) {
            $magazine->file = Magazine::uploadPdfFile($request, 'file');
        }
        
        if ($request->hasFile('image')) {
            $magazine->image = Magazine::uploadPdfFile($request, 'image');
        }
        
        $magazine->name = $request->name;
        //$magazine->description = $request->description;
        $magazine->hightlight_one = $request->hightlight_one;
        $magazine->hightlight_two = $request->hightlight_two;
        $magazine->hightlight_three = $request->hightlight_three;
        $magazine->hightlight_four = $request->hightlight_four;
        $magazine->hightlight_five = $request->hightlight_five;
        $magazine->hightlight_six = $request->hightlight_six;
        $magazine->save();

        //$result = Post::sendMagazineLetter($request->name,$magazine->image);

        return redirect()->route('magazines.index')->withSuccess('Updating successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        /*$response = Gate::inspect('delete-magazines');
        if ($response->allowed()) {*/
        Magazine::destroy($id);
        return response()->json(['success' => 'Deleted successfully.']);
        /*} else {
            return response()->json(['authorize' => 'This action is unauthorized.']);
        }*/
    }

    /*  public function readMagazine(){
          $this->authorize('read-roles');
  //        return $dataTable->render('admin.role.index');
      }*/

    /**
     * Open the digital version of magazine
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function readMagazine(Magazine $magazinId)
    {
        $filePath = 'magazines/' . $magazinId->file;
        $pdfLink = asset("storage/" . $filePath);

        return view('magzine', compact('pdfLink'));
    }

    /**
     * View news letter
     *
     * @throws Throwable
     */
    public function viewNewsLetter()
    {

        $data = Post::getNewsLetterData();

        $posts1 = $data['postData'];
        $posts2 = $data['postData2'];
        $emailId = 'test@example.com';
        echo view('frontend.magz.emails.news_subscribe_email', compact('posts1', 'posts2', 'emailId'))->render();
        exit();
    }


    public function sendNewsLetterEmail()
    {

        $result = Post::sendNewsLetter();
        dd($result['message']);
    }

    public function sendMagazineLetterEmail()
    {
        $result = Post::sendMagazineLetter();
        dd($result['message']);
    }

}
