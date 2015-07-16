<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo  $this->lang->line('manager_hr') ; ?></h3>
        <?php
        if($this->session->userdata('login') !== null)
        {
          ?>
        <button type="button" class="btn btn-primary show-form"><?php echo  $this->lang->line('create_hr') ; ?></button>
        <button id="export-excel-hr" type="button" class="btn btn-primary">  <span class="glyphicon glyphicon-download" aria-hidden="true"></span> <?php echo $this->lang->line('export-excel'); ?></button>
        <?php
        }
        ?>
        <div class="form-add-hr" >
            <h4><?php echo $this->lang->line('hr_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <p style="color:#5cb85c; font-size:15px; padding:20px; display:none" class="bg-success successMessage">Thêm mới nhân sự thành công.</p>
            <table class="form">
              <tr>
                <td><div class="form-group">
                  <label><?php echo $this->lang->line('idhr'); ?></label>
                  <input id="idHr" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('idhr'); ?>">
                </div></td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('fullname'); ?></label>
                    <input id="fullname" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('fullname'); ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('level'); ?></label>
                    <select class="form-control" id="hrlevel">
                      <?php
                        foreach ($levels as $level) {
                          echo '<option  value="'.$level['id'].'">'.$level['name'].'</option>';
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
                            echo '<option  value="'.$team['id'].'">'.$team['name'].'</option>';
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
                    <input id="timejoin" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('timejoin'); ?>" value="<?php echo date('d-m-Y'); ?>">
                  </div>
                </td>
                <td>
                 <div class="form-group">
                    <label><?php echo $this->lang->line('email'); ?></label>
                    <input id="email" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>">
                  </div>   
                </td>
                <td colspan="2">
                  <div class="form-group">
                    <label><?php echo $this->lang->line('skype'); ?></label>
                    <input id="skype" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('skype'); ?>">
                  </div>
                </td>
                <tr>
                  <td colspan="2">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('address'); ?></label>
                      <input id="address" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('address'); ?>">
                    </div>
                  </td>
                  <td colspan="2">
                    <div class="form-group">
                      <label><?php echo $this->lang->line('phone'); ?></label>
                      <input id="phone" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('phone'); ?>">
                    </div>
                  </td>
                </tr>
              </tr>
            </table>
            <div class="form-group">
              <label><?php echo $this->lang->line('note'); ?></label>
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"></textarea>
            </div>
            <input id="type" type="hidden" value="create">
            <button class="btn btn-primary submit-hr"><?php echo $this->lang->line('done'); ?></button>
        </div>

        <div class="list-hr">
        <table id="list-hr" class="table table-hover table-bordered" lass="display" cellspacing="0" width="100%">
          <thead>
          <tr id="getList">
            <td><?php echo $this->lang->line('serial'); ?></td>
            <td><?php echo $this->lang->line('idhr'); ?></td>
            <td><?php echo $this->lang->line('fullname'); ?></td>
            <td><?php echo $this->lang->line('level'); ?></td>
            <td><?php echo $this->lang->line('team'); ?></td>
            <?php
            if($this->session->userdata('login') !== null)
            {
              ?>
            <td style="text-align:center"><?php echo $this->lang->line('edit'); ?></td>
            <td style="text-align:center"><?php echo $this->lang->line('delete'); ?></td>
            <?php
            }
            ?>
          </tr>
          </thead>
          <tbody>
          <?php
            $stt = 1; 
            foreach($items as $item)
            {
              echo '<tr>';
              echo '<td>'.$stt++.'</td>';
              echo '<td>'.$item['id_hr'].'</td>';
              echo '<td>'.$item['fullname'].'</td>';
              
              echo '<td>'.$item['level'].'</td>';
              echo '<td>'.$item['team'].'</td>';
              if($this->session->userdata('login') !== null)
              {
              echo '<td style="text-align:center"><a href="'.base_url().'auth/hr/editHr/'.$item['id'].'"><button type="button" class="btn btn-primary btn-xs">'.$this->lang->line('edit').'</button></a></td>';
              echo '<td style="text-align:center"><button onclick="delHr('.$item['id'].')" type="button" class="btn btn-danger btn-xs">'.$this->lang->line('delete').'</button></td>';
              }
              echo '</tr>';
            }
          ?>
          </tbody>
        </table>
        </div>
      </div>
</div>
