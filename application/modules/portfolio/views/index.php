-<!DOCTYPE html>
<html>
<head>
	<title><?php echo $site_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="description" content="<?php  echo $description; ?>">
	<meta name="keywords" content="<?php echo $key_work; ?>">
	<meta name="author" content="Quân Nguyễn - facebok.com/librauit">
	<script type="text/javascript" src="<?php echo base_url(); ?>public/portfolio/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/portfolio/js/mine.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/portfolio/css/hover.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/portfolio/css/animate.css" media="all">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/portfolio/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/portfolio/css/style1.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/portfolio/css/mine.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>public/portfolio/js/modernizr.custom.86080.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
			var base_url = "<?php echo base_url(); ?>";
			var last_collection = "<?php echo $last_collection; ?>";
	</script>
	<link href="<?php echo base_url(); ?>public/portfolio/lightbox/ekko-lightbox.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>public/portfolio/lightbox/ekko-lightbox.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/portfolio/js/jquery.lazyload.js"></script>
	<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">-->
</head>
<body>
<header class="animated slideInDown">
	<div class="lang">
		 <a href="<?php echo base_url(); ?>portfolio/set_lang/en"><?php echo $this->lang->line('en'); ?></a>
		 /
         <a href="<?php echo base_url(); ?>portfolio/set_lang/vi"><?php echo $this->lang->line('vi'); ?></a>
	</div>
	<div class="web-name"><h1 style="text-transform: uppercase"><?php echo $site_title; ?></h1></div>
	<div class="nav-menu">
		<ul>
			<li id="1" class="hvr-sweep-to-top"><?php echo $this->lang->line('portfolio_menu_home'); ?></li>
			<li id="2" class="hvr-sweep-to-top"><?php echo $this->lang->line('portfolio_menu_collection'); ?></li>
			<li id="3" class="hvr-sweep-to-top"><?php echo $this->lang->line('portfolio_menu_about'); ?></li>
			<li id="4" class="hvr-sweep-to-top"><?php echo $this->lang->line('portfolio_menu_press'); ?></li>
			<li id="5" class="hvr-sweep-to-top"><a href="<?php echo base_url(); ?>store" target="_blank"><?php echo $this->lang->line('portfolio_menu_store'); ?></a></li>
			<!--<li id="6" class="hvr-sweep-to-top">Retailers</li>-->
			<!--<li id="7" class="hvr-sweep-to-top">Contact</li>-->
		</ul>
	</div>
</header>
<article class="article1 animated slideInUp">
	<div class="article hvr-shutter-out-vertical latest-collection">
		<h1>The latest looks</h1>
		<h4>View the collection</h4>
	</div>
	<?php
		if($link_1_title != '')
		{
	?>
	<div class="article hvr-shutter-out-vertical">
		<a target="_blank" href="<?php echo $link_1_url; ?>">
		<h1><?php echo $link_1_title; ?></h1>
		<h4><?php echo $link_1_small_title; ?></h4>
		</a>
	</div>
	<?php
		}
	?>
	<?php
		if($link_2_title != '')
		{
	?>
	<div class="article hvr-shutter-out-vertical">
		<a target="_blank" href="<?php echo $link_2_url; ?>">
		<h1><?php echo $link_2_title; ?></h1>
		<h4><?php echo $link_2_small_title; ?></h4>
		</a>
	</div>
	<?php
		}
	?>
</article>
<div class="article2 animated">
	<h2><?php echo $about_title; ?></h2>
	<p>
		<?php echo nl2br($about_content); ?>
	</p>
	<h2><?php echo $contact_name; ?></h2>
	<p>
		<?php echo nl2br($contact_content); ?>
	</p>	
</div>
<!--<div class="article3 animated">
	<div class="form-contact">
		<h1>Contact</h1>
		<label>Please Note:</label>
		<p>
			Before you send a message, please check to see if your question is answered in our FAQ (Frequently Asked Questions), which you can find to the right. Messages sent here will be received by our office staff. Christian Siriano does not receive any personal messages sent below or to the contact e-mails to the right. This form is for business and professional inquiries. We do not accept any unsolicited materials. Please fill out all fields and click "send my message.
		</p>
		<br>
		<form>
		<label>Name</label><br>
		<input required type="text" id="name" ><br><br>
		<label>E-mail</label><br>
		<input required type="email" id="email" ><br><br>
		<label>Message</label><br>
		<textarea required id="message"></textarea><br><br>
		<input type="submit" id="send-message" value="Send my message">
		</form>
	</div>
	<div class="content-contact">
		<ul>
			<li>
				<h4>Address</h4>
				<span>155 Nguyen Chi Thanh, F9</span>
			</li>
		</ul>
	</div>
</div>-->
<div class="collection" >
</div>
<div class="collection-title animated">
		<ul>
			<h1 style="text-transform: uppercase;"><?php echo $this->lang->line('portfolio_menu_collection'); ?></h1>
			<!--<li>
				<span>2015</span>
				<ul>
					
					<li class="collectid" id="collect_1">Spring / Summer</li>
					<li class="collectid" id="collect_2">Pre Fall</li>
				</ul>
			</li>
			<li>
				<span>2014 -15</span>
				<ul>
					<li class="collectid" id="collect_4">Resort</li>
				</ul>
			</li>
			<li>
				<span class="collectid" id="collect_3">BRIDAL</span>
			</li>-->
			<?php
			if(count($collections) > 0)
			{
				foreach($collections as $collection)
				{
			?>
			<li>
				<span class="collectid" id="collect_<?php echo $collection['collection_id']; ?>"><?php echo $collection['collection_name']; ?></span>
			</li>
			<?php				
				}
			}
			?>
		</ul>
</div>
<div class="list-collection animated">
	<ul>
		<!--<li class="collect_1"><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav7.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li class="collect_2"><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav11.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li class="collect_3"><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav12.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li class="collect_4"><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav13.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav14.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav15.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav16.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav17.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>
		<li><img height="500" src="<?php echo base_url(); ?>public/portfolio/img/collections/nav/nav18.jpg"><div class="view-gallary hvr-bounce-to-right">View Gallary</div></li>-->
		<?php
		if(count($collections) > 0)
		{
			foreach($collections as $collection)
			{
		?>
		<li class="collect_<?php echo $collection['collection_id']; ?>"><img style="width:103px" height="500" src="<?php echo base_url().$collection['collection_featured_image']; ?>"><div class="view-gallary hvr-bounce-to-right">Xem Bộ Sưu Tập</div></li>
		<?php				
			}
		}
		?>
	</ul>
</div>
<div class="show-collection animated">
	<div class="title-content-collection">
		<h1 ><i id="title-content-collection"></i></h1>
	</div>
	<div class="content-collection">
		<div class="show-image">
			<img id="show-image" style="width:337px" height="505" src="">
		</div>
		<div class="gallery-collection">
			<ul id="gallery-collection">
				<!--<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_10th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_9th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_8th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_7th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_6th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_5th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_4th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_3th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_2th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_1th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_10th.jpg"></li>
				<li><img src="<?php echo base_url(); ?>public/portfolio/img/collections/aw2015/thumb/CSAW2015_9th.jpg"></li>-->

			</ul>
		</div>
	</div>
	<div class="back-to-all animated"><b><?php echo $this->lang->line('portfolio_back'); ?> </b><br /> <?php echo $this->lang->line('portfolio_menu_collection'); ?></div>
</div>
<div class="press" >
</div>
<div class="press-title animated">
<h4>Press</h4>
</div>
<div  class="list-press animated row">
	 <div style="margin-left:5%;width:95%;height:100%;overflow: scroll;overflow-x:hidden" class="class-press">
	 <?php
	 echo '<div class="row">';
	 foreach ($press as $key => $value) {
	 ?>
	 <a href="<?php echo base_url().$value['press_image_2']; ?>" data-toggle="lightbox" data-gallery="multiimages" data-title="<?php echo $value['press_name']; ?>" class="col-sm-3">
     <img data-original="<?php echo base_url().$value['press_image_2']; ?>" class="thumb-press lazy img-responsive">
     </a>
	 <?php
	 }
	 echo '</div>';
	 ?>
		  		
	 </div>
</div>
<footer>
	<ul class="animated slideInLeft">
		<li><?php echo $footer; ?></li>
		<li> &copy; All Rights Reserved</li>
	</ul>
	<div class="social animated slideInRight">
		<li><a href="<?php echo $facebook; ?>">Facebook</a></li>
		<li><a href="<?php echo $instagram; ?>">Instagram</a></li>
		<li><a href="<?php echo $twitter; ?>">Twitter</a></li>
		<li><a href="<?php echo $tumblr; ?>">Tumblr</a></li>
	</div>
</footer>
<!-- BackgroundSlide -->
<ul class="cb-slideshow">
            <li><span>Image 01</span><div></div></li>
            <li><span>Image 02</span><div></div></li>
            <li><span>Image 03</span><div></div></li>
            <li><span>Image 04</span><div></div></li>
            <li><span>Image 05</span><div></div></li>
            <li><span>Image 06</span><div></div></li>
</ul>
<!-- End -->
</body>
</html>
 <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js"></script>
 <script type="text/javascript">
			$(function() {
			    $("img.lazy").lazyload();
			});
            $(document).ready(function ($) {
                // delegate calls to data-toggle="lightbox"
                $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
                    event.preventDefault();
                    return $(this).ekkoLightbox({
                        onShown: function() {
                            if (window.console) {
                                return console.log('Checking our the events huh?');

                            }
                        },
						onNavigate: function(direction, itemIndex) {
                            if (window.console) {
                                return console.log('Navigating '+direction+'. Current item: '+itemIndex);
                            }
						}
                    });
                });

                //Programatically call
                $('#open-image').click(function (e) {
                    e.preventDefault();
                    $(this).ekkoLightbox();


                });
                $('#open-youtube').click(function (e) {
                    e.preventDefault();
                    $(this).ekkoLightbox();
                });

				// navigateTo
                $(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {

                    event.preventDefault();

                    return $(this).ekkoLightbox({
                        onShown: function() {

							var a = this.modal_content.find('.modal-footer a');
							if(a.length > 0) {

								a.click(function(e) {

									e.preventDefault();
									this.navigateTo(2);

								}.bind(this));

							}

                        }
                    });
                });


            });
        </script>
