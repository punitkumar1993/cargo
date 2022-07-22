<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Models\TermTaxonomy;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Vinkla\Hashids\HashidsManager;

class CategoryController extends Controller
{
	use SEOToolsTrait;
    protected $hashids;

    /**
     * CategoryController constructor.
     * @param HashidsManager $hashids
     */
    public function __construct(HashidsManager $hashids)
    {
        $this->hashids = $hashids;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Term $term)
    {
        $term_taxonomy_id = $term->taxonomy->id;
        $termTaxonomy = TermTaxonomy::find($term_taxonomy_id);
        $paginate_posts = $termTaxonomy->post()->latest()->paginate(8);
        $hashids = $this->hashids;
		if($term->meta_title && $term->meta_description) {
			$this->seoTools($paginate_posts, $term,true);
		}
		else
		{
			$this->seoTools($paginate_posts, $term);
		}
        return view(Settings::active_theme('page/category'), compact(
            'term', 'paginate_posts', 'hashids'
        ));
    }

    /**
     * Total news
     * @return Application|View
     */
    public function news()
    {
        $paginate_posts = (new Post())->where('post_type', '=','post')->latest()->paginate(8);
        $hashids = $this->hashids;

        $this->seoTools($paginate_posts);
        $term = null;

        return view(Settings::active_theme('page/category'), compact(
            'term', 'paginate_posts', 'hashids'
        ));
    }

    /**
     * Total news
     * @return Application|View
     */
    public function events()
    {
        $paginate_posts = (new Post())->where('post_type', '=','event')->latest()->paginate(8);
        $hashids = $this->hashids;

        $this->seoTools($paginate_posts);
        $term = null;
		
		SEOTools::setTitle('Aviation Events And Magazine | Cargo Trends');
        SEOTools::setDescription('Get updated news about latest aviation events in our magazine.');


        return view(Settings::active_theme('page/events'), compact(
            'term', 'paginate_posts', 'hashids'
        ));
    }

    /**
     * Total mro
     * @return Application|View
     */
    public function mro()
    {
        $paginate_posts = (new Post())->where('post_type', '=','mro')->latest()->paginate(8);
        $hashids = $this->hashids;

        $this->seoTools($paginate_posts);
        $term = null;

        return view(Settings::active_theme('page/mro'), compact(
            'term', 'paginate_posts', 'hashids'
        ));
    }

    /**
     * Set tools
     *
     * @param $paginate_posts
     * @param string $termName
     */
    public function seoTools($paginate_posts, $term = '',$has_meta = false)
    {
        $image = (Settings::get('ogimage')) ? route('ogi.display', Settings::get('ogimage')) :
            asset('img/cover.png');

        $atttribute = ($paginate_posts->currentPage() == 1) ? "" : " - Page " . $paginate_posts->currentPage();
		if($has_meta)
		{
			SEOTools::setTitle($term->meta_title);
		} else {
        	SEOTools::setTitle(Settings::get('sitename') . " - Category: $term $atttribute");
		}
        SEOTools::setDescription($has_meta ? $term->meta_description : Settings::get('sitedescription'));
        SEOTools::metatags()->setKeywords(Settings::get('metakeyword'));
        SEOTools::setCanonical(Settings::get('siteurl'));
        SEOTools::opengraph()->setTitle($has_meta ? $term->meta_title : Settings::get('sitename'));
        SEOTools::opengraph()->setDescription($has_meta ? $term->meta_description : Settings::get('sitedescription'));
        SEOTools::opengraph()->setUrl(Settings::get('siteurl'));
        SEOTools::opengraph()->setSiteName(Settings::get('company_name'));
        SEOTools::opengraph()->addImage($image);
        SEOTools::twitter()->setSite('@' . Settings::get('twitter'));
        SEOTools::twitter()->setTitle($has_meta ? $term->meta_title : Settings::get('sitename'));
        SEOTools::twitter()->setDescription($has_meta ? $term->meta_description : Settings::get('sitedescription'));
        SEOTools::twitter()->setUrl(Settings::get('siteurl'));
        SEOTools::twitter()->setImage($image);
        SEOTools::jsonLd()->setTitle($has_meta ? $term->meta_title : Settings::get('sitename'));
        SEOTools::jsonLd()->setDescription($has_meta ? $term->meta_description : Settings::get('sitedescription'));
        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setUrl(Settings::get('siteurl'));
        SEOTools::jsonLd()->addImage($image);
    }
}
