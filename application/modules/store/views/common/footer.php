<div id="site_footer" class="strip">
      <footer class="canvas">
        <h3><?php echo $this->lang->line('text_store_more'); ?></h3>
        <ul>
          <li><a href="/" alt="Home"><?php echo $this->lang->line('text_store_home'); ?></a></li>      
          <li><a href="/products"><?php echo $this->lang->line('text_store_product'); ?></a></li>
        
                
          <li><a href="/contact"><?php echo $this->lang->line('text_store_contact'); ?></a></li>
          <!--<li><a href="/cart">Cart</a></li>  -->      
          
          <li><a href="http://twitter.com/CSiriano" title="Follow us on Twitter">Twitter</a></li>
          
          
          <li><a href="http://facebook.com/christiansirianofans" title="Friend us on Facebook">Facebook</a></li>
          
          
          <li id="search">
            <form id="search-form" name="search" action="/products" method="get">
              <a href="#search-form"><?php echo $this->lang->line('text_store_search'); ?></a>
              <input id="search-input" name="search" type="text">
            </form>
          </li>
                   
        </ul>
        <p><?php echo $footer; ?> &copy; All Rights Reserved</p>
      
        
        <a href="#" id="website" class="button"><?php echo $this->lang->line('text_store_back_to_site'); ?></a>
        
      
        <!--<div id="badge"><a href="#" title="Start your own store at Big Cartel now">Online Store by Big Cartel</a></div>-->      
      </footer>
</div>