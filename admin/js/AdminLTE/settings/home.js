'use strict';

configApp.factory("SettingHomeService", function($http) {
  return {
  	save : function(sendData)
  	{
  		var urlConfig = [baseUrl, 'admin','home_save'].join('/');
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
    settingHome : function()
    {
      var urlConfig = [baseUrl, 'admin','get_home_page'].join('/');
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
configControllers.controller('HomePageController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'SettingHomeService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, SettingHomeService, $route) {
    document.title = 'AdminLTE | Trang chủ';
    $('#message_success').hide();
    SettingHomeService.settingHome().success(function(res){
      $scope.link_1_title = res.link_1_title;
      $scope.link_1_small_title = res.link_1_small_title;
      $scope.link_1_url = res.link_1_url;
      $scope.link_2_title = res.link_2_title;
      $scope.link_2_small_title = res.link_2_small_title;
      $scope.link_2_url = res.link_2_url;
    });
    $scope.btnSettingHomeSave = function()
    {
      var data = {
        "link_1_title" : $scope.link_1_title,
        "link_1_small_title" : $scope.link_1_small_title,
        "link_1_url" : $scope.link_1_url,
        "link_2_title" : $scope.link_2_title,
        "link_2_small_title" : $scope.link_2_small_title,
        "link_2_url" : $scope.link_2_url
      };

      SettingHomeService.save(data).success(function(res){
          $scope.message_success = "Cập nhật thành công";
      });
    }
}]);