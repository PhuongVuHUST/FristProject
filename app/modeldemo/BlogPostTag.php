<?php

	/*Đây là mô hình cho bảng trung gian blog_post_tags. Nó không có bất kỳ logic đặc biệt*/
namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPostTag extends Model
{
    protected $fillable = array('post_id', 'tag_id');
}
