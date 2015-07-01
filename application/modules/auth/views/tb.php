<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo $this->lang->line('manager_tb'); ?></h3>
        <?php
          if($this->session->userdata('login') !== null)
          {


        ?>
          <button type="button" class="btn btn-primary show-form-update-quantity"><?php echo $this->lang->line('create_tb'); ?></button>
          <button type="button" class="btn btn-primary show-form "><?php echo $this->lang->line('update_quantity_tb'); ?></button>
        <?php
          }
        ?>
        <div class="form-add-tb" >
            <h4><?php echo $this->lang->line('tb_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px ; display:none" class="bg-danger errorMessage"></p>
            <table class="form">
              <tr>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('tb_id'); ?></label>
                    <input id="idTb" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('tb_id'); ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('tb_name'); ?></label>
                    <input id="nameTb" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('tb_name'); ?>">
                  </div>
                </td>
                <!--<td>
                <div class="form-group">
                    <label><?php //echo $this->lang->line('tb_date_buy'); ?></label>
                    <input id="timebuy" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('date_buy'); ?>" value="<?php echo date('d-m-Y'); ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php //echo $this->lang->line('tb_time_use'); ?></label>
                    <input id="timeUse" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('time_use'); ?>" value="<?php echo date('d-m-Y'); ?>">
                  </div>
                </td>-->
              </tr>
            </table>
            
           
            <div class="form-group">
              <label><?php echo $this->lang->line('tb_info'); ?></label>
              <textarea id="desc" placeholder="<?php echo $this->lang->line('tb_info'); ?>" class="form-control"></textarea>
            </div>
            
            <div class="form-group">
              <label><?php echo $this->lang->line('note'); ?></label>
              <textarea id="note" placeholder="<?php echo $this->lang->line('note'); ?>" class="form-control"></textarea>
            </div>
            <input id="type" type="hidden" value="create">
            <button class="btn btn-primary submit"><?php echo $this->lang->line('done'); ?></button>
        </div>
        <div class="form-update-quantity-tb" >
            <h4><?php echo $this->lang->line('tb_update_quantity_info'); ?></h4>
            <p style="color:#d44950; font-size:15px; padding:20px ; display:none" class="bg-danger searchErrorMessage"></p>
            
            <div class="ui-widget">
                      <select id="combobox">
                        <option value="">Select one...</option>
                        <?php
                          foreach($items as $item)
                          {
                            echo '<option value="'.$item['id'].'">'.$item['name'].' - '.$item['idTb'].'</option>';
                          }
                        ?>
                      </select>
                      <button class="btn btn-primary search"><?php echo $this->lang->line('tb_search'); ?></button>
            </div>
            <!-- Form update  quantity -->
            <div id="form-update-quantity" style="display:none">
            <h4><?php echo $this->lang->line('tb_info'); ?> : <span id="info_tb">ds</span></h4>
            <p style="color:#d44950; font-size:15px; padding:20px ; display:none" class="bg-danger errorMessage"></p>
            <p style="color:#5cb85c; font-size:15px; padding:20px ; display:none" class="bg-success successMessage"><?php echo $this->lang->line('message_update_success'); ?></p>
            <table class="form">
              <tr>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('tb_quantity'); ?></label>
                    <input id="quantityTb" required type="text" class="form-control" placeholder="<?php echo $this->lang->line('tb_quantity'); ?>">
                  </div>
                </td>
                <td>
                <div class="form-group">
                    <label><?php echo $this->lang->line('tb_date_buy'); ?></label>
                    <input id="timebuy" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('date_buy'); ?>" value="<?php echo date('d-m-Y'); ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('tb_time_use'); ?></label>
                    <input id="timeUse" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('time_use'); ?>" value="<?php echo date('d-m-Y'); ?>">
                  </div>
                </td>
              </tr>
            </table>
            <input id="type" type="hidden" value="update_quantity">
            <button class="btn btn-primary submit-update-quantity"><?php echo $this->lang->line('update'); ?></button>
          </div>
        </div>
        <div class="list-tb">
        <?php
        if($this->session->userdata('login') !== null)
        {
        ?>
        <div class="form-group">
                    <div class="ui-widget">
                      <select id="combobox-index">
                        <option value="">Select one...</option>
                        <?php
                          foreach($items as $item)
                          {
                            echo '<option value="'.$item['id'].'">'.$item['name'].' - '.$item['idTb'].'</option>';
                          }
                        ?>
                      </select>
                      <button class="btn btn-primary search-index"><?php echo $this->lang->line('tb_search'); ?></button>
                    </div>
        </div>
        <?php
          }
        ?> 
        <div class="list-tb-result">
        <table id="list-tb" class="table table-hover table-bordered" lass="display" cellspacing="0" width="100%">
          <thead>
          <tr id="getList">
            <td><?php echo $this->lang->line('serial'); ?></td>
            <td><?php echo $this->lang->line('tb_id'); ?></td>
            <td><?php echo $this->lang->line('tb_name'); ?></td>
            <td><?php echo $this->lang->line('tb_quantity'); ?></td> 
            <?php 
              if($this->session->userdata('login') !== null)
              {
              ?>      
            <td style="text-align:center"><?php echo $this->lang->line('edit'); ?></td>
            <td style="text-align:center"><?php echo $this->lang->line('delete'); ?></td>
            <?php } ?>
          </tr>
          </thead>
          <tbody>
          <?php
            $stt = 1; 
            foreach($items as $item)
            {
              echo '<tr>';
              echo '<td>'.$stt++.'</td>';
              echo '<td>'.$item['idTb'].'</td>';
              echo '<td>'.$item['name'].'</td>';
              echo '<td>'.$item['quantity'].'</td>';
              if($this->session->userdata('login') !== null)
              {
                echo '<td style="text-align:center"><a href="'.base_url().'auth/thietbi/edit/'.$item['id'].'"><button type="button" class="btn btn-primary btn-xs">'.$this->lang->line('edit').'</button></a></td>';
                echo '<td style="text-align:center"><button onclick="delTb(\''.$item['idTb'].'\')" type="button" class="btn btn-danger btn-xs">'.$this->lang->line('delete').'</button></td>';
              }
              echo '</tr>';
            }
          ?>
          </tbody>
        </table>
        </div>
        <div class="list-tb-search-result" style="display:none">
          <table id="list-tb-search" class="table table-hover table-bordered" lass="display" cellspacing="0" width="100%">
              <thead>
              <tr id="getList">
                <td><?php echo $this->lang->line('serial'); ?></td>
                <td><?php echo $this->lang->line('tb_id'); ?></td>
                <td><?php echo $this->lang->line('tb_name'); ?></td>
                  <td><?php echo $this->lang->line('tb_quantity'); ?></td>       
                  <td style="text-align:center"><?php echo $this->lang->line('edit'); ?></td>
                <td style="text-align:center"><?php echo $this->lang->line('delete'); ?></td>
              </tr>
              </thead>
              <tbody>
                
              </tbody>
          </table>
        </div>
        </div>
      </div>
</div>
