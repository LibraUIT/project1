'use strict';

/* App Module */

var configApp = angular.module('quannguyen', [
  'ui.router',
  'ngRoute',
  'configControllers'
]);

var baseUrl = "http://localhost/project_shopping";
function isAdminLogin()
{
    
    var isAdminLogin = localStorage.getItem("isAdminLogin");
    
    isAdminLogin = (typeof isAdminLogin !== "undefined" && isAdminLogin !== null) ? isAdminLogin : false;
    return isAdminLogin;
}
configApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/', {
        templateUrl: 'home.html',
        controller: 'BaseController'
      }).
      when('/setting_portfolio', {
        templateUrl : 'templates/setting/portfolio.html',
        controller : 'SettingPortfolioController'
      }).
      when('/setting_contact_page', {
        templateUrl : 'templates/setting/contact_page.html',
        controller : 'ContactPageController'
      }).
      when('/setting_about_page', {
        templateUrl : 'templates/setting/about_page.html',
        controller : 'AboutPageController'
      }).
      when('/setting_home_page', {
        templateUrl : 'templates/setting/home_page.html',
        controller : 'HomePageController'
      }).
      when('/setting_language',{
        templateUrl : 'templates/setting/language.html',
        controller : 'LanguageController'
      }).
      when('/collection_create', {
        templateUrl : 'templates/collection/create.html',
        controller : 'CollectionController'
      }).
      when('/collection_list', {
        templateUrl : 'templates/collection/list.html',
        controller : 'CollectionListController'
      }).
      when('/collection/:id', {
        templateUrl : 'templates/collection/edit.html',
        controller : 'CollectionListController'
      }).
      when('/press_create', {
        templateUrl : 'templates/press/create.html',
        controller : 'PressController'
      }).
      when('/press_list', {
        templateUrl : 'templates/press/list.html',
        controller : 'PressListController'
      }).
      when('/press/:id', {
        templateUrl : 'templates/press/edit.html',
        controller : 'PressListController'
      }).
      when('/category_create',{
        templateUrl : 'templates/category/create.html',
        controller : 'CategoryController'
      }).
      when('/category_list', {
        templateUrl : 'templates/category/main.html',
        controller : 'CategoryListController'
      }).
      when('/category/:id', {
        templateUrl : 'templates/category/edit.html',
        controller : 'CategoryController'
      }).
      when('/product_create', {
        templateUrl : 'templates/product/create.html',
        controller : 'ProductController'
      }).
      when('/product_list', {
        templateUrl : 'templates/product/product_list.html',
        controller : 'ProductListController'
      }).
      when('/product/:id', {
        templateUrl : 'templates/product/edit.html',
        controller : 'ProductController'
      }).
      otherwise({
          redirectTo: '/'
      });
  }]);

configApp.factory("LangService", function($http) {
  return {
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
    server : function()
    {
      var urlConfig = [baseUrl, 'server'].join('/');
      return $http.get(urlConfig);
    }
  }
});

var langArray;
var configControllers = angular.module('configControllers', ['ui.bootstrap']);

configControllers.controller('BaseController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'LangService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, LangService, $route) {
    document.title = 'AdminLTE | Dashboard';
    if(isAdminLogin() === false)
    {
        //$location.path('/sign');
       window.location.href = [baseUrl, 'admin', 'login'].join('/');
    }else
    {
      LangService.user('en').success(function(res){
          settingLayout(); 
          langArray = res;
          $scope.text_menu_dashboard = langArray.text_menu_dashboard;
          $scope.text_menu_home =langArray.text_menu_home;
      });

    }
    
}]).directive('menuController', function( $routeParams, $route, $location, LangService) {
  return {
      restrict: 'A',
      link : function(scope, elem, attrs)
      {
          LangService.user('en').success(function(res){
            langArray = res;
            scope.text_menu_dashboard = langArray.text_menu_dashboard;
            scope.text_menu_product_manament = langArray.text_menu_product_manament;
            scope.text_menu_collection_manament = langArray.text_menu_collection_manament;
            scope.text_menu_press_manament = langArray.text_menu_press_manament;
            scope.text_menu_category_manament = langArray.text_menu_category_manament;
            scope.text_menu_list_product = langArray.text_menu_list_product;
            scope.text_menu_create_new = langArray.text_menu_create_new;
            scope.text_menu_list_collection = langArray.text_menu_list_collection;
            scope.text_menu_list_press = langArray.text_menu_list_press;
            scope.text_menu_list_category = langArray.text_menu_list_category;
            scope.text_menu_general  = langArray.text_menu_general;
            scope.text_menu_contact_info = langArray.text_menu_contact_info;
            scope.text_menu_about = langArray.text_menu_about;
            scope.text_menu_home = langArray.text_menu_home;
            scope.text_menu_settings_title = langArray.text_menu_settings_title; 
            scope.text_menu_language = langArray.text_menu_language;
            scope.text_hello = langArray.text_hello;
          });
         
          
      }
  }
});
function settingLayout()
{
    $("body").removeClass("skin-blue skin-black");
    var cls = (typeof localStorage.getItem("cls") !== "undefined" && localStorage.getItem("cls") !== null) ? localStorage.getItem("cls") : 'skin-blue';
    $("body").addClass(cls);
  
    $('.'+cls).attr('checked', 'checked');
}
// Remove null item in array 
function isArray(obj) {
    // http://stackoverflow.com/a/1058753/1252748
    return Object.prototype.toString.call(obj) === '[object Array]';
}
function removeEmptyArrayElements(arr) { 
   if (!isArray(arr)) {
      return arr;
   } else {
       return arr.filter( function(elem) { 
          return elem !== null
       } ).map(removeEmptyArrayElements)
   }
}
function removeItemByValue(value, array, removeItem)
{
    array = jQuery.grep(array, function(value) {
      return value != removeItem;
    });
    return array;
}
function checkLogin()

{
  if(isAdminLogin() === false)
    {
        //$location.path('/sign');
        window.location.href = [baseUrl, 'admin', 'login'].join('/');
    }
}