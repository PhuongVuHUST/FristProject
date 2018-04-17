@extends('layouts.admin.master')
@section('head.title')
  Add New Post
@endsection
@section('head.css')
{{-- <link rel="stylesheet" href="{{asset('css/bootstrap-fileinput.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.min.css')}}">
 --}}{{-- <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}"> --}}
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css')}}">
@endsection

@section('content')
 <div class="content-wrapper">
    <section class="content-header">

      <div class="portlet light bordered">
          <div class="portlet-title">
              <div class="caption font-dark">
                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                  <span class="caption-subject bold uppercase"> Tạo mới bài viết</span>
              </div>
             {{-- @include('includes.messages') --}}
          </div>
{{-- 
          @if(count($errors)>0)
            <div class="alert alert-danger">
              @foreach($errors->all() as $error )
              {{ $error <br> }}
              @endforeach
            </div>
          @endif --}}
          <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" id="post-create">
              {{csrf_field()}}
              <div class="portlet-body">
                  <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label for="">Tiêu đề (<span style="color: red">*</span>)</label>
                              <input type="text" class="form-control" id="title" placeholder="Tiêu đề" name="title">
                              @if ($errors->has('title'))
                                  <span class="errors">{{$errors->first('title')}}</span>
                              @endif
                          </div>
                          <div class="form-group">
                              <label for="">Status (<span style="color: red">*</span>)</label>
                              <input type="text" class="form-control" id="status" placeholder="Status" name="status">
                              @if ($errors->has('status'))
                                  <span class="errors">{{$errors->first('status')}}</span>
                              @endif
                          </div>
                          <div class="form-group">
                              <label for="">Tóm tắt (<span style="color: red">*</span>)</label>
                              <textarea class="form-control" name="subtitle" id="subtitle" cols="30" rows="4" placeholder="Description"></textarea> 
                              @if ($errors->has('subtitle'))
                                  <span class="errors">{{$errors->first('subtitle')}}</span>
                              @endif
                          </div>
                           <div class="form-group">
                                    <label for="">Nội dung (<span style="color: red">*</span>)</label>
                                    <textarea class="form-control" name="body" id="content" cols="30" rows="10" placeholder="Content" class="ckeditor" name="editor"></textarea> 
                                    @if ($errors->has('body'))
                                        <span class="errors">{{$errors->first('body')}}</span>
                                    @endif
                                </div>
                      </div>

                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          
                          {{-- categories --}}
                          <div class="portlet light bordered">
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class="fa fa-list font-green" aria-hidden="true"></i>
                                      <span class="caption-subject font-green bold">Danh mục</span>
                                  </div>
                              </div>
                              <div class="portlet-body">
                                  <select class="form-control" name="category_id">
                                      @if (count($categories)>0) @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach @endif
                                  </select>
                              </div>
                          </div>
                          
                          {{-- featured image  --}}
                          <div class="portlet light bordered">
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class="fa fa-picture-o font-green" aria-hidden="true"></i>
                                      <span class="caption-subject font-green bold">Ảnh thumbnail</span>
                                  </div>
                              </div>
                              <div class="portlet-body">
                                   <div class="fileinput fileinput-new" data-provides="fileinput">
                                      <div class="fileinput-new thumbnail" style="width: 250px; height: 200px;">
                                          <img id="previewimg" src="{{ asset('img/default-avatar.png') }}" alt="No Image" /> </div>
                                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 200px;"> </div>
                                      <div style="margin-top: 10px;">
                                          <span class="input-group-btn">
                                            <a id="lfm" data-input="thumbnail" data-preview="previewimg" class="btn btn-primary">
                                             <input type="file" name="image">
                                            </a>
                                          </span>
                                          @if ($errors->has('image'))
                                              <span class="errors">{{$errors->first('image')}}</span>
                                          @endif
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                          {{-- Tags --}}
                          <div class="portlet light bordered">
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class="fa fa-tags font-green" aria-hidden="true"></i>
                                      <span class="caption-subject font-green bold">Tags</span>
                                  </div>
                              </div>
                              <div class="portlet-body">
                                   <div class="form-group">
                                      <select multiple name="tags[]" id="tags" data-role="tagsinput">
                                      </select>
                                      @if ($errors->has('tags'))
                                          <span class="errors">{{$errors->first('tags')}}</span>
                                      @endif
                                  </div>
                              </div>
                          </div> 
                                     

                          <div class="portlet light bordered">
                              <div class="portlet-title">
                                  <div class="caption">
                                      <i class="fa fa-tags font-green" aria-hidden="true"></i>
                                      <span class="caption-subject font-green bold">Hành động</span>
                                  </div>
                              </div>
                              <div class="portlet-body">
                                   <div class="form-group">
                                      <button type="submit" id="add-post" class="btn btn-sm green btn-circle" style="width: 40%"> Lưu </button>                               
                                      <input type="reset" class="btn btn btn-sm btn-circle" style="width: 40%" value="Nhập lại">
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
              
          </div>
        </form>
      </div>
    </section>
  </div>

@endsection

@section('footer.js')


<script src="'https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/prism.js'"></script>

{{-- <script src="{{url('js/bootstrap-fileinput.js')}}"></script> --}}
<script src="'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js'"></script>

{{-- <script src="{{url('js/bootstrap-tagsinput.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>

    tinymce.init({
    selector: '#content',
    height: 500,
    theme: 'modern',
    menubar: false,
    autosave_ask_before_unload: false,
    plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern codesample"
    ],
    toolbar1: "newdocument | forecolor backcolor cut copy paste bullist numlist bold italic underline strikethrough| alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect  | searchreplace  | outdent indent | undo redo | link unlink anchor code | insertdatetime preview | table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | codesample",
    image_advtab: true,
    content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css'
    ],
    setup: function (ed) {
        ed.on('init', function (e) {
            ed.execCommand("fontName", false, "Tahoma");
        });
    },
    relative_urls: false,
    remove_script_host : false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = route_prefix + '?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Image manager',
        width : x * 0.9,
        height : y * 0.9,
        resizable : "yes",
        close_previous : "no"
      });
    }
   });

    $('#post-create').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });
</script>

@endsection