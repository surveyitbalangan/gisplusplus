<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {
    
    function __construct(){
        parent::__construct();
    }

    public function index(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$d['judul']		= $this->config->item('lisensi_app');
			$d['perusahaan']= $this->config->item('nama_perusahaan');
			$d['footer'] 	= $this->config->item('copyright');
			$d['app_name'] 	= $this->config->item('app_name');
			$d['deskripsi'] = $this->config->item('app_fullname');
			
			$d['level'] 	= $this->session->userdata('level');
			$d['nik'] 	    = $this->session->userdata('nik_intranet');	
			$d['nama'] 		= $this->session->userdata('nama_intranet');
			$d['jabatan']	= $this->session->userdata('nama_jabatan_intranet');

			$this->template->display('satuan/home',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}
	
	function load_data(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$param = $this->input->post("cari");

			$sql = "";
			$sql .= "SELECT * FROM m_satuan A0
					 WHERE ID IS NOT NULL";
			if ($param!='') {
				$sql .= " AND A0.SATUAN LIKE '%$param%'";
			}
			$sql .=" ORDER BY A0.ID";

			$d['data'] = $this->app_model->manualQuery($sql);
			$this->load->view('satuan/load_data',$d);
		}else{
			?>
				<script type="text/javascript">
					alert('Maaf, Session anda telah habis. Silakan login ulang');
					window.location.replace('/intranet');
				</script>
			<?
		}
	}

	function simpan(){
		if(!isset($_POST)){
			show_404();
		}	
		
		$kode 	= $this->input->post('kode');
		$nama 	= $this->input->post('nama');

		$sql  = "";
		$sql .= "SELECT * FROM m_satuan WHERE ID='$kode'";
		$stmt = $this->app_model->manualQuery($sql);
		if ($stmt->num_rows()<=0) {
			$sql = "";
			$sql .= "INSERT INTO m_satuan(SATUAN) 
					 VALUES('$nama')";

			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				echo "simpan_ok";
			}else{
				echo "simpan_no";
			}			
		}else{
			$sql = "";
			$sql .= "UPDATE m_satuan SET SATUAN='$nama'
					 WHERE ID='$kode'";
			$exec = $this->app_model->manualQuery($sql);
			if ($exec) {
				echo "edit_ok";
			}else{
				echo "edit_no";
			}
			
		}					
	}

	function hapus(){
		if(!isset($_POST)){
			show_404();
		}	
			
		$kode 	= $this->input->post('kode');

		$sql 	= "";
		$sql   .= "DELETE FROM m_satuan WHERE ID='$kode'";

		$this->app_model->manualQuery($sql);
		$this->load_data();
	}
}