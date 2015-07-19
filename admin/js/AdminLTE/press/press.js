'use strict';
configApp.factory("PressService", function($http) {
    return {
        save : function(sendData)
        {
            var urlConfig = [baseUrl, 'admin','press_save'].join('/');
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
        getListPress: function(page)
        {
            var urlConfig = [baseUrl, 'admin','press_list'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ page : page}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        getPressById : function(id)
        {
            var urlConfig = [baseUrl, 'admin','press_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ id : id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        updatePressById : function(data)
        {
            var urlConfig = [baseUrl, 'admin','press_update_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ data : data}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        },
        deletePressById : function(id)
        {
            var urlConfig = [baseUrl, 'admin','delete_press_get_by_id'].join('/');
            return $http({
                method: 'POST',
                url: urlConfig,
                data: $.param({ id : id }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            });
        }
    }
});
var featuredPress = [], featuredPress9 = [], listPress = [];
configControllers.controller('PressController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'PressService', '$route',
    function($scope, $rootScope, $routeParams, $location, $http, $state, PressService, $route) {
        document.title = 'AdminLTE';
        checkLogin();
        $scope.text_menu_dashboard = langArray.text_menu_dashboard;
        $scope.text_menu_press_manament = langArray.text_menu_press_manament;
        $scope.text_menu_create_new = langArray.text_menu_create_new;
        $scope.btn_back = langArray.btn_back;
        $scope.text_information = langArray.text_information;
        $scope.text_name= langArray.text_name;
        $scope.text_featured_image = langArray.text_featured_image;
        $scope.text_add_photo = langArray.text_add_photo;
        $scope.text_click_to_remove = langArray.text_click_to_remove;
        $scope.text_photo = langArray.text_photo;
        $scope.text_upload_status = langArray.text_upload_status;
        $scope.text_upload_new_image = langArray.text_upload_new_image;
        $scope.btn_save = langArray.btn_save;
        $('#fileupload').change(function(){
            readURL1(this);
        });
        $('#fileupload9').change(function(){
            readURL9(this);
        });
        $('#blah').on('click', function(){
            $(this).attr('src', '').css({"display":"none"});
            featuredPress = [];
        });
        $('#blah2').on('click', function(){
            $(this).attr('src', '').css({"display":"none"});
            featuredPress9 = [];
        });
        $scope.btnBack = function()
        {
            $location.path("/press_list");
        }
        $scope.btnPressUpload = function()
        {
            if(featuredPress.length == 0)
            {
                $scope.message_error = langArray.message_error_select_featured_image;
            }else if(featuredPress9.length == 0)
            {
                $scope.message_error = langArray.message_error_select_image;
            }else
            {
                listPress.push(featuredPress);
                listPress.push(featuredPress9);
                doUpload(listPress);

            }
        }
        $scope.btnPressSave = function()
        {
            if($scope.en_title == undefined || $scope.vi_title == undefined )
            {
                $scope.message_error = langArray.message_error_name;
            }else if(imageArray.length < 2)
            {
                $scope.message_error = langArray.message_error_upload_image;
            }else
            {
                var data = {
                    "en_name" : $scope.en_title,
                    "vi_name" : $scope.vi_title,
                    "image1" : imageArray[0],
                    "image2" : imageArray[1]
                };
                PressService.save(data).success(function(res){
                    if(res == "TRUE")
                    {
                        featuredPress = [], featuredPress9 = [], listPress = [], imageArray = [];
                        uploadComplete = 0;
                        per = 0;
                        status  = 0;
                        $location.path("/press_list");
                    }
                });
            }
        }

    }]);
configControllers.controller('PressListController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'PressService', '$route',
    function($scope, $rootScope, $routeParams, $location, $http, $state, PressService, $route) {
        document.title = 'AdminLTE';
        checkLogin();
        $scope.text_menu_press_manament = langArray.text_menu_press_manament;
        $scope.text_menu_dashboard = langArray.text_menu_dashboard;
        $scope.text_menu_list_press = langArray.text_menu_list_press;
        $scope.text_featured_image = langArray.text_featured_image;
        $scope.text_photo = langArray.text_photo;
        $scope.comlumn_name = langArray.comlumn_name;
        $scope.comlumn_edit = langArray.comlumn_edit;
        $scope.comlumn_date_created = langArray.column_date_created;
        $scope.comlumn_delete = langArray.comlumn_delete;
        $scope.btn_edit = langArray.btn_edit;
        $scope.btn_delete = langArray.btn_delete;
        $scope.text_page = langArray.text_page;
        $scope.modal_title = langArray.modal_title;
        $scope.modal_message_delete_comfirm = langArray.modal_message_delete_comfirm;
        $scope.btn_cancle = langArray.btn_cancle;
        $scope.currentPage = 1;
        $scope.baseUrl = baseUrl;
        $scope.btnDelete = function(id)
        {
            $('#myModal').modal('show') ;
            $scope.press_id = id;
        }
        $scope.deleteSelected = function()
        {
            PressService.deletePressById($scope.press_id).success(function(res){
                $('#myModal').modal('hide') ;
                $('.fade').removeClass('in').addClass('out').hide();
                $route.reload();
            });
        }
        $scope.page = function()
        {
            PressService.getListPress($scope.currentPage).success(function(res){
                $scope.table = res.data;
                $scope.totalItems = 1;
                $scope.numPages = res.total_page;
                $scope.setPage = function (pageNo) {
                    $scope.currentPage = pageNo;
                };
                $scope.maxSize = 5;
                $scope.bigTotalItems = res.total;
                $scope.bigCurrentPage = 1;
                $('li.ng-scope').on('click', function(){
                    var page = parseInt($(this).find('a').text());
                    if(page != $scope.currentPage){
                        $scope.currentPage = page;
                        PressService.getListPress($scope.currentPage).success(function(res){
                            var tableHtml = ' <tbody>'+
                                '<tr>'+
                                '<th style="text-align:center">'+$scope.text_featured_image+'</th>'+
                                '<th style="text-align:center">'+$scope.text_photo+'</th>'+
                                '<th>'+$scope.comlumn_name+'</th>'+
                                '<th>'+$scope.comlumn_date_created+'</th>'+
                                '<th style="">'+$scope.btn_edit+'</th>'+
                                '<th style="">'+$scope.comlumn_delete+'</th>'+
                                '</tr>';
                            for(var i = 0; i < res.data.length; i++)
                            {
                                tableHtml += '<tr>';
                                tableHtml += '<td style="text-align:center"><img style="width:150px;height:100px" src="'+baseUrl+'/'+res.data[i].press_image_1+'" ></td>';
                                tableHtml += '<td style="text-align:center"><img style="width:150px;height:100px" src="'+baseUrl+'/'+res.data[i].press_image_2+'" ></td>';
                                tableHtml += '<td>'+res.data[i].en_press_name+'<br />'+res.data[i].vi_press_name+'</td>';
                                tableHtml += '<td>'+res.data[i].date_created+'</td>';
                                tableHtml += '<td style="text-align:center"><a href="#/press/'+res.data[i].press_id+'"><button class="btn btn-primary btn-sm">'+$scope.btn_edit+'</button></</a></td>';
                                tableHtml += '<td style="text-align:center"><button ng-click="btnDelete('+res.data[i].press_id+')" class="btn btn-danger btn-sm">'+$scope.btn_delete+'</button></td>';
                                tableHtml += '</tr>';
                            }
                            $('.table').html(tableHtml);
                        });
                    }
                });
            });

        }
        $scope.page();






    }]).directive('editPress', function(PressService, $routeParams, $route, $location) {
    return {
        restrict: 'A',
        link : function(scope, elem, attrs)
        {
            document.title = 'AdminLTE ';
            checkLogin();
            var pressId = $routeParams.id;
            PressService.getPressById (pressId).success(function(res){
                if(res != null)
                {
                    scope.edit_press = langArray.edit_press;
                    scope.text_menu_press_manament = langArray.text_menu_press_manament;
                    scope.text_menu_dashboard = langArray.text_menu_dashboard;
                    scope.btn_back = langArray.btn_back;
                    scope.text_information = langArray.text_information;
                    scope.text_name = langArray.text_name;
                    scope.text_featured_image = langArray.text_featured_image;
                    scope.text_add_photo = langArray.text_add_photo;
                    scope.text_click_to_remove = langArray.text_click_to_remove;
                    scope.text_photo = langArray.text_photo;
                    scope.text_upload_status = langArray.text_upload_status;
                    scope.text_upload_new_image = langArray.text_upload_new_image;
                    scope.btn_save = langArray.btn_save;
                    scope.en_title = res.en_press_name;
                    scope.vi_title = res.vi_press_name;
                    $('#blah').attr('src', baseUrl+res.press_image_1).css({"display":"block"});
                    $('#blah2').attr('src', baseUrl+res.press_image_2).css({"display":"block"});
                    var img1 = res.press_image_1;
                    var img2 = res.press_image_2;
                    $('#fileupload').change(function(){
                        readURL1(this);
                    });
                    $('#fileupload9').change(function(){
                        readURL9(this);
                    });
                    $('#blah').on('click', function(){
                        $(this).attr('src', '').css({"display":"none"});
                        featuredPress = [];
                        img1 = 0;
                    });
                    $('#blah2').on('click', function(){
                        $(this).attr('src', '').css({"display":"none"});
                        featuredPress9 = [];
                        img2 = 0;
                    });
                    scope.btnPressUpload = function()
                    {

                        if(featuredPress.length != 0)
                        {
                            listPress = [];
                            listPress.push(featuredPress);
                            doUpload(listPress);
                            img1 = 0;
                        }else if(featuredPress9.length !=0)
                        {
                            listPress = [];
                            listPress.push(featuredPress9);
                            doUpload(listPress);
                            img2 = 0;
                        }else if( featuredPress.length !=0 && featuredPress9.length !=0)
                        {
                            listPress = [];
                            listPress.push(featuredPress);
                            listPress.push(featuredPress9);
                            doUpload(listPress);
                            img1 = 0;
                            img2 = 0;
                        }else
                        {
                            scope.message_error = langArray.message_error_select_image;
                        }
                    }
                    scope.btnBack = function()
                    {
                        $location.path("/press_list");
                    }
                    scope.btnPressUpdate = function()
                    {
                        if(scope.en_title == 'undefined' || scope.en_title == '' || scope.vi_title == 'undefined' || scope.vi_title == '' )
                        {
                            scope.message_error = langArray.message_error_name;
                        }else if(scope.title != 'undefined' && scope.title != '')
                        {
                            if(img1 != 0 && img2 != 0)
                            {
                                var data = {
                                    "id" : pressId,
                                    "en_name" : scope.en_title,
                                    "vi_name" : scope.vi_title,
                                    "image1" : img1,
                                    "image2" : img2
                                }
                                update();
                            }else if(img1 == 0 && status ==1)
                            {
                                var data = {
                                    "id" : pressId,
                                    "en_name" : scope.en_title,
                                    "vi_name" : scope.vi_title,
                                    "image1" : imageArray[0],
                                    "image2" : img2
                                }
                                update();
                            }else if(img2 == 0 && status ==1)
                            {
                                var data = {
                                    "id" : pressId,
                                    "en_name" : scope.en_title,
                                    "vi_name" : scope.vi_title,
                                    "image1" : img1,
                                    "image2" : imageArray[0]
                                }
                                update();
                            }else if(img1 == 0 && img2 == 0 && status==1)
                            {
                                var data = {
                                    "id" : pressId,
                                    "en_name" : scope.en_title,
                                    "vi_name" : scope.vi_title,
                                    "image1" : imageArray[0],
                                    "image2" : imageArray[1]
                                }
                                update();
                            }else
                            {
                                scope.message_error = langArray.message_error_select_image;
                            }
                            function update()
                            {
                                PressService.updatePressById(data).success(function(res){

                                    if(res == "TRUE")
                                    {
                                        $route.reload();
                                    }
                                });
                            }

                        }
                    }
                }
            });
        }
    }
});
function readURL1(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            featuredPress = document.getElementById("fileupload").files[0];
            $('#blah').attr('src', e.target.result).css({"display":"block"});

        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURL9(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            featuredPress9 = document.getElementById("fileupload9").files[0];
            $('#blah2').attr('src', e.target.result).css({"display":"block"});
        }

        reader.readAsDataURL(input.files[0]);
    }
}
var imageArray = [];
var uploadComplete = 0;
var per = 0;
var status  = 0;
function doUpload(imgUpload)
{
    for(var i=0; i<listPress.length; i++)
    {
        var data = new FormData();
        data.append('filename', imgUpload[i].name);
        data.append('myfile', imgUpload[i]);
        $.ajax({
            url: [baseUrl, 'admin', 'postImgPressUpload'].join('/'),
            type: 'POST',
            data: data,
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
                if( imageArray.length > 0 &&imageArray.indexOf(data) == -1)
                {
                    imageArray.push(data);
                }else
                {
                    imageArray.push(data);
                }
                uploadComplete++;
                completeBar(uploadComplete);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                // Handle errors here
                console.log('ERRORS: ' + textStatus);
                // STOP LOADING SPINNER
            }
        });
    }

}
function completeBar(complete)
{

    var total = listPress.length;
    per = (complete%total)*100;
    if(per == 0)
    {
        status = 1;
        per = 100;
    }
    $('.progress-bar-success').css({"width":per+"%"});
}