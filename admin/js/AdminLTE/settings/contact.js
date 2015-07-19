'use strict';
configApp.factory("ContactPageService", function($http) {
  return {
  	save : function(sendData)
  	{
  		var urlConfig = [baseUrl, 'admin','contact_page_save'].join('/');
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
    getContactPage : function()
    {
      var urlConfig = [baseUrl, 'admin','get_contact_page'].join('/');
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

configControllers.controller('ContactPageController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'ContactPageService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, ContactPageService, $route) {
    document.title = 'AdminLTE ';
    checkLogin();
    ContactPageService.getContactPage().success(function(res){
          if(res)
          {
              $scope.page_name = res.page_name;
              $scope.en_contact_page = res.en_page_content;
              $scope.vi_contact_page = res.vi_page_content;
              $scope.text_menu_settings_title = langArray.text_menu_settings_title;
              $scope.text_menu_dashboard = langArray.text_menu_dashboard;
              $scope.text_contact_info = langArray.text_contact_info;
              $scope.text_title = langArray.text_title;
              $scope.btn_save = langArray.btn_save;
              $scope.message_update_success = langArray.message_update_success;
              $scope.text_content = langArray.text_content;
          }  
           
      }); 
    $scope.btnContactSave = function()
    {
    	
    	if($scope.en_contact_page !== undefined )
    	{
    		var data = {
    			"en_contact_page" : $scope.en_contact_page,
          "vi_contact_page" : $scope.vi_contact_page,
          "page_name" : $scope.page_name
    		};
    		ContactPageService.save(data).success(function(res){
          if(res == "TRUE")
          {

              $scope.message_success = $scope.message_update_success;
          }    
		    });
    	}
    }
    
}]);