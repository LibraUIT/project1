'use strict';
configApp.factory("HeaderService", function($http) {
  return {
    user : function(sendData)
    {
      var urlConfig = [baseUrl, 'admin','get_user'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ id : sendData}),
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
configControllers.controller('headerController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'HeaderService',
  function($scope, $rootScope, $routeParams, $location, $http, $state, HeaderService) {
  	if(isAdminLogin() !== false)
    {
	  	 HeaderService.user(isAdminLogin()).success(function(res){
	  	 	$scope.userLoginName = res.u_email;  	 	
	  	 });
	     $scope.SignOut = function()
	     {
	     	localStorage.removeItem("isAdminLogin");
	     	window.location.href = [baseUrl, 'admin', 'logout'].join('/');
	     }
 	}
}]);