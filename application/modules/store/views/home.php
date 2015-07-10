<?php
  $count = count($pro);
  echo "<ul id='products' class='' </br>";
  for($i = 0; $i < $count; $i++)
  {
    $id = $pro[$i]['id'];
    $img_url = rtrim(ltrim($pro[$i]['images'],'["'),'"]');
    $product_name =  $pro[$i]['name'];
    $price = $pro[$i]['price'];
    echo "<li id='".$pro[$i]['id']."' class='product'>";
    echo "<a href=".base_url()."store/viewProduct/".$id." title='".$product_name."'>";
    echo "<div class='product_header'>";
    echo "<h2>".$product_name."</h2>";
    echo "<span class='dash'></span>"; 
    echo "<h3><span class='currency_sign'>$</span>".$price."</h3>";
    echo "</div>";
    echo "<div class='product_thumb'>";
    echo "<img src='".base_url()."$img_url'/>"; //Thay thế bằng BASE_URL
    echo "</div>";
    echo "</a>";
    echo "</li>";
  }
  echo "</ul>";
?>

