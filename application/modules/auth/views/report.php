<div class="container-fluid">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h3><?php echo  $this->lang->line('report_assign') ; ?></h3>
        <ul style="border:1px solid #000" class="tree-assign">
          <table class="table company">
                        <tr class="active">
                          <td style="width:10%"><h4><?php echo $this->lang->line('type'); ?></h4></td>
                          <td style="width:20%"><h4><?php echo $this->lang->line('tb_id'); ?></h4></td>
                          <td style="width:20%"><h4><?php echo $this->lang->line('tb_name'); ?></h4></td>
                          <td style="width:30%"><h4><?php echo $this->lang->line('note'); ?></h4></td>
                          <td style="width:20%"><h4><?php echo $this->lang->line('date_use'); ?></h4></td>
                        </tr>
          </table>
          <h2><?php echo $this->lang->line('company'); ?></h2>
          
          <?php
            foreach($tbs as $tb)
                  {
                    if($tb['ob'] == 'company')
                    {
                      $date = date_create($tb['date']);
                      $date = date_format($date, 'd-m-Y');
                      if($tb['typeId'] == 1)
                        {
                          $class = "success";
                        }else if($tb['typeId'] == 2)
                        {
                          $class = "warning";
                        }else if($tb['typeId'] == 3)
                        {
                          $class = "danger";
                        }
                      echo '<li>';
                      ?>
                      <table class="table company">
                        <tr class="<?php echo $class; ?>">
                          <td style="width:10%"><?php echo $tb['type']; ?></td>
                         
                          <td style="width:20%"><?php echo $tb['idTb']; ?></td>
                           <td style="width:20%"><?php echo $tb['tb_name']; ?></td>
                          <td style="width:30%"><?php echo $tb['note']; ?></td>
                          <td style="width:20%"><?php echo $date; ?></td>
                        </tr>
                      </table>
                      <?php
                      echo '</li>';
                    }
                  }
            foreach($depts as $dept)
            {
              echo '<li><ul>';
              echo '<h4>'.$dept['name'].'</h4>';
              foreach($tbs as $tb)
                  {
                    if($tb['ob'] == $dept['team_id'])
                    {
                      $date = date_create($tb['date']);
                      $date = date_format($date, 'd-m-Y');
                      if($tb['typeId'] == 1)
                        {
                          $class = "success";
                        }else if($tb['typeId'] == 2)
                        {
                          $class = "warning";
                        }else if($tb['typeId'] == 3)
                        {
                          $class = "danger";
                        }
                      echo '<li>';
                      ?>
                      <table class="table dept">
                        <tr class="<?php echo $class; ?>">
                          <td style="width:10%"><?php echo $tb['type']; ?></td>
                          
                          <td style="width:20%"><?php echo $tb['idTb']; ?></td>
                          <td style="width:20%"><?php echo $tb['tb_name']; ?></td>
                          <td style="width:30%"><?php echo $tb['note']; ?></td>
                          <td style="width:20%"><?php echo $date; ?></td>
                        </tr>
                      </table>
                      <?php
                      echo '</li>';
                    }
                  }
              foreach($hrs as $hr)
              {
                if($hr['team_id'] == $dept['team_id'])
                {
                    $idHR = $hr['id_hr'];
                    echo '<li><ul>';
                    if (in_array( $idHR, $hrView, true)) {
                      echo '<b>'.$hr['fullname'].'</b>';
                      foreach($tbs as $tb)
                      {
                        if($tb['ob'] == $hr['id_hr'])
                        {
                          $date = date_create($tb['date']);
                          $date = date_format($date, 'd-m-Y');
                          if($tb['typeId'] == 1)
                          {
                            $class = "success";
                          }else if($tb['typeId'] == 2)
                          {
                            $class = "warning";
                          }else if($tb['typeId'] == 3)
                          {
                            $class = "danger";
                          }
                          echo '<li>';
                          ?>
                          <table class="table hr">
                            <tr class="<?php echo $class; ?>">
                              <td style="width:10%"><?php echo $tb['type']; ?></td> 
                              <td style="width:20%"><?php echo $tb['idTb']; ?></td>
                              <td style="width:20%"><?php echo $tb['tb_name']; ?></td>
                              <td style="width:30%"><?php echo $tb['note']; ?></td>
                              <td style="width:20%"><?php echo $date; ?></td>
                            </tr>
                          </table>
                          <?php
                          echo '</li>';
                        }
                      }
                    }
                    echo '</ul></li>';
                  
                }
              }
              echo '</ul></li>';
            }
          ?>

        </ul>
      </div>
</div>
<style type="text/css">
  tr, td
  {
    border: none !important;
  }
</style>
