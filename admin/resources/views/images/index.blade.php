@extends('layout.dashboard')

@section('content')
<style type="text/css">
.modal-dialog, .modal-content {
    z-index: 1051 !important;
}
.modal-dialog {
    width: 800px;
    margin: 30px auto;
}
[ng\:cloak], [ng-cloak], .ng-cloak {
  display: none !important;
}
</style>
<script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" type="text/css" />
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
<div ng-controller="ImageController" class="ng-cloak">
    <div class="col-xs-12">
          <div class="box">
            <div class="box-header"> 
            <div class="row">
                <div class="col-xs-6">
                    <button class="btn btn-success pull-left" data-toggle="modal" data-target="#create-user">Create New</button>
                </div>
                <div class="col-xs-6">
                     <div class="input-group input-group-sm">
                      <input type="text" name="table_search" ng-model="searchText" class="form-control pull-right" placeholder="Search">

                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default" ng-click="searchDB()"><i class="fa fa-search"></i></button>

                      </div>
                    </div>
                </div>
            </div>                             
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                     <tr>
                        <th>No</th>
                        <th>Name</th>
                       
                        <th width="220px">Action</th>
                    </tr>
                    <tr dir-paginate="value in data | productsPerPage:5" total-items="totalItems">
                        <td>[[ $index + 1 ]]</td>
                        <td>[[ value.name ]]</td>
                       
                        <td>
                        <button data-toggle="modal" ng-click="edit(value.id)" data-target="#edit-data" class="btn btn-primary">Edit</button>
                        <button ng-click="remove(value,$index)" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
              </table>
            </div>
            <div class="box-footer clearfix">
                <dir-pagination-controls class="pull-right" on-page-change="pageChanged(newPageNumber)" template-url="layout/dirPagination.html" ></dir-pagination-controls>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
    <!-- Create Modal -->
    <div class="modal" id="create-user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" name="addProduct" enctype="multipart/form-data" role="form" ng-submit="saveAdd()">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Image</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Name : </strong>
                                <div class="form-group">
                                    <input ng-model="form.name" type="text" placeholder="Name" name="name" class="form-control" required />
                                </div>
                                <div ng-messages="addProduct.name.$error" ng-show="addProduct.name.$dirty">
                                    <p ng-message="required">Providing  name is mandatory.</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>credit : </strong>
                                <div class="form-group">
                                    <input ng-model="form.credit" type="text" placeholder="credit" name="credit" class="form-control"  />
                                </div>

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <strong>Description : </strong>
                                <div class="form-group">
                                  <textarea ng-model="form.description" class="form-control" rows="5" name="description" ></textarea>
                                </div>
                            </div>
                           
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input ng-model="form.path" type="file" class="uploadImage" placeholder="path" name="path" onchange="angular.element(this).scope().uploadedFile(this)" />
                                </div>
                            </div> 
                             <img ng-src="[[image_source]]" style="display:none;" >

                       

                        </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" ng-disabled="addProduct.$invalid" class="btn btn-primary">Submit</button>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
  <div class="modal" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form method="POST" name="editProduct" enctype="multipart/form-data" role="form" ng-submit="saveEdit()">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Image</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Name : </strong>
                                <div class="form-group">
                                    <input ng-model="form.name" type="text" placeholder="Name" name="name" class="form-control" required />
                                </div>
                                <div ng-messages="editProduct.name.$error" ng-show="editProduct.name.$dirty">
                                    <p ng-message="required">Providing  name is mandatory.</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>credit : </strong>
                                <div class="form-group">
                                    <input ng-model="form.credit" type="text" placeholder="credit" name="credit" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <strong>Description : </strong>
                                <div class="form-group">
                                  <textarea ng-model="form.description" class="form-control" rows="5" name="description" ></textarea>
                                </div>
                            </div>
                           
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input ng-model="form.path" type="file" class="uploadImage" placeholder="path" name="path" onchange="angular.element(this).scope().uploadedFile(this)"  />
                                </div>
                            </div> 
                             <img ng-src="[[image_source]]" style="display:none;" required>

                       

                        </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" ng-disabled="editProduct.$invalid" class="btn btn-primary">Submit</button>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection  
