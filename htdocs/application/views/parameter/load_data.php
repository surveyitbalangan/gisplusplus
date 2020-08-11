<script type="text/javascript">    
    $('.edit').click(edit);

    function edit(){
        var baris   = $(this).closest('.baris');
        var id      = $('.col_id',baris).html();  
        var nama    = $('.col_name',baris).html();
        var satuan  = $('.col_id_satuan',baris).html();
        var jenis   = $('.col_jenis',baris).html();
        
        // alert(tipe);
        $('#form-edit input[id="txtKode"]').val(id).attr('disabled','disabled');
        $('#form-edit input[id="txtNama_edit"]').val(nama);
        $('#form-edit select[id="cboSatuan_edit"]').val(satuan);
        $('#form-edit select[id="cboJenis_edit"]').val(jenis);
        // if (aktif==1) {
        //     ok = true;
        // }else{
        //     ok = false;
        // }
        // $('#form-input input[id="chk_aktif"]').prop('checked',ok);

        $('.modal-title').html("Edit Data");  
        $('#form-edit').modal({
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
          url   : "<?=base_url();?>parameter/hapus",
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
      <th width="70%">Parameter</th>
      <th width="1%">Satuan</th>
      <th width="5px">Jenis</th>
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
            <td class="col_name"><?=$db['PARAMETER'];?></td>
            <td class="col_id_satuan" style="display:none;"><?=$db['ID_SATUAN'];?></td>
            <td class="col_satuan"><?=$db['SATUAN'];?></td>
            <td class="col_jenis"><?=$db['JENIS'];?></td>
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
          <td colspan="5"><font color="red">no data found</font></td>
        </tr>
        <?php
      }
    ?>
  </tbody>          
</table>