@extends('layouts.admin.master')

@section('head.css')
{{-- <link rel="stylesheet" href="{{asset('css/bootstrap-fileinput.css')}}"> --}}
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.min.css')}}">
{{-- <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}"> --}}
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css')}}">
@endsection

@section('content')

  <div class="content-wrapper">
    <section class="content-header">
 
      <div class="portlet light bordered">
          <div class="portlet-title">
              <div class="caption font-dark">
          
                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                  <span class="caption-subject bold uppercase"> Tạo mới Tag</span>
              </div>

          </div>
          <form action="#" method="POST" enctype="multipart/form-data" id="post-create">
              {{csrf_field()}}
              <div class="portlet-body">
                  <div class="row">
                      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                          <div class="form-group">
                              <label for="">Title(<span style="color: red">*</span>)</label>
                              <input type="text" class="form-control" id="title" placeholder="Tiêu đề" name="title">
                              @if ($errors->has('title'))
                                  <span class="errors">{{$errors->first('title')}}</span>
                              @endif
                          </div>
                          <div class="form-group">
                              <label for="">Slug (<span style="color: red">*</span>)</label>
                              <input type="text" class="form-control" id="slug" placeholder="" name="slug">
                              @if ($errors->has('slug'))
                                  <span class="errors">{{$errors->first('slug')}}</span>
                              @endif
                          </div>
                        
                      </div> 
                  </div>

              
            </div>
          </form>
      </div>
      </div>
      
    </section>
  </div>

@endsection

@section('footer.js')

{{-- <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script> --}}

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> --}}

{{-- <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script> --}}
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/tinymce.min.js')}}"></script>

{{-- <script src="{{url('js/prism.js')}}"></script> --}}
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/prism/1.13.0/prism.js')}}"></script>

{{-- <script src="{{url('js/bootstrap-fileinput.js')}}"></script> --}}
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js')}}"></script>

{{-- <script src="{{url('js/bootstrap-tagsinput.min.js')}}"></script> --}}
<script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js')}}"></script>

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