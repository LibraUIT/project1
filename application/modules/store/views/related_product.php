<?php
# This function random 3 interger values and return array result
# Author: Huy Vo
# Date: 13/07/2015
# Kaka... ^^
function hrand($min, $max){
	$result = array();
	$x = rand($min, $max);
	if($x < $max && $x > $min){
		$y = rand($min, $x-1);
		$z = rand($x+1, $max);
		$result = array($x, $y, $z);
	}
	else
	{
		return hrand($min, $max);
	}
	return $result;
}

?>
<aside id="more_products" class="canvas">
	<h3>Related products</h3>
	<ul id="products">
		<?php
			if(count($info) <= 3){
				for($i=0; $i<count($info); $i++){
					$id = $info[$i]['id'];
					$name = $info[$i]['name'];
					$price = $info[$i]['price'];
					$price_new = $info[$i]['price_new'];
					$images = rtrim(ltrim($info[$i]['images'],'["'),'"]');
					echo "<li id='".$id."' class='product'>";
					echo "<a href='".base_url()."store/viewProduct/".$id."' title='View ".$name."'>";
					echo "<div class='product_header'>";
					echo "<h2>".$name."</h2>";
					echo "<span class='dash'></span>";
					echo "<h3><span class='currency_sign'>$</span>".$price."</h3>";
					echo "</div>";
					echo "<div class='product_thumb'>";
					echo "<img src='".base_url().$images."' class='fade_in' alt='Image of".$name."' />";
					echo "</div>";
					echo "</a>";
					echo "</li>";
				}
			}
			else{
				$rand_select = hrand(0, count($info)-1);
				foreach($rand_select as $key => $value){
					$proList[$key] = $info[$value];
				}
				for($i=0; $i<3; $i++){
					$id = $proList[$i]['id'];
					$name = $proList[$i]['name'];
					$price = $proList[$i]['price'];
					$price_new =$proList[$i]['price_new'];
					$images = rtrim(ltrim($proList[$i]['images'],'["'),'"]');
					echo "<li id='".$id."' class='product'>";
					echo "<a href='".base_url()."store/viewProduct/".$id."' title='View ".$name."'>";
					echo "<div class='product_header'>";
					echo "<h2>".$name."</h2>";
					echo "<span class='dash'></span>";
					echo "<h3><span class='currency_sign'>$</span>".$price."</h3>";
					echo "</div>";
					echo "<div class='product_thumb'>";
					echo "<img src='".base_url().$images."' class='fade_in' alt='Image of".$name."' />";
					echo "</div>";
					echo "</a>";
					echo "</li>";
				}
			}

		?>
		<li></li>
	</ul>
</aside>