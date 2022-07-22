<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $page)
    {
        preg_match_all('/src="([^"]*)"/', $page->post_content, $result);

        if ($page->post_image) {
            if($page->post_image != "noimage.png"){
                $image = route('ogi.display', $page->post_image);
            } else {
                $image = asset('images/cover.png');
            }
        } else {
            if ($result[0]) {
                $image = route('ogi.display', last(explode('/', $result[1][0])));
            } else {
                $image = asset('images/cover.png');
            }
        }

        SEOTools::setTitle($page->post_title);

        if ($page->meta_description) {
            $description = $page->meta_description;
        } else {
            if ($page->post_summary) {
                $description = \Str::limit(strip_tags($page->post_summary), 160);
            } else {
                if ($page->post_content) {
                    $description = \Str::limit(strip_tags($page->post_content), 160);
                } else {
                    $description = Settings::get('sitedescription');
                }
            }
        }

        if ($page->meta_keyword) {
            $keyword = $page->meta_keyword;
        } else {
            $keyword = Settings::get('metakeyword');
        }

        SEOTools::setDescription($description);
        SEOTools::metatags()->setKeywords($keyword);
        SEOTools::setCanonical(Settings::get('siteurl'));

        OpenGraph::setTitle($page->post_title)
            ->setDescription($description)
            ->setType('article')
            ->setArticle([
                'published_time' => $page->created_at,
                'modified_time' => $page->updated_at,
                'author' => $page->user->name,
            ]);
        SEOTools::opengraph()->setUrl(url("/news/" . $page->post_name));
        SEOTools::opengraph()->setSiteName(Settings::get('company_name'));
        SEOTools::opengraph()->addImage($image);

        SEOTools::twitter()->setSite('@' . Settings::get('twitter'));
        SEOTools::twitter()->setTitle($page->post_title);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setUrl(url("/news/" . $page->post_name));
        SEOTools::twitter()->setImage($image);

        SEOTools::jsonLd()->setTitle($page->post_title);
        SEOTools::jsonLd()->setDescription($description);
        SEOTools::jsonLd()->setType('WebPage');
        SEOTools::jsonLd()->setUrl(url("/news/" . $page->post_name));
        SEOTools::jsonLd()->addImage($image);

        return view(Settings::active_theme('page/page'), compact('page'));
    }
}
