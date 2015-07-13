<aside id="more_products" class="canvas">
	<h3>Related products</h3>
	<ul id="products">
		<?php
			$count = count($info);
			for($i=0; $i<$count; $i++){
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

		?>
		<li></li>
	</ul>
</aside>