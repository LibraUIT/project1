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
<<<<<<< HEAD
			// $data = array(
			// 	$pro[rand(0,$count)],
				
			// );
			if(count($pro) <= 3){
				for($i=0; $i<count($pro); $i++){
					$id = $pro[$i]['id'];
					$name = $pro[$i]['name'];
					$price = $pro[$i]['price'];
					$price_new = $pro[$i]['price_new'];
					$img_data = explode(",", $proList[$i]['images']);
				    foreach ($img_data as $key => $value) {
				        $img_url[$key] = rtrim(ltrim($value,'["'),'"]');
				    }
					echo "<li id='".$id."' class='product'>";
					echo "<a href='".base_url()."store/viewProduct/".$id."' title='View ".$name."'>";
					echo "<div class='product_header'>";
					echo "<h2>".$name."</h2>";
					echo "<span class='dash'></span>";
					echo "<h3><span class='currency_sign'>$</span>".$price."</h3>";
					echo "</div>";
					echo "<div class='product_thumb'>";
					echo "<img src='".base_url().$img_url['0']."' class='fade_in' alt='Image of".$name."' />";
					echo "</div>";
					echo "</a>";
					echo "</li>";
				}
			}
			else{
				$rand_select = hrand(0, count($pro)-1);
				// echo count($pro);
				// echo "<pre>";
				// print_r($rand_select);
				// echo "</pre>";

				foreach($rand_select as $key => $value){
					$proList[$key] = $pro[$value];
				}
				// echo count($proList);
				// echo "<pre>";
				// print_r($proList);
				// echo "</pre>";
=======
			$count = count($info);
			for($i=0; $i<$count; $i++){
				$id = $info[$i]['id'];
				$name = $info[$i]['name'];
				$price = $info[$i]['price'];
				$price_new = $info[$i]['price_new'];
				$images = rtrim(ltrim($info[$i]['images'],'["'),'"]');
				echo "<li id='".$id."' class='product'>";
				echo "<a href='".base_url()."store/viewProduct/".$id."/".$this->rewrite->make($name).".html"."' title='View ".$name."'>";
				echo "<div class='product_header'>";
				echo "<h2>".$name."</h2>";
				echo "<span class='dash'></span>";
				if(isset($info[$i]['price_new']))
				{
					$ftm = '%i VND';
					$money = money_format($ftm, $price_new);
       				$money = str_replace('GBP', '', $money);
					echo "<h3><span class='currency_sign'></span>".$money."</h3>";
					$money_new = money_format($ftm, $price);
       				$money_new = str_replace('GBP', '', $money_new);
       				echo "<h3 style='text-decoration: line-through;font-size:11px'><span class='currency_sign'></span>".$money_new."</h3>";
				}else
				{
					$ftm = '%i VND';
					$money = money_format($ftm, $price);
       				$money = str_replace('GBP', '', $money);
					echo "<h3><span class='currency_sign'></span>".$money."</h3>";
				}		
				echo "</div>";
				echo "<div class='product_thumb'>";
				echo "<img src='".base_url().$images."' class='fade_in' alt='Image of".$name."' />";
				echo "</div>";
				echo "</a>";
				echo "</li>";
>>>>>>> aa904718486410897ee83533b15bc854a85a855d

				// echo "<pre>";
				// print_r($proList);
				// echo "</pre>";
				for($i=0; $i<3; $i++){
					$id = $proList[$i]['id'];
					$name = $proList[$i]['name'];
					$price = $proList[$i]['price'];
					$price_new =$proList[$i]['price_new'];
					$img_data = explode(",", $proList[$i]['images']);
				    foreach ($img_data as $key => $value) {
				        $img_url[$key] = rtrim(ltrim($value,'["'),'"]');
				    }
					echo "<li id='".$id."' class='product'>";
					echo "<a href='".base_url()."store/viewProduct/".$id."' title='View ".$name."'>";
					echo "<div class='product_header'>";
					echo "<h2>".$name."</h2>";
					echo "<span class='dash'></span>";
					echo "<h3><span class='currency_sign'>$</span>".$price."</h3>";
					echo "</div>";
					echo "<div class='product_thumb'>";
					echo "<img src='".base_url().$img_url['0']."' class='fade_in' alt='Image of".$name."' />";
					echo "</div>";
					echo "</a>";
					echo "</li>";
				}
			}
			

		?>
		<li></li>
	</ul>
</aside>