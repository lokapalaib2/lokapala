
<link href="{{ asset('css/bootstrap.min.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.dataTables.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/dataTables.bootstrap.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/selectize.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/selectize.bootstrap3.css') }}" rel="stylesheet">
<link href="{{ asset('css/theme/assets/css/zabuto_calendar.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/theme/assets/js/gritter/css/jquery.gritter.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/theme/assets/lineicons/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/theme/assets/css/style.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/theme/assets/css/style-responsive.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/jquery.Jcrop.min.css') }}" rel='stylesheet' type='text/css'>

<link href="{{ asset('css/jquery.fancybox.css') }}" rel='stylesheet' type='text/css'>
<link href="{{ asset('css/font-awesome.css') }}" rel='stylesheet' type='text/css'>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

    var oFReader = null;
    var image = null;
    var globalResizedWidth = '600';
    var jcrop_api, globalWidth, globalHeight, globalConfDimension;

    /* INIT */
    $('.image_block').remove();
    $(".uploadImage").val("");

    $(".uploadImage").change(function(){

        $(this).parent().find(".image_block").remove();
        $.when( createImageElement(this) ).done( cropImageElement(this) );
    });
   

    
    function createImageElement(obj) {
        var html = '<div class="image_block">';
        html += '<input type="hidden" class="x1" ng-model="form.x1" name="x1" value="0" />';
        html += '<input type="hidden" class="y1" ng-model="form.y1" name="y1" value="0" />';
        html += '<input type="hidden" class="x2" ng-model="form.x2" name="x2" value="0" />';
        html += '<input type="hidden" class="y2" ng-model="form.y2" name="y2" value="0" />';
        html += '<br><img class="image_preview" style="width:'+globalResizedWidth+'px" />';
        html += '</div>';
        $(obj).after(html);
    }
   
    function cropImageElement(obj) {
        var ext = getExtension($(obj).val());
        if(ext == "jpg" || ext == "jpeg" || ext == "png" || ext == "gif"){
            var dimensionconf = '1000x667';
            var separator = dimensionconf.split("x");
            var dimheight = separator[1];
            var dimwidth = separator[0];
            if(dimwidth != 'undefined' || dimheight != 'undefined'){
                doLoadCropping(obj, dimwidth, dimheight);
            }
            return false;
        }else{
            alert('Silahkan periksa kembali ekstensi file Anda.');
            $('.image_block').remove();
            $("#uploadImage").val("");
            return false;
        }
    }

    function doLoadCropping(obj, dimwidth, dimheight) {
        if(oFReader !=null){
            oFReader = null;
        }
        
        var min_width = dimwidth;
        var min_height = dimheight;
        var objFile = obj.files[0];
        var max_foto_mb = '2';
        var max_foto_byte = parseInt(max_foto_mb)*1048576; //convert MB to Byte
        
        if(objFile.size > max_foto_byte) {
            $(obj).parent().find(".image_block").remove();
            $(obj).val("");
            alert("File terlalu besar, silahkan upload file dengan ukuran yang lebih kecil");
            $('.image_block').remove();
            $("#uploadImage").val("");
        } else {
            // prepare HTML5 FileReader
            oFReader = new FileReader();
            image  = new Image();
            oFReader.readAsDataURL(objFile);
            
            oFReader.onload = function (_file) {
                image.src    = _file.target.result;
                image.onload = function() {
                        globalWidth = this.width;
                        globalHeight = this.height;
                        
                        $(obj).parent().find(".image_preview").attr("src", this.src);

                        if(globalWidth < min_width || globalHeight < min_height) {
                                $(obj).parent().find(".image_block").remove();
                                $(obj).val("");
                                alert("Dimensi gambar terlalu kecil, silahkan upload gambar dengan dimensi yang sesuai");
                        } else {
                            cropImage(globalWidth, globalHeight, min_width, min_height, $(obj).parent().find(".image_preview"));
                        }
                };

                image.onerror= function() {
                    alert('Invalid file type: '+ objFile.type);
                };     
                
            }
        }
    }

    function cropImage(width, height, minwidth, minheight, obj) {
        var resizedWidth = globalResizedWidth;
        var resizedHeight = (resizedWidth * height) / width;
        var resizedMinWidth = (minwidth * resizedWidth) / width;
        var resizedMinHeight = (minheight * resizedHeight) / height;
        
        if(minwidth != '' || minheight != ''){
            $(obj).Jcrop({
                setSelect: [ 0, 0, resizedMinWidth, resizedMinHeight ],
                minSize: [ resizedMinWidth, resizedMinHeight ],
                onSelect: updateCoords,
                allowSelect: false,
                bgFade: true,
                bgOpacity: 0.4,
                aspectRatio: minwidth / minheight
            },function(){
                jcrop_api = this;
            });
        }
    }
    function updateCoords(c){
        $('.x1').val(c.x);
        $('.y1').val(c.y);
        $('.x2').val(c.x2);
        $('.y2').val(c.y2);
        $('.w').val(c.w);
        $('.h').val(c.h);
    };
    function getExtension(filename) {
        return filename.split('.').pop().toLowerCase();
    }
});
</script>
<div class="row widget bg-primary">
        <div class="col-xs-12 widget-body">                             
                <div class="col-xs-12 text-right margintop8">
                    <?php if(isset($is_tinymce) && $is_tinymce == true){ ?>
                            <a href="{{ env('APP_URL') }}listtinymce" class="btn btn-xs btn-warning">List Gambar</a> 
                    <?php }else{ ?>
                            <a href="{{ env('APP_URL') }}viewlist" class="btn btn-xs btn-warning">List Gambar</a> 
                    <?php } ?>                                  
                </div>          
        </div>
</div>   
<div class="container">
   
    <div class="row">
        <form action="{{route('image.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Name : </strong>
            <div class="form-group">
                <input  type="text" placeholder="Name" name="name" class="form-control" required />
                 {!! $errors->first('name', '<p class="help-block">:message</p>') !!}

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>credit : </strong>
            <div class="form-group">
                <input  type="text" placeholder="credit" name="credit" class="form-control" required />
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <strong>Description : </strong>
            <div class="form-group">
              <textarea  class="form-control" rows="5" name="description" ></textarea>
            </div>
        </div>
       
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <input  type="file" class="uploadImage" placeholder="path" name="path"  />
                 {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
            </div>
        </div> 
        <div class="col-xs-12 col-sm-12 col-md-12">
         <input type="hidden" name="is_popup" value="1">
         <button type="submit"  class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
    

</div>
                