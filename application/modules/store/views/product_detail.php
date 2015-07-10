<?php
	$img_url = rtrim(ltrim($pro['images'],'["'),'"]');
	$name = $pro['name'];
	$description = $pro['description'];
?>
<div id="content" class="strip">
	<div class="canvas fade_in">
		<header class="product_header page_header">
			<h1><?php echo $name; ?></h1>
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
		</div>
	</div>

</div>