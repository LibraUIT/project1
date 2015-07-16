<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title><?php echo $site_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="<?php  echo $description; ?>">
    <meta name="keywords" content="<?php echo $key_work; ?>">
    <meta name="author" content="Quan Nguyen">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/portfolio/css/mobile.css" />
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/starter-template/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container scroll" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand title" href="#"><?php echo $site_title; ?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
              <li class="active"><a href="<?php echo base_url(); ?>" class="title"><?php echo $this->lang->line('portfolio_menu_home'); ?></a></li>
              <li><a href="<?php echo base_url(); ?>portfolio/collections" class="title"><?php echo $this->lang->line('portfolio_menu_collection'); ?></a></li>
              <li><a href="<?php echo base_url(); ?>portfolio/press" class="title"><?php echo $this->lang->line('portfolio_menu_press'); ?></a></li>
              <li><a href="<?php echo base_url(); ?>portfolio/about" class="title"><?php echo $this->lang->line('portfolio_menu_about'); ?></a></li>
              <li><a href="<?php echo base_url(); ?>store" class="title"><?php echo $this->lang->line('portfolio_menu_store'); ?></a></li>
          </ul>
        </div><!--/.nav-collapse -->
        <?php $this->load->view($view); ?>
        <div id="lang">
          <a href="<?php echo base_url(); ?>portfolio/set_lang/en"><?php echo $this->lang->line('en'); ?></a> | 
           <a href="<?php echo base_url(); ?>portfolio/set_lang/vi"><?php echo $this->lang->line('vi'); ?></a>
        </div>
        <div id="footer">
          <a href="<?php echo $twitter; ?>">Twitter</a> | 
          <a href="<?php echo $facebook; ?>">Facebook</a> | 
          <a href="<?php echo $instagram; ?>">Instagram</a> | <a href="<?php echo $tumblr; ?>">Tumblr</a>
          <br>
          <?php echo $footer; ?> &copy; All Rights Reserved
          <div id="naptha_container0932014_0707">
          </div>
        </div>
      </div>
    </nav>
    
    
    


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>
<html data-ember-extension="1" style="background:white"><head><style>
  body{
    font-size: 14pt;
    font-family: HelveticaNeue-Light;
    color: white;
    background-color: black;
    padding: 10px;
    position: relative;
    margin: 0px;
  }
  img{
    width:100%;
  }
  #index-background
  {
      background-image: url('<?php echo base_url(); ?>public/portfolio/images/bgimage.jpg');
      background-size: 200px;
      background-repeat: no-repeat;
      background-position: right;
      background-position-y: 50px;
      background-color: #000;
  }

</style>
