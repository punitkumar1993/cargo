<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Setting;
use App\Models\TermTaxonomy;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        //
    }

    public function get_setting($name)
    {
        $get_settings = Setting::get();
        $value = $get_settings->whereIn('name', $name)->first()->value;
        return $value;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $image = (Settings::get('ogimage')) ? route('ogi.display', Settings::get('ogimage')) :
        asset('img/cover.png');

        SEOTools::setTitle("Contact's Page");
        SEOTools::setDescription("Contact's Page");
        SEOTools::metatags()->setKeywords("Contact's Page");
        SEOTools::setCanonical(url("/contact"));
        SEOTools::opengraph()->setUrl(url("/contact"));
        SEOTools::opengraph()->setSiteName(Settings::get('company_name'));
        SEOTools::opengraph()->addImage($image);
        SEOTools::twitter()->setSite('@' . Settings::get('twitter'));
        SEOTools::twitter()->setTitle("Contact's Page");
        SEOTools::twitter()->setDescription("Contact's Page");
        SEOTools::opengraph()->setUrl(url("/contact"));
        SEOTools::twitter()->setImage($image);
        SEOTools::jsonLd()->setTitle("Contact's Page");
        SEOTools::jsonLd()->setDescription("Contact's Page");
        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setUrl(url("/contact"));
        SEOTools::jsonLd()->addImage($image);

        $getPosts = Post::wherePostType('post');
        $recentPosts = $getPosts->latest();
        $last_recentPost = $recentPosts->first()->post_title;
        $tag_count = TermTaxonomy::where('taxonomy', 'tag')->withCount('post')->orderBy('post_count', 'DESC')->get();

        return view(Settings::active_theme('page/contact'),compact('tag_count','recentPosts','last_recentPost'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email',
            'subject' => 'nullable',
            'message' => 'required',
            'status' => 'read',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $save = Contact::create($data);

        if ($save) {
            return response()->json([
                'status' => true,
                'data' => 'Message has been sent'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'data' => 'Message could not be sent'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeMagazine(Request $request)
    {
        // Setup the validator
        $rules = [
            'name'         => 'required',
            'email'        => 'required|email|unique:users,email',
            'organization' => 'required',
           // 'g-recaptcha-response' => 'required|captcha'
        ];
        $validator = Validator::make($request->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails()) {
            // 400 being the HTTP code for an invalid request.
            return response()->json(['status' => false, 'errors'  => $validator->getMessageBag()->toArray()], 400);
        }

        $password = Settings::randomPassword();
        $insertData = $request->validate($rules);
        $insertData['password'] = Hash::make($password);
        $insertData['username'] = 'magazine-user';

        $email = $request->email;

        $emailId = $request->email;

        /*Mail::send( 'frontend.magz.emails.magazine_email', $data, function($message)
        use ( $emailId ) {

            $message->to($emailId )
                ->subject('e-Magazine Subscribed | Cargo Trends')
                ->from( 'notifications@cargotrends.in', 'Cargo Trends' );
        });*/

        $html = view('frontend.magz.emails.magazine_email', compact('email','password'))->render();;

        $body = [
            'FromEmail' => Config::get('adminlte.mailJetFromEmail'),
            'FromName' => Config::get('adminlte.mailJetFromName'),
            'Subject' => "e-Magazine Subscribed | Cargo Trends",
            'Text-part' => strip_tags($html),
            'Html-part' => $html,
            'Recipients' => [['Email' => $emailId]]
        ];

        $result = Post::sendEmailMailJet($body);

        if (!$result['error']){
            $save = User::updateOrCreate(['email' => $request->email], $insertData)->assignRole('magazine-user');

            if ($save) {
                return response()->json(
                    [
                        'status' => true,
                        'data'   => 'Email has been sent with the login credential to access the magazines. Please check your Inbox.'
                    ]
                );
            }
        }

        return response()->json(
            [
                'status' => false,
                'data'   => 'Something went wrong! Please try again later.'
            ]
        );
    }
}
