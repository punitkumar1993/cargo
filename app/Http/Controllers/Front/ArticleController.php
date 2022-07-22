<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Posts;
use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\TermTaxonomy;
use App\Traits\Table;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Http\Request;
use Vinkla\Hashids\HashidsManager;
use Vinkla\Hashids\Facades\Hashids;

class ArticleController extends Controller
{
    use Table;

    protected $hashids;

    /**
     * ArticleController constructor.
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
        $posts = Posts::posts()->latest()->paginate(8);

        $image = (Settings::get('ogimage')) ? route('ogi.display', Settings::get('ogimage')) :
        asset('img/cover.png');

        $atttribute = ($posts->currentPage() == 1) ? "" : " - Page " . $posts->currentPage();

        SEOTools::setTitle(Settings::get('sitename'). " - Latest News $atttribute");
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

        return view(Settings::active_theme('page/posts'), compact('posts','hashids'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        $hashids = $this->hashids;

        $exists = $post->termtaxonomy()->where('taxonomy', 'category')->exists();

        if ($exists) {
            $term_taxonomy_id = $post->termtaxonomy->where('taxonomy', 'category')->first()->id;
            $query = TermTaxonomy::find($term_taxonomy_id);
            $term_taxonomy = $query->post()->inRandomOrder()->get();
        } else {
            $term_taxonomy = Post::postType()->whereDoesnthave('termtaxonomy', function($query){
                $query->where('taxonomy','category');
            })->inRandomOrder()->get();
        }

        $countRelatedPost = count($term_taxonomy);

        $hits = $post->post_hits += 1;
        $post->update(['post_hits' => $hits]);
        $post->termtaxonomy->where('taxonomy', 'category');

        $checkTag = is_null($post->termtaxonomy->where('taxonomy', 'tag')->first());
        $checkCategory = is_null($post->termtaxonomy->where('taxonomy', 'category')->first());

        if ($post->termtaxonomy()->where('taxonomy', 'tag')->exists()) {
            $tags = $post->termtaxonomy()->where('taxonomy', 'tag')->get();

        } else {
            $tags = [];
        }

        preg_match_all('/src="([^"]*)"/', $post->post_content, $result);

        if (!empty($post->post_image)) {
            if (!empty($post->post_image)){
                $image = route('ogi.display', $post->post_image);
            } else {
                $image = asset('img/cover.png');
            }
        } else {
            if ($result[0]) {
                $image = route('ogi.display', last(explode('/', $result[1][0])));
            } else {
                $image = asset('img/cover.png');
            }
        }

        SEOTools::setTitle($post->post_title);

        if ($post->meta_description) {
            $description = $post->meta_description;
        } else {
            if ($post->post_summary) {
                $description = \Str::limit(strip_tags($post->post_summary), 160);
            } else {
                if ($post->post_content) {
                    $description = \Str::limit(strip_tags($post->post_content), 160);
                } else {
                    $description = Settings::get('sitedescription');
                }
            }
        }

        if ($post->meta_keyword) {
            $keyword = $post->meta_keyword;
        } else {
            if ($post->termtaxonomy()->where('taxonomy', 'tag')->exists()) {
                $tags = $post->termtaxonomy()->where('taxonomy', 'tag')->get();
                foreach ($tags as $tag) {
                    $tag_array[] = $tag->term->name;
                }
                $keyword = implode(", ", $tag_array);
            } else {
                $keyword = Settings::get('metakeyword');
            }
        }

        if ($post->termtaxonomy()->where('taxonomy', 'tag')->exists()) {
            $tags = $post->termtaxonomy()->where('taxonomy', 'tag')->get();
            foreach ($tags as $tag) {
                $tag_array[] = $tag->term->name;
            }
            $meta_tags = implode(", ", $tag_array);
        } else {
            $meta_tags = "";
        }

        SEOTools::setDescription($description);
        SEOTools::metatags()->setKeywords($keyword);
        SEOTools::setCanonical(Settings::get('siteurl'));

        OpenGraph::setTitle($post->post_title)
            ->setDescription($description)
            ->setType('article')
            ->setArticle([
                'published_time' => $post->created_at,
                'modified_time' => $post->updated_at,
                'author' => $post->user->name,
                'tag' => $meta_tags
            ]);
        SEOTools::opengraph()->setUrl(url("/news/".$post->post_name));
        SEOTools::opengraph()->setSiteName(Settings::get('company_name'));
        SEOTools::opengraph()->addImage($image);

        SEOTools::twitter()->setSite('@' . Settings::get('twitter'));
        SEOTools::twitter()->setTitle($post->post_title);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setUrl(url("/news/" . $post->post_name));
        SEOTools::twitter()->setImage($image);

        SEOTools::jsonLd()->setTitle($post->post_title);
        SEOTools::jsonLd()->setDescription($description);
        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setUrl(url("/news/" . $post->post_name));
        SEOTools::jsonLd()->addImage($image);

        return view(Settings::active_theme('page/single'), compact(
            'post', 'tags', 'term_taxonomy', 'hashids', 'countRelatedPost'
        ));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPopular()
    {
        $hashids = $this->hashids;
        $posts = Post::wherePostType('post')->wherePostStatus('publish')->orderBy('post_hits','DESC')->paginate(8);

        $image = (Settings::get('ogimage')) ? route('ogi.display', Settings::get('ogimage')) :
            asset('img/cover.png');

        $atttribute = ($posts->currentPage() == 1) ? "" : " - Page " . $posts->currentPage();

        SEOTools::setTitle(Settings::get('sitename'). " - All Popular News $atttribute");
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

        return view(Settings::active_theme('page/popular'), compact('posts', 'hashids'));
    }

    /**
     * @param Request $request
     */
    public function react(Request $request)
    {
        $hashids = Hashids::decode($request->id);
        $id = $hashids[0];
        $post = Post::findOrFail($id);
        $like = ($request->val == "true") ? $post->like += 1 : $post->like -= 1;
        $post->update(['like' => $like]);
    }
}
