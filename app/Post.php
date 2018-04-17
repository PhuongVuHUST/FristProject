<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug','body','subtitle','user_id','category_id','image','status','posted_by'
    ];

    public function category() {
        
    	return $this->beLongsTo('App\Category', 'category_id', 'id');
    }

    public function tags() {
        /* Liên kết nhiều nhiều*/
        return $this->belongsToMany('App\Tag','post_tags','post_id','tag_id')->withTimestamps();
    }

    public function user() {
        /* Liên kết con->cha*/
        return $this->beLongsTo('App\User');
    }

    public function comments() {
        /* Liên kết 1- nhiều*/
        return $this->hasMany('App\Comment');
    }
}