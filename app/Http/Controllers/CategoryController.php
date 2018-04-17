<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $date = date("YmdHis", time());

        $data = $request->all(); //Để lấy dữ liệu từ phía người dùng nhập vào

        $rules = [
            'name' => 'required',
            'slug' => 'required',
            
        ];

        $messages = [
            'name.required' => 'Ten không được bỏ trống!',
            'slug.required' => 'Mô tả không được bỏ trống!',
            
        ];
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }

    
        // $data['slug'] = str_slug($data['title']);

        $flag = Category::create($data);

        session()->flash('msg', '<script type="text/javascript">toastr.success("Thêm mới bài viết thành công! Vui lòng chờ bài viết được kiểm duyệt.")</script>');

        return redirect()->route('categories.list');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
