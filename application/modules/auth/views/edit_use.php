<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo $this->lang->line('edit_use_asset'); ?></h3>
        <a href="<?php echo base_url(); ?>auth/tbuse"><button type="button" class="btn btn-default btn-lg">  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></button></a>
        <div class="form-edit-use" >
            <h4><?php echo $this->lang->line('use_asset_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <p style="color:#5cb85c; font-size:15px; padding:20px; display:none" class="bg-success successMessage"><?php echo $this->lang->line('message_update_success'); ?></p>
            <table class="form">
              <tr>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('tb_name'); ?> </label>
                    <br>
                    <select class="tbs" multiple="multiple">
                      <?php 
                        foreach ($lists as $list) {
                          echo '<option value="'.$list['id'].'">'.$list['name'].' ( '.$list['idTb'].' ) </option>';
                        }
                      ?>
                  </select>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('date_use'); ?></label>
                    <?php
                        $date = date_create($item['date_use']);
                        $date = date_format($date, 'd-m-Y');
                    ?>
                    <input id="dateUse" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('time_use'); ?>" value="<?php echo $date; ?>">
                  </div>
                </td>
              </tr>
            </table>
            <table class="form">
                <tr>
                  <td>
                      <div class="form-group">
                        <label><?php echo $this->lang->line('object'); ?> </label>
                        <div class="radio">
                          <label>
                            <input <?php if($item['ob'] == 1) echo 'checked="checked"'; ?> type="radio" name="optionsRadios" id="setpermission" value="1">
                            <?php echo $this->lang->line('all'); ?>
                          </label>
                          </div>
                      </div>
                  </td>
                  <td>
                      <div class="form-group">
                          <label></label>
                          <div class="radio">
                              <label>
                                <input <?php if($item['ob'] == 2) echo 'checked="checked"'; ?> type="radio" name="optionsRadios" id="setpermission" value="2">
                                <?php echo $this->lang->line('team'); ?>
                              </label>
                          </div>
                      </div>
                  </td>
                  <td>
                      <div class="form-group">
                          <label></label>
                          <div class="radio">
                              <label>
                                <input <?php if($item['ob'] == 3) echo 'checked="checked"'; ?> type="radio" name="optionsRadios" id="setpermission" value="3">
                                <?php echo $this->lang->line('personal'); ?>
                              </label>
                          </div>
                      </div>
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td>
                    <div class="form-group">
                        <select class="teams" multiple="multiple" style="width:470px">
                          <?php 
                            foreach ($teams as $team) {
                              echo '<option value="'.$team['id'].'">'.$team['name'].'</option>';
                            }
                          ?>
                        </select>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                        <select class="personal" multiple="multiple" style="width:440px">
                          <?php
                            foreach ($hrs as $hr) {
                              echo '<option value="'.$hr['id'].'">'.$hr['fullname'].' - '.$hr['team'].'</option>';
                            }
                          ?>
                        </select>
                    </div>
                  </td>
                </tr>
            </table>
            
            <div class="form-group">
              <label><?php echo $this->lang->line('note'); ?></label>
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"><?php echo $item['note_use']; ?>
              </textarea>
            </div>
            <input id="ob" value="<?php echo $item['ob']; ?>" type="hidden">
            <input id="id" type="hidden" value="<?php echo $item['use_id']; ?>">
            <input id="type" type="hidden" value="update">
            <button class="btn btn-primary submit-set-use"><?php echo $this->lang->line('update'); ?></button>
        </div>
      </div>
</div>
