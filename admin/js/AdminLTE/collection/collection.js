'use strict';
var image = [], featured = [], collection = [];
configApp.factory("CollectionService", function($http) {
  return {
  	save : function(sendData)
  	{
  		var urlConfig = [baseUrl, 'admin','collection_save'].join('/');
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
    getListCollection : function(page)
    {
      var urlConfig = [baseUrl, 'admin','collection_list'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ page : page}),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    getCollectionById : function(id)
    {
      var urlConfig = [baseUrl, 'admin','collection_get_by_id'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ id : id}),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    updateCollectionById : function(data)
    {
      var urlConfig = [baseUrl, 'admin','update_get_by_id'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ data : data}),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    deleteCollectionById : function(id)
    {
      var urlConfig = [baseUrl, 'admin','delete_get_by_id'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ id : id }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    },
    removeImage : function(images)
    {
      var urlConfig = [baseUrl, 'admin','removeImage'].join('/');
      return $http({
        method: 'POST',
        url: urlConfig,
        data: $.param({ images : images }),
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
      });
    }
  }
});

configControllers.controller('CollectionController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'CollectionService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, CollectionService, $route) {
    document.title = 'AdminLTE ';
    checkLogin();
    $scope.text_menu_collection_manament = langArray.text_menu_collection_manament;
    $scope.text_menu_dashboard = langArray.text_menu_dashboard;
    $scope.text_menu_create_new = langArray.text_menu_create_new;
    $scope.btn_back = langArray.btn_back;
    $scope.text_name = langArray.text_name;
    $scope.text_featured_image = langArray.text_featured_image;
    $scope.text_add_photo = langArray.text_add_photo;
    $scope.text_click_to_remove = langArray.text_click_to_remove;
    $scope.text_photo_gallery = langArray.text_photo_gallery;
    $scope.text_upload_status = langArray.text_upload_status;
    $scope.text_upload_new_image = langArray.text_upload_new_image;
    $scope.btn_save = langArray.btn_save;
    $('#fileupload').change(function(){
        readURL(this);
    });
    $('#morefileupload').change(function(){
        readURL2(this);
    });
    $('#blah').on('click', function(){
        $(this).attr('src', '').css({"display":"none"});
    });
    $('#blah2').on('click', function(){
                    $(this).attr('src', '').css({"display":"none"});
    });
    $scope.btnBack = function()
                {
                  $location.path("/collection_list");  
                }
    $scope.btnCollectionUpload = function()
    {
       
       if(featured.length == 0)
       {
          $scope.message_error = langArray.message_error_select_image;
       }else if(collection.length == 0)
       {
          $scope.message_error = langArray.message_error_select_image;
       }
       else
       {
          var imgArr = $('.blah2');
          $.each(imgArr, function( index, value ) {
              var key = $(value).attr('id');
              if($(value).attr('style') == "display: none;")
              {
                for(var j = 0; j < collection.length ; j++)
                {
                  if(j == key)
                  {
                      collection[j] = null;
                  }
                }
              }
          });
          collection = removeEmptyArrayElements(collection);
          doUploaded(collection);
          doUploaded2(featured);
          /*setInterval(function(){
              if(status == 1)
              {
                  //setTimeout(function(){
                          var data = {
                            'title' : $scope.title,
                            'featured' : featuredImage,
                            'collections' : JSON.stringify(imageArray)
                          };
                          CollectionService.save(data).success(function(res){
                              $scope.message_success = 'Tạo mới bộ sưu tập thành công';
                                   status = 0;
                                   featuredImage = '';
                                   imageArray = [];                  
                                   $location.path("/collection_list");   
                          });
                  //}, 3000);     
              }
                
           }, 3000); 
          */         

        }
    }
    $scope.btnCollectionSave =  function()
    {
      if($scope.en_title === undefined || $scope.vi_title === undefined)
       {
          $scope.message_error = langArray.message_error_name;
       }
       else if(featuredImage == '')
       {
          $scope.message_error = langArray.message_error_select_image;
       }else if(imageArray.length == 0)
       {
          $scope.message_error = langArray.message_error_select_image;
       }
       else{
          if(status == 1)
          {
                          $scope.message_error = '';
                          var data = {
                            'en_title' : $scope.en_title,
                            'vi_title' : $scope.vi_title,
                            'featured' : featuredImage,
                            'collections' : JSON.stringify(imageArray)
                          };
                          CollectionService.save(data).success(function(res){
                              $scope.message_success = langArray.message_success;
                                   status = 0;
                                   featuredImage = '';
                                   imageArray = [];                  
                                   $location.path("/collection_list");   
                          });
          }
       }
    }
}]);
configControllers.controller('CollectionListController', ['$scope', '$rootScope','$routeParams', '$location','$http', '$state', 'CollectionService', '$route',
  function($scope, $rootScope, $routeParams, $location, $http, $state, CollectionService, $route) {
      document.title = 'AdminLTE ';
      checkLogin();
      $scope.text_menu_collection_manament = langArray.text_menu_collection_manament;
      $scope.text_menu_dashboard  = langArray.text_menu_dashboard;
      $scope.text_menu_list_collection =langArray.text_menu_list_collection;
      $scope.text_featured_image = langArray.text_featured_image;
      $scope.comlumn_name = langArray.comlumn_name;
      $scope.column_date_created = langArray.column_date_created;
      $scope.comlumn_edit = langArray.comlumn_edit;
      $scope.comlumn_delete = langArray.comlumn_delete;
      $scope.modal_title = langArray.modal_title;
      $scope.modal_message_delete_comfirm = langArray.modal_message_delete_comfirm;
      $scope.btn_delete = langArray.btn_delete;
      $scope.btn_edit = langArray.btn_edit;
      $scope.btn_cancle = langArray.btn_cancle;
      $scope.text_page = langArray.text_page;
      $scope.currentPage = 1;
      $scope.baseUrl = baseUrl;
      $scope.btnDelete = function(id)
      {
          $('#myModal').modal('show') ;
          $scope.coll_id = id;
      }
      $scope.deleteSelected = function()
      {
          CollectionService.deleteCollectionById($scope.coll_id).success(function(res){
              $('#myModal').modal('hide') ;
              $('.fade').removeClass('in').addClass('out').hide();
              $route.reload();
          });
      }
      $scope.page = function()
      {
        CollectionService.getListCollection($scope.currentPage).success(function(res){
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
                    CollectionService.getListCollection($scope.currentPage).success(function(res){
                        var tableHtml = ' <tbody>'+
                                          '<tr>'+
                                            '<th style="text-align:center">'+$scope.text_featured_image+'</th>'+
                                            '<th>'+$scope.comlumn_name+'</th>'+
                                            '<th>'+$scope.column_date_created+'</th>'+
                                            '<th style="">'+$scope.comlumn_edit+'</th>'+
                                            '<th style="">'+$scope.comlumn_delete+'</th>'+
                                            '</tr>';
                        for(var i = 0; i < res.data.length; i++)
                        {
                            tableHtml += '<tr>';
                            tableHtml += '<td style="text-align:center;height:260px"><img style="width:50px" src="'+baseUrl+'/'+res.data[i].collection_featured_image+'" ></td>';
                            tableHtml += '<td>'+res.data[i].collection_name+'</td>';
                            tableHtml += '<td>'+res.data[i].collection_date_created+'</td>';
                            tableHtml += '<td style="text-align:center"><a href="#/collection/'+res.data[i].collection_id+'"><button class="btn btn-primary btn-sm">'+$scope.btn_edit+'</button></</a></td>';
                            tableHtml += '<td style="text-align:center"><button ng-click="btnDelete('+res.data[i].collection_id+')" class="btn btn-danger btn-sm">'+$scope.btn_delete+'</button></td>';
                            tableHtml += '</tr>';
                        }                    
                        $('.table').html(tableHtml);                    
                    });
                }
        }); 
        });

      }
      $scope.page();

      
      

      

}]).directive('editCollection', function(CollectionService, $routeParams, $route, $location) {
  return {
    restrict: 'A',
    link : function(scope, elem, attrs)
    {
        document.title = 'AdminLTE ';
        checkLogin();
        scope.text_menu_collection_manament = langArray.text_menu_collection_manament;
        scope.text_menu_dashboard = langArray.text_menu_dashboard;
        scope.edit_collection = langArray.edit_collection;
        scope.btn_back = langArray.btn_back;
        scope.text_information = langArray.text_information;
        scope.text_name = langArray.text_name;
        scope.text_featured_image =langArray.text_featured_image;
        scope.change_image = langArray.change_image;
        scope.text_photo_gallery = langArray.text_photo_gallery;
        scope.text_click_to_remove = langArray.text_click_to_remove;
        scope.text_add_photo = langArray.text_add_photo;
        scope.text_upload_status = langArray.text_upload_status;
        scope.text_upload_new_image = langArray.text_upload_new_image;
        scope.btn_save =langArray.btn_save;
        scope.btn_cancle = langArray.btn_cancle;
        var collectionId = $routeParams.id;
        collection = [];
        featured = '';
        status = 0;
        CollectionService. getCollectionById (collectionId).success(function(res){
            if(res != null)
            {
                scope.btnBack = function()
                {
                  $location.path("/collection_list");  
                }
                scope.btnCollectionCancle = function()
                {
                  $location.path("/collection_list");  
                }
                scope.en_title = res.en_collection_name;
                scope.vi_title = res.vi_collection_name;
                scope.featuredImage = res.collection_featured_image;
                
                if(res.collection_image_list != '')
                {
                  scope.imageArray = JSON.parse(res.collection_image_list);
                  scope.check = 1;
                }else
                {
                  scope.imageArray = [];
                }
                imageArray = scope.imageArray;
                scope.update = 0;
                scope.removeUpload = function(item)
                {
                  scope.imageArray = removeItemByValue(item, scope.imageArray, item);
                  imageArray = scope.imageArray;
                }
                $('#fileupload').change(function(){
                    readURL(this);
                });
                $('#morefileupload').change(function(){
                  readURL2(this);
                });
                $('#blah').on('click', function(){
                    $(this).attr('src', '').css({"display":"none"});
                });
                $('#blah2').on('click', function(){
                    $(this).attr('src', '').css({"display":"none"});
                });
                scope.btnCollectionUpload = function()
                {
                    var imgArr = $('.blah2');
                    
                    $.each(imgArr, function( index, value ) {
                        var key = $(value).attr('id');
                        if($(value).attr('style') == "display: none;")
                        {
                          for(var j = 0; j < collection.length ; j++)
                          {
                            if(j == key)
                            {
                                scope.remove.push(value);
                                collection[j] = null;
                            }
                          }
                        }
                    });
                    collection = removeEmptyArrayElements(collection);
                    if(featured.length == 0)
                    {
                        console.log("Khong co file de up");
                    }else
                    {
                        doUploaded2(featured);
                        
                    }
                    if(collection.length > 0)
                    {
                        doUploaded(collection);
                        console.log(collection.length);
                    }else
                    {
                        console.log("Khong co file de up");
                        console.log(collection.length);
                    }
                    

                }
                scope.btnCollectionUpdate = function()
                {
                   var edit = 0;
                   if(scope.imageArray.length == 0 && imageArray.length > 0)
                   {
                      scope.imageArray = imageArray;
                      edit = 1;
                   }else if(scope.imageArray.length > 0 && imageArray.length > 0)
                   {
                      scope.imageArray = imageArray;
                      /*var a = mergeObjects(scope.imageArray, imageArray);
                      scope.imageArray = scope.imageArray.concat(a);*/
                      edit = 1;
                   }else if(scope.imageArray.length == 0 && imageArray.length == 0)
                   {
                      scope.message_error = langArray.message_error_select_image;
                      edit = 0;
                   }
                   if(featured != "")
                   {
                      scope.featuredImage = featuredImage ;
                   }

                   /*if(edit == 1)
                   {*/
                    if(scope.en_title != '' || scope.vi_title != '')
                    {  
                      var data = {
                        "id" : collectionId,
                        "en_name" : scope.en_title,
                        "vi_name" : scope.vi_title,
                        "featuredImage" : scope.featuredImage,
                        "collectionImage" : JSON.stringify(scope.imageArray)
                      }
                      CollectionService.updateCollectionById(data).success(function(res){
                          if(res == "TRUE")
                          {
                            $route.reload();
                          }
                      });
                    }else
                    {
                      scope.message_error = langArray.message_error_name;
                    }
                  /*}else
                   {
                      console.log('Khong update hinh anh');
                      var data = {
                        "id" : collectionId,
                        "name" : scope.title

                      };
                      CollectionService.updateCollectionById(data).success(function(res){
                          if(res == "TRUE")
                          {
                            $route.reload();
                          }
                      });
                   }*/
                   
                }
            }
        });      
    }
  };
});


function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            featured = document.getElementById("fileupload").files[0];
            $('#blah').attr('src', e.target.result).css({"display":"block"});
        }

        reader.readAsDataURL(input.files[0]);
    }
}
var i = 0;
function readURL2(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            collection.push(document.getElementById("morefileupload").files[0]);
           $('#more').append('<img class=" blah2" width="190px" id="'+i+'" src="'+e.target.result+'" alt="your image" />');
            i++;
        }
        reader.readAsDataURL(input.files[0]);

        setInterval(function(){
           $('.blah2').on('click', function(){
                $(this).attr('src', '').css({"display":"none"});
            });   
        }, 1000);
    }
}
var imageArray = [];
var featuredImage = '';
var uploadComplete = 0;
var per = 0;
var status  = 0;
function doUploaded(imgUpload)
{
  for(var i=0; i<collection.length; i++)
  {
    var data = new FormData();
      data.append('filename', imgUpload[i].name);
      data.append('myfile', imgUpload[i]);
    $.ajax({
          url: [baseUrl, 'admin', 'postImgUpload'].join('/'),
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
              completeBared(uploadComplete);
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
function doUploaded2(imgUpload)
{
    var data = new FormData();
    data.append('filename', imgUpload.name);
    data.append('myfile', imgUpload);
    $.ajax({
          url: [baseUrl, 'admin', 'postImgUpload2'].join('/'),
          type: 'POST',
          data: data,
          cache: false,
          processData: false, // Don't process the files
          contentType: false, // Set content type to false as jQuery will tell the server its a query string request
          success: function(data, textStatus, jqXHR)
          {
              featuredImage = data;
              uploadComplete++;
              completeBared(uploadComplete);
          },
          error: function(jqXHR, textStatus, errorThrown)
          {
              // Handle errors here
              console.log('ERRORS: ' + textStatus);
              // STOP LOADING SPINNER
          }
      });    
}
function completeBared(complete)
{
   
   var total = collection.length + 1;
   per = (complete%total)*100;
   if(per == 0)
   {
      status = 1;
      per = 100;
   }
   $('.progress-bar-success').css({"width":per+"%"});
}
//Function merge array
//http://codereview.stackexchange.com/questions/16306/how-to-optimize-merge-of-two-objects-that-include-arrays-of-objects
function isArray(o) {
  return Object.prototype.toString.call(o) == "[object Array]";
}

// Assumes that target and source are either objects (Object or Array) or undefined
// Since will be used to convert to JSON, just reference objects where possible
function mergeObjects(target, source) {

  var item, tItem, o, idx;

  // If either argument is undefined, return the other.
  // If both are undefined, return undefined.
  if (typeof source == 'undefined') {
    return source;
  } else if (typeof target == 'undefined') {
    return target;
  }

  // Assume both are objects and don't care about inherited properties
  for (var prop in source) {
    item = source[prop];

    if (typeof item == 'object' && item !== null) {

      if (isArray(item) && item.length) {

        // deal with arrays, will be either array of primitives or array of objects
        // If primitives
        if (typeof item[0] != 'object') {

          // if target doesn't have a similar property, just reference it
          tItem = target[prop];
          if (!tItem) {
            target[prop] = item;

          // Otherwise, copy only those members that don't exist on target
          } else {

            // Create an index of items on target
            o = {};
            for (var i=0, iLen=tItem.length; i<iLen; i++) {
              o[tItem[i]] = true
            }

            // Do check, push missing
            for (var j=0, jLen=item.length; j<jLen; j++) {

              if ( !(item[j] in o) ) {
                tItem.push(item[j]);
              } 
            }
          }
        } else {
          // Deal with array of objects
          // Create index of objects in target object using ID property
          // Assume if target has same named property then it will be similar array
          idx = {};
          tItem = target[prop]

          for (var k=0, kLen=tItem.length; k<kLen; k++) {
            idx[tItem[k].id] = tItem[k];
          }

          // Do updates
          for (var l=0, ll=item.length; l<ll; l++) {
            // If target doesn't have an equivalent, just add it
            if (!(item[l].id in idx)) {
              tItem.push(item[l]);
            } else {
              mergeObjects(idx[item[l].id], item[l]);
            }
          }  
        }
      } else {
        // deal with object
        mergeObjects(target[prop],item);
      }

    } else {
      // item is a primitive, just copy it over
      target[prop] = item;
    }
  }
  return target;
}
