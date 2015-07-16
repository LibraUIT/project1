<?php
foreach($pro as $key => $value){
	echo "<aside id='more_products' class='canvas'>";
	echo "<h3>$key</h3>";
	echo "</aside>";
	echo "<ul id='products'>";
	for($i = 0; $i < count($pro[$key]); $i++){
		$id = $value[$i]['id'];
		$product_name = $value[$i]['name'];
		$price = $value[$i]['price'];
		$price_new = $value[$i]['price_new'];
		$img_data = explode(",", $value[$i]['images']);
		foreach ($img_data as $keys => $values) {
        	$img_url[$keys] = rtrim(ltrim($values,'["'),'"]');
    	}
		echo "<li id='".$id."' class='product'>";
		echo "<a href='".base_url()."store/viewProduct/".$id."/"."' title='View $product_name'>";
		echo "<div class='product_header'>";
		echo "<h2>$product_name</h2>";
		echo "<span class='dash'></span>";
		echo "<h3><span class='currency_sign'>$</span>".$price."</h3>"; // Fix lại chổ này money_format()
		echo "</div>";
		echo "<div class='product_thumb'>";
		echo "<img src='".base_url().$img_url['0']."'/>";
		echo "</div>";
		echo "</a>";
		echo "</li>";
	}
	echo "</ul>";
	
}
