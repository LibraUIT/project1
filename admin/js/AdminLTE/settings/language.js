'use strict';
configApp.factory("LanguagePageService", function($http) {
  return {
  	
      getConfig : function()
      {
        var urlConfig = [baseUrl, 'admin','getLang'].join('/');
        return $http.get(urlConfig);
      },
      save : function(sendData)
      {
        var urlConfig = [baseUrl, 'admin','language_save'].join('/');
          return $http({
            method: 'POST',
            url: urlConfig,
            data: $.param({ data : sendData}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
          });
      }
  }
});
configControllers.controller('LanguageController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'LanguagePageService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, LanguagePageService, $route) {
    document.title = 'AdminLTE ';
    checkLogin();
    LanguagePageService.getConfig().success(function(res){
        $scope.language = res.name;
    });
    $scope.text_menu_dashboard = langArray.text_menu_dashboard;
    $scope.text_menu_settings_title = langArray.text_menu_settings_title;
    $scope.message_update_success = langArray.message_update_success;
    $scope.text_menu_language = langArray.text_menu_language;
    $scope.btn_save = langArray.btn_save;
      
    $scope.btnLanguageSave = function()
    {
    	 $scope.message_success  = '';
       var data = {
          "name" : $scope.language
       };
       LanguagePageService.save(data).success(function(res){
          if(res == "TRUE")
          {
             $scope.message_success = langArray.message_success;
          }
       });
    }
    
}]);