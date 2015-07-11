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
    document.title = 'AdminLTE ';
    checkLogin();
    AboutPageService.getAboutPage().success(function(res){
          if(res)
          {
              $scope.page_name = res.page_name;
              $scope.about_page = res.page_content;
              $scope.text_menu_dashboard = langArray.text_menu_dashboard;
              $scope.text_menu_settings_title = langArray.text_menu_settings_title;
              $scope.text_menu_about = langArray.text_menu_about;
              $scope.text_title = langArray.text_title;
              $scope.text_content = langArray.text_content;
              $scope.btn_save = langArray.btn_save;
              $scope.message_update_success = langArray.message_update_success;
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

              $scope.message_success = $scope.message_update_success;
          }    
		    });
    	}
    }
    
}]);