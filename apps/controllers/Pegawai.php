<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Pegawai extends REST_Controller {
	
	function __construct($config = 'rest')
	{
		$this->data = [];
		parent::__construct($config);
		$this->load->database();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function title()
	{
		return 'Pegawai';
	}
	public function author()
	{
		return 'Pudin S I';
	}
	public function MainModel()
	{
		return 'PegawaiModel';
	}
	public function contact()
	{
		return 'najzmitea@gmail.com';
	}
	public function ClassNama()
	{
		return 'pegawai';
	}

	//Menampilkan data
	function index_get()
	{

		$id = $this->get('id');
		$this->load->model($this->MainModel(), 'M_najzmi');
		$cekdata = $this->M_najzmi->cekPegawai();
		if ($cekdata){
			if ($id == '') {
				$pegawai = $this->M_najzmi->getPegawai();
			} else {
				$pegawai = $this->M_najzmi->getPegawai($id);
			}

			$row = array();
			foreach ($pegawai as $pDn) {
				$row[] = array(
					'id'		=> $pDn->id_pegawai,
					'nip' 		=> $pDn->pegawai_nip,
					'tanggal' 	=> $pDn->pegawai_tanggal,
				);
			}

			if ($pegawai) {
				$this->response([
					'status' 	=> TRUE,
					'data' 		=> $row,
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' 	=> FALSE,
					'message' 	=> 'ID Tidak ditemukan',
				], REST_Controller::HTTP_NOT_FOUND);
			}
		}else{
			$this->response([
				'status' 	=> FALSE,
				'message' 	=> 'Data Tidak ditemukan',
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	//Tambah Data
	function index_post()
	{
		$pdn_add['pegawai_nip'] 			= $this->post('nip');
		$pdn_add['pegawai_tanggal'] 		= $this->post('tanggal');
		//$pdn_add['pegawai_tgl_input'] 	= date('Y-m-d H:i:s');

		if (empty($pdn_add['pegawai_nip']) || empty($pdn_add['pegawai_tanggal'])) {
			$this->response([
				'status' 	=> FALSE,
				'message' 	=> 'Data Kosong',
			], REST_Controller::HTTP_NO_CONTENT);
		} else {
			$this->load->model($this->MainModel(), 'M_najzmi');
			$add_data = $this->M_najzmi->addPegawai($pdn_add);
			if ($add_data) {
				$this->response([
					'status' 		=> TRUE,
					'message' 		=> 'Data berhasil ditambahkan',
				], REST_Controller::HTTP_CREATED);
			} else {
				$this->response([
					'status' 	=> FALSE,
					'message' 	=> 'Data Gagal Ditambahkan',
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	//Edit Data
	function index_put()
	{
		$id_put 						= $this->put('id');
		$pdn_put['pegawai_nip'] 		= $this->put('nama');
		$pdn_put['pegawai_tanggal'] 	= $this->put('unit');

		if (empty($id_put) || empty($pdn_put['pegawai_nip']) || empty($pdn_put['pegawai_tanggal'])) {
			$this->response([
				'status' 	=> FALSE,
				'message' 	=> 'Data Kosong',
			], REST_Controller::HTTP_NO_CONTENT);
		} else {
			$this->load->model($this->MainModel(), 'M_najzmi');
			$add_data = $this->M_najzmi->updatePegawai($pdn_put, $id_put);
			if ($add_data) {
				$this->response([
					'status' 		=> TRUE,
					'message' 		=> 'Data berhasil diupdate',
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' 	=> FALSE,
					'message' 	=> 'Data gagal diupdate',
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	//Hapus data
	function index_delete()
	{
		$id_del = $this->delete('id');
		if ($id_del === null) {
			$this->response([
				'status' 	=> FALSE,
				'message' 	=> 'Mohon sertakan ID',
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$this->load->model($this->MainModel(), 'M_najzmi');
			$del_data = $this->M_najzmi->deletePegawai($id_del);
			if ($del_data) {
				$this->response([
					'status' 	=> TRUE,
					'id'		=> $id_del,
					'message' 	=> 'deleted.',
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'ID Tidak ditemukan',
				], REST_Controller::HTTP_NOT_FOUND);
			}
		}
	}
}