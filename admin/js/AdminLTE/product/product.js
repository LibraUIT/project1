'use strict';
configApp.factory("ProductService", function($http) {
  return {
    getCategory : function()
    {
      var urlConfig = [baseUrl, 'admin','category_list'].join('/');
        return $http({
          method: 'POST',
          url: urlConfig,
          data: $.param({}),
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    },
  	save : function(sendData)
  	{
  		var urlConfig = [baseUrl, 'admin','product_save'].join('/');
	      return $http({
	        method: 'POST',
	        url: urlConfig,
	        data: $.param({ data : sendData}),
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	      });
  	},
  	list : function(page)
  	{
  		var urlConfig = [baseUrl, 'admin','product_list'].join('/');
	      return $http({
	        method: 'POST',
	        url: urlConfig,
	        data: $.param({ page : page }),
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	      });
  	},
  	deleteById : function(id)
    {
      var urlConfig = [baseUrl, 'admin','delete_product_get_by_id'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ id : id }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    getById : function(id)
    {
      var urlConfig = [baseUrl, 'admin','product_get_by_id'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ id : id}),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    updateById : function(data)
    {

      var urlConfig = [baseUrl, 'admin','product_update_get_by_id'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ data : data}),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }
  }
});
configControllers.controller('ProductController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', '$route', 'ProductService',
  function($scope, $rootScope, $routeParams, $location, $http, $state, $route, ProductService) {
    document.title = 'AdminLTE ';
    checkLogin();
    $scope.text_menu_product_manament = langArray.text_menu_product_manament;
    $scope.text_menu_dashboard = langArray.text_menu_dashboard;
    $scope.text_menu_create_new = langArray.text_menu_create_new;
    $scope.btn_back = langArray.btn_back;
    $scope.text_name = langArray.text_name;
    $scope.column_category = langArray.column_category;
    $scope.text_description = langArray.text_description;
    $scope.text_price = langArray.price;
    $scope.text_price_new = langArray.price_new;
    $scope.text_photo_gallery = langArray.text_photo_gallery;
    $scope.text_add_photo = langArray.text_add_photo;
    $scope.text_click_to_remove = langArray.text_click_to_remove;
    $scope.text_upload_status = langArray.text_upload_status;
    $scope.text_upload_new_image = langArray.text_upload_new_image;
    $scope.btn_save = langArray.btn_save;
    $scope.btn_cancle = langArray.btn_cancle;
    ProductService.getCategory().success(function(res){
      $scope.category = res;
    });
    $('#productfileupload').change(function(){
      showImage(this);
    });
    $scope.btnCancle = function()
    {
    	$location.path("/product_list");
    }
    $scope.btnBack = function()
	    	{
	    		$location.path("/product_list");
	    	}
    $scope.btnProductUpload = function()
    {
        
        if(productImg.length == 0)
        {
          $scope.message_error = langArray.message_error_upload_image;
        }else
        {
          var imgArr = $('.blah2');
          $.each(imgArr, function( index, value ) {
              var key = $(value).attr('id');
              if($(value).attr('style') == "display: none;")
              {
                for(var j = 0; j < productImg.length ; j++)
                {
                  if(j == key)
                  {
                      productImg[j] = null;
                  }
                }
              }
          });
          productImg = removeEmptyArrayElements(productImg);
          doUploadProduct(productImg);
        }
    }  
    $scope.btnCreateProduct = function()
    {
    	$scope.message_error = '';
      if($scope.title == undefined)
    	{
    	   $scope.message_error = langArray.message_error_name;	
    	}else if($scope.category_id == undefined)
      {
         $scope.message_error = langArray.message_error_choose_category; 
      }
      else if($scope.description == undefined)
    	{
    		 $scope.message_error = langArray.messgae_error_enter_description;  
    	}else if($scope.price == undefined)
      {
         $scope.message_error = langArray.message_error_enter_price; 
      }else if(validatePrice($scope.price) == false)
      {
        $scope.message_error = langArray.message_error_price_is_int; 
      }else if($scope.price_new && validatePrice($scope.price_new) == false)
      {
         $scope.message_error = langArray.message_error_price_is_int; 
      }else if(imageArray.length == 0)
      {
        $scope.message_error = langArray.message_error_upload_image; 
      }else
      {
         if(! $scope.price_new)
         {
            var data = {
              "name" : $scope.title,
              "category_id" : $scope.category_id,
              "description" : $scope.description,
              "price" : $scope.price,
              "images" : JSON.stringify(imageArray)
           };
         }else
         {
            var data = {
              "name" : $scope.title,
              "category_id" : $scope.category_id,
              "description" : $scope.description,
              "price" : $scope.price,
              "price_new" : $scope.price_new,
              "images" : JSON.stringify(imageArray)
           };
         }
         ProductService.save(data).success(function(res){
            productImg = [];
            imageArray = [];
            uploadComplete = 0;
            per = 0;
            status  = 0;
            $location.path("/product_list");
         });
         
      }
    }
}]);
configControllers.controller('ProductListController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'ProductService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, ProductService, $route) {
    document.title = 'AdminLTE ';
    checkLogin();
    $scope.text_menu_product_manament = langArray.text_menu_product_manament;
    $scope.text_menu_list_product = langArray.text_menu_list_product;
    $scope.text_menu_dashboard = langArray.text_menu_dashboard;
    $scope.text_featured_image = langArray.text_featured_image;
    $scope.comlumn_name = langArray.comlumn_name;
    $scope.column_category = langArray.column_category;
    $scope.price = langArray.price;
    $scope.price_new = langArray.price_new;
    $scope.column_date_created = langArray.column_date_created;
    $scope.comlumn_edit = langArray.comlumn_edit;
    $scope.comlumn_delete = langArray.comlumn_delete;
    $scope.btn_edit = langArray.btn_edit;
    $scope.btn_delete = langArray.btn_delete;
    $scope.text_page = langArray.text_page;
    $scope.modal_title = langArray.modal_title;
    $scope.modal_message_delete_comfirm = langArray.modal_message_delete_comfirm;
    $scope.btn_cancle = langArray.btn_cancle;
    $scope.currentPage = 1;
    $scope.baseUrl = baseUrl;
    ProductService.list($scope.currentPage).success(function(res){
             $scope.table = res.data;
             $scope.totalItems = 1;
             $scope.numPages = res.total_page;
             $scope.setPage = function (pageNo) {
                $scope.currentPage = pageNo;
              };
             $scope.maxSize = 5;
             $scope.bigTotalItems = res.total;
             $scope.bigCurrentPage = 1;
              $('li.ng-scope').on('click', function(){
                var page = parseInt($(this).find('a').text());
                if(page != $scope.currentPage){
                    $scope.currentPage = page;
                    ProductService.list($scope.currentPage).success(function(res){
                        var tableHtml = ' <tbody>'+
                                          '<tr>'+
                                            '<th style="text-align:center">'+$scope.text_featured_image+'</th>'+
                                            '<th>'+$scope.comlumn_name+'</th>'+
                                            '<th>'+$scope.column_category+'</th>'+
                                            '<th>'+$scope.price+'</th>'+
                                            '<th>'+$scope.price_new+'</th>'+
                                            '<th>'+$scope.column_date_created+'</th>'+
                                            '<th style="">'+$scope.comlumn_edit+'</th>'+
                                            '<th style="">'+$scope.comlumn_delete+'</th>'+
                                            '</tr>';
                        for(var i = 0; i < res.data.length; i++)
                        {
                            if(res.data[i].price_new == null)
                            {
                              var price_new = '';
                            }else
                            {
                              var price_new = res.data[i].price_new;
                            }
                            tableHtml += '<tr style="height:100px">';
                            tableHtml += '<td style="text-align:center"><img style="width:50px" src="'+baseUrl+'/'+res.data[i].image+'" ></td>';
                            tableHtml += '<td>'+res.data[i].name+'</td>';
                            tableHtml += '<td>'+res.data[i].category_name+'</td>';
                            tableHtml += '<td>'+res.data[i].price+'</td>';
                            tableHtml += '<td>'+price_new+'</td>';
                            tableHtml += '<td>'+res.data[i].date_created+'</td>';
                            tableHtml += '<td style="text-align:center"><a href="#/product/'+res.data[i].id+'"><button class="btn btn-primary btn-sm">'+$scope.btn_edit+'</button></</a></td>';
                            tableHtml += '<td style="text-align:center"><button id="'+res.data[i].id+'" ng-click="btnDelete('+res.data[i].id+')" class="btn btn-danger btn-sm btnDelete">'+$scope.btn_delete+'</button></td>';
                            tableHtml += '</tr>';
                        } 

                        $('.table').html(tableHtml); 
                        $('.btnDelete').on('click', function(){
                            $('#myModal').modal('show') ;
                            $scope.product_id = $(this).attr('id');
                        });                    
                    });
                }
              });
    });
    $scope.btnDelete = function(id)
      {
          $('#myModal').modal('show') ;
          $scope.product_id = id;
      }
    $scope.deleteSelected = function()
      {
          ProductService.deleteById($scope.product_id).success(function(res){
              $('#myModal').modal('hide') ;
              $('.fade').removeClass('in').addClass('out').hide();
              $route.reload();
              
          });
      }

}]).directive('editProduct', function(ProductService, $routeParams, $route, $location) {
  return {
    	restrict: 'A',
    	link : function(scope, elem, attrs)
	    {
	    	document.title = 'AdminLTE ';
        checkLogin();
        scope.text_menu_product_manament= langArray.text_menu_product_manament;
        scope.text_menu_dashboard = langArray.text_menu_dashboard;
        scope.edit_product = langArray.edit_product;
        scope.btn_back = langArray.btn_back;
        scope.text_name = langArray.text_name;
        scope.column_category = langArray.column_category;
        scope.text_description = langArray.text_description;
        scope.price = langArray.price;
        scope.price_new = langArray.price_new;
        scope.text_photo_gallery = langArray.text_photo_gallery;
        scope.text_click_to_remove = langArray.text_click_to_remove;
        scope.text_upload_new_image = langArray.text_upload_new_image;
        scope.text_add_photo = langArray.text_add_photo;
        scope.text_upload_status = langArray.text_upload_status;
        scope.btn_save = langArray.btn_save;
        scope.btn_cancle = langArray.btn_cancle;
	    	var pId = $routeParams.id;
	    	ProductService.getById(pId).success(function(res){
	    		if(res)
	    		{
	    			scope.baseUrl = baseUrl;
            scope.title = res.name;
            scope.category_id = res.category_id;
            scope.description = res.description;
            scope.price = res.price;
            scope.price_new = res.price_new;
            scope.imagesProduct = JSON.parse(res.images);
            scope.check = 1;
            imageArray = scope.imagesProduct;
            scope.removeUpload = function(item)
            {
                scope.imagesProduct = removeItemByValue(item, scope.imagesProduct, item);
                imageArray = scope.imagesProduct;
            }
	    		}
	    	});
        $('#productfileupload').change(function(){
            showImage(this);
        });
        $('#blah2').on('click', function(){
            $(this).attr('src', '').css({"display":"none"});
        });
        scope.btnProductUpload = function()
        {
            
            if(productImg.length == 0)
            {
              scope.message_error = langArray.message_error_select_image;
            }else
            {
              var imgArr = $('.blah2');
              $.each(imgArr, function( index, value ) {
                  var key = $(value).attr('id');
                  if($(value).attr('style') == "display: none;")
                  {
                    for(var j = 0; j < productImg.length ; j++)
                    {
                      if(j == key)
                      {
                          productImg[j] = null;
                      }
                    }
                  }
              });
              productImg = removeEmptyArrayElements(productImg);
              doUploadProduct(productImg);
            }
        }  
	    	scope.btnBack = function()
	    	{
	    		$location.path("/product_list");
	    	}
	    	scope.btnUpdateProduct = function()
	    	{
		    	 scope.message_error = '';
           if(scope.title == '')
           {
              scope.message_error = langArray.message_error_name;
           }else if(scope.category_id == undefined)
           {
              scope.message_error = langArray.message_error_choose_category;
           }else if(scope.description == '')
           {
              scope.message_error = langArray.messgae_error_enter_description;
           }else if(scope.price == '')
           {
              scope.message_error = langArray.message_error_enter_price; 
           }else if(validatePrice(scope.price) == false)
           {
              scope.message_error = langArray.message_error_price_is_int; 
           }else if(scope.price_new && validatePrice(scope.price_new) == false)
           {
              scope.message_error = langArray.message_error_price_is_int; 
           }else if(imageArray.length == 0)
           {
              scope.message_error = langArray.message_error_upload_image; 
           }else
           {
              if(! scope.price_new)
               {
                  var data = {
                    "id" : pId,
                    "name" : scope.title,
                    "category_id" : scope.category_id,
                    "description" : scope.description,
                    "price" : scope.price,
                    "images" : JSON.stringify(imageArray)
                 };
               }else
               {
                  var data = {
                    "id" : pId,
                    "name" : scope.title,
                    "category_id" : scope.category_id,
                    "description" : scope.description,
                    "price" : scope.price,
                    "price_new" : scope.price_new,
                    "images" : JSON.stringify(imageArray)
                 };
               }
               ProductService.updateById(data).success(function(res){
                  if(res == "TRUE")
                    {
                      productImg = [];
                      imageArray = [];
                      uploadComplete = 0;
                      per = 0;
                      status  = 0;
                      $route.reload();
                    }
               });
           }
        }
	    }
	}
});
var i = 0;
var productImg = [];
function showImage(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            if(productImg.indexOf(document.getElementById("productfileupload").files[0]) == -1)
            {
                productImg.push(document.getElementById("productfileupload").files[0]);
                $('#more').append('<img class=" blah2" width="190px" id="'+i+'" src="'+e.target.result+'" alt="your image" />');
                i++;
            }
        }
        reader.readAsDataURL(input.files[0]);

        setInterval(function(){
           $('.blah2').on('click', function(){
                $(this).attr('src', '').css({"display":"none"});
            });   
        }, 1000);
    }
}
var imageArray = [];
var uploadComplete = 0;
var per = 0;
var status  = 0;
function doUploadProduct(imgUpload)
{
  for(var i=0; i<productImg.length; i++)
  {
    var data = new FormData();
      data.append('filename', imgUpload[i].name);
      data.append('myfile', imgUpload[i]);
    $.ajax({
          url: [baseUrl, 'admin', 'postImgUploadProduct'].join('/'),
          type: 'POST',
          data: data,
          cache: false,
          processData: false, // Don't process the files
          contentType: false, // Set content type to false as jQuery will tell the server its a query string request
          success: function(data, textStatus, jqXHR)
          {
              if( imageArray.length > 0 &&imageArray.indexOf(data) == -1)
              {
                imageArray.push(data);
              }else
              {
                imageArray.push(data);
              }
              uploadComplete++;
              completeBarProduct(uploadComplete);
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
              // Handle errors here
              console.log('ERRORS: ' + textStatus);
              // STOP LOADING SPINNER
          }
      });  
  }
  
}
function completeBarProduct(complete)
{
   
   var total = productImg.length + 1;
   per = (complete%total)*100;
   if(per == 0)
   {
      status = 1;
      per = 100;
   }
   $('.progress-bar-success').css({"width":per+"%"});
}
function validatePrice(price)
{
  return price % 1 === 0;
}
