'use strict';
configApp.factory("HeaderService", function($http) {
  return {
    user : function(sendData)
    {
      var urlConfig = [baseUrl, 'admin','get_user'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ id : sendData, email : localStorage.getItem("isAdminemail"), pass : localStorage.getItem("isAdminpass")}),
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
configControllers.controller('headerController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'HeaderService', 'LangService',
  function($scope, $rootScope, $routeParams, $location, $http, $state, HeaderService, LangService) {
  	if(isAdminLogin() !== false)
    {
	  	 HeaderService.user(isAdminLogin()).success(function(res){
        if(res != "FALSE")
        {

	  	  	 $scope.userLoginName = res.u_email;
           LangService.user('en').success(function(res){
              var langarr = res;
              $scope.text_profile = langarr.text_profile;
              $scope.text_singout = langarr.text_singout;
              
           });
        }else
        {
          window.location.href = [baseUrl, 'admin', 'logout'].join('/');
        }

	  	 });
	     $scope.SignOut = function()
	     {
	     	localStorage.removeItem("isAdminLogin");
	     	window.location.href = [baseUrl, 'admin', 'logout'].join('/');
	     }
 	}
}]);