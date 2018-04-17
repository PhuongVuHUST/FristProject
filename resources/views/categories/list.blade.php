{{-- {{ dd($categories) }} --}}


@extends('layouts.admin.master')

@section('head.css')
{{-- <link rel="stylesheet" href="{{asset('css/bootstrap-fileinput.css')}}"> --}}
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}"> --}}
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
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
        
     
          <a class="btn btn-success" data-toggle="modal" href='#modal-id'>Add New</a>
          <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Add new Catagory</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="POST" role="form">
                      @csrf
                      {{-- <legend class="text-center">Add new Catagory</legend> --}}
                    
                      <div class="form-group">
                        <label for="name" >Name</label>
                        <input type="text" class="form-control " name="name" id="name" required="" placeholder="Input Name">
                      </div>
                      <div class="form-group">
                        <label for="slug" >Slug</label>
                        <input type="text" class="form-control " required=" " name="slug" id="slug" placeholder="Input Slug">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                
              </div>
            </div>
          </div>

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
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Category Name</th>
                          <th>Slug</th>
                          <th>Action</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($category as $category)
                          <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                              <td>
                                <a href="{{ route('category.show') }}" data-toggle="modal"><span class="glyphicon glyphicon glyphicon-eye-close" style="color: orange"></span></span></a>

                             

                                <a href="#edit" data-toggle="modal"><span class="glyphicon glyphicon-edit" style="color: blue"></span></a>
                                    <div class="modal fade" id="edit">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Add new Catagory</h4>
                                          </div>
                                          <div class="modal-body">

                                              <form action="{{ route('category.edit') }}" method="POST" role="form">
                                                @csrf
                                                {{-- <legend class="text-center">Add new Catagory</legend> --}}
                                              {{-- @foreach ($category as $cat) --}}
                                                <div class="form-group">
                                                  <label for="name" >Name</label>
                                                  <input type="text" class="form-control " name="name" id="name"  value="{{$category->name}}">
                                                   {{-- @if ($errors->has('name'))
                                                    <span class="errors">{{$errors->first('name')}}</span>
                                                    @endif --}}
                                                </div>
                                                <div class="form-group">
                                                  <label for="slug" >Slug</label>
                                                  <input type="text" class="form-control " name="slug" id="slug" value="{{$category->slug}}">
                                                  {{--  @if ($errors->has('slug'))
                                                    <span class="errors">{{$errors->first('slug')}}</span>
                                                    @endif --}}
                                                </div>
                                              {{--   @endforeach --}}
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </form>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                 <a href="" class="btn btn-default deleteBtn" data-id="{{$category->id}}">
                                    <span class="glyphicon glyphicon-trash" style="color: red"></span>
                                </a>
                              </td>
                            </tr>
                          </tr>
                        @endforeach
                        </tbody>
                       {{--  <tfoot>
                        <tr>
                          <th>S.No</th>
                          <th>Tag Name</th>
                          <th>Slug</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        </tfoot> --}}
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
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/tinymce.min.js')}}"></script>

{{-- <script src="{{url('js/prism.js')}}"></script> --}}
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/prism.js')}}"></script>

{{-- <script src="{{url('js/bootstrap-fileinput.js')}}"></script> --}}
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js')}}"></script>

{{-- <script src="{{url('js/bootstrap-tagsinput.min.js')}}"></script> --}}
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(function () {
        $("#example1").DataTable();
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
                  url: "{{route('category.delete')}}",
                  data: {
                    category_id : id,
                  },
                  success: function(res)
                  {
                    console.log(res);
                    $('#category_'+res).remove();
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