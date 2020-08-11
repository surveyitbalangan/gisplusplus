<script type="text/javascript">
    var auto_refresh;

    seger();
    cari_open();

    function seger(){
        auto_refresh = setInterval(function (){
            // alert('refresh');
            window.location.replace('monitoring');
            // load_data();
        }, 10000);
    }
      
    function stop_seger(){
        clearTimeout(auto_refresh);
    }

    function cari_open(){
        var table = document.getElementById('tabel_data'), 
            rows = table.getElementsByTagName('tr'),
            i, j, cells, customerId;

        for (i = 0, j = rows.length; i < j; ++i) {
            cells = rows[i].getElementsByTagName('td');
            if (!cells.length) {
                continue;
            }
            statusId = cells[12].innerHTML;
            if (statusId=='OPEN') {
              // alert('Ketemu di Kolom ke '+j+', baris ke :'+i);
              // alert("cari play");               
              play_suara();
            }
            // else{
            //   alert("cari stop");
            //   alert(statusId);
            //   stop_suara();
            // } 
        }
    }
      
    function play_suara(){
        // alert("Play musik");
        var myPath = "<?=base_url();?>asset/sound/";
        // alert(myUrl+"asset/sound/");
        ion.sound({
          sounds: [
            {
              name: "timber"
            },
          ],
          path: myPath,
          preload: false
        });
        ion.sound.play("timber",{
          volume:1,
          loop:false
        });
    }

    function stop_suara(){            
        ion.sound.stop("timber");
        ion.sound.destroy("timber");
        // alert("Stop play");
    }

    function load_data(){
      // var status = $('#cboStatus').val();

			$.ajax({
				type : 'POST',
				url  : '<?=base_url()?>monitoring/load_data',
				// data : {'status':status},
				// cache: false,
				success : function(ok){					
					$('#isiData').animate({ opacity: "show" }, "slow");
					$('#isiData').html(ok);					
				},
				error : function(event, textStatus, errorThrown){
					alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
				},
				complete : function(){
					
				}	
			})
		}

    $('.edit').click();

    function edit(){
        var baris     = $(this).closest('.baris');
        var id        = $('.col_id',baris).html();  
        var lokasi    = $('.col_location_id',baris).html();
        var kategori  = $('.col_cate_id',baris).html();
        var desc      = $('.col_desc',baris).html();
        var prioritas = $('.col_priority_id',baris).html();
        
        // alert(kategori);
        $('#form-input input[id="txtKode"]').val(id);
        $('#form-input select[id="cboLocation"]').val(lokasi).attr('disabled','disabled');
        $('#form-input select[id="cboCategory"]').val(kategori).attr('disabled','disabled');
        $('#form-input textarea[id="txtDescription"]').val(desc).attr('disabled','disabled');
        $('#form-input select[id="cboPriority"]').val(prioritas).attr('disabled','disabled');

        $('.modal-title').html("Update Data");  
        $('#form-input').modal({
          show: true,
          keyboard:false,
          backdrop:false
        })
      
    }

    $('.delete').click(hapus);

    function hapus(){
        var baris = $(this).closest('.baris');  
        var kode  = $('.col_id',baris).html();
        $('#form-hapus input[id="txtid_hapus"]').val(kode);

        $('.modal-title').html("Confirm");  
        $('#form-hapus').modal({
          show: true,
          keyboard:false,
          backdrop:false
        })       
    }
    
    $('#btnHapus').click(function(){
      hapus_data();
    })

    function hapus_data(){
        var kode  = $("#txtid_hapus").val();

        $.ajax({
          url   : "<?=base_url();?>monitoring/hapus",
          type  : "POST",
          data  : {"kode":kode},
          success : function(data){
            swal('Informasi','Data berhasil dihapus','success');
            $('#isiData').html(data);
            $("#form-hapus").modal("hide");
          }
        })
    }
</script>
<table id="tabel_data" class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
      <th width="1%">No</th>     
      <th width="10px">#</th>
      <th width="5px" style="display:none;">Ticketing Number</th>
      <th width="5px">Ticket Date</th>
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
            <td align="center">              
              <a title="Update" class="edit" href="<?=base_url();?>monitoring/show_detail/<?=$db['TIC_NO'];?>"><i class="fa fa-sm fa-pencil"></i></a>
              <?php
                if($db['TIC_STATUS']==1){
              ?>
              <!-- &nbsp;|&nbsp; -->&nbsp;
              <a title="Delete" class="delete" href="#"><i class="fa fa-sm fa-trash-o"></i></a>
              <?php
                }
              ?>
            </td>
            <td class="col_id" style="display:none;"><?=$db['TIC_NO'];?></td>            
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