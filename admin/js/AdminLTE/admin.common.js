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
      });
    }
    
}]);
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
