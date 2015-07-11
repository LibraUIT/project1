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
    echo "<a href=".base_url()."store/viewProduct/".$id."/".$this->rewrite->make($product_name).".html"." title='".$product_name."'>";
    echo "<div class='product_header'>";
    echo "<h2>".$product_name."</h2>";
    echo "<span class='dash'></span>"; 
    setlocale(LC_MONETARY, 'en_GB');
   
    if(isset($pro[$i]['price_new']))
    {
      $ftm = '%i VND';
      $money = money_format($ftm, $pro[$i]['price_new']);
      $money = str_replace('GBP', '', $money);
      echo "<h3><span class='currency_sign'></span>". $money."</h3>";
      $money_new = money_format($ftm, $price);
      $money_new = str_replace('GBP', '', $money_new);
      echo "<h3 style='text-decoration: line-through;font-size:11px'><span class='currency_sign'></span>". $money_new."</h3>";
    }else
    {
      $ftm = '%i VND';
      $money = money_format($ftm, $pro[$i]['price']);
      $money = str_replace('GBP', '', $money);
      echo "<h3><span class='currency_sign'></span>". $money."</h3>";
     
    }
    
    echo "</div>";
    echo "<div class='product_thumb'>";
    echo "<img src='".base_url()."$img_url'/>"; //Thay thế bằng BASE_URL
    echo "</div>";
    echo "</a>";
    echo "</li>";
  }
  echo "</ul>";
?>
