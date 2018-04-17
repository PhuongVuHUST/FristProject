<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
   // protected $fillable = array('url', 'title', 'description', 'content', 'image', 'blog', 'category_id');

   //  public static function prevBlogPostUrl($id) {
   //  	/*chúng tôi đang đặt hàng kết quả bằng cách sử dụng id theo thứ tự giảm dần để chúng tôi có thể có được số thấp nhất ngay sau khi 3*/
   //      $blog = static::where('id', '<', $id)->orderBy('id', 'desc')->first();

   //      return $blog ? $blog->url : '#';
   //  }

   //  public static function nextBlogPostUrl($id) {

   //      $blog = static::where('id', '>', $id)->orderBy('id', 'asc')->first();

   //      return $blog ? $blog->url : '#';
   //  }

   //  public function tags() {
   //  	/*định nghĩa rất nhiều mối quan hệ giữa các bài đăng và blog_tags sử dụng bảng trung gian blog_post_tags.*/
   //      return $this->belongsToMany('App\BlogTag','blog_post_tags','post_id','tag_id');
   //  }

   //   public function category() {
   //      return $this->hasOne('App\Category', 'id', 'category_id');
   //  }
    /*      ZENT       */

    protected $fillable = [
        'title', 'thumbnail', 'description','content','user_id','category_id', 'status','slug',
    ];
    public function tags() {
        return $this->belongsToMany('App\Tag','post_tags','post_id','tag_id')->withTimestamps();
    }

    public function user() {
        return $this->beLongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
