<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use App\Comment;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function __construct() {
        
    }

    /*
        Load danh sách các bài viết đã được đăng lên trang blog
     */
    
    public function adminIndex() {

        $posts = Post::orderBy('id', 'DESC')->get();

        return view('posts.show',[
            'posts' => $posts,
        ]);
    }   

    /*
        Load danh sách các bài viết đang chờ được duyệt
     */
    public function adminDraftPosts() {

        $posts = Post::whereIn('status', [0,2])->orderBy('id','DESC')->get();

        $categories = Category::all();

        $tags = Tag::all();

        return view('posts.index',[
            'posts'      => $posts,
            'categories' => $categories,
            'tags'       => $tags
        ]);
    }

    /*
        Form thêm mới bài viết
     */
    public function adminPostCreate() {
        
        $categories = Category::all();

        return view('posts.create',[
            'categories' => $categories,
        ]);
    }

    /*
        Thêm mới bài viết và chờ duyệt
     */
    public function adminPostStore(Request $request) {

        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $date = date("YmdHis", time());

        $data = $request->all(); //Để lấy dữ liệu từ phía người dùng nhập vào

        $rules = [
            'title' => 'required',
            'subtitle' => 'required',
            'body' => 'required',
            'tags.*' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg',
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống!',
            'subtitle.required' => 'Mô tả không được bỏ trống!',
            'body.required' => 'Nội dung không được bỏ trống!',
            'tags.*.required' => 'Tags không được bỏ trống!',
            'category_id.required' => 'Danh mục không được bỏ trống!',
            'image.required' => 'image không được bỏ trống!',
            'image.mimes' => 'image phải là ảnh (jpg, jpeg, png)!',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }

        // $data['user_id'] = \Auth::user()->id;

        // $tags = $data['tags'];

        // unset($data['tags']);

        $data['slug'] = str_slug($data['title']);

        if ($request->hasFile('image')) {

            $extension = '.'.$data['image']->getClientOriginalExtension(); // Lấy ra đuôi ảnh của người dùng

            $file_name = md5($data['slug']).'_'. $date . $extension; // MD5 mã hóa theo slug của bài viết

            $data['image']->storeAs('upload/images',$file_name); 

            $data['image'] = 'upload/images/'.$file_name;
        }

        $flag = Post::create($data);

        // if (!empty($flag)) {

        //     foreach ($tags as $tag) {

        //         $tag = trim(preg_replace('/\s+/', ' ', $tag));

        //         $tag_id = Tag::where('slug',str_slug($tag))->first();

        //         if (empty($tag_id)) {

        //             $temp = [
        //                 'name' => $tag,
        //                 'slug' => str_slug($tag),
        //             ];

        //             $tag_id = Tag::create($temp);

        //         }

        //         $tag_id = $tag_id->id;

        //         $flag->tags()->attach($tag_id);
        //     }
        // }

        session()->flash('msg', '<script type="text/javascript">toastr.success("Thêm mới bài viết thành công! Vui lòng chờ bài viết được kiểm duyệt.")</script>');

        return redirect()->route('admin.posts.list');
    }

    /*
        Duyệt bài viết
     */
    public function adminDraftUpt(Request $request) {
        
        $post_id = $request->all();

        $post_id = $post_id['post_id'];

        Post::find($post_id)->update(['status' => 1]);

        return \Response::json([
            'error' => false,
            'message' => 'Đăng bài thành công'
        ]);
    }

    /*
        Form chỉnh sửa bài viết
     */
    public function adminPostEdit($slug) {

        $post = Post::where('slug',$slug)->first();

        $categories = Category::all();
        $tags = Tag::all();
        echo $tags->name;
        die;

        return view('posts.edit',[
            'post'=>$post,
            'categories'=>$categories,
            'tags'=>$tags,
        ]);
    }

    /*
        Lưu các chỉnh sửa bài viết
     */
    public function adminPostUpdate(Request $request) {

        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $date = date("YmdHis", time());

        $data = $request->all();

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'tags.*' => 'required',
            'category_id' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
        ];

        $messages = [
            'title.required' => 'Tiêu đề không được bỏ trống!',
            'description.required' => 'Mô tả không được bỏ trống!',
            'content.required' => 'Nội dung không được bỏ trống!',
            'tags.*.required' => 'Tags không được bỏ trống!',
            'category_id.required' => 'Danh mục không được bỏ trống!',
            'image.mimes' => 'image phải là ảnh (jpg, jpeg, png)!',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }

        $data['user_id'] = \Auth::user()->id;

        $data['slug'] = str_slug($data['title']);

        if ($request->hasFile('image')) {

            $extension = '.'.$data['image']->getClientOriginalExtension();

            $file_name = md5($data['slug']).'_'. $date . $extension;

            $data['image']->storeAs('upload/images',$file_name);

            $data['image'] = 'upload/images/'.$file_name;
        }

        $id = $data['id'];

        unset($data['id']);

        $tags = $data['tags'];

        unset($data['tags']);

        $data['status'] = 2;

        $post = Post::find($id);

        $post->update($data);

        $sync_tags = [];

        foreach ($tags as $tag) {

            $tag = trim(preg_replace('/\s+/', ' ', $tag));

            $tag_id = Tag::where('slug',str_slug($tag))->first();

            if (empty($tag_id)) {

                $temp = [
                    'name' => $tag,
                    'slug' => str_slug($tag),
                ];

                $tag_id = Tag::create($temp);

            }
            array_push($sync_tags, $tag_id->id);
        }

        $sync_tags = array_unique($sync_tags);

        $post->tags()->sync($sync_tags);

        session()->flash('msg', '<script type="text/javascript">toastr.success("Cập nhập bài viết thành công! Vui lòng chờ bài viết được kiểm duyệt.")</script>');

        return redirect()->route('posts.list');
    }

    /*
        Xóa bài viết
     */
    public function adminPostDelete(Request $request) {
        $id = $request->all()['post_id'];

        Post::destroy($id);

        return \Response::json([
            'error' => false,
        ]);
    }
}