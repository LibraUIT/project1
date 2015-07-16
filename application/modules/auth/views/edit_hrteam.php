<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo $this->lang->line('team_info_update'); ?></h3>
        <a href="<?php echo base_url(); ?>auth/hrteam"><button type="button" class="btn btn-default btn-lg">  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></button></a>
        <div class="form-edit-hr-level" >
            <h4><?php echo $this->lang->line('team_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <p style="color:#5cb85c; font-size:15px; padding:20px; display:none" class="bg-success successMessage"><?php echo $this->lang->line('message_update_success'); ?></p>
            <table class="form">
              <tr>
                <td>
                    <div class="form-group">
                      <label><?php echo $this->lang->line('team_id'); ?></label>
                      <input id="teamid" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('team_id'); ?>" value="<?php echo $item['team_id']; ?>">
                    </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('team_name'); ?></label>
                    <input id="name" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('team_name'); ?>" value="<?php echo $item['name']; ?>">
                  </div>
                </td>
              </tr>
            </table>
            <div class="form-group">
              <label><?php echo $this->lang->line('note'); ?></label>
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"><?php echo $item['note']; ?></textarea>
            </div>
            <input id="id" type="hidden" value="<?php echo $item['id']; ?>">
            <input id="type" type="hidden" value="update">
            <button class="btn btn-primary submit-hr-team"><?php echo $this->lang->line('update'); ?></button>
        </div>
      </div>
</div>
