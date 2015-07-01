'use strict';
configApp.factory("AboutPageService", function($http) {
  return {
  	save : function(sendData)
  	{
  		var urlConfig = [baseUrl, 'admin','about_page_save'].join('/');
	      return $http({
	        method: 'POST',
	        url: urlConfig,
	        data: $.param({ data : sendData}),
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	      });
  	},
    user : function(sendData)
    {
      var urlConfig = [baseUrl, 'admin','lang'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ lang : sendData}),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    getAboutPage : function()
    {
      var urlConfig = [baseUrl, 'admin','get_about_page'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    server : function()
    {
      var urlConfig = [baseUrl, 'server'].join('/');
      return $http.get(urlConfig);
    }
  }
});
configControllers.controller('AboutPageController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'AboutPageService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, AboutPageService, $route) {
    document.title = 'AdminLTE | Giới thiệu';
    AboutPageService.getAboutPage().success(function(res){
          if(res)
          {
              $scope.page_name = res.page_name;
              $scope.about_page = res.page_content;
          }  
           
      }); 
    $scope.btnAboutSave = function()
    {
    	
    	if($scope.about_page !== undefined && $scope.page_name != undefined )
    	{
    		var data = {
    			"page_name" : $scope.page_name,
    			"about_page" : $scope.about_page
    		};
    		AboutPageService.save(data).success(function(res){
          if(res == "TRUE")
          {

              $scope.message_success = 'Cập nhật thành công';
          }    
		    });
    	}
    }
    
}]);