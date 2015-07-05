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
      var urlConfig = [baseUrl, 'admin','category_update_get_by_id'].join('/');
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
    document.title = 'AdminLTE | Tạo mới';
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
          $scope.message_error = "Vui lòng tải lên hình ảnh cho sản phẩm";
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
    	   $scope.message_error = "Vui lòng nhập vào tên của sản phẩm";	
    	}else if($scope.category_id == undefined)
      {
         $scope.message_error = "Vui lòng chọn category cho sản phẩm"; 
      }
      else if($scope.description == undefined)
    	{
    		 $scope.message_error = "Vui lòng nhập vào mô tả sản phẩm";  
    	}else if($scope.price == undefined)
      {
         $scope.message_error = "Vui lòng nhập vào giá cho sản phẩm"; 
      }else if(validatePrice($scope.price) == false)
      {
        $scope.message_error = "Gía của sản phẩm phải là số"; 
      }else if($scope.price_new && validatePrice($scope.price_new) == false)
      {
         $scope.message_error = "Gía mới của sản phẩm phải là số"; 
      }else if(imageArray.length == 0)
      {
        $scope.message_error = "Vui lòng tải lên hình ảnh cho sản phẩm"; 
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
            $location.path("/product_list");
         });
         
      }
    }
}]);
configControllers.controller('ProductListController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'ProductService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, ProductService, $route) {
    document.title = 'AdminLTE | Quản lý category';
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
                                            '<th style="text-align:center">Ảnh Đại Diện</th>'+
                                            '<th>Tên </th>'+
                                            '<th>Category</th>'+
                                            '<th>Giá</th>'+
                                            '<th>Giá Mới</th>'+
                                            '<th>Ngày Tạo</th>'+
                                            '<th style="">Chỉnh Sửa</th>'+
                                            '<th style="">Xóa</th>'+
                                            '</tr>';
                        for(var i = 0; i < res.data.length; i++)
                        {
                            tableHtml += '<tr style="height:100px">';
                            tableHtml += '<td style="text-align:center"><img style="width:50px" src="'+baseUrl+'/'+res.data[i].image+'" ></td>';
                            tableHtml += '<td>'+res.data[i].name+'</td>';
                            tableHtml += '<td>'+res.data[i].category_name+'</td>';
                            tableHtml += '<td>'+res.data[i].price+'</td>';
                            tableHtml += '<td>'+res.data[i].price_new+'</td>';
                            tableHtml += '<td>'+res.data[i].date_created+'</td>';
                            tableHtml += '<td style="text-align:center"><a href="#/product/'+res.data[i].id+'"><button class="btn btn-primary btn-sm">Chỉnh Sửa</button></</a></td>';
                            tableHtml += '<td style="text-align:center"><button ng-click="btnDelete('+res.data[i].id+')" class="btn btn-danger btn-sm">Xóa</button></td>';
                            tableHtml += '</tr>';
                        }                    
                        $('.table').html(tableHtml);                    
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
              
              $route.reload();
              $('#myModal').modal('hide') ;
              $('.fade').removeClass('in').addClass('out');
          });
      }

}]).directive('editProduct', function(ProductService, $routeParams, $route, $location) {
  return {
    	restrict: 'A',
    	link : function(scope, elem, attrs)
	    {
	    	document.title = 'AdminLTE | Chỉnh sửa sản phẩm';
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
              scope.message_error = "Vui lòng chọn hình ảnh cho sản phẩm";
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
	    	scope.btnEditCategory = function()
	    	{
		    	if(scope.title != '')
		    	{
		    		var data = {
		    			"id" : cateId,
		    			"name" : scope.title
		    		};
		    		CategoryService.updateById(data).success(function(res){
		    			if(res == "FALSE")
		    			{
		    				scope.message_error = 'Tên này đã tồn tại.';
		    			}else
		    			{
		    				$route.reload();
		    			}
		    		});
		    	}else
		    	{
		    		scope.message_error = "Vui lòng nhập vào tên của category";
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
