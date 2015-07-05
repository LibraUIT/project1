'use strict';
configApp.factory("CategoryService", function($http) {
  return {
  	save : function(sendData)
  	{
  		var urlConfig = [baseUrl, 'admin','category_save'].join('/');
	      return $http({
	        method: 'POST',
	        url: urlConfig,
	        data: $.param({ data : sendData}),
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	      });
  	},
  	list : function()
  	{
  		var urlConfig = [baseUrl, 'admin','category_list'].join('/');
	      return $http({
	        method: 'POST',
	        url: urlConfig,
	        data: $.param({}),
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	      });
  	},
  	deleteById : function(id)
    {
      var urlConfig = [baseUrl, 'admin','delete_category_get_by_id'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ id : id }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    getById : function(id)
    {
      var urlConfig = [baseUrl, 'admin','category_get_by_id'].join('/');
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
configControllers.controller('CategoryController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', '$route', 'CategoryService',
  function($scope, $rootScope, $routeParams, $location, $http, $state, $route, CategoryService) {
    document.title = 'AdminLTE | Tạo mới';
    $scope.btnCancle = function()
    {
    	$location.path("/category_list");
    }
    $scope.btnBack = function()
	    	{
	    		$location.path("/category_list");
	    	}
    $scope.btnCreateCategory = function()
    {
    	if($scope.title != undefined)
    	{
    		var data = {
    			"title" : $scope.title
    		};
    		CategoryService.save(data).success(function(res){
    			if(res == "FALSE")
    			{
    				$scope.message_error = 'Tên này đã tồn tại.';
    			}else
    			{
    				$location.path("/category_list");
    			}
    		});
    	}else
    	{
    		$scope.message_error = "Vui lòng nhập vào tên của category";
    	}
    }
}]);
configControllers.controller('CategoryListController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'CategoryService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, CategoryService, $route) {
    document.title = 'AdminLTE | Quản lý category';
    CategoryService.list().success(function(res){
    	if(res)
    	{
    		$scope.table = res;
    	}
    });
    $scope.btnDelete = function(id)
      {
          $('#myModal').modal('show') ;
          $scope.category_id = id;
      }
    $scope.deleteSelected = function()
      {
          CategoryService.deleteById($scope.category_id).success(function(res){
              $('#myModal').modal('hide') ;
              $('.fade').removeClass('in').addClass('out');
              $route.reload();
          });
      }
}]).directive('editCategory', function(CategoryService, $routeParams, $route, $location) {
  return {
    	restrict: 'A',
    	link : function(scope, elem, attrs)
	    {
	    	document.title = 'AdminLTE | Chỉnh sửa category';
	    	var cateId = $routeParams.id;
	    	CategoryService.getById(cateId).success(function(res){
	    		if(res)
	    		{
	    			scope.title = res.category_name;
	    		}
	    	});
	    	scope.btnBack = function()
	    	{
	    		$location.path("/category_list");
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