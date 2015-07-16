<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/auth.login.css">
</head>
<body>
<div class="container">
<div class="form-login">
 <form method="post" action="<?php echo base_url(); ?>auth/submit">
  <h1><?php echo $this->lang->line('login'); ?></h1>
  <?php
  	if(isset($error))
  	{
  		echo '<p style="text-align:center; padding:5px; color: #c7254e" class="bg-danger">'.$error.'</p>';
  	}
  ?>
  <div class="form-group">
    <label><?php echo $this->lang->line('username'); ?></label>
    <input required name="username" type="text" class="form-control" id="username" placeholder="<?php echo $this->lang->line('username'); ?>" 
    value="<?php if(isset($username)){ echo $username; } ?>" >
  </div>
  <div class="form-group">
    <label><?php echo $this->lang->line('password'); ?></label>
    <input required name="password" type="password" class="form-control" id="password" placeholder="<?php echo $this->lang->line('password'); ?>">
  </div>
  <button name="submit" type="submit" class="btn btn-primary"><?php echo $this->lang->line('login'); ?></button>
  <div>
  <br>   
            <?php
              echo $this->lang->line('language');
              if($this->session->userdata('lang') !== null)
              {
                  $lang = $this->session->userdata('lang');
                  switch($lang['0'])
                  {
                    case "vi":
                        echo '<a href="'.base_url().'auth/lang/set/en"><img src="'.base_url().'public/images/flags/us.png" ></a>';
                        break;
                    case "en";
                        echo '<a href="'.base_url().'auth/lang/set/vi"><img src="'.base_url().'public/images/flags/vn.png" ></a>';
                        break;    
                  }
              }else{
                  echo '<a href="'.base_url().'auth/lang/set/en"><img src="'.base_url().'public/images/flags/us.png" ></a>';
              } 
            ?>
  </div>          
</form>
</div>
</div>
<script src="<?php echo base_url(); ?>public/js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
</body>
</html>