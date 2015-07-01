<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo $this->lang->line('tb_info_update'); ?></h3>
            <a href="<?php echo base_url(); ?>auth/tb"><button type="button" class="btn btn-default btn-lg">  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></button></a>
            <div class="form-edit-tb" >
            <h4><?php echo $this->lang->line('tb_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px ; display:none" class="bg-danger errorMessage"></p>
            <p style="color:#5cb85c; font-size:15px; padding:20px ; display:none" class="bg-success successMessage"><?php echo $this->lang->line('message_update_success'); ?></p>
            <table class="form">
              <tr>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('tb_id'); ?></label>
                    <input id="idTb" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('tb_id'); ?>" value="<?php echo $item['idTb']; ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('tb_name'); ?></label>
                    <input id="nameTb" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('tb_name'); ?>" value="<?php echo $item['name']; ?>">
                  </div>
                </td>
                <!--<td>
                  <div class="form-group">
                    <label><?php //echo $this->lang->line('tb_date_buy'); ?></label>
                    
                    <?php 
                      //$date_buy = date_create($item['date_buy']);
                    ?>
                    <input id="timebuy" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('date_buy'); ?>" value="<?php echo date_format($date_buy,'d-m-Y'); ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php //echo $this->lang->line('tb_time_use'); ?></label>
                    <?php
                      //$time_use = date_create($item['date_use']);
                    ?>
                    <input id="timeUse" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('time_use'); ?>" value="<?php echo date_format($time_use,'d-m-Y'); ?>">
                  </div>
                </td>-->
              </tr>
            </table>
            
           
            <div class="form-group">
              <label><?php echo $this->lang->line('tb_info'); ?></label>
              <textarea id="desc" placeholder="<?php echo $this->lang->line('tb_info'); ?>" class="form-control"><?php echo $item['descTb']; ?></textarea>
            </div>
            <div class="form-group">
              <label><?php echo $this->lang->line('note'); ?></label>
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"><?php echo $item['note']; ?></textarea>
            </div>
            <input id="type" type="hidden" value="update">
            <input id="id" type="hidden" value="<?php echo $item['id']; ?>">
            <button class="btn btn-primary submit"><?php echo $this->lang->line('update'); ?></button>
        </div>
      </div>
</div>