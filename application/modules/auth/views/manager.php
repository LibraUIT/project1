<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo  $this->lang->line('manager_assign') ; ?></h3>
        <?php
        if($this->session->userdata('login') !== null)
        {
          ?>
        <a href="<?php echo base_url(); ?>auth/assign"><button type="button" class="btn btn-primary show-form-update-quantity"><?php echo $this->lang->line('uses_asset'); ?></button></a>
        <button id="export-excel-assign" type="button" class="btn btn-primary">  <span class="glyphicon glyphicon-download" aria-hidden="true"></span> <?php echo $this->lang->line('export-excel'); ?></button>

        <?php
        }
        ?>
        <div class="list-assign">
        <table id="list-assign" class="table table-hover table-bordered" lass="display" cellspacing="0" width="100%">
          <thead>
          <tr id="getList">
            <td><?php echo  $this->lang->line('serial') ; ?></td>
            <td><?php echo  $this->lang->line('type') ; ?></td>
            <td><?php echo  $this->lang->line('id_assign') ; ?></td>
            <td><?php echo  $this->lang->line('assign_from') ; ?></td>
            <td><?php echo  $this->lang->line('assign_to') ; ?></td>
            
            <td><?php echo  $this->lang->line('tb_id') ; ?></td>
            <td><?php echo  $this->lang->line('tb_name') ; ?></td>
            <td><?php echo  $this->lang->line('date_use') ; ?></td>
            <td><?php echo  $this->lang->line('tb_quantity') ; ?></td>
            <?php
            if($this->session->userdata('login') !== null)
            {
              ?>
            <td style="text-align:center"><?php echo  $this->lang->line('view') ; ?></td>
            <td style="text-align:center"><?php echo  $this->lang->line('delete') ; ?></td>
            <?php
              }
              ?>
          </tr>
          </thead>
          <tbody>
          <?php
            $stt = 1; 
            foreach($lists as $list)
            {
              $array = array("H_", "D_");
              $ID_USE = str_replace($array, '', $list['id_use']) ;
              echo '<tr>';
              echo '<td>'.$stt++.'</td>';
              echo '<td>'.$list['type'].'</td>';
              echo '<td>'.$ID_USE.'</td>';
              echo '<td style="padding:0">'.$list['assign'].'</td>';
              echo '<td style="padding:0">'.$list['hr'].'</td>';
              echo '<td style="padding:0">'.$list['idtb'].'</td>';
              echo '<td style="padding:0">'.$list['tb'].'</td>';
              
              $date = date_create($list['date']);
              $date = date_format($date, 'd-m-Y');
              echo '<td>'.$date.'</td>';
              echo '<td>'.$list['quantity'].'</td>';
              if($this->session->userdata('login') !== null)
              {
              echo '<td style="text-align:center"><a href="'.base_url().'auth/report2/'.$list['id_use'].'"><button type="button" class="btn btn-primary btn-xs">'.$this->lang->line('view').'</button></a></td>';
              echo '<td style="text-align:center"><button onclick="delAssign('.$list['id'].')" type="button" class="btn btn-danger btn-xs">'.$this->lang->line('delete').'</button></td>';
              }
              echo '</tr>';
            }
          ?>
          </tbody>
        </table>
        </div>
      </div>
</div>
