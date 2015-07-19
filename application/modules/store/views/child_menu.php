<aside class="category_nav">
	<nav class="categories">
		<h3><?php echo $this->lang->line('text_store_product'); ?></h3>
		<ul>
			<li class="selected">
				<!-- ::before --> <!-- Do not understand this line -->
				<a href="<?php echo base_url();?>store/products/0-all.html"><?php echo $this->lang->line('text_all'); ?></a>
			</li>
			<?php
			foreach($categorys as $cate)
			{		
			?>
			<li class="page">
				<a href="<?php echo base_url()."store/products/".$cate['category_id']."-".$this->rewrite->make($cate['category_name']); ?>.html" title="View <?php echo $cate['category_name']; ?>"><?php echo $cate['category_name']; ?></a>
			</li>
			<?php
			}
			?>
			<!--<li class="page">
				<a href="/category/tops" title="View Tops">Tops</a>
			</li>
			<li class="page">
				<a href="/category/skirts" title="View Skirts">Skirts</a>
			</li>
			<li class="page">
				<a href="/category/dresses" title="View Dresseses">Dresses</a>
			</li>
			<li class="page">
				<a href="/category/accessories" title="View Accessories">Accessories</a>
			</li>
			<li class="page">
				<a href="/category/limited-edition" title="View Limited Edition">Limited Edition</a>
			</li>
			<li class="page">
				<a href="/category/outerwear" title="View Outerwear">Outerwear</a>
			</li>
			<li class="page">
				<a href="/category/bottoms" title="View Bottoms">Bottoms</a>
			</li>
			<li class="page">
				<a href="/category/shoes" title="View Shoes">Shoes</a>
			</li>
			<li class="page">
				<a href="/category/sketches" title="View Sketches">Sketches</a>
			</li>
			<li class="page">
				<a href="/category/gifts" title="View Gifts">Gifts</a>
			</li>
			<li class="page">
				<a href="/category/under-150" title="View Under $150">Under $150</a>
			</li>-->
		</ul>
	</nav>
</aside>