<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socialmedia extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */
  protected $table = 'socialmedia';

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'url', 'icon', 'slug',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function users()
  {
      return $this->belongsToMany('App\Models\User', 'user_socialmedia', 'socialmedia_id', 'user_id')->withTimestamps();
  }
}
