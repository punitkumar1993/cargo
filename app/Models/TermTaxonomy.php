<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'term_id', 'taxonomy', 'description', 'parent'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'term_taxonomies';

    /**
     * Get the term record associated with the term_taxonomy.
     */
    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function post()
    {
        return $this->belongsToMany('App\Models\Post', 'term_relationships','term_taxonomy_id','post_id')->withTimestamps();
    }
}
