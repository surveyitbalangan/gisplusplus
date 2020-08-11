<script type="text/javascript">
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
          url   : "<?=base_url();?>dokumentasi/hapus",
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
      <th width="5px">Kategori</th>
      <th width="5px">No. Dokumen</th>
      <th width="15%">Nama Dokumen</th>      
      <th width="5px">Penanggung Jawab</th>  
      <th width="5px">Tgl Pembuatan</th>
      <th width="10px">Keterangan</th>
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
            <td class="col_kategori"><?=$db['KATEGORI'];?></td>         
            <td class="col_no"><?=$db['NO_DOKUMEN'];?></td>
            <td class="col_nama"><?=$db['NAMA_DOKUMEN'];?></td>
            <td class="col_pj"><?=$db['PENANGGUNG_JAWAB'];?></td>
            <td class="col_tgl"><?=$db['TGL_BUAT'];?></td>
            <td class="col_ket"><?=$db['KETERANGAN'];?></td>
            <td align="center">            
              <a title="Detail Data" class="detail btn btn-sm btn-success btn-flat" href="<?=base_url()?>dokumentasi/show_detail/<?=$db['ID']?>"><i class="fa fa-sm fa-list"></i></a>
              <a title="Edit Data" class="edit btn btn-sm btn-info btn-flat" href="<?=base_url()?>dokumentasi/show_edit/<?=$db['ID']?>"><i class="fa fa-sm fa-pencil"></i></a>
              <button title="Hapus Data" class="delete btn btn-sm btn-warning btn-flat"><i class="fa fa-sm fa-trash-o"></i></button>
            </td>
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