<?php

namespace App\Services;

use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Term;

class Slug
{
    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title,'-');

        $allSlugs = $this->getRelatedSlugs($slug, $id);

        if (!$allSlugs->contains('post_name', $slug)) {
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('post_name', $newSlug)) {
                return $newSlug;
            }
        }

        // throw new \Exception('Can not create a unique slug');
    }


    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('post_name')->where('post_name', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }


    public function createSlugTag($title, $id = 0)
    {
        $slug = Str::slug($title, '-');

        $allSlugs = $this->getRelatedSlugsTag($slug, $id);

        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
    }

    protected function getRelatedSlugsTag($slug, $id = 0)
    {
        return Term::select('slug')
            ->whereHas('taxonomy', function ($query) {
                $query->where('taxonomy', 'tag');
            })
            ->where('slug', 'LIKE', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function createSlugCategory($title, $id = 0)
    {
        $slug = Str::slug($title, '-');

        $allSlugs = $this->getRelatedSlugsCategory($slug, $id);

        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
    }

    protected function getRelatedSlugsCategory($slug, $id = 0)
    {
        return Term::select('slug')
            ->whereHas('taxonomy', function ($query) {
                $query->where('taxonomy', 'category');
            })
            ->where('slug', 'LIKE', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
