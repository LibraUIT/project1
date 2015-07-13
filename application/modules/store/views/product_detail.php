<?php
	$img_data = explode(",", $pro['images']);
	foreach ($img_data as $key => $value) {
		$img_url[$key] = rtrim(ltrim($value,'["'),'"]');
	}
	$name = $pro['name'];
	$description = $pro['description'];
?>
<header class="product_header page_header">
	<h1><?php echo $name; ?> </h1>
	<span class="dash"></span>
	<h3>
		<?php
		 setlocale(LC_MONETARY, 'en_GB');
		if(isset($pro['price_new']))
	     {
	         $ftm = '%i VND';
	         $money = money_format($ftm, $pro['price_new']);
	         $money = str_replace('GBP', '', $money);
	         echo "<span class='currency_sign'></span>". $money;
	         $money_new = money_format($ftm, $pro['price']);
	         $money_new = str_replace('GBP', '', $money_new);
	         echo "<h3 style='text-decoration: line-through;font-size:11px'><span class='currency_sign'></span>". $money_new."</h3>";
	       }else
	       {
	         $ftm = '%i VND';
	         $money = money_format($ftm, $pro['price']);
	         $money = str_replace('GBP', '', $money);
	         echo "<span class='currency_sign'></span>". $money;
			//echo "<span class='currency_sign'></span>"."35USD";
	     
	       }
		?>
	</h3>
</header>
<section id="product_images">
	<ul class="slides">
		<?php
			foreach ($img_url as $key => $value) {
				echo "<li id='image_".$key."'>";
				echo "<img src='".base_url().$value."' class='fade_in' alt='Image of &quot;".$name."&quot;' />";
				echo "</li>";
			}
		?>
	</ul>
</section>
<div id="product_info">
	<section id="product_description">
		<p><?php echo $description; ?></p>
	</section>
</div>
