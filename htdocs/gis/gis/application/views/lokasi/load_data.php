<script type="text/javascript">    
    $('.edit').click(edit);

    function edit(){
        var baris   = $(this).closest('.baris');
        var id      = $('.col_id',baris).html();  
        var nama    = $('.col_name',baris).html();
        
        // alert(tipe);
        $('#form-input input[id="txtKode"]').val(id).attr('disabled','disabled');
        $('#form-input input[id="txtNama"]').val(nama);
        // if (aktif==1) {
        //     ok = true;
        // }else{
        //     ok = false;
        // }
        // $('#form-input input[id="chk_aktif"]').prop('checked',ok);

        $('.modal-title').html("Edit Data");  
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

        $('.modal-title').html("Konfirmasi");  
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
          url   : "<?=base_url();?>lokasi/hapus",
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
      <th width="5px" style="display:none;">ID</th>
      <th width="88%">Lokasi PIT</th>
      <th width="5px">Action</th>
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
            <td class="col_name"><?=$db['LOKASI_PIT'];?></td>
            <td align="center">            
              <button title="Edit Data" class="edit btn btn-sm btn-info btn-flat" href="#"><i class="fa fa-sm fa-pencil"></i></button>
              <button title="Hapus Data" class="delete btn btn-sm btn-warning btn-flat" href="#"><i class="fa fa-sm fa-trash-o"></i></button>
            </td>
          </tr>
        <?php
        }
      }else{
        ?>
        <tr>
          <td colspan="4"><font color="red">no data found</font></td>
        </tr>
        <?php
      }
    ?>
  </tbody>          
</table>