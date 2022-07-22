<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Term extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug','meta_title','meta_description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taxonomy()
    {
        return $this->hasOne('App\Models\TermTaxonomy');
    }

    /**
     * @param $query
     */
    public function scopeCategory($query)
    {
        $query->whereHas('taxonomy', function($q) {
            $q->where('taxonomy', 'category');
        });
    }

    /**
     * @param $query
     */
    public function scopeTag($query)
    {
        $query->whereHas('taxonomy', function($q) {
            $q->where('taxonomy', 'tag');
        });
    }

    /**
     * @param $query
     * @param $name
     */
    public function scopeOfName($query, $name)
    {
        $query->where('name', $name);
    }

    /**
     * @param $query
     * @param $name
     */
    public function scopeSearchName($query, $name)
    {
        $query->where("name", "LIKE", "%$name%");
    }

    /**
     * Get all categories
     *
     * @return mixed
     */
    public static function getCategoried(){
        return self::whereHas("taxonomy", function($query){
            $query->where("taxonomy", "category");
        })->with("taxonomy")->where('name', '!=', 'News')->where('name', '!=', 'Events')->latest()->get();
    }
}
