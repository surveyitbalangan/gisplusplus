<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model {
	/**
	 * @author : toni
	 * @date : 31 Juli 2015 
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/

	function __construct(){
		parent::__construct();
	}
	
	// query otomatis dengan active record
	public function getAllData($tabel){
		return $this->db->get($tabel);
	}

	public function getAllDataLimited($tabel,$limit,$offset){
		return $this->db->get($tabel,$limit,$offset);
	}

	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
	
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	// public function getKode()
	// {
	// 	$q = $this->db->query("select MAX(RIGHT(kode,4)) as kd_max from SIMBAS.T_PENGAJUAN");
	// 	$kd = "";
	// 	if($q->num_rows()>0)
	// 	{
	// 		foreach($q->result() as $k)
	// 		{
	// 			$tmp = ((int)$k->kd_max)+1;
	// 			$kd = sprintf("%04s", $tmp);
	// 		}
	// 	}
	// 	else
	// 	{
	// 		$kd = "0001";
	// 	}	
	// 	return "BR".$kd;
	// }

	public function getKodePengajuan(){ //0001/IN/PROP/VI/2016
		$thnNow = date("Y");
		$blnNow = date("m");
		switch ($blnNow) {
			case 1:
				$bln_romawi = 'I';
				break;
			case 2:
				$bln_romawi = 'II';
				break;
			case 3:
				$bln_romawi = 'III';
				break;
			case 4:
				$bln_romawi = 'IV';
				break;
			case 5:
				$bln_romawi = 'V';
				break;
			case 6:
				$bln_romawi = 'VI';
				break;
			case 7:
				$bln_romawi = 'VII';
				break;
			case 8:
				$bln_romawi = 'VIII';
				break;
			case 9:
				$bln_romawi = 'IX';
				break;
			case 10:
				$bln_romawi = 'XI';
				break;
			case 11:
				$bln_romawi = 'XI';
				break;
			case 12:
				$bln_romawi = 'XII';
				break;
			
			default:
				# code...0002/INP/PML2/III/2016
				// 0001/IN/PROP/VI/2016
				break;
		}
		
		$strsql = "SELECT COALESCE(MAX(NO_PENGAJUAN),0) AS NO_PENGAJUAN FROM SIMBAS.T_PENGAJUAN
				   WHERE NO_PENGAJUAN IS NOT NULL";
		$hasil 	= $this->db->query($strsql);
		if ($hasil->num_rows()>0) {
			foreach($hasil->result_array() as $row){
				$id = $row['NO_PENGAJUAN'];

				$bln 	= explode("-", $id);
				$noUrut = (int) substr($id,1,4);
				if ($bln[3] == $bln_romawi){
					$noUrut = $noUrut+1;
				}else{
					$noUrut = "1";
				}
			}			
		}else{
			$noUrut="1";
		}							
		
		$new_urut 	= sprintf("%04s", $noUrut);
		$newID 		= $new_urut."-IN-PROP-".$bln_romawi."-".$thnNow;

		return $newID;
	}

	function generated_id_pelamar(){
		$sql 	= "";
		$sql 	= "SELECT MAX(ID_PELAMAR) AS 'ID_PELAMAR' FROM m_pelamar";
		$stmt 	= $this->db->query($sql);
		$id_pelamar ='';
		$tglnow = date("Ym");

		if ($stmt->num_rows()>0) {
			foreach ($stmt->result_array() as $db) {
				$id_pelamar = $db['ID_PELAMAR'];
			}
			$tgl=substr($id_pelamar,3,6);
			$noUrut = (int) substr($id_pelamar,11,4);
			if ($tgl == $tglnow){
				$noUrut=$noUrut+1;
			}
			else{
				$noUrut="1";
			}
		}else{
			$noUrut="1";
		}		
		
		$char = "PEL" . $tglnow."-";
		$newID = $char . sprintf("%04s", $noUrut);
		return $newID;
	}

	function generated_id_seleksi(){
		$sql 	= "";
		$sql 	= "SELECT MAX(ID_SELEKSI) AS 'ID_SELEKSI' FROM t_seleksi";
		$stmt 	= $this->db->query($sql);
		$id_seleksi ='';
		$tglnow = date("Ym");

		if ($stmt->num_rows()>0) {
			foreach ($stmt->result_array() as $db) {
				$id_seleksi = $db['ID_SELEKSI'];
			}
			$tgl=substr($id_seleksi,3,6);
			$noUrut = (int) substr($id_seleksi,11,4);
			if ($tgl == $tglnow){
				$noUrut=$noUrut+1;
			}
			else{
				$noUrut="1";
			}
		}else{
			$noUrut="1";
		}		
		
		$char 	= "TES".$tglnow."-";
		$newID 	= $char . sprintf("%04s", $noUrut);
		return $newID;
	}

	public function hitung_expired(){
		$lama_expired = $this->config->item('lama_expired');
		$sql 	= "SELECT YEAR(NOW())+$lama_expired AS TAHUN,
				   MONTH(NOW()) AS BULAN,DAY(NOW()) AS TGL";
		$stmt 	= $this->db->query($sql);
		foreach($stmt->result_array() as $row){
			$thn = $row['TAHUN'];
			$bln = $row['BULAN'];
			$tgl = $row['TGL'];
		}
		return $thn.'-'.$bln.'-'.$tgl;
	}

	public function getCurrentDate($key=null){
		$sql 	= "SELECT YEAR(NOW()) AS TAHUN,
				   MONTH(NOW()) AS BULAN,DAY(NOW()) AS TGL";
		$stmt 	= $this->db->query($sql);
		foreach($stmt->result_array() as $row){
			$thn = $row['TAHUN'];
			$bln_ = $row['BULAN'];
			switch ($bln_) {
				case '1':
					$bln = 'JANUARY';
					break;
				case '2':
					$bln = 'FEBRUARY';
					break;
				case '3':
					$bln = 'MARCH';
					break;
				case '4':
					$bln = 'APRIL';
					break;
				case '5':
					$bln = 'MAY';
					break;
				case '6':
					$bln = 'JUNE';
					break;
				case '7':
					$bln = 'JULY';
					break;
				case '8':
					$bln = 'AUGUST';
					break;
				case '9':
					$bln = 'SEPTEMBER';
					break;
				case '10':
					$bln = 'OCTOBER';
					break;
				case '11':
					$bln = 'NOVEMBER';
					break;
				case '12':
					$bln = 'DECEMBER';
					break;
				default:
					# code...
					break;
			}
			$tgl = $row['TGL'];
		}
		switch ($key) {
			case 'THN':
				$hasil = $thn;		
				break;
			case 'BLN':
				$hasil = $bln;		
				break;
			case 'TGL':
				$hasil = $tgl;		
				break;
			default:
				$hasil = $thn.'-'.$bln.'-'.$tgl;
				break;
		}

		return $hasil;
	}

	public function getTotDocCategory(){
		$sql 	= "SELECT COUNT(*) AS 'DOK' FROM m_kategori A0				   
				   ORDER BY A0.ID";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['ID']] = $data['KATEGORI'];
		}
		return $arr;
	}

	public function getPendidikan(){
		$sql 	= "SELECT *
				   FROM m_pendidikan A0				  
				   ORDER BY ID";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['ID']] = $data['PENDIDIKAN'];
		}
		return $arr;
	}

	public function getJurusan(){
		$sql 	= "SELECT *
				   FROM m_jurusan A0				   
				   ORDER BY ID";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['ID']] = $data['JURUSAN'];
		}
		return $arr;
	}

	public function getKampus(){		
		$sql 	= " SELECT *
					FROM m_kampus A0										
					ORDER BY ID";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['ID']] = $data['KAMPUS'];
			// $arr[] = array(
			// 	'kode' 	=> $data['SUBCATE_ID'],
			// 	'nama'  => $data['SUBCATE_NAME']
			// );
		}
		return $arr;
	}

	public function getKategoriDokumen(){
		$sql 	= "SELECT *
				   FROM m_kategori A0				   
				   ORDER BY ID";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['ID']] = $data['KATEGORI'];
		}
		return $arr;
	}

	public function getKelompokDokumen(){
		$sql 	= "SELECT *
				   FROM m_kelompok A0				   
				   ORDER BY ID";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['ID']] = $data['KELOMPOK'];
		}
		return $arr;
	}

	public function getTotNewTicket(){
		$sql 	= "SELECT COUNT(*)AS JUMLAH FROM BCLDB.DBO.T_TICKETING A0
				   WHERE TIC_STATUS=1";
		$stmt 	= $this->db->query($sql);

        $jml = 0;
		foreach($stmt->result_array() as $data){	
			$jml = $data['JUMLAH'];
		}
		return $jml;
	}

	public function getIT(){
		$sql 	= "SELECT *
				   FROM BCLDB.DBO.M_EMPLOYEE A0				   
				   WHERE A0.EMP_IS_ACTIVE=1
				   AND A0.EMP_DEPT_ID='D00000'
				   ORDER BY EMP_NIK";
		$stmt 	= $this->db->query($sql);

        $arr = array();
		foreach($stmt->result_array() as $data){	
			$arr[$data['EMP_NIK']] = $data['EMP_NAME'];
		}
		return $arr;
	}

	public function cek_hak_akses($nik,$id_app){		
		$sql = "";
		$sql = "SELECT ROLE_NIK,EMP_NAME,APP_ID,APP_NAME,AKTIF,CARI,TAMBAH,
				SIMPAN,HAPUS,CETAK from ahmad.VW_HAK_AKSES
				WHERE ROLE_NIK='$nik' AND APP_ID='$id_app'";
		$stmt= $this->db->query($sql);
		if ($stmt->num_rows()>0) {
			foreach($stmt->result_array() as $row){
				$cari = $row['AKTIF'];
			}
			if ($cari==1) {
				$status_aktif=1;
			}else{
				$status_aktif=0;
			}			
		}else{
			$status_aktif=0;
		}

		return $status_aktif;
	}
	
	
}

/* End of file app_model.php */
/* Location: ./application/models/app_model.php */