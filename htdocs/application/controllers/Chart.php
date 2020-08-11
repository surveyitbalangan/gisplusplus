<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {

	function __construct(){
			parent::__construct();
	}

	function index(){
		$cek = $this->session->userdata('login_intranet_sukses');
		if(!empty($cek)){
			$d['judul']			= $this->config->item('lisensi_app');
			$d['perusahaan']= $this->config->item('nama_perusahaan');
			$d['footer'] 		= $this->config->item('copyright');
			$d['app_name'] 	= $this->config->item('app_name');
			$d['deskripsi'] = $this->config->item('app_fullname');					

			$d['nik']				= $this->session->userdata('nik_intranet');
			$d['level'] 		= $this->session->userdata('level');	
			$d['nama'] 			= $this->session->userdata('nama_intranet');
			$d['jabatan']		= $this->session->userdata('nama_jabatan_intranet');

			$this->template->display('chart/home',$d);
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
		// $status = $this->input->post("status");
        
		$sql = "";
		$sql .= "SELECT * FROM vw_seleksi A0
				 WHERE STATUS IN (0,1,2)";
		// if ($status!='') {
		// 	$sql .= " AND A0.TIC_STATUS = '$status'";
		// }
		$sql .=" ORDER BY A0.ID_SELEKSI";

		$d['data'] = $this->app_model->manualQuery($sql);
		$d['nik']  = 'Admin';//$this->session->userdata('nik');
		$this->load->view('seleksi/load_data',$d);
	}	
}