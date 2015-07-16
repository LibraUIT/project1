<div class="container-fluid">
      <?php 
                $date = date_create($use['date']);
                $date1 = date_format($date, 'd / m / Y');
                $date2 = date_format($date, 'd-m-Y');
              ?>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo  $this->lang->line('use_asset_info') ; ?></h3>
        <a href="<?php echo base_url(); ?>auth/managers"><button type="button" class="btn btn-default btn-lg">  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo $this->lang->line('back'); ?></button></a>
        <button id="edit-report" style=" margin-left:20px;display:none" type="button" class="btn btn-primary btn-lg">  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <?php echo $this->lang->line('edit'); ?></button>
        <button style=" margin-left:20px;" onclick="PrintElem('.view-assign')" type="button" class="btn btn-primary btn-lg">  <span class="glyphicon glyphicon-print" aria-hidden="true"></span> <?php echo $this->lang->line('print'); ?></button>
        <!-- Edit -->
        <div style="display:none" class="form-edit-assign" >
            <p style="color:#d44950; font-size:15px; padding:20px; display:none" class="bg-danger errorMessage"></p>
            <table class="form">
              <tr>
                <td>
                  <div class="form-group">
                      <label>Loại</label>
                      <select class="form-control"  id="type-assign">
                        <?php
                          if($use['type'] == 1)
                          {
                            echo '<option selected="selected" value="1">Bàn giao</option>';
                          }else
                          {
                            echo '<option value="1">Bàn giao</option>';
                          }
                          if($use['type'] == 2)
                          {
                            echo '<option selected="selected" value="2">Trả</option>';
                          }else
                          {
                            echo '<option value="2">Trả</option>';
                          }
                          if($use['type'] == 3)
                          {
                            echo '<option selected="selected" value="3">Hủy</option>';
                          }else
                          {
                            echo '<option value="3">Hủy</option>';
                          } 
                        ?>
                        
                        
                        
                      </select>
                    </div>
                  </td>
                <td>
                <td>
                  <div class="form-group">
                      <label><?php echo  $this->lang->line('assign_from') ; ?></label>
                      <input id="assign_from" required type="text" class="form-control" placeholder="<?php echo  $this->lang->line('assign_from') ; ?>" value="<?php echo implode(', ', $object1); ?>">
                    </div>
                  </td>
                <td>
                  <div class="form-group">
                    <label><?php echo  $this->lang->line('assign_to') ; ?></label>
                    <input id="assign_to" required type="text" class="form-control" placeholder="<?php echo  $this->lang->line('assign_to') ; ?> " value="<?php echo implode(', ', $object2); ?>">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <label><?php echo $this->lang->line('date_use'); ?></label>
                    
                    <input id="dateUse" class="datepicker form-control" data-date-format="dd-mm-yyyy" placeholder="<?php echo $this->lang->line('time_use'); ?>" value="<?php echo $date2; ?>">
                  </div>
                </td>
              </tr>
            </table>
            <div class="form-group">
                    <label><?php echo $this->lang->line('select_tb'); ?></label>
                    <input id="select_tb" required type="text" class="form-control" placeholder="<?php echo  $this->lang->line('select_tb') ; ?>" value="<?php echo implode(', ', $tb2); ?>">
                  </div>
            <div class="form-group">
              <label><?php echo  $this->lang->line('note') ; ?></label>
              <textarea id="note" placeholder="<?php echo  $this->lang->line('note') ; ?>" class="form-control"><?php echo str_replace('<br />', '', $use['note']) ; ?></textarea>
            </div>
            <input id="type" type="hidden" value="update">
            <button class="btn btn-primary submit-assign"><?php echo  $this->lang->line('update') ; ?></button>
        </div>
        <!-- View -->
        <div id="view-assign"  class="view-assign">
            <div class="form-group">
                <table width="100%">
                  <tr>
                    <td style="text-align:center;margin-top:0px"><H4><?php echo $this->lang->line('company-title'); ?></H4></td>
                    <td style="text-align:center;margin-top:0px"><h4>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</h4>
                    <span style="border-bottom: 1px dotted #000;padding-bottom:5px">Độc Lập - Tự Do - Hạnh Phúc</span></td>
                  </tr>
                </table>
            </div>
            <div style="margin-top:50px" class="form-group">
              <h2 style="text-align:center"><?php 
              if($use['type'] == 1)
              {
                    echo $this->lang->line('title_assign'); 
              }else if($use['type'] == 2)
              {
                    echo $this->lang->line('title_assign_2');
              }else
              {
                    echo $this->lang->line('title_assign_3');
              }
              ?></h2>
            </div>
            <div class="form-group">
              
              <span><?php echo $this->lang->line('date'); ?> : <?php echo $date1; ?></span>
            </div>
            <div class="form-group">

              <h4><?php echo $this->lang->line('assign_from'); ?> </h4>
              <?php
                $stt = 1;
                foreach($object as $key=>$ob)
                {
                  echo '<span>'.$stt++.'. '.$ob.'</span><br>';
                }
              ?>
            </div>
            <div class="form-group">
              <h4><?php echo $this->lang->line('assign_to'); ?> </h4>
              <?php
                $stt = 1;
                foreach($HR as $key=>$hr)
                {
                  echo '<span>'.$stt++.'. '.$hr.'</span><br>';
                }
              ?>
            </div>
            <div class="form-group">
                <table class="table table-bordered" style="margin-top:20px;" id="table"  border="1" cellpadding="5" CELLSPACING="0" width="100%">
                    <tbody>
                    <tr>
                        <td><b><?php echo $this->lang->line('serial'); ?></b></td>
                        <td><b><?php echo $this->lang->line('tb_id'); ?></b></td>
                        <td><b><?php echo $this->lang->line('tb_name'); ?></b></td>
                        <td><b><?php echo $this->lang->line('tb_info'); ?></b></td>
                        <td><b><?php echo $this->lang->line('tb_quantity'); ?></b></td>
                    </tr>
                    <?php
                        $i=1;
                        foreach($table as $key => $tb)
                        {
                          echo '<tr>';
                          echo '<td>'.$i++.'</td>';
                          echo '<td>'.$key.'</td>';
                          echo '<td>'.$tb['name'].'</td>';
                          echo '<td>'.$tb['descTb'].'</td>';
                          echo '<td>'.$tb['quantity'].'</td>';
                          echo '</tr>';
                        }
                    ?>
                    </tbody>
                </table>    
            </div>
            <div class="form-group">
            <h4><?php echo $this->lang->line('note'); ?></h4>
            <p style="font-size:13px;text-align: justify;"><?php echo $use['note']; ?></p>
            </div>
            <div class="form-group">
            <table style="margin-top:20px;" width="100%">
              <tr>
                <td style="text-align:center"><h4><?php echo $this->lang->line('assign_from'); ?></h4></td>
                <td style="text-align:center"><h4><?php echo $this->lang->line('assign_to'); ?></h4></td>
              </tr>
            </table>
            </div>

        </div>
        
      </div>
</div>
<script type="text/javascript">
  var idAssign = '<?php echo $use['id']; ?>';
  var idTbHr = '<?php echo $use['id_use']; ?>';
  assign_from = <?php echo json_encode(array_keys($object1)); ?>;

  assign_to = <?php echo json_encode(array_keys($object2)); ?>;
  select_tb = <?php echo json_encode(array_keys($tb2)); ?>;
  var count1 = 0, count2 = 0; count3 =0;
  $( "#assign_from" ).on("click", function(){
    if(count1 == 0)
    {
      $( "#assign_from" ).val('');
      assign_from = [];
    }
    count1++;
  });
  $( "#assign_to" ).on("click", function(){
    
    if(count2 == 0)
    {
      $( "#assign_to" ).val('');
      assign_to = [];
    }
    count2++;
  });
  $( "#select_tb" ).on("click", function(){
    
    if(count3 == 0)
    {
      $( "#select_tb" ).val('');
      select_tb= [];
    }
    count3++;
  });

</script>
