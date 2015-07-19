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
      var urlConfig = [baseUrl, 'admin','server'].join('/');
      return $http.get(urlConfig);
    },
    lastActivity : function()
    {
      var urlConfig = [baseUrl, 'admin','last_activity'].join('/');
      return $http.get(urlConfig);
    },
    changePass : function(sendData)
    {
      var urlConfig = [baseUrl, 'admin','changePass'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ data : sendData }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
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
           $scope.userLoginId = res.u_id;
           $scope.userLoginLevel = res.u_level;
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
       HeaderService.server().success(function(res){
          if(res)
          {
            $scope.categorys = res.categorys;
            $scope.collections = res.collections;
            $scope.disk_free = res.disk_free;
            $scope.disk_total = res.disk_total;
            $scope.hostname = res.hostname;
            $scope.press = res.press;
            $scope.products = res.products;
            $scope.timezone = res.timezone;
            $scope.text_products= langArray.text_products;
            $scope.text_collections = langArray.text_collections;
            $scope.text_press = langArray.text_press;
            $scope.text_categorys = langArray.text_categorys;
            $scope.text_more_info = langArray.text_more_info;
          }
       });
       HeaderService.lastActivity().success(function(res){
          if(res)
          {
            $scope.base_url = baseUrl;
            $scope.last_product_image = baseUrl + JSON.parse(res.product.images)[0];
            $scope.last_product_en_name = res.product.en_name;
            $scope.last_product_vi_name = res.product.vi_name;
            $scope.last_product_id = res.product.id
            $scope.text_new_product = langArray.text_new_product
            $scope.last_collection_image = baseUrl + res.collection.collection_featured_image;
            $scope.last_collection_en_name = res.collection.en_collection_name;
            $scope.last_collection_vi_name = res.collection.vi_collection_name;
            $scope.last_collection_id = res.collection.collection_id;
            $scope.text_new_collection = langArray.text_new_collection
            $scope.text_new_press = langArray.text_new_press
            $scope.last_new_press_image = baseUrl + res.press.press_image_1;
            $scope.last_new_press_en_name = res.press.en_press_name;
            $scope.last_new_press_vi_name = res.press.vi_press_name;
            $scope.last_new_press_id = res.press.press_id;
          }
       });
	     $scope.SignOut = function()
	     {
	     	//localStorage.removeItem("isAdminLogin");
        localStorage.clear();
	     	window.location.href = [baseUrl, 'admin', 'logout'].join('/');
	     }
 	}
}]);
configControllers.controller('ProfileController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'HeaderService', 'LangService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, HeaderService, LangService, $route) {
    if(isAdminLogin() !== false)
    {
       document.title = 'AdminLTE';
       var userId = $routeParams.id;
       $scope.text_old_password = langArray.text_old_password;
       $scope.text_new_password = langArray.text_new_password;
       $scope.text_new_password_repeat = langArray.text_new_password_repeat;
       $scope.btn_save = langArray.btn_save;
       $scope.btn_cancle = langArray.btn_cancle;
       $scope.text_menu_dashboard = langArray.text_menu_dashboard;
       $scope.text_profile = langArray.text_profile;
       $scope.text_change_pass = langArray.text_change_pass;
       console.log($scope.userLoginLevel)
       $scope.btnCancle = function()
       {
          $scope.old_password = '';
          $scope.new_password = '';
          $scope.new_password_repeat = '';
          $scope.message_error = '';
          $scope.message_success = '';
          $route.reload();
       }
       $scope.btnUpdatePassword = function()
       {
          if($scope.old_password == undefined)
          {
            $scope.message_error = langArray.message_error_old_password_required;
          }else if($scope.new_password == undefined)
          {
            $scope.message_error = langArray.message_error_new_password_required;
          }else if($scope.new_password_repeat == undefined)
          {
            $scope.message_error = langArray.message_error_new_password_repeat_required;
          }else if($scope.new_password != $scope.new_password_repeat)
          {
            $scope.message_error = langArray.message_error_new_password_repeat_not_match;
          }else
          {
              var data = {
                "old_password" : $scope.old_password,
                "new_password" : $scope.new_password,
                "new_password_repeat" : $scope.new_password_repeat,
                "userId" : userId

              };
              HeaderService.changePass(data).success(function(res){
                if(res == "1")
                {
                  $scope.message_error = langArray.message_error_old_password;
                }else
                {
                  localStorage.setItem("isAdminpass", res);
                  $scope.old_password = '';
                  $scope.new_password = '';
                  $scope.new_password_repeat = '';
                  $scope.message_error = '';
                  $scope.message_success = langArray.message_success;
                  setTimeout(function(){ $route.reload(); }, 2000);
                  
                }
              });
          }
       } 
    }else
    {
      window.location.href = [baseUrl, 'admin', 'login'].join('/');
    }
}]);