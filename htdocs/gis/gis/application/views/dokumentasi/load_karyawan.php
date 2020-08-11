<script type="text/javascript">
    $('.pilih_karyawan').click(do_pilih_karyawan);

    function do_pilih_karyawan(){
      	// alert('Pilih');
		var baris   = $(this).closest('.baris');
        var nik_kar = $('.col_id',baris).html();
		var nama_kar= $('.col_nama',baris).html();
		// var jab_kar = $('.col_jab',baris).html();

        // $('#form-show-atasan input[id="txtAtasan"]').val(nama);
        // $('#form-show-atasan input[id="txtNIKAtasan"]').val(nik);      	
		$('#txtNama').val(nama_kar);
        $('#txtNIKKaryawan').val(nik_kar);
        // $('#txtPendidikan').val(pendidikan);
        // alert(nik+' - '+nama);

      	$('#form-show-karyawan').modal('hide');
    }
</script>
<table id="tabel_data" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th width="1%">No</th>
			<th width="1%" style="display:none-;">NIK</th>	
			<th width="20px">Nama</th>			
            <th width="100px">Jabatan</th>
			<th width="1%">Pilih</th>
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
					<td class="col_id" style="display:none-;"><?=$db['EMP_NIK'];?></td>
					<td class="col_nama"><?=$db['EMP_NAME'];?></td>
                    <td class="col_jab"><?=$db['TITLE_NAME'];?></td>
					<td align="center">
						<button title="Pilih" class="pilih_karyawan btn btn-sm btn-info btn-flat"><i class="fa fa-check"></i></button>						
					</td>
				</tr>
				<?php
			}
		}
	?>
	</tbody>
</table>