<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo $this->lang->line('set_use_asset'); ?></h3>
        <button type="button" class="btn btn-primary show-form"><?php echo $this->lang->line('create_use_asset'); ?></button>
        <div class="form-add-use" >
            <h4><?php echo $this->lang->line('use_asset_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
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
                    <input id="dateUse" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('time_use'); ?>" value="<?php echo date('d-m-Y'); ?>">
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
                            <input checked="checked" type="radio" name="optionsRadios" id="setpermission" value="1">
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
                                <input type="radio" name="optionsRadios" id="setpermission" value="2">
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
                                <input type="radio" name="optionsRadios" id="setpermission" value="3">
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
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"></textarea>
            </div>
            <input id="type" type="hidden" value="create">
            <button class="btn btn-primary submit-set-use"><?php echo $this->lang->line('done'); ?></button>
        </div>

        <div class="list-hrlevel">
        <table id="list-hrlevel" class="table table-hover table-bordered" lass="display" cellspacing="0" width="100%">
          <thead>
          <tr id="getList">
            <td><?php echo $this->lang->line('serial'); ?></td>
            <td><?php echo $this->lang->line('tb_id'); ?></td>
            <td><?php echo $this->lang->line('tb_name'); ?></td>
            <td><?php echo $this->lang->line('used'); ?></td>
            <td><?php echo $this->lang->line('note'); ?></td>
            <td><?php echo $this->lang->line('date_use'); ?></td>
            <td style="text-align:center"><?php echo $this->lang->line('edit'); ?></td>
            <td style="text-align:center"><?php echo $this->lang->line('delete'); ?></td>
          </tr>
          </thead>
          <tbody>
          <?php
            $stt = 1; 
            foreach($arrs as $arr)
            {
              echo '<tr>';
              echo '<td>'.$stt++.'</td>';
              echo '<td>'.$arr['tb_id'].'</td>';
              echo '<td>'.$arr['name_tb'].'</td>';
              echo '<td>'.$arr['object_use'].'</td>';
              echo '<td>'.$arr['note_use'].'</td>';
              $date = date_create($arr['date_use']);
              $date = date_format($date, 'd-m-Y');
              echo '<td>'.$date.'</td>';
              echo '<td style="text-align:center"><a href="'.base_url().'auth/thietbi/editUse/'.$arr['use_id'].'"><button type="button" class="btn btn-primary btn-xs">'.$this->lang->line('edit').'</button></a></td>';
              echo '<td style="text-align:center"><button onclick="delTbUse('.$arr['use_id'].')" type="button" class="btn btn-danger btn-xs">'.$this->lang->line('delete').'</button></td>';
              echo '</tr>';
            }
          ?>
          </tbody>
        </table>
        </div>
      </div>
</div>
