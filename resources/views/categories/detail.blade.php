
@extends('layouts.admin.master')
@section('head.title')
    Show Article
@endsection
@section('head.css')
{{-- <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/themes/prism.min.css">
  {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"> --}}
{{-- <link rel="stylesheet" href="{{url('css/datatables.bootstrap.css')}}"> --}}

<style>

  span{
    line-height: 2 !important;
  }
  img {
    display: block !important;
    max-width: 100%;
  }
</style>
@endsection

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
    <div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-green uppercase">
            {{-- <i class="fa fa-file-text" aria-hidden="true"></i> <a class="font-green uppercase" href=""> Danh sách bài viết  </a></div> --}}
            <p><b style="font-size:30px;">Category </b> : {{ $category->name }}</p>
            
       
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6 col-lg-5">
            <a href="{{ route('posts.create') }}"><button class="btn green btn-circle"><i class="fa fa-plus"></i> Thêm mới</button></a>
        </div>
        {{-- <div class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
            <form method="get" action="">
                <input type="text" class="search-class form-control" id="search"  name="search"  placeholder="Nhập Thông Tin Tìm Kiếm">
            </form>
        </div> --}}
    </div>
    <div class="portlet-body">
         <table class="table table-striped table-bordered table-hover" id="example1">
        <thead>
            <tr>
               <th class="stl-column color-column">Id</th>
               <th class="stl-column color-column">Thumbnail</th>
               <th class="stl-column color-column" style="width: 25%">Title</th>
               {{-- <th class="stl-column color-column">Người tạo</th>
               <th class="stl-column color-column">Danh mục</th> --}}
               <th class="stl-column color-column">Created_at</th>
               <th class="stl-column color-column">Status</th>
               <th class="stl-column color-column">Action</th>
            </tr>
        </thead>
        <tbody>
           
            @if (count($posts)>0) 
            @foreach($category->posts as $post)
                <tr id="#post_{{ $post->id }}">
                    <td class="stl-column">{{ $post->id }}</td>
                    <td><img src="{{asset($post->image)}}" width="150px"></td>
                    <td>{{$post->title}}</td>
                   {{--  <td class="stl-column">{{$post->user->name}}</td>
                    <td class="stl-column">{{$post->category->name}}</td> --}}
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
                        <a href="{{ route('detail-post',$post->slug) }}" class="btn btn-default">
                            <span class="glyphicon glyphicon glyphicon-eye-close" style="color: orange"></span>
                        </a>
                        @if (Request::is('admin/posts'))
                          <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-default"><span class="glyphicon glyphicon-edit" style="color: blue"></span></a>    
                        @elseif (Request::is('admin/posts/draft'))  
                          <a href="" class="btn btn-default draftBtn" data-id="{{$post->id}}">Đăng bài</a> 
                        @endif
                        <a href="" class="btn btn-default deleteBtn" data-id="{{$post->id}}">
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
    </div>
    </section>
</div>

    @endsection

    @section('footer.js')

    @if (!empty(session('msg')))
      {!!session('msg')!!}
    @endif
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>

  <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  <script>
      $(function () {
        $("#example1").DataTable();
    });
  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/prism.min.js"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <script>
       $(function () {
          $("#example1").DataTable();
      });
    </script>

    <script type="text/javascript">

      $('.draftBtn').on('click', function(e){
        var post_id = $(this).data('id');

        e.preventDefault();
        swal({
          title: "Bạn có muốn đăng bài viết này không?",
          icon: "info",
          buttons: {
            cancel: 'Hủy',
            confirm: 'Đăng bài'
          }
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                  type: "POST",
                  url: "{{route('posts.draft.update')}}",
                  data: {
                    post_id : post_id,
                  },
                  success: function(res)
                  {
                    if(!res.error) {
                        toastr.success('Bài viết đã được đăng!');

                        setTimeout(function () {   
                            window.location.reload();
                        }, 1000)

                    }
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    toastr.error(thrownError);

                  }
            });
          } else {
            swal("Bạn đã hủy đăng bài viết!");
          }
        });
      });  

      $('.deleteBtn').on('click', function(e){
        var id = $(this).data('id');

        e.preventDefault();
        swal({
          dangerMode: true,
          title: "Bạn có muốn xóa viết này không?",
          icon: "warning",
          buttons: {
            cancel: 'Hủy',
            confirm: 'Xóa'
          }
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                  type: "POST",
                  url: "{{route('posts.delete')}}",
                  data: {
                    post_id : id,
                  },
                  success: function(res)
                  {
                    console.log(res);
                    $('#post_'+id).remove();
                    if(!res.error) {
                        toastr.success('Bài viết đã được xóa!');

                        setTimeout(function () {   
                            window.location.reload();
                        }, 1000)
                    }
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                    toastr.error(thrownError);

                  }
            });
          } else {
            swal("Bạn đã hủy xóa bài viết!");
          }
        });
      });
    </script>
@endsection