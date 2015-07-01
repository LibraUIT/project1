<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo  $this->lang->line('use_asset_info') ; ?></h3>
        <a href="<?php echo base_url(); ?>auth/managers"><button type="button" class="btn btn-default btn-lg">  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></button></a>
        <div class="form-add-assign" >
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <table class="form">
              <tr>
                <td>
                  <div class="form-group">
                      <label><?php echo  $this->lang->line('type') ; ?></label>
                      <select class="form-control"  id="type-assign">
                        <option value="1"><?php echo  $this->lang->line('type_1') ; ?></option>
                        <option value="2"><?php echo  $this->lang->line('type_2') ; ?></option>
                        <option value="3"><?php echo  $this->lang->line('type_3') ; ?></option>
                      </select>
                    </div>
                  </td>
                <td>
                <td>
                  <div class="form-group">
                      <label><?php echo  $this->lang->line('assign_from') ; ?></label>
                      <input id="assign_from" required type="text" class="form-control" placeholder="<?php echo  $this->lang->line('assign_from') ; ?>">
                    </div>
                  </td>
                <td>
                  <div class="form-group">
                    <label><?php echo  $this->lang->line('assign_to') ; ?></label>
                    <input id="assign_to" required type="text" class="form-control" placeholder="<?php echo  $this->lang->line('assign_to') ; ?>">
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
            <div class="form-group">
                    <label><?php echo $this->lang->line('select_tb'); ?></label>
                    <input id="select_tb" required type="text" class="form-control" placeholder="<?php echo  $this->lang->line('select_tb') ; ?>">
                  </div>
            <div class="form-group">
              <label><?php echo  $this->lang->line('note') ; ?></label>
              <textarea id="note" placeholder="<?php echo  $this->lang->line('note') ; ?>" class="form-control"></textarea>
            </div>
            <input id="type" type="hidden" value="create">
            <button class="btn btn-primary submit-assign"><?php echo  $this->lang->line('done') ; ?></button>
        </div>
      </div>
</div>
