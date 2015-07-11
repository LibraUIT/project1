<?php
	$img_url = rtrim(ltrim($pro['images'],'["'),'"]');
	$name = $pro['name'];
	$description = $pro['description'];
?>
<header class="product_header page_header">
	<h1><?php echo $name; ?> </h1>
	<span class="dash"></span>
	<h3>
		<span class="currency_sign">$</span><?php echo $pro['price'];?>
	</h3>
</header>
<section id="product_images">
	<ul class="slides">
		<li id="image_1">
			<img src="<?php echo base_url().$img_url; ?>" class="fade_in" alt="Image of &quot;Ladies in Colorful Satin Gowns&quot; Original Sketch" />
		</li>
		<!-- :after -->
	</ul>
</section>
<div id="product_info">
	<section id="product_description">
		<p><?php echo $description; ?></p>
	</section>
	<section id="product_form">
		<form method="post" action="">
			<input id="option" name="cart[add][id]" type="hidden" value="93782383">
			<button id="product-addtocart" name="submit" type="submit" class="button">
				<span>Add to cart</span>
			</button>
		</form>
	</section>
	<ul id="social_links">
		<li id="social_facebook">
			<h4>Like it</h4>
			<div class="social_action">
				<!-- Insert your facebook links below -->
				<iframe src="//www.facebook.com/plugins/like.php?href=http://store.christiansiriano.com/product/ladies-in-colorful-satin-gowns-original-sketch&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50%; height:20px;" allowtransparency="true"></iframe> 
			</div>
		</li>
		<li id="social_tweet">
			<h4>Tweet it</h4>
			<div class="social_action">
				<!-- Insert your twiter links below -->
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://store.christiansiriano.com/product/ladies-in-colorful-satin-gowns-original-sketch" data-text="Check out " ladies="" in="" colorful="" satin="" gowns"="" original="" sketch="" from="" christian="" siriano!"="" data-via="CSiriano">Tweet</a>
				<!-- End -->
				<!-- SOME SCRIPT PROCESS FOR SWITTER MISSING HERE -->
			</div>
		</li>
		<!-- Warning Can not show Pinit icon -->
		<li id="social_pinterest">
			<h4>Pin it</h4>
			<div class="social_action">
				<!-- Insert your Pinterest links below -->
				<a class="PIN_1436501083707_pin_it_button_20 PIN_1436501083707_pin_it_button_en_20_gray PIN_1436501083707_pin_it_button_inline_20 PIN_1436501083707_pin_it_beside_20" data-pin-href="//www.pinterest.com/pin/create/button/?guid=Sk24y2WB2Vf7-1&amp;url=http%3A%2F%2Fstore.christiansiriano.com%2Fproduct%2Fladies-in-colorful-satin-gowns-original-sketch&amp;media=http%3A%2F%2Fimages.cdn.bigcartel.com%2Fbigcartel%2Fproduct_images%2F160161877%2Fmax_h-1000%2Bmax_w-1000%2F36.jpg&amp;description=An%20original%20one-of-a-kind%20sketch%20drawn%20and%20signed%20by%20Christian%20Siriano,%20unframed.%20Media:%20watercolor%20and%20ink%20on%20paper.%20Sketch%20orders%20are%20limited%20edition%20and%20non-refundable.%20Sketch%20dimensions:%2011%22%20x%2014%22" data-pin-log="button_pinit" data-pin-config="beside">
					<span class="PIN_1436501083707_hidden" id="PIN_1436501083707_pin_count_0">
						<i></i>
					</span>
				</a>
			</div>
		</li>
	</ul>
</div>
