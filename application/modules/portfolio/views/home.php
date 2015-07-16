      <div id="index-background">
          <p>
            <?php echo $message; ?>
          </p>

          <div class="link-list">
            <a href="<?php echo base_url(); ?>">
              <?php echo $this->lang->line('portfolio_menu_home'); ?>
            </a>
            <br>
            <a href="<?php echo base_url(); ?>portfolio/collections">
              <?php echo $this->lang->line('portfolio_menu_collection'); ?>
            </a>
            <br>
            <a href="<?php echo base_url(); ?>portfolio/about">
              <?php echo $this->lang->line('portfolio_menu_about'); ?>
              
            </a>
            <br>
            <a href="<?php echo base_url(); ?>portfolio/press">
              <?php echo $this->lang->line('portfolio_menu_press'); ?>
            </a>
            <br>
            <a href="<?php echo base_url(); ?>store">
              <?php echo $this->lang->line('portfolio_menu_store'); ?>
            </a>

          </div>
        <br>
      </div>