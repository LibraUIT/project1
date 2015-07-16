<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3>Admin</h3>
        <div class="form-edit-hr-level" >
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <p style="color:#5cb85c; font-size:15px; padding:20px; display:none" class="bg-success successMessage"><?php echo $this->lang->line('message_update_success'); ?></p>
            <table class="form">
              <tr>
                <td>
                  <div class="form-group">
                      <label><?php echo  $this->lang->line('old_password') ; ?></label>
                      <input id="old" required type="password" class="form-control" placeholder="<?php echo  $this->lang->line('old_password') ; ?>" value="">
                    </div>
                  </td>
                <td>
                  <div class="form-group">
                    <label><?php echo  $this->lang->line('new_password') ; ?></label>
                    <input id="new" required type="password" class="form-control" placeholder="<?php echo  $this->lang->line('new_password') ; ?>" value="">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo  $this->lang->line('re_password') ; ?></label>
                    <input id="re" required type="password" class="form-control" placeholder="<?php echo  $this->lang->line('re_password') ; ?>" value="">
                  </div>
                </td>
              </tr>
            </table>
            <button class="btn btn-primary submit-admin"><?php echo $this->lang->line('update'); ?></button>
        </div>
      </div>
</div>
