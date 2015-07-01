'use strict';

configApp.factory("SettingPortfolioService", function($http) {
  return {
  	save : function(sendData)
  	{
  		var urlConfig = [baseUrl, 'admin','portfolio_save'].join('/');
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
    settingPortfolio : function()
    {
      var urlConfig = [baseUrl, 'admin','get_setting_portfolio'].join('/');
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

configControllers.controller('SettingPortfolioController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'SettingPortfolioService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, SettingPortfolioService, $route) {
    document.title = 'AdminLTE | Cài đặt chung';
    $('#message_success').hide();
     SettingPortfolioService.settingPortfolio().success(function(res){
          if(res)
          {
              $scope.site_title = res.site_title;
              $scope.key_work = res.key_work;
              $scope.description = res.description;
              $scope.facebook = res.facebook;
              $scope.instagram = res.instagram;
              $scope.twitter = res.twitter;
              $scope.tumblr = res.tumblr;
              $scope.footer = res.footer;
          }  
           
      }); 

    $scope.btnSettingPortfolioSave =  function()
    {
    	
    	if($scope.site_title !== undefined)
    	{
    		var data = {
    			"site_title" : $scope.site_title,
    			"key_work" : $scope.key_work,
    			"description" : $scope.description,
    			"facebook" : $scope.facebook,
    			"instagram" : $scope.instagram,
    			"twitter" : $scope.twitter,
    			"tumblr" : $scope.tumblr,
    			"footer" : $scope.footer
    		};
    		SettingPortfolioService.save(data).success(function(res){
            $scope.message_success = 'Cập nhật thành công';
		        
		       
		    });
    	}
    }


    
}]);