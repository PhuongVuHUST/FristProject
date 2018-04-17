@extends('layouts.admin.master')
@section('head.css')
	<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
@endsection
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Blank page
      <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Examples</a></li>
      <li class="active">Blank page</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        {{-- <h3 class="box-title">Title</h3> --}}
        {{-- @can('posts.create', Auth::user()) --}}
          <a class=' btn btn-success' href="{{ route('posts.create') }}">Add New</a>
       {{--  @endcan --}}
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
          </div>
          <!-- /.box-header -->
            <div class="box-body">
             {{--  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Sub Title</th>
                  <th>Slug</th>
                  <th>Creatd At</th>
                  {{-- @can('posts.update',Auth::user()) --}}
                  {{-- <th>Action</th> --}}
                  {{-- @endcan --}}
                  {{--  @can('posts.delete', Auth::user()) --}}
                  {{-- <th>Delete</th> --}}
                 {{--  @endcan --}}
               {{--  </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                  <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->subtitle }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->created_at }}</td>

                    {{-- @can('posts.update',Auth::user()) --}}
                     {{--  <td>
                      	<a href="#" style="color: orange"><span class="glyphicon glyphicon glyphicon-eye-close"></span></a>
                      	<a href="{{ route('posts.edit', $post->slug) }}" style="color: blue"><span class="glyphicon glyphicon-edit"></span></a> --}} --}}
                    {{-- @endcan --}}

                    {{-- @can('posts.delete', Auth::user()) --}}
                    
                     {{--  <form id="delete-form-{{ $post->id }}" method="post" action="{{ route('posts.delete') }}" style="display: none" class="delete">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                      </form>
                          <a href="#" title="Delete" class=" delete">
                          <span class="glyphicon glyphicon-trash" style="color: red"></span></a>
                    </td>
                 {{--  @endcan --}}
               {{--    </tr>
                  @endforeach
                
                </tbody> --}} 
             {{--  </table> --}} 
               <table class="table table-striped table-bordered table-hover" id="posts-table">
        <thead>
            <tr>
               <th class="stl-column color-column">Id</th>
               <th class="stl-column color-column">Thumbnail</th>
               <th class="stl-column color-column" style="width: 25%">Tiêu đề</th>
               <th class="stl-column color-column">Người tạo</th>
               <th class="stl-column color-column">Danh mục</th>
               <th class="stl-column color-column">Ngày tạo</th>
               <th class="stl-column color-column">Trạng thái</th>
               <th class="stl-column color-column">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @if (count($posts)>0) @foreach ($posts as $post)
                <tr>
                    <td class="stl-column">{{$count++}}</td>
                    <td><img src="{{asset($post->image)}}" width="150px"></td>
                    <td>{{$post->title}}</td>
                    <td class="stl-column">{{$post->user->name}}</td>
                    <td class="stl-column">{{$post->category->name}}</td>
                    <td class="stl-column">{{date('d-m-Y H:i',strtotime($post->created_at))}}</td>
                    <td class="stl-column">
                      @if ($post->status == 1)
                        Đã đăng bài
                      @elseif ($post->status == 2)
                        Chỉnh sửa
                      @elseif ($post->status == 0)
                        Mới tạo
                      @endif
                    </td>
                    <td class="stl-column">
                        <a href="{{ route('detail-post',$post->slug) }}" class="btn btn-info">
                          <span class="glyphicon glyphicon glyphicon-eye-close" style="color: orange"></span>
                        </a>
                        @if (Request::is('admin/posts'))
                          <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-success">
                            <span class="glyphicon glyphicon-edit" style="color: blue"></span>
                          </a>    
                        @elseif (Request::is('admin/posts/draft'))  
                          <a href="" class="btn btn-success draftBtn" data-id="{{$post->id}}">Đăng bài</a> 
                        @endif
                        <a href="" class="btn btn-danger deleteBtn" data-id="{{$post->id}}"> 
                          <span class="glyphicon glyphicon-trash" style="color: red"></span>
                        </a>
                    </td>
                </tr>
            @endforeach 
            @else
                <h4>Chưa có bài viết nào!</h4>
            @endif
        </tbody>
    </table>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footer.js')
	<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
	<script>
		  $(function () {
		    $("#example1").DataTable();
  	});
    $(function(){

      // $('.example').on('click', .)
      $('.delete').click(function(e){
          e.preventDefault();
          var url = $(this).attr('action');
          console.log(url);

          swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
          },
          function(isConfirm){
            if (isConfirm){
              swal("Deleted!", "Your imaginary file has been deleted!", "success");
              window.location.href = url;
            } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
          });
        //    $.ajax({
        //     type: "GET",
        //     url: '/property_details',
        //     dataType: "json",
        //     data: {
        //         href: link
        //     }
        // }).done(function (data) {
        //     // I'm assuming that the 'property_details' table has a 'url' field?
        //     // If not, just replace this with whatever you need.
        //     if (data && data.hasOwnProperty('url')) {
        //         window.location = data.url;
        //     }
        // });
      })
    });
</script>
@endsection