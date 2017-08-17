@extends('layout.dashboard')

@section('content')
<style type="text/css">
.modal-dialog, .modal-content {
    z-index: 1051 !important;
}
[ng\:cloak], [ng-cloak], .ng-cloak {
  display: none !important;
}
</style>
<div ng-controller="CategoryController" class="ng-cloak">
    <div class="col-xs-12">
          <div class="box">
            <div class="box-header"> 
            <div class="row">
                <div class="col-xs-6">
                    <button class="btn btn-success pull-left" data-toggle="modal" data-target="#create-user">Create Menu</button>
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

                <form method="POST" name="addProduct" role="form" ng-submit="saveAdd()">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create Menu</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Name : </strong>
                                <div class="form-group">
                                    <input ng-model="form.name" type="text" id="name" placeholder="Name" name="name" class="form-control" required />
                                </div>
                                <div ng-messages="addProduct.name.$error" ng-show="addProduct.name.$dirty">
                                    <p ng-message="required">Providing  name is mandatory.</p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Slug : </strong>
                                <div class="form-group">
                                    <input ng-model="form.slug" type="text" placeholder="Slug" name="slug" class="form-control ArticleSlug"  required/>
                                </div>
                                <div ng-messages="addProduct.slug.$error">
                                    <p ng-message="required">Slug must be checked before submit type tab in slug now.</p>
                                </div>
                                 <script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#name").slug();
                                    });
                                </script>
                            </div>                                                       
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <strong>Set Menu</strong>
                                <div class="radio">
                                      <label><input type="radio" value="0" name="is_menu" ng-model="form.is_menu">Not Menu</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" value ="1" name="is_menu"  ng-model="form.is_menu" checked="checked">Menu</label>
                                </div>
                            </div>

                        </div>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" ng-disabled="addProduct.$invalid" class="btn btn-primary">Submit</button>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="edit-data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" name="editProduct" role="form" ng-submit="saveEdit()">
                    <input ng-model="form.id" type="hidden" placeholder="Name" name="name" class="form-control" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Tag</h4>
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
                            <strong>Slug : </strong>
                            <div class="form-group">
                                <input ng-model="form.slug" type="text" placeholder="Slug" name="slug" class="form-control" required />
                            </div>
                             <div ng-messages="editProduct.slug.$error" ng-show="editProduct.slug.$dirty">
                                <p ng-message="required">Providing  slug is mandatory.</p>
                            </div>
                        </div>
                       
                         <div class="col-xs-12 col-sm-12 col-md-12">
                              
                              <strong>Set Menu</strong>
        
                                
                                    <div class="radio">
                                          <label><input type="radio" value="0" name="is_menu"  ng-model="form.is_menu" >Not Menu</label>
                                    </div>
                                    <div class="radio">
                                      <label><input type="radio" value ="1" name="is_menu" ng-model="form.is_menu">Menu</label>
                                    </div>
                                
                            </div>
                                    
                                
                        </div> 
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" ng-disabled="editProduct.$invalid" class="btn btn-primary create-crud">Submit</button>                
                    </div>
                   
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection  
