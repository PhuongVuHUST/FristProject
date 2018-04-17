@extends('layouts.admin.master')

@section('head.css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    <span class="caption-subject bold uppercase"> Cập nhật bài viết</span>
                </div>

            </div>
            <form action="{{ route('posts.update') }}" method="POST" enctype="multipart/form-data" id="post-update">
                    {{csrf_field()}}
                <input type="hidden" name="id" value="{{$post->id}}">
                <div class="portlet-body">
                    @if (count($post)>0)
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="">Tiêu đề (<span style="color: red">*</span>)</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{$post->title}}">
                                    @if ($errors->has('title'))
                                        <span class="errors">{{$errors->first('title')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Tóm tắt (<span style="color: red">*</span>)</label>
                                    <textarea class="form-control" name="subtitle" id="subtitle" cols="30" rows="4" placeholder="subtitle">{{$post->subtitle}}</textarea> 
                                    @if ($errors->has('subtitle'))
                                        <span class="errors">{{$errors->first('subtitle')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung (<span style="color: red">*</span>)</label>
                                    <textarea class="form-control" name="body" id="content" cols="30" rows="10" placeholder="Content" class="ckeditor" name="editor">
                                        {{$post->body}}</textarea> 
                                    @if ($errors->has('body'))
                                        <span class="errors">{{$errors->first('body')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                
                                {{-- categories --}}
                                {{-- <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-list font-green" aria-hidden="true"></i>
                                            <span class="caption-subject font-green bold">Danh mục</span>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="portlet-body">
                                        <select class="form-control" name="category_id">
                                            @if (count($categories)>0) @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{($category->id==$post->category_id)?'selected':''}}>{{$category->name}}</option>
                                            @endforeach @endif
                                        </select>
                                        @if ($errors->has('categories'))
                                            <span class="errors">{{$errors->first('categories')}}</span>
                                        @endif
                                    </div> --}}
                              {{--   </div> --}}
                                
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
                                                @if(empty($post->image))
                                                <img id="previewimg" src="{{asset('dist/img/admin.jpg')}}" alt="No Image" />
                                                @else
                                                <img id="previewimg" src="{{asset($post->image)}}" alt="No Image" />
                                                @endif 
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 200px;"> </div>
                                            <div style="margin-top: 10px;">
                                                <span class="input-group-btn">
                                                  <a id="lfm" data-input="thumbnail" data-preview="previewimg" class="btn btn-primary" value="{{ $post->image }}">
                                                    <input type="file" name="image" value="{{ $post->image }}">
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
                               {{--  <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-tags font-green" aria-hidden="true"></i>
                                            <span class="caption-subject font-green bold">Tags</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                         <div class="form-group">
                                            <select multiple name="tags[]" id="tags" data-role="tagsinput">
                                                @if(count($post->tags) > 0)
                                                @foreach($post->tags as $tag) 
                                                    <option value="{{$tags->name}}">{{$tags->name}}</option>
                                                @endforeach @endif
                                            </select>
                                            @if ($errors->has('tags'))
                                                <span class="errors">{{$errors->first('tags')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}
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
                    @endif
                </div>
            </form>
        </div>
     </section>
  <!-- /.content -->
</div>

@endsection

@section('footer.js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/jquery.tinymce.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/prism.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.min.js"></script>

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

    $('#post-update').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });
</script>

@endsection