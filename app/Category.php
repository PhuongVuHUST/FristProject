<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id','name','slug','create_at','updated_at'
    ];

    public function posts()
    {
    	// return $this->belongsToMany('App\Post','category_posts')->orderBy('created_at','DESC')->paginate(5);

        return $this->hasMany('App\Post','category_id','id');
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    // public function posts(){

    // }
}
