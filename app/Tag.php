<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //  protected $fillable = [
    //     'id','name','slug','create_at','updated_at'
    // ];

     public function posts()
    {
    	return $this->belongsToMany('App\Post','post_tags')->orderBy('created_at','DESC')->paginate(5);
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
