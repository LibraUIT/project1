'use strict';
configApp.factory("UserService", function($http) {
    return {
        save : function(sendData)
        {
            var urlConfig = [baseUrl, 'admin','user_save'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ data : sendData}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        list : function()
        {
            var urlConfig = [baseUrl, 'admin','user_list'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        deleteById : function(id)
        {
            var urlConfig = [baseUrl, 'admin','delete_user_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ id : id }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        getById : function(id)
        {
            var urlConfig = [baseUrl, 'admin','user_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ id : id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        updateById : function(data)
        {
            var urlConfig = [baseUrl, 'admin','user_update_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ data : data}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        }
    }
});
configControllers.controller('UserController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', '$route', 'UserService',
    function($scope, $rootScope, $routeParams, $location, $http, $state, $route, UserService) {
        document.title = 'AdminLTE';
        checkLogin();
        $scope.text_user_email = langArray.text_user_email;
        $scope.text_user_password = langArray.text_user_password;
        $scope.text_user_password_repeat = langArray.text_user_password_repeat;
        $scope.btn_save = langArray.btn_save;
        $scope.btn_clear = langArray.btn_clear;
        $scope.text_menu_create_new= langArray.text_menu_create_new;
        $scope.text_change_pass = langArray.text_change_pass;
        $scope.message_success = '';
        $scope.message_error = '';
        $scope.message_error_permission = langArray.message_error_permission;
        $scope.btn_back = langArray.btn_back;
        $scope.text_menu_list_user = langArray.text_menu_list_user;
        $scope.edit_user = langArray.edit_user;
        $scope.btnCancle = function()
        {
            $location.path("/user_list");
        }
        $scope.btnClear = function()
        {
            $scope.user_email = '';
            $scope.user_password = '';
            $scope.user_password_repeat = '';
            $scope.message_success = '';
            $scope.message_error = '';
        }
        $scope.btnCreateUser = function()
        {
            if($scope.user_email == undefined)
            {
                $scope.message_error = langArray.message_error_email;
            }else if(validateEmail($scope.user_email) == false)
            {
                $scope.message_error = langArray.message_error_email_not_validate;
            }else if($scope.user_password == undefined)
            {
                $scope.message_error = langArray.message_error_password;
            }else if($scope.user_password_repeat == undefined)
            {
                $scope.message_error = langArray.message_error_password_repeat;
            }else if($scope.user_password != $scope.user_password_repeat)
            {
                $scope.message_error = langArray.message_error_password_repeat_not_match;
            }
            else
            {
                var data = {
                    "u_email" : $scope.user_email,
                    "u_password" : $scope.user_password
                };
                UserService.save(data).success(function(res){
                    if(res == 0)
                    {
                        $scope.message_error = langArray.message_error_exits_email;
                    }else
                    {
                        $scope.user_email = '';
                        $scope.user_password = '';
                        $scope.user_password_repeat = '';
                        $scope.message_error = '';
                        $scope.message_success = langArray.message_success;
                        setTimeout(function(){ $route.reload(); }, 2000);
                    }
                });
            }
        }

    }]);
var uid;
configControllers.controller('UserListController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'UserService', '$route',
    function($scope, $rootScope, $routeParams, $location, $http, $state, UserService, $route) {
        document.title = 'AdminLTE';
        checkLogin();
        $scope.message_error_permission = langArray.message_error_permission;
        $scope.comlumn_email = langArray.comlumn_email;
        $scope.comlumn_edit = langArray.comlumn_edit;
        $scope.comlumn_delete = langArray.comlumn_delete;
        $scope.btn_edit = langArray.btn_edit;
        $scope.btn_delete = langArray.btn_delete;
        $scope.modal_title = langArray.modal_title;
        $scope.modal_message_delete_comfirm = langArray.modal_message_delete_comfirm;
        $scope.btn_cancle = langArray.btn_cancle;
        UserService.list().success(function(res){
            $scope.table = res;
        });
        $scope.btnDelete = function(id)
        {
            $('#myModal').modal('show') ;
            uid = id;
        }
        $scope.deleteSelected = function()
        {
            UserService.deleteById(uid).success(function(res){
                $('#myModal').modal('hide') ;
                $('.fade').removeClass('in').addClass('out').hide();
                $route.reload();
            });
        }
    }]).directive('editUser', function(UserService, $routeParams, $route, $location) {
    return {
        restrict: 'A',
        link : function(scope, elem, attrs)
        {
            document.title = 'AdminLTE ';
            checkLogin();
            var uId = $routeParams.id;
            UserService.getById(uId).success(function(res){
                if(res)
                {
                    scope.user_email = res.u_email;
                }else
                {
                    $location.path("/user_list");
                }
            });
            scope.btnClear = function()
            {
                scope.user_email = '';
                scope.user_password = '';
                scope.user_password_repeat = '';
                scope.message_success = '';
                scope.message_error = '';
            }
            scope.btnUpdateUser = function()
            {
                if(scope.user_password == undefined)
                {
                    scope.message_error = langArray.message_error_password;
                }else if(scope.user_password_repeat == undefined)
                {
                    scope.message_error = langArray.message_error_password_repeat;
                }else if(scope.user_password != scope.user_password_repeat)
                {
                    scope.message_error = langArray.message_error_password_repeat_not_match;
                }
                else
                {
                    var data = {
                        "u_id" : uId,
                        "u_password" : scope.user_password
                    }
                    UserService.updateById(data).success(function(res){
                        scope.user_email = '';
                        scope.user_password = '';
                        scope.user_password_repeat = '';
                        scope.message_error = '';
                        scope.message_success = langArray.message_success;
                        setTimeout(function(){ $route.reload(); }, 2000);
                    });
                }
            }

        }
    }
});