<div id="site_header" class="strip">
      <div class="canvas">
        <nav id="main_nav">
          <ul>
            <li><a href="<?php echo base_url(); ?>store/products"><?php echo $this->lang->line('text_store_product'); ?></a></li><li><a href="<?php echo base_url(); ?>store/contact"><?php echo $this->lang->line('text_store_contact'); ?></a></li><!--<li><a href="<?php echo base_url(); ?>store/cart">Cart</a></li>-->
          </ul>
        </nav>
        <br />
        <div style="font-size:11px;text-align:center">
          <a href="<?php echo base_url(); ?>store/set_lang/en"><?php echo $this->lang->line('en'); ?></a>
          /
         <a href="<?php echo base_url(); ?>store/set_lang/vi"><?php echo $this->lang->line('vi'); ?></a>
         </div>
        <header>
          
          <div id="branding">
            <a href="<?php echo base_url(); ?>store">
              <h2><?php echo $this->lang->line('text_store_home'); ?></h2>
              <img src="http://images.cdn.bigcartel.com/bigcartel/theme_images/6088794/max_h-1000+max_w-1000/Christian_Siriano_logosm.jpg" alt="Christian Siriano">
            </a>
          </div>
          
        </header>
      
        <nav id="mobile_nav">
          <ul>
            <li><a href="<?php echo base_url(); ?>store/products"><?php echo $this->lang->line('text_store_product'); ?></a></li>
            <!--<li><a href="<?php echo base_url(); ?>store/cart">Cart</a></li>-->
            <li><a href="#site_footer" alt="See more options"><?php echo $this->lang->line('text_store_more'); ?></a></li>          
          </ul>      
        </nav>
      </div>
</div>