'use strict';
configApp.factory("CategoryService", function($http) {
    return {
        save : function(sendData)
        {
            var urlConfig = [baseUrl, 'admin','category_save'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ data : sendData}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        list : function()
        {
            var urlConfig = [baseUrl, 'admin','category_list'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        deleteById : function(id)
        {
            var urlConfig = [baseUrl, 'admin','delete_category_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ id : id }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        getById : function(id)
        {
            var urlConfig = [baseUrl, 'admin','category_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ id : id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        updateById : function(data)
        {
            var urlConfig = [baseUrl, 'admin','category_update_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ data : data}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        }
    }
});
configControllers.controller('CategoryController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', '$route', 'CategoryService',
    function($scope, $rootScope, $routeParams, $location, $http, $state, $route, CategoryService) {
        document.title = 'AdminLTE';
        checkLogin();

        $scope.btnCancle = function()
        {
            $location.path("/category_list");
        }
        $scope.btnBack = function()
        {
            $location.path("/category_list");
        }
        $scope.btnCreateCategory = function()
        {
            if($scope.title != undefined)
            {
                var data = {
                    "title" : $scope.title
                };
                CategoryService.save(data).success(function(res){
                    if(res == "FALSE")
                    {
                        $scope.message_error = langArray.message_error_exits_name;
                    }else
                    {
                        $location.path("/category_list");
                    }
                });
            }else
            {
                $scope.message_error = langArray.message_error_category_name;
            }
        }
        $scope.text_name = langArray.text_name;
        $scope.btn_save = langArray.btn_save;
        $scope.btn_cancle = langArray.btn_cancle;
        $scope.text_menu_create_new = langArray.text_menu_create_new;
        $scope.text_menu_dashboard = langArray.text_menu_dashboard;
        $scope.text_menu_category_manament = langArray.text_menu_category_manament;
        $scope.btn_back = langArray.btn_back;
    }]);
configControllers.controller('CategoryListController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'CategoryService', '$route',
    function($scope, $rootScope, $routeParams, $location, $http, $state, CategoryService, $route) {
        document.title = 'AdminLTE';
        checkLogin();
        CategoryService.list().success(function(res){
            if(res)
            {
                $scope.table = res;
            }
            $scope.text_menu_category_manament = langArray.text_menu_category_manament;
            $scope.text_menu_dashboard = langArray.text_menu_dashboard;
            $scope.text_menu_list_category = langArray.text_menu_list_category;
            $scope.comlumn_name= langArray.comlumn_name;
            $scope.comlumn_edit = langArray.comlumn_edit;
            $scope.comlumn_delete = langArray.comlumn_delete;
            $scope.btn_edit = langArray.btn_edit;
            $scope.btn_delete = langArray.btn_delete;
            $scope.btn_cancle = langArray.btn_cancle;
            $scope.modal_title = langArray.modal_title;
            $scope.modal_message_delete_comfirm = langArray.modal_message_delete_comfirm;
        });
        $scope.btnDelete = function(id)
        {
            $('#myModal').modal('show') ;
            $scope.category_id = id;
        }
        $scope.deleteSelected = function()
        {
            CategoryService.deleteById($scope.category_id).success(function(res){
                $('#myModal').modal('hide') ;
                $('.fade').removeClass('in').addClass('out').hide();
                $route.reload();
            });
        }
    }]).directive('editCategory', function(CategoryService, $routeParams, $route, $location) {
    return {
        restrict: 'A',
        link : function(scope, elem, attrs)
        {
            document.title = 'AdminLTE ';
            checkLogin();
            scope.text_menu_category_manament = langArray.text_menu_category_manament;
            scope.text_menu_dashboard = langArray.text_menu_dashboard;
            scope.edit_category = langArray.edit_category;
            scope.btn_back = langArray.btn_back;
            scope.text_name= langArray.text_name;
            scope.btn_save= langArray.btn_save;
            scope.btn_cancle = langArray.btn_cancle;
            var cateId = $routeParams.id;
            CategoryService.getById(cateId).success(function(res){
                if(res)
                {
                    scope.title = res.category_name;
                }
            });
            scope.btnBack = function()
            {
                $location.path("/category_list");
            }
            scope.btnEditCategory = function()
            {
                if(scope.title != '')
                {
                    var data = {
                        "id" : cateId,
                        "name" : scope.title
                    };
                    CategoryService.updateById(data).success(function(res){
                        if(res == "FALSE")
                        {
                            scope.message_error = langArray.message_error_exits_name;
                        }else
                        {
                            $route.reload();
                        }
                    });
                }else
                {
                    scope.message_error = langArray.message_error_category_name;
                }
            }
        }
    }
});