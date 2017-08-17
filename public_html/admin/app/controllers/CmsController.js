
app.controller('UserController', function(dataFactory,$scope,$http,apiUrl){
 
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalItemsemp = {};

  $scope.totalItems = 0;
  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };

  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest(apiUrl+'/user?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalItems = data.total;
          });
      }else{
        dataFactory.httpRequest(apiUrl+'/user?page='+pageNumber).then(function(data) {
          console.log(data);
          $scope.data = data.data;
          $scope.totalItems = data.total;
        });
      }
  }

  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalItemsemp = $scope.totalItems;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalItems = $scope.totalItemsemp;
              $scope.libraryTemp = {};
          }
      }
  }
  $scope.saveAdd = function(){
    $http({
        method  : 'POST',
        url     : apiUrl+'/user',
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
        $scope.data.push(data);
        $scope.form.email = '';
        $scope.form.name = '';
        $scope.form.password = '';            
        $.toast({
            heading: 'Success',
            text: 'success',
            showHideTransition: 'slide',
            icon: 'success'
        });
         $(".modal").modal("hide");
         getResultsPage(1); 
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }
  // $scope.saveAdd = function(){
  //   dataFactory.httpRequest('user','POST',{},$scope.form).then(function(data) {
  
  //     $scope.data.push(data);
  //     $scope.form.email = '';
  //     $scope.form.name = '';
  //     $scope.form.password = '';
  //      alert("success");
  //     $(".modal").modal("hide");
  //      getResultsPage(1);
  //   });
  // }

  $scope.edit = function(id){
    dataFactory.httpRequest(apiUrl+'/user/'+id+'/edit').then(function(data) {
    	console.log(data);
      	$scope.form = data;
    });
  }
   $scope.saveEdit = function(){
    $http({
        method  : 'PUT',
        url     : apiUrl+'/user/'+$scope.form.id,
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
        $scope.form.email = '';
        $scope.form.name = '';
        $scope.form.password = '';
        $(".modal").modal("hide");       
        $scope.data = apiModifyTable($scope.data,data.id,data);
        $.toast({
            heading: 'Success',
            text: 'Success',
            showHideTransition: 'slide',
            icon: 'success'
        });
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }
  // $scope.saveEdit = function(){
  //   dataFactory.httpRequest(apiUrl+'/user/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
  //       alert("success");
  //       $scope.form.email = '';
  //       $scope.form.name = '';
  //       $scope.form.password = '';
  //     	$(".modal").modal("hide");
       
  //       $scope.data = apiModifyTable($scope.data,data.id,data);
  //   });
  // }

  $scope.remove = function(product,index){
    var result = confirm("Are you sure delete this user?");
   	if (result) {
      dataFactory.httpRequest(apiUrl+'/user/'+product.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
           getResultsPage(1);
           $.toast({
              heading: 'Success',
              text: 'success',
              showHideTransition: 'slide',
              icon: 'success'
          });
      });
    }
  }
   
});
app.controller('TagController', function(dataFactory,$scope,$http,apiUrl){
 
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalItemsemp = {};

  $scope.totalItems = 0;
  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };

  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest(apiUrl+'/tag?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalItems = data.total;
          });
      }else{
        dataFactory.httpRequest(apiUrl+'/tag?page='+pageNumber).then(function(data) {
          console.log(data);
          $scope.data = data.data;
          $scope.totalItems = data.total;
        });
      }
  }

  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalItemsemp = $scope.totalItems;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalItems = $scope.totalItemsemp;
              $scope.libraryTemp = {};
          }
      }
  }
  $scope.saveAdd = function(){
    $http({
        method  : 'POST',
        url     : apiUrl+'/tag',
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
        $scope.form.slug = '';
        $scope.form.name = '';
        $scope.form.meta_title = '';
        $scope.form.meta_description = '';
        $scope.form.is_popular = 0;      
        $.toast({
            heading: 'Success',
            text: 'success',
            showHideTransition: 'slide',
            icon: 'success'
        });
        $(".modal").modal("hide");
       getResultsPage(1);
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }
  // $scope.saveAdd = function(){
  //   dataFactory.httpRequest('tag','POST',{},$scope.form).then(function(data) {
  //     $scope.data.push(data);
  //     $scope.form.slug = '';
  //     $scope.form.name = '';
  //     $scope.form.meta_title = '';
  //     $scope.form.meta_description = '';
  //     $scope.form.is_popular = 0;
  //     alert("success");
  //     $(".modal").modal("hide");
  //      getResultsPage(1);
  //   });
  // }

  $scope.edit = function(id){
    dataFactory.httpRequest(apiUrl+'/tag/'+id+'/edit').then(function(data) {
      console.log(data);
        $scope.form = data;
    });
  }
  $scope.saveEdit = function(){
    $http({
        method  : 'PUT',
        url     : apiUrl+'/tag/'+$scope.form.id,
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
        $scope.form.slug = '';
        $scope.form.name = '';
        $scope.form.meta_title = '';
        $scope.form.meta_description = '';
        $scope.form.is_popular = 0;
        $(".modal").modal("hide");
        $scope.data = apiModifyTable($scope.data,data.id,data);
         $.toast({
            heading: 'Success',
            text: 'Success',
            showHideTransition: 'slide',
            icon: 'success'
        });
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }
  // $scope.saveEdit = function(){
  //   dataFactory.httpRequest(apiUrl+'/tag/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
  //       $scope.form.slug = '';
  //       $scope.form.name = '';
  //       $scope.form.meta_title = '';
  //       $scope.form.meta_description = '';
  //       $scope.form.is_popular = 0;
  //       alert("success");
  //       $(".modal").modal("hide");
  //       $scope.data = apiModifyTable($scope.data,data.id,data);
  //   });
  // }

  $scope.remove = function(product,index){
    var result = confirm("Are you sure delete this tag?");
    if (result) {
      dataFactory.httpRequest(apiUrl+'/tag/'+product.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
          $.toast({
              heading: 'Success',
              text: 'success',
              showHideTransition: 'slide',
              icon: 'success'
          });
      });
    }
  }
   
});
app.controller('TopicController', function(dataFactory,$scope,$http,apiUrl){
 
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalItemsemp = {};

  $scope.totalItems = 0;
  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };

  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest(apiUrl+'/topic?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalItems = data.total;
          });
      }else{
        dataFactory.httpRequest(apiUrl+'/topic?page='+pageNumber).then(function(data) {
          console.log(data);
          $scope.data = data.data;
          $scope.totalItems = data.total;
        });
      }
  }

  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalItemsemp = $scope.totalItems;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalItems = $scope.totalItemsemp;
              $scope.libraryTemp = {};
          }
      }
  }
  $scope.saveAdd = function(){
    $http({
        method  : 'POST',
        url     : apiUrl+'/topic',
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
          $scope.data.push(data);
          $scope.form.slug = '';
          $scope.form.name = '';
          $.toast({
            heading: 'Success',
            text: 'success',
            showHideTransition: 'slide',
            icon: 'success'
        });
        getResultsPage(1);
        $(".modal").modal("hide");
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }
  // $scope.saveAdd = function(){
  //   dataFactory.httpRequest('topic','POST',{},$scope.form).then(function(data) {
  //     $scope.data.push(data);
     
  //     $scope.form.name = '';
  //     $scope.form.slug = '';
  //     alert("success");
  //     $(".modal").modal("hide");
  //      getResultsPage(1);
  //   });
  // }

  $scope.edit = function(id){
    dataFactory.httpRequest(apiUrl+'/topic/'+id+'/edit').then(function(data) {
      console.log(data);
        $scope.form = data;
    });
  }
  $scope.saveEdit = function(){
    $http({
        method  : 'PUT',
        url     : apiUrl+'/topic/'+$scope.form.id,
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
         $.toast({
            heading: 'Success',
            text: 'Success',
            showHideTransition: 'slide',
            icon: 'success'
        });
        $scope.form.slug = '';
        $scope.form.name = '';
        $(".modal").modal("hide");
        $scope.data = apiModifyTable($scope.data,data.id,data);
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }

  // $scope.saveEdit = function(){
  //   dataFactory.httpRequest(apiUrl+'/topic/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
  //       $scope.form.name = '';
  //       $scope.form.slug = '';
  //       alert("success");
  //       $(".modal").modal("hide");
  //       $scope.data = apiModifyTable($scope.data,data.id,data);
  //   });
  // }

  $scope.remove = function(product,index){
    var result = confirm("Are you sure delete this topic?");
    if (result) {
      dataFactory.httpRequest(apiUrl+'/topic/'+product.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
          $.toast({
            heading: 'Success',
            text: 'success',
            showHideTransition: 'slide',
            icon: 'success'
        });
      });
    }
  }
   
});
app.controller('CategoryController', function(dataFactory,$scope,$http,apiUrl){
 
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalItemsemp = {};

  $scope.totalItems = 0;
  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };

  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest(apiUrl+'/category?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalItems = data.total;
          });
      }else{
        dataFactory.httpRequest(apiUrl+'/category?page='+pageNumber).then(function(data) {
          console.log(data);
          $scope.data = data.data;
          $scope.totalItems = data.total;
        });
      }
  }

  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalItemsemp = $scope.totalItems;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalItems = $scope.totalItemsemp;
              $scope.libraryTemp = {};
          }
      }
  }

  

  $scope.edit = function(id){
    dataFactory.httpRequest(apiUrl+'/category/'+id+'/edit').then(function(data) {
      console.log(data);
        $scope.form = data;
    });
  }
  $scope.saveAdd = function(){
        $http({
        method  : 'POST',
        url     : apiUrl+'/category',
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
          $scope.data.push(data);
          $scope.form.slug = '';
          $scope.form.name = '';
          $.toast({
            heading: 'Success',
            text: 'success',
            showHideTransition: 'slide',
            icon: 'success'
        });
        getResultsPage(1);
        $(".modal").modal("hide");
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }
  // $scope.saveAdd = function(){
  //   dataFactory.httpRequest('category','POST',{},$scope.form).then(function(data) {
  //     $scope.data.push(data);
  //     $scope.form.slug = '';
  //     $scope.form.name = '';
  //     $.toast({
  //       heading: 'Success',
  //       text: 'success',
  //       showHideTransition: 'slide',
  //       icon: 'success'
  //   });
  //     getResultsPage(1);
  //     $(".modal").modal("hide");
  //   });
  // }
  $scope.saveEdit = function(){
    $http({
        method  : 'PUT',
        url     : apiUrl+'/category/'+$scope.form.id,
        processData: false,
       
        data : $scope.form,
       
       }).success(function(data){
         $.toast({
            heading: 'Success',
            text: 'Success',
            showHideTransition: 'slide',
            icon: 'success'
        });
        $scope.form.slug = '';
        $scope.form.name = '';
        $(".modal").modal("hide");
        $scope.data = apiModifyTable($scope.data,data.id,data);
            
    }).error(function(data){
           $.each(data, function(index, value) {
               $.toast({
                  heading: 'Error',
                  text: value,
                  showHideTransition: 'slide',
                  icon: 'error'
              });
          }); 
    });
  }
  // $scope.saveEdit = function(){
  //   dataFactory.httpRequest(apiUrl+'/category/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
  //       $.toast({
  //         heading: 'Success',
  //         text: 'Success',
  //         showHideTransition: 'slide',
  //         icon: 'success'
  //     });
  //       $scope.form.slug = '';
  //       $scope.form.name = '';
  //       $(".modal").modal("hide");
  //       $scope.data = apiModifyTable($scope.data,data.id,data);
  //   });
  // }

  $scope.remove = function(product,index){
    var result = confirm("Are you sure delete this category?");
    if (result) {
      dataFactory.httpRequest(apiUrl+'/category/'+product.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
           $.toast({
            heading: 'Success',
            text: 'success',
            showHideTransition: 'slide',
            icon: 'success'
        });
      });
    }
  }
   
});
app.controller('ImageController', function(dataFactory,$scope,$http,apiUrl){
 
  $scope.data = [];
  $scope.libraryTemp = {};
  $scope.totalItemsemp = {};
  $scope.form = [];
  $scope.files = [];
  $scope.totalItems = 0;
  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };

  getResultsPage(1);
  function getResultsPage(pageNumber) {
      if(! $.isEmptyObject($scope.libraryTemp)){
          dataFactory.httpRequest(apiUrl+'/image?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
            $scope.data = data.data;
            $scope.totalItems = data.total;
          });
      }else{
        dataFactory.httpRequest(apiUrl+'/image?page='+pageNumber).then(function(data) {
          console.log(data);
          $scope.data = data.data;
          $scope.totalItems = data.total;
        });
      }
  }

  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
          if($.isEmptyObject($scope.libraryTemp)){
              $scope.libraryTemp = $scope.data;
              $scope.totalItemsemp = $scope.totalItems;
              $scope.data = {};
          }
          getResultsPage(1);
      }else{
          if(! $.isEmptyObject($scope.libraryTemp)){
              $scope.data = $scope.libraryTemp ;
              $scope.totalItems = $scope.totalItemsemp;
              $scope.libraryTemp = {};
          }
      }
  }

  // $scope.saveAdd = function(){
  //   dataFactory.httpRequest('image','POST',{},$scope.form).then(function(data) {
  //     $scope.data.push(data);
  //     $scope.form.email = '';
  //     $scope.form.name = '';
  //     $scope.form.password = '';
  //     $(".modal").modal("hide");
  //   });
  // }
  $scope.saveAdd = function() {
    $scope.form.image = $scope.files[0]; 
    $http({
        method  : 'POST',
        url     : apiUrl+'/image',
        processData: false,
        transformRequest: function (data) {
            var formData = new FormData();
            formData.append("path", $scope.form.image);
            formData.append("name", $scope.form.name);
            formData.append("description", $scope.form.description);
            formData.append("credit", $scope.form.credit);        
            formData.append("x1", $(".x1").val());  
            formData.append("y1",$(".y1").val());  
            formData.append("x2", $(".x2").val());  
            formData.append("y2", $(".y2").val());  
            return formData;  
        },  
        data : $scope.form,
        headers: {
               'Content-Type': undefined
        }
       }).success(function(data){
            if(data == 'success'){
                 $.toast({
                    heading: 'Success',
                    text: 'success',
                    showHideTransition: 'slide',
                    icon: 'success'
                });
                $scope.form.name = '';
                $scope.form.description = '';
                $scope.form.credit = '';
                $('.image_block').remove();
                 getResultsPage(1);
                $(".modal").modal("hide");
            }else{
                 $.toast({
                    heading: 'Error',
                    text: 'error',
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
       });

  };

 
$scope.saveEdit = function() {
    $scope.form.image = $scope.files[0]; 
   
    $http({
        method  : 'POST',
        url     : apiUrl+'/image/'+$scope.form.id,
        processData: false,
        transformRequest: function (data) {
            var formData = new FormData();
            formData.append("id", $scope.form.id);
            formData.append("path", $scope.form.image);
            formData.append("name", $scope.form.name);
            formData.append("description", $scope.form.description);
            formData.append("credit", $scope.form.credit);        
            formData.append("x1", $(".x1").val());  
            formData.append("y1",$(".y1").val());  
            formData.append("x2", $(".x2").val());  
            formData.append("y2", $(".y2").val());  
            return formData;  
        },  
        data : $scope.form,
        headers: {
               'Content-Type': undefined
        }
       }).success(function(data){
            if(data == 'success'){
                 $.toast({
                    heading: 'Success',
                    text: 'success',
                    showHideTransition: 'slide',
                    icon: 'success'
                });
                $scope.form.name = '';
                $scope.form.description = '';
                $scope.form.credit = '';
                $('.image_block').remove();
                $(".modal").modal("hide");
            }else{
                 $.toast({
                    heading: 'Error',
                    text: data,
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
    });

  };
  $scope.uploadedFile = function(element) {
    $scope.currentFile = element.files[0];
    var reader = new FileReader();

    reader.onload = function(event) {
      $scope.image_source = event.target.result
      $scope.$apply(function($scope) {
        $scope.files = element.files;
      });
    }
        reader.readAsDataURL(element.files[0]);
  }
  $scope.edit = function(id){
    dataFactory.httpRequest(apiUrl+'/image/'+id+'/edit').then(function(data) {
        $scope.form = data;
        $.toast({
              heading: 'Success',
              text: 'success',
              showHideTransition: 'slide',
              icon: 'success'
        });
    });
  }

  // $scope.saveEdit = function(){
  //   dataFactory.httpRequest(apiUrl+'/image/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
      
  //   });
  // }
 
  $scope.remove = function(product,index){
    var result = confirm("Are you sure delete this image?");
    if (result) {
      dataFactory.httpRequest(apiUrl+'/image/'+product.id,'DELETE').then(function(data) {
          $scope.data.splice(index,1);
          $.toast({
              heading: 'Success',
              text: 'success',
              showHideTransition: 'slide',
              icon: 'success'
          });
      });
    }
  }
   
});
