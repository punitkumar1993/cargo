<?php

namespace App\Helpers;

use App\Models\Post;
use App\Models\Term;
use App\Models\TermTaxonomy;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Posts
{
    /**
     * @return mixed
     */
    public static function posts() {
        return Post::wherePostType('post')->wherePostStatus('publish');;
    }

    /**
     * @return mixed
     */
    public static function postCount() {
        return Post::wherePostType('post')->count();
    }

    /**
     * @return mixed
     */
    public static function pageCount() {
        return Post::wherePostType('page')->count();
    }

    /**
     * @return mixed
     */
    public static function popularPosts() {
//        return self::posts()->orderBy('post_hits', 'DESC');
        return self::posts()->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek())->orderBy('post_hits', 'DESC');
    }

    /**
     * @return mixed
     */
    public static function recentPosts() {
        return self::posts()->latest();
    }

    /**
     * @return mixed
     */
    public static function lastWeekPosts() {
        return self::posts()->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek())->orderBy('post_hits', 'DESC');
    }

    public static function next($post) {
        return self::posts()->where('id', '>', $post->id);
    }

    public static function previous($post) {
        return self::posts()->where('id', '<', $post->id);
    }

    /**
     * @return mixed
     */
    public static function tagCount() {
        return TermTaxonomy::where('taxonomy', 'tag')->withCount('post')->orderBy('post_count', 'desc')->get();
    }

    /**
     * @param $query
     * @return string
     */
    public static function getLinkCategory($query) {
        if ($query->termtaxonomy()->where('taxonomy', 'category')->exists()) {
            return $query->termtaxonomy->where('taxonomy', 'category')->first()->term->slug;
        } else {
            return '';
        }
    }

    /**
     * @param $query
     * @return string
     */
    public static function getCategory($query) {
        if (!empty($query->termtaxonomy->where('taxonomy', 'category')->first()->term->name)) {
            return $query->termtaxonomy->where('taxonomy', 'category')->first()->term->name;
        } else {
            return '';
        }
    }

    /**
     * @param $label
     * @return mixed
     */
    public static function label($label) {
        $term_id = Term::whereSlug($label)->first()->id;
        $term_taxonomy_id = TermTaxonomy::whereTermId($term_id)->first()->id;
        $termTaxonomy = TermTaxonomy::find($term_taxonomy_id);
        return $termTaxonomy->post()->latest();
    }

    /**
     * @param $image
     * @return string
     */
    public static function postThumb($image) {
        $path = storage_path('app/public/images');
        $dimensionWidth = '640';

        $getFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $getFileExtension = pathinfo($image->getClientOriginalExtension(), PATHINFO_FILENAME);
        $fileName = $getFileName . '-' . Str::random(10) . '.' . $getFileExtension;
        $img = Image::make($image);
        $resizeImage = $img->resize($dimensionWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->insert($resizeImage, 'center');
        $img->save($path . '/' . $fileName);

        return $fileName;
    }

    /**
     * @param $image
     * @return string
     */
    public static function getPostThumb($image) {
        if (empty($image)) {
            $file = file_get_contents(public_path('img/noimage.png'));
            $type = File::mimeType(public_path('img/noimage.png'));
        } else {
            $exists = Storage::disk('public')->exists('images/' . $image);
            if (!$exists) {
                $file = public_path('img/noimage.png');
                $type = File::mimeType($file);
            } else {
                $file = Storage::get('public/images/' . $image);
                $type = Storage::disk('public')->mimeType('images/' . $image);
            }
        }
        return 'data:' . $type . ';base64,' . base64_encode($file);
    }

    /**
     * @param $post_content
     * @param $post_image
     * @return string
     */
    public static function getImage($post_content, $post_image) {
        preg_match_all('/src="([^"]*)"/', $post_content, $result);

        if (!empty($post_image)) {
            if (!empty($post_image)){
                $image = route('post.image', $post_image);
            } else {
                $image = asset('img/noimage.png');
            }
        } else {
            if ($result[0]) {
                if(Storage::disk('public')->exists('images/' . last(explode('/', $result[1][0])))){
                    $image = route('post.image', last(explode('/', $result[1][0])));
                }else{
                    $image = asset('img/noimage.png');
                }
            } else {
                $image = asset('img/noimage.png');
            }
        }
        return $image;
    }
}
