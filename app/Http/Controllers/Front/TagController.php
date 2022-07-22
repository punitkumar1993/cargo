<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Models\TermTaxonomy;
use App\Models\Post;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

use Vinkla\Hashids\HashidsManager;

class TagController extends Controller
{
    protected $hashids;

    /**
     * TagController constructor.
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
    public function index(Term $term)
    {
        $term_taxonomy_id = $term->taxonomy->id;
        $termTaxonomy = TermTaxonomy::find($term_taxonomy_id);

        $posts = Post::wherePostType('post');

        $paginate = $termTaxonomy->post()->paginate(8);

        $hashids = $this->hashids;

        $image = (Settings::get('ogimage')) ? route('ogi.display', Settings::get('ogimage')) :
            asset('img/cover.png');

        $atttribute = ($paginate->currentPage() == 1) ? "" : " - Page " . $paginate->currentPage();

        SEOTools::setTitle(Settings::get('sitename'). " - Tag: $term->name $atttribute");
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

        return view(Settings::active_theme('page/tag'), compact(
            'term',
            'termTaxonomy',
            'paginate',
            'hashids'
        ));
    }
}
