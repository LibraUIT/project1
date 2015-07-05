$(window).bind("load", function() {
    var basePageId = 1;
    loadPage(basePageId);
    var colorTitle = [
        "#CFD8DC",
        "#FCE4EC",
        "#F8BBD0",
        "#F48FB1"
    ];
    var time = 1;
    setInterval(function(){ 
        $('.web-name h1').css({"color" : colorTitle[time]});
        time++;
        if(time + 0 == 4 )
        {
            time = 0;
        }
    }, 8000);
    function loadPage(basePageId)
    {
        $(function(){
          //Reset nav menu
          $('.nav-menu ul li').css({"background-color" : "transparent", "color" : "#CFD8DC"});
          $('.nav-menu ul li').hover(function(){
            $(this).css({"color" : "#E53935"});
          });
          $('.nav-menu ul li').mouseleave(function(){
               var id = $(this).attr('id');
               if(basePageId != id)
               {
                    $(this).css({"color" : "#CFD8DC"});
               }else
               {
                    $(this).css({"color" : "#000"}); 
               } 
          });    
          switch(basePageId)
          {
            case 1:
                $('li#1').css({"background-color" : "#CFD8DC", "color" : "#000"});
                break;
            case 2:
                $('li#2').css({"background-color" : "#CFD8DC", "color" : "#000"});
                break;    
            case 3:
                $('li#3').css({"background-color" : "#CFD8DC", "color" : "#000"});
                break;
            case 7:
                $('li#7').css({"background-color" : "#CFD8DC", "color" : "#000"});
                break;         
          }
        });
    }
    function clearArticle()
    {
        $('.collection').css({"display" : "none"});
        $('.article1').removeClass('slideInUp').addClass('fadeOutUpBig');
        $('.article2').removeClass('slideInUp').addClass('fadeOutUpBig');
        $('.article3').removeClass('slideInUp').addClass('fadeOutUpBig');
        $('.collection-title').removeClass('slideInLeft').addClass('fadeOutUpBig');
        $('.list-collection').removeClass('slideInUp').addClass('fadeOutUpBig');
        $('.show-collection').fadeOut();
        $('.cb-slideshow').show();
    }
    function mouseleaveImage()
    {
       $('.list-collection ul li').mouseleave(function(){
            $(this).find('img').css({"-webkit-filter" : "grayscale(90%)"});
            $(".collectid").css({"color" : "#000"});
       });
    }
    function mouseleaveLink()
    {
        $('.collectid').mouseleave(function(){
            $(this).css({"color" : "#000"});
            $('.list-collection ul li img').css({"-webkit-filter" : "grayscale(90%)"});
        });

    } 
    $('.view-gallary').hover(function(){
        $(this).parent().find('img').css({"-webkit-filter" : "grayscale(0%)"});
        mouseleaveImage();
    }); 
    $('.list-collection ul li').hover(function(){
        $(this).find('img').css({"-webkit-filter" : "grayscale(0%)"});
        var collect_id = $(this).attr('class');
        $(".collectid").css({"color" : "#000"});
        $('#'+collect_id).css({"color" :"#FFF"});
        mouseleaveImage();
    });
    $('.collectid').hover(function(){
        $(this).css({"color" : "#FFF"});
        var collect_id = $(this).attr('id');
        $('.'+collect_id).find('img').css({"-webkit-filter" : "grayscale(0%)"});
        mouseleaveLink();
    });
    $('.collectid').on('click', function(){
        var collect_id = $(this).attr('id');
        $('.collection-title').fadeOut();
        $('.list-collection').fadeOut();
        $('.show-collection').css({"display" : "block"});
        $('.show-collection').addClass('fadeInUp');
        $('.show-collection').removeClass('fadeOutUp');
        $.ajax({
          method: "POST",
          url: base_url+['portfolio', 'get_collection_by_id'].join('/'),
          data: { collect_id : collect_id }
          })
          .done(function( res ) {
                $('#title-content-collection').text(res.collection_name);
                var collections = JSON.parse(res.collection_image_list);
                $('#show-image').attr('src', base_url+collections[0]);
                var listImage = '';
                var count = 0;
                $.each( collections, function( key, value ) {
                    if(count == 0)
                    {
                       listImage += '<li><img class="clickImage" onclick="clickImage('+count+')" style="width:52px;height:78px;-webkit-filter: grayscale(0%);" src="'+base_url+value+'"></li>'; 
                    }
                    else
                    {
                        listImage += '<li><img class="clickImage" onclick="clickImage('+count+')" style="width:52px;height:78px" src="'+base_url+value+'"></li>';
                    }
                    count++;
                });
                $('#gallery-collection').html(listImage);
          });
    });
    $('.latest-collection').on('click', function(){
        basePageId = 2;
        loadPage(basePageId)
        clearArticle();
        $('.collection').css({"display" : "block"});
        $('.collection-title').css({"display" : "block"});
        $('.collection-title').addClass('slideInLeft');
        $('.list-collection').css({"display" : "block"});
        $('.list-collection').addClass('slideInUp');
        var collect_id = 'collect_43';
        $('.collection-title').fadeOut();
        $('.list-collection').fadeOut();
        $('.show-collection').css({"display" : "block"});
        $('.show-collection').addClass('fadeInUp');
        $('.show-collection').removeClass('fadeOutUp');
        getCollection(collect_id);
    });
    $('.view-gallary').on('click', function(){
        var collect_id = $(this).parent().attr('class');
        $('.collection-title').fadeOut();
        $('.list-collection').fadeOut();
        $('.show-collection').css({"display" : "block"});
        $('.show-collection').addClass('fadeInUp');
        $('.show-collection').removeClass('fadeOutUp');
        $.ajax({
          method: "POST",
          url: base_url+['portfolio', 'get_collection_by_id'].join('/'),
          data: { collect_id : collect_id }
          })
          .done(function( res ) {
                $('#title-content-collection').text(res.collection_name);
                var collections = JSON.parse(res.collection_image_list);
                $('#show-image').attr('src', base_url+collections[0]);
                var listImage = '';
                var count = 0;
                $.each( collections, function( key, value ) {
                    if(count == 0)
                    {
                       listImage += '<li><img class="clickImage" onclick="clickImage('+count+')" style="width:52px;height:78px;-webkit-filter: grayscale(0%);" src="'+base_url+value+'"></li>'; 
                    }
                    else
                    {
                        listImage += '<li><img class="clickImage" onclick="clickImage('+count+')" style="width:52px;height:78px" src="'+base_url+value+'"></li>';
                    }
                    count++;
                });
                $('#gallery-collection').html(listImage);
          });
    });
    $('.back-to-all').on('click', function(){
        $('.collection-title').fadeIn();
        $('.list-collection').fadeIn();
        $('.show-collection').addClass('fadeOutUp');
        $('.show-collection').css({"display" : "none"});
    });
    $("#1").on("click", function(){
        basePageId = 1;
        loadPage(basePageId)
        clearArticle();
        $('.article1').css({"display" : "block"});
        $('.article1').addClass('slideInUp');
        $('body').css({"background-image" : "none"});
    });
    $("#2").on("click", function(){
        basePageId = 2;
        loadPage(basePageId)
        clearArticle();
        $('.collection').css({"display" : "block"});
        $('.collection-title').css({"display" : "block"});
        $('.collection-title').addClass('slideInLeft');
        $('.list-collection').css({"display" : "block"});
        $('.list-collection').addClass('slideInUp');
    });
    $("#3").on("click", function(){
        basePageId = 3;
        loadPage(basePageId);
        clearArticle();
        $('.cb-slideshow').hide();
        $('.article2').css({"display" : "block"});
        $('.article2').addClass('slideInUp');
        $('body').css({"background-image" : "url('"+base_url+"public/portfolio/img/about/about.jpg')"});
    });
    $("#7").on("click", function(){
        basePageId = 7;
        loadPage(basePageId);
        clearArticle();
        $('.cb-slideshow').hide();
        $('.article3').css({"display" : "block"});
        $('.article3').addClass('slideInUp');
        $('body').css({"background-image" : "url('"+base_url+"public/portfolio/img/contact/contact.jpg')"});
    });


});
function clickImage(img)
{
  // $('.clickImage').css({"-webkit-filter":"grayscale(0%)"});
   $( ".clickImage" ).each(function( index ) {
        if(index == img)
        {
            $(this).css({"-webkit-filter":"grayscale(0%)"});
            var img_url = $(this).attr('src');
            $('#show-image').attr('src',img_url);
        }else
        {
           $(this).css({"-webkit-filter":"grayscale(100%)"}); 
        }
    });     
}
function getCollection(collect_id)
{
   $.ajax({
          method: "POST",
          url: base_url+['portfolio', 'get_collection_by_id'].join('/'),
          data: { collect_id : collect_id }
          })
          .done(function( res ) {
                $('#title-content-collection').text(res.collection_name);
                var collections = JSON.parse(res.collection_image_list);
                $('#show-image').attr('src', base_url+collections[0]);
                var listImage = '';
                var count = 0;
                $.each( collections, function( key, value ) {
                    if(count == 0)
                    {
                       listImage += '<li><img class="clickImage" onclick="clickImage('+count+')" style="width:52px;height:78px;-webkit-filter: grayscale(0%);" src="'+base_url+value+'"></li>'; 
                    }
                    else
                    {
                        listImage += '<li><img class="clickImage" onclick="clickImage('+count+')" style="width:52px;height:78px" src="'+base_url+value+'"></li>';
                    }
                    count++;
                });
                $('#gallery-collection').html(listImage);
          }); 
}