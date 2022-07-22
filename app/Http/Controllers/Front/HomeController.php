<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Magazine;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Vinkla\Hashids\HashidsManager;
use DB;

class HomeController extends Controller
{

    protected $hashids;

    /**
     * HomeController constructor.
     * @param HashidsManager $hashids
     */
    public function __construct(HashidsManager $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $hashids = $this->hashids;

        $image = (Settings::get('ogimage')) ? route('ogi.display', Settings::get('ogimage')) :
        asset('img/cover.png');

        SEOTools::setTitle(Settings::get('sitename'));
        SEOTools::setDescription(Settings::get('sitedescription'));
        SEOTools::metatags()->setKeywords(Settings::get('metakeyword'));
        SEOTools::setCanonical(Settings::get('siteurl'));
        SEOTools::opengraph()->setTitle(Settings::get('sitename'));
        SEOTools::opengraph()->setDescription(Settings::get('sitedescription'));
        SEOTools::opengraph()->setUrl(Settings::get('siteurl'));
        SEOTools::opengraph()->setSiteName(Settings::get('company_name'));
        SEOTools::opengraph()->addImage($image);
        SEOTools::twitter()->setSite('@' . Settings::get('twitter'));
        SEOTools::twitter()->setTitle(Settings::get('sitename'));
        SEOTools::twitter()->setDescription(Settings::get('sitedescription'));
        SEOTools::twitter()->setUrl(Settings::get('siteurl'));
        SEOTools::twitter()->setImage($image);
        SEOTools::jsonLd()->setTitle(Settings::get('sitename'));
        SEOTools::jsonLd()->setDescription(Settings::get('sitedescription'));
        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setUrl(Settings::get('siteurl'));
        SEOTools::jsonLd()->addImage($image);

        $posts = Post::wherePostType('post')->wherePostStatus('publish')->paginate(5);

        return view(Settings::active_theme('page/home'), compact('posts','hashids'));
    }

    /**
     * Open the digital version of magazine
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function readMagazine(Magazine $magazinId){

        $filePath = 'magazines/'.$magazinId->file;
        $pdfLink = asset("storage/". $filePath);

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
    
    /**
     * View news letter
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewMagazine($magazinId)
    {
        $magazinData = Magazine::find($magazinId);
        $magazineName = $magazinData->name;
        $magazineImage = $magazinData->image;
        echo view('frontend.magz.emails.magazine_subscribe_email', compact('magazineName','magazineImage'))->render();
        exit();
    }
    
    /**
     * Total news
     * @return Application|View
     */
    public function getEvents()    
    {
        $events = (Post::where('post_type', '=','event')->select('post_name','post_title as title',DB::raw('SUBSTRING_INDEX(event_date_time,"-",1) as start'),DB::raw('SUBSTRING_INDEX(event_date_time,"-",-1) as end'))->get());
        $data = array();
        foreach($events as $i=>$event)
        {
            $data[$i]["title"] = $event->title;
            $data[$i]["start"] = date('Y-m-d',strtotime($event->start));
            $data[$i]["end"] = date('Y-m-d',strtotime($event->end)) ;
            $data[$i]["url"] = route('event.show',$event->post_name) ;
        }
        return response()->json($data);
    }
}
