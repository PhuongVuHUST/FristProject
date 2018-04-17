<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

      public function __construct()
    {
        // $this->middleware('auth:admin');
        // $this->middleware('can:posts.category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $category = Category::all();
        return view('categories.list',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        

         date_default_timezone_set("Asia/Ho_Chi_Minh");

        $date = date("YmdHis", time());

        $data = $request->all(); //Để lấy dữ liệu từ phía người dùng nhập vào
        

        $rules = [
            'name' => 'required|min:3|max:100',
            'slug' => 'required',
            
        ];

        $messages = [
            'name.required' => 'Tiêu đề không được bỏ trống!',
            'name.min'=>'Tên thể lạo phải có độ dài từ 3 cho đến 100',
            'slug.required' => 'Mô tả không được bỏ trống!',
            
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }
    
      
       $flag = Category::create($data);
       

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $category = Category::first();
        $posts = Post::all();
       
      return view('categories.detail',[
            'posts' => $posts,
            'category' => $category,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category::where('id',$id)->all();
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responseht
     */
    public function update(Request $request )
    {

       
        $this->validate($request,[
            'name' => 'required|unique:categories,name|min:3|max:100',
            'slug' => 'required',
            ],
            [
                'name.request'=>'Bạn chưa nhập tên category',
                'name.unique'=>'Tên category đã tồn tại',
                'name.min'=>'Tên category phải trog khoảng 3 đến 10 kí tự',
                'slug.required'=>'Slug không được để trống',
            ]);
       
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
       

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        // category::where('id',$id)->delete();
        // return redirect()->back();
        $id = $request->all()['category_id'];

        Category::find($id)->delete();

        return \Response::json([
            'error' => true,
        ]);
    }
}
