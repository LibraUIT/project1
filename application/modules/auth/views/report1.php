<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo  $this->lang->line('report_free') ; ?></h3>
        <?php
        if($this->session->userdata('login') !== null)
        {
          ?>
        <button id="export-excel" type="button" class="btn btn-primary btn-lg">  <span class="glyphicon glyphicon-download" aria-hidden="true"></span> <?php echo $this->lang->line('export-excel'); ?></button>
        <?php
          }
        ?>
        <div class="list-tb">
        <table id="list-hr" class="table table-hover table-bordered" lass="display" cellspacing="0" width="100%">
          <thead>
          <tr id="getList">
            <td><?php echo  $this->lang->line('serial') ; ?></td>
            <td><?php echo  $this->lang->line('tb_id') ; ?></td>
            <td><?php echo  $this->lang->line('tb_name') ; ?></td>
            <td><?php echo  $this->lang->line('quantity_buy'); ?></td>
            <td><?php echo  $this->lang->line('quantity_assign') ; ?></td>
            <td><?php echo  $this->lang->line('quantity_cancle') ; ?></td>
            <td><?php echo  $this->lang->line('quantity_destroy') ; ?></td>
            <td><?php echo  $this->lang->line('quantity_free') ; ?></td>
          </tr>
          </thead>
          <tbody>
          <?php
            $stt = 1; 
            foreach($lists as $list)
            {
              echo '<tr>';
              echo '<td>'.$stt++.'</td>';
              echo '<td>'.$list['idTb'].'</td>';
              echo '<td>'.$list['name'].'</td>';
              echo '<td>'.$list['quantity'].'</td>';
              echo '<td>'.$list['quantity_assign'].'</td>';
              echo '<td>'.$list['quantity_cancle'].'</td>';
              echo '<td>'.$list['quantity_destroy'].'</td>';
              echo '<td>'.($list['quantity'] + $list['quantity_cancle']  - $list['quantity_assign'] - $list['quantity_destroy']).'</td>';
              echo '</tr>';
            }
          ?>
          </tbody>
        </table>
        </div>
      </div>
</div>
