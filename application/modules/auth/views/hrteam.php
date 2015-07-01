<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo $this->lang->line('manager_team'); ?></h3>
        <?php
          if($this->session->userdata('login') !== null)
          {
            ?>
        <button type="button" class="btn btn-primary show-form"><?php echo $this->lang->line('create_team'); ?></button>
        <?php
        }
        ?>
        <div class="form-add-hr-team" >
            <h4><?php echo $this->lang->line('team_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <table class="form">
              <tr>
                <td>
                    <div class="form-group">
                      <label><?php echo $this->lang->line('team_id'); ?></label>
                      <input id="teamid" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('team_id'); ?>">
                    </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('team_name'); ?></label>
                    <input id="name" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('team_name'); ?>">
                  </div>
                </td>
              </tr>
            </table>
            <div class="form-group">
              <label><?php echo $this->lang->line('note'); ?></label>
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"></textarea>
            </div>
            <input id="type" type="hidden" value="create">
            <button class="btn btn-primary submit-hr-team"><?php echo $this->lang->line('done'); ?></button>
        </div>

        <div class="list-hrteam">
        <table id="list-hrteam" class="table table-hover table-bordered" lass="display" cellspacing="0" width="100%">
          <thead>
          <tr id="getList">
            <td><?php echo $this->lang->line('serial'); ?></td>
            <td><?php echo $this->lang->line('team_id'); ?></td>
            <td><?php echo $this->lang->line('team_name'); ?></td>
            <td><?php echo $this->lang->line('note'); ?></td>
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
              echo '<td>'.$item['team_id'].'</td>';
              echo '<td>'.$item['name'].'</td>';
              echo '<td>'.$item['note'].'</td>';
              if($this->session->userdata('login') !== null)
              { 
              echo '<td style="text-align:center"><a href="'.base_url().'auth/hr/edit_team/'.$item['id'].'"><button type="button" class="btn btn-primary btn-xs">'.$this->lang->line('edit').'</button></a></td>';
              echo '<td style="text-align:center"><button onclick="delHrTeam('.$item['id'].')" type="button" class="btn btn-danger btn-xs">'.$this->lang->line('delete').'</button></td>';
              }
              echo '</tr>';
            }
          ?>
          </tbody>
        </table>
        </div>
      </div>
</div>
