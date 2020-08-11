<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th style="display:none;">ID</th>
            <th width="70%">Nama Dokumen</th>      
            <th width="5px">Modifikasi</th>  
            <th width="5px">Modifikasi Oleh</th>
        </tr>
    </thead>      
    <tbody>
    <?php
        $i=0;
        if ($data->num_rows()>0) {
            foreach ($data->result_array() as $db) {          
            $i++;          
            ?>
            <tr class="baris">
                <td class="col_no" align="center"><?=$i;?></td>
                <td class="col_id" style="display:none;"><?=$db['ID'];?></td>
                <td class="col_nama"><img src="<?=base_url();?>asset/images/folder-1.png" alt="Image" width="20" height="20"/>&nbsp;&nbsp;&nbsp;<a href="<?=base_url().'asset/file_dokumen/'.$db['FILE_DOKUMEN'];?>" target="_blank"><?=$db['NO_DOKUMEN'];?></a> - <?=$db['NAMA_DOKUMEN'];?></td>
                <td class="col_date"><?=$db['LOG_DATE'];?></td>
                <td class="col_log"><?=$db['EMP_NAME'];?></td>                                        
            </tr>
            <?php
            }
        }else{
            ?>
            <tr>
            <td colspan="8"><font color="red">no data found</font></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>