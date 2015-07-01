<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE - Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>public/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>public/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var lang = null;
    </script>
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url(); ?>admin"><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg"><?php echo $this->lang->line('text_login_form_small_title'); ?></p>
          <div id="message-login-error" style="display:none" class="alert alert-danger alert-dismissable">
                    <h4><i class="icon fa fa-ban"></i><?php echo $this->lang->line('text_login_form_message_error_title'); ?></h4>
                    <span ></span>
          </div>
          <div class="form-group has-feedback">
            <input id="u_email" type="email" class="form-control" placeholder="<?php echo $this->lang->line('text_login_form_email_title'); ?>"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input id="u_password" type="password" class="form-control" placeholder="<?php echo $this->lang->line('text_login_form_password_title'); ?>"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> <?php echo $this->lang->line('text_login_form_remember_title'); ?>
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button id="submit-admin-login" class="btn btn-primary btn-block btn-flat"><?php echo $this->lang->line('text_login_form_sign_in_title'); ?></button>
            </div><!-- /.col -->
          </div>
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>public/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- adminlogin -->
    <script src="<?php echo base_url(); ?>public/admin/admin.login.js"></script>
    <script src="<?php echo base_url(); ?>public/admin/admin.common.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>