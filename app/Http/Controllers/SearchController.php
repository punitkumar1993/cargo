<?php

namespace App\Http\Controllers;

use App\Helpers\Settings;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Vinkla\Hashids\HashidsManager;

class SearchController extends Controller
{

    protected $hashids;

    /**
     * SearchController constructor.
     * @param HashidsManager $hashids
     */
    public function __construct(HashidsManager $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $hashids = $this->hashids;
        $keyword = $request->get('q');

        $query = Post::postType('post');
        $results = $query->with('termtaxonomy')
                    ->where('post_title', 'like', "%".$keyword."%")
                    ->orWhere('post_content', 'like', "%".$keyword."%")
                    ->orWhere('post_image', 'like', "%".$keyword."%")
                    ->orWhereHas('termtaxonomy', function($query) use ($keyword){
                        $query->with('term')->whereHas('term', function($query) use ($keyword){
                            $query->where('name', $keyword);
                        });
                    })->
                    latest()->paginate(4);

        $countResults = count($results);

        $image = (Settings::get('ogimage')) ? route('ogi.display', Settings::get('ogimage')) :
            asset('img/cover.png');

        SEOTools::setTitle(Settings::get('sitename'). " - Search: " . $keyword);
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

        return view(Settings::active_theme('page/search'), compact('results','keyword','countResults','hashids'));
    }
}
