<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo $this->lang->line('hr_info_update'); ?></h3>
        <a href="<?php echo base_url(); ?>auth/hrb"><button type="button" class="btn btn-default btn-lg">  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></button></a>
        <div class="form-edit-hr" >
            <h4><?php echo $this->lang->line('hr_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <p style="color:#5cb85c; font-size:15px; padding:20px; display:none" class="bg-success successMessage"><?php echo $this->lang->line('message_update_success'); ?></p>
            <table class="form">
              <tr>
                <td><div class="form-group">
                  <label><?php echo $this->lang->line('idhr'); ?></label>
                  <input value="<?php echo $item['id_hr']; ?>" id="idHr" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('idhr'); ?>">
                </div></td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('fullname'); ?></label>
                    <input value="<?php echo $item['fullname']; ?>" id="fullname" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('fullname'); ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('level'); ?></label>
                    <select class="form-control" id="hrlevel">
                      <?php
                        foreach ($levels as $level) {
                          if($item['level'] == $level['id'])
                            {
                              echo '<option selected="selected"  value="'.$level['id'].'">'.$level['name'].'</option>';
                            }else
                            {
                              echo '<option  value="'.$level['id'].'">'.$level['name'].'</option>';
                            }
                        }
                      ?>
                    </select>
                  </div>
                </td>
                <td>
                    <div class="form-group">
                      <label><?php echo $this->lang->line('team'); ?></label>
                      <select class="form-control" id="hrteam">
                        <?php
                          foreach ($teams as $team) {
                            if($item['team'] == $team['id'])
                              {
                                echo '<option selected="selected"  value="'.$team['id'].'">'.$team['name'].'</option>';
                              }else
                              {
                                echo '<option  value="'.$team['id'].'">'.$team['name'].'</option>';
                              }
                          }
                        ?>
                      </select>
                    </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('timejoin'); ?></label>
                    <?php 
                      $date_create = date_create($item['date_join']);
                      $date_join = date_format($date_create, 'd-m-Y');
                    ?>
                    <input value="<?php echo $date_join; ?>" id="timejoin" class="datepicker form-control" data-date-format="mm-dd-yyyy" placeholder="<?php echo $this->lang->line('timejoin'); ?>" >
                  </div>
                </td>
                <td>
                 <div class="form-group">
                    <label><?php echo $this->lang->line('email'); ?></label>
                    <input id="email" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php echo $item['email']; ?>">
                  </div>   
                </td>
                <td colspan="2">
                  <div class="form-group">
                    <label><?php echo $this->lang->line('skype'); ?></label>
                    <input id="skype" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('skype'); ?>" value="<?php echo $item['skype']; ?>">
                  </div>
                </td>
                <tr>
                  <td colspan="2">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('address'); ?></label>
                      <input id="address" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('address'); ?>" value="<?php echo $item['address']; ?>">
                    </div>
                  </td>
                  <td colspan="2">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('phone'); ?></label>
                      <input id="phone" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('phone'); ?>" value="<?php echo $item['phone']; ?>">
                    </div>
                  </td>
                </tr>
              </tr>
            </table>
            <div class="form-group">
              <label><?php echo $this->lang->line('note'); ?></label>
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"><?php echo $item['note']; ?></textarea>
            </div>
            <input id="id" type="hidden" value="<?php echo $item['id']; ?>">
            <input id="type" type="hidden" value="update">
            <button class="btn btn-primary submit-hr"><?php echo $this->lang->line('update'); ?></button>
        </div>
      </div>
</div>
