@extends('layout.dashboard')

@section('content')

<script type="text/javascript">
  tinymce.init({
    selector : "textarea#body",
    plugins : ["advlist autolink lists link image charmap print preview anchor template addimageleft " , "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste gambar"],
    toolbar : "insertfile undo redo addimageleft | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image gambar",
    content_css : '{{ env('APP_URL') }}css/bootstrap.min.css,{{ env('APP_URL') }}css/theme/assets/css/style-responsive.css,{{ env('APP_URL') }}css/backend_custome.css,{{ env('APP_URL') }}css/layout.css,{{ env('APP_URL') }}css/components.css',
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,
      
  }); 
  $(document).ready(function(){
       $('.openpopupberita').click(function(){
           $.fancybox.open([{
                  type:'iframe',
                  autoSize        :  false,
                  width:'85%',
                  href:'{{ env('APP_URL') }}viewlist',
             }])
      });
      @if(old('tipe') ==  2)  
        $(".video_url").show();
      @else
        $(".video_url").val("");
        $(".video_url").hide();

      @endif
      $('input:radio[name=tipe]').change(function() {
          var tipe_val = $(this).val();
          if(tipe_val == 1){
            $(".video_url").val("");
            $(".video_url").hide();
          }else if(tipe_val == 2){
            $(".video_url").show();
          }
      });
      $("#id_category").select2({
          placeholder: "Pilih salah satu category",
          initSelection: function(element, callback) {
               callback({id: "{{old('id_category')}}", text: "{{old('category_text')}}" });
                     
          },
          ajax: {
              url: "{{url('/categoryListData')}}",
              dataType: 'json',
              data: function (term, page) {
                  return {
                      q: term
                  };
              },
              results: function (data, page) {
                  return { results: data };
              } ,
              cache: false
          }
      }).on("change", function(e) {
         $('#category_text').val($('#s2id_id_category').text()); 
      });
       $("#id_topics").select2({
          placeholder: "Pilih salah satu topik",
          initSelection: function(element, callback) {
               callback({id: "{{old('id_topics')}}", text: "{{old('topics_text')}}" });
                     
          },
          ajax: {
              url: "{{url('/topicsListData')}}",
              dataType: 'json',
              data: function (term, page) {
                  return {
                      q: term
                  };
              },
              results: function (data, page) {
                  return { results: data };
              } ,
              cache: false
          }
      }).on("change", function(e) {
         $('#topics_text').val($('#s2id_id_topics').text()); 
      });
       $("#id_penulis").select2({
        placeholder: "silahkan pilih penulis",
        initSelection: function(element, callback){
            var id = $(element).val();
            
            if(id !== "") {
                $.ajax("{{url('/usersListData')}}", {
                    data: {id: id},
                    method:'GET',
                    dataType: "json"
                }).done(function(data) {
                    callback(data);
                });
            }
        },
        ajax: {
            url: "{{url('/usersListData')}}",
            dataType: 'json',
            data: function (term, page) {
                return {
                    q: term
                };
            },
            results: function (data, page) {
                return { results: data };
            } ,
            cache: false
        },
        tags: true
    }).on("change", function(e) {
      $('#penulis_text').val($('.select2-chosen').text()); 
    });
     $("#id_tags").select2({
        placeholder: "silahkan pilih tag",
        initSelection: function(element, callback){
            var id = $(element).val();
            
            if(id !== "") {
                $.ajax("{{url('/tagsListData')}}", {
                    data: {id: id},
                    method:'GET',
                    dataType: "json"
                }).done(function(data) {
                    callback(data);
                });
            }
        },
        ajax: {
            url: "{{url('/tagsListData')}}",
            dataType: 'json',
            data: function (term, page) {
                return {
                    q: term
                };
            },
            results: function (data, page) {
                return { results: data };
            } ,
            cache: false
        },
        tags: true
    }).on("change", function(e) {
      $('#tags_text').val($('.select2-chosen').text()); 
    });

  });
  function removedatapublish(){
  $('#list-path').html("");
}
function selectimageberita(id,name){
     var htmldata = "";
        htmldata += "<div id='path_"+id+"' >";
      htmldata += "<input type='hidden' name='id_image_cover' value='"+id+"'>";
      htmldata += "<div class='row boxdatapublish'>";
      htmldata += "<div class='col-xs-12'>"+'<img src="{{ env('APP_URL') }}pic/original/'+name+'"style="max-width:500px;max-height:500px;" />'+"</div>"
      htmldata += "<div class='col-xs-12' text-center><button class='btn btn-xs btn-danger btn-remove' onclick='removedatapublish("+id+")'>Hapus</button></div>  ";
      htmldata += "</div>";
      htmldata += "</div>";

        $('#list-path').html(htmldata);
}
  </script>
  <div class="col-xs-12">
          <div class="box">
            <div class="panel panel-default">
              <div class="panel-body">
                <form action="{{route('content.store')}}" method="post"  enctype="multipart/form-data">
                {{csrf_field()}}
                 <div class="form-group">
                       <input type="hidden" id="id_category" name="id_category" value="{{old('id_category')}}" class="form-input form-control" />
                       <input type="hidden" id="category_text" name="category_text" value="{{old('category_text')}}" class="form-input form-control" />     
                  </div>
                  {!! $errors->first('id_category', '<p class="help-block">:message</p>') !!}
                  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{old('title')}}">
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                  </div>
                  <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                    <input type="text" name="slug" class="form-control ArticleSlug" placeholder="Slug" value="{{old('slug')}}">
                    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
                  </div>
                  <script type="text/javascript">
                      $(document).ready(function(){
                          $("#title").slug();
                      });
                  </script>
                  <div class="form-group{{ $errors->has('summary') ? ' has-error' : '' }}">
                    <textarea class="form-control" rows="5" name="summary">{{old('summary')}}</textarea>
                    {!! $errors->first('summary', '<p class="help-block">:message</p>') !!}
                  </div>
                   <div class="form-group">
                       <input type="hidden" id="id_topics" name="id_topics" value="{{old('id_topics')}}" class="form-input form-control" />
                       <input type="hidden" id="topics_text" name="topics_text" value="{{old('topics_text')}}" class="form-input form-control" />     
                  </div>
                  {!! $errors->first('id_topics', '<p class="help-block">:message</p>') !!}
                   <div class="form-group">
                       <input type="hidden" id="id_penulis" name="id_penulis" value="{{old('id_penulis')}}" class="form-input form-control" />
                       <input type="hidden" id="penulis_text" name="penulis_text" value="{{old('penulis_text')}}" class="form-input form-control" />     
                  </div>
                  {!! $errors->first('id_penulis', '<p class="help-block">:message</p>') !!}
                  <div class="form-group">
                       <input type="hidden" id="id_tags" name="id_tags" value="{{old('id_tags')}}" class="form-input form-control" />
                       <input type="hidden" id="tags_text" name="tags_text" value="{{old('tags_text')}}" class="form-input form-control" />     
                  </div>
                  {!! $errors->first('id_tags', '<p class="help-block">:message</p>') !!}
                   <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <textarea class="form-control" rows="15" name="body" id="body">{{old('body')}}</textarea>
                    {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
                  </div>
                 
                 <div class="form-group">
                    
                       <label class="radio-inline">
                              <input  name="status" value="0" type="radio"  @if(!old('status')) checked @endif @if(old('status') ==  0) checked @endif>
                              Not Active
                      </label>
                      <label class="radio-inline">
                              <input name="status" value="1" type="radio" @if(old('status') ==  1) checked @endif>
                              Active
                     </label>
                 
                  </div>
                  <div class="form-group">
                    
                       <label class="radio-inline">
                              <input  name="tipe" value="1" type="radio"  @if(!old('tipe')) checked @endif @if(old('tipe') ==  1) checked @endif>
                              Berita
                      </label>
                      <label class="radio-inline">
                              <input name="tipe" value="2" type="radio" @if(old('tipe') ==  2) checked @endif>
                              Video
                     </label>
                 
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-4">
                      <input type="text" name="video_url" class="form-control video_url" placeholder="video url" value="{{old('video_url')}}">
                    </div>
                  </div>
                  <div class="form-group">
  
                      <div id="list-path">
                      </div>
                  </div>    
                  <div class="form-group">
                    
                     <a href="#" id="btn-berita" class="btn btn-primary openpopupberita">Pilih Gambar</a>
                    
                  </div>
                  {!! $errors->first('id_image_cover', '<p class="help-block">:message</p>') !!}
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                  </div>

                </form>
              </div>
            </div>
      </div>
</div>
@endsection  