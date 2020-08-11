<script type="text/javascript">
    
</script>
<table id="tabel_data" class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th width="1%">No</th>     
      <th width="1%" style="display:none-;">Ticketing Number</th>
      <th width="15px">Ticket Date</th>
      <th width="50px">User</th>
      <th width="50px">Category</th>
      <th width="150px">Description</th>
      <th width="5px">Priority</th>
      <th width="5px">Status</th>      
    </tr>
  </thead>      
  <tbody>
    <?php
      $i=0;
      if ($data->num_rows()>0) {
        foreach ($data->result_array() as $db) {          
          $i++;
          if($db['TIC_PRIORITY']==1){
            $warna = '#468847';
          }else if($db['TIC_PRIORITY']==2){
            $warna = 'orange';
          }else if($db['TIC_PRIORITY']==3){
            $warna = 'red';
          }          
          ?>
          <tr class="baris">
            <td class="col_no" align="center"><?=$i;?></td>            
            <td class="col_id" style="display:none-;"><?=$db['TIC_NO'];?></td>            
            <td class="col_date"><?=$db['TIC_DATE'];?></td>
            <td class="col_user_nik" style="display:none;"><?=$db['TIC_NIK'];?></td>
            <td class="col_user"><?=$db['USER'];?></td>
            <td class="col_cate_id" style="display:none;"><?=$db['TIC_CATEGORY_ID'];?></td>
            <td class="col_cate_name"><?=$db['CATE_NAME'];?></td>
            <td class="col_desc"><?=$db['TIC_DESCRIPTION'];?></td>
            <td class="col_priority_id" style="display:none;"><?=$db['TIC_PRIORITY'];?></td>
            <td class="col_priority_desc" style="background-color: <?=$warna;?>; color:#fff;"><?=$db['PRIORITY_DESC'];?></td>            
            <td class="col_status_id" style="display:none;"><?=$db['TIC_STATUS'];?></td>            
            <td class="col_stat_desc"><?=$db['STATUS_DESC'];?></td>
            <td class="col_location_id" style="display:none;"><?=$db['TIC_LOCATION'];?></td>
          </tr>
        <?php
        }
      }
    ?>
  </tbody>          
</table>