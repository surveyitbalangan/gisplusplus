<script type="text/javascript">
    $('.pilih_vacant').click(do_pilih_vacant);

    function do_pilih_vacant(){
      	// alert('Pilih');
		var baris   = $(this).closest('.baris');
        var id_vacant      = $('.col_id',baris).html();
		var nama_vacant 	= $('.col_nama',baris).html();

        // $('#form-show-atasan input[id="txtAtasan"]').val(nama);
        // $('#form-show-atasan input[id="txtNIKAtasan"]').val(nik);      	
		$('#txtVacant').val(nama_vacant);
        $('#txtIdVacant').val(id_vacant);
        // alert(nik+' - '+nama);

      	$('#form-show-lowongan').modal('hide');
    }
</script>
<table id="tabel_data" class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th width="1%">No</th>
			<th width="1%" style="display:none;">ID</th>	
			<th width="100px">Lowongan</th>			
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
					<td class="col_id" style="display:none;"><?=$db['ID'];?></td>
					<td class="col_nama"><?=$db['VACANT'];?></td>
					<td align="center">
						<button title="Pilih" class="pilih_vacant btn btn-sm btn-info btn-flat"><i class="fa fa-check"></i></button>						
					</td>
				</tr>
				<?php
			}
		}
	?>
	</tbody>
</table>