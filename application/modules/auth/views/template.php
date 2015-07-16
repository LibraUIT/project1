<!DOCTYPE html>
<html>
<head>
	<title>KingCom Manament | <?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/stylesheet.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/select/multiple-select.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery-ui.css">
  <script type="text/javascript">
          var apiUrl = "<?php echo base_url(); ?>auth";
  </script>
  <script src="<?php echo base_url(); ?>public/js/jquery-1.9.1.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/jquery-ui.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/common.js"></script>
  <script src="<?php echo base_url(); ?>public/js/tb.js"></script>
  <script src="<?php echo base_url(); ?>public/js/hr.js"></script>
  <script src="<?php echo base_url(); ?>public/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>public/js/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>public/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url(); ?>public/select/jquery.multiple.select.js"></script>
  <script src="<?php echo base_url(); ?>public/js/uses.js"></script>
  <script src="<?php echo base_url(); ?>public/js/assign.js"></script>
  <script src="<?php echo base_url(); ?>public/js/admin.js"></script>
</head>
<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>auth/report">KingCom Management</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>auth/report"><?php echo $this->lang->line('menu_home'); ?></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->lang->line('menu_asset'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>auth/tb"><?php echo $this->lang->line('menu_manager_asset'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>auth/managers"><?php echo $this->lang->line('menu_uses_asset'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>auth/report1"><?php echo $this->lang->line('report_free'); ?></a></li>

              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->lang->line('menu_hr'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url(); ?>auth/hrlevel"><?php echo $this->lang->line('menu_hr_level'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>auth/hrteam"><?php echo $this->lang->line('menu_hr_team'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>auth/hrb"><?php echo $this->lang->line('menu_hr_hr'); ?></a></li>
              </ul>
            </li>
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->lang->line('say_hello'); ?> <b><?php echo $userLogin['username']; ?></b> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <?php
                    if($this->session->userdata('login') !== null)
                    {
                        echo '<li><a href="'.base_url().'auth/admin">Admin</a></li>';
                        echo '<li><a href="'.base_url().'auth/logout">'.$this->lang->line('logout').'</a></li>';

                    }else
                    {
                        echo '<li><a href="'.base_url().'auth/login">'.$this->lang->line('login').'</a></li>';
                        
                    }
                ?>
                
              </ul>
            </li>
            <?php
              if($this->session->userdata('lang') !== null)
              {
                  $lang = $this->session->userdata('lang');
                  switch($lang['0'])
                  {
                    case "vi":
                        echo '<li><a href="'.base_url().'auth/lang/set/en"><img src="'.base_url().'public/images/flags/us.png" ></a></li>';
                        break;
                    case "en";
                        echo '<li><a href="'.base_url().'auth/lang/set/vi"><img src="'.base_url().'public/images/flags/vn.png" ></a></li>';
                        break;    
                  }
              }else{
                  echo '<li><a href="'.base_url().'auth/lang/set/en"><img src="'.base_url().'public/images/flags/us.png" ></a></li>';
              } 
            ?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <?php $this->load->view($view) ?>


</body>
</html>