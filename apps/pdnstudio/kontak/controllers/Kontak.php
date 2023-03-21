<?php defined('__NAJZMI_PUDINTEA__') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller
{

	function __construct($config = 'rest')
	{
		$this->data = [];
		parent::__construct($config);
		$this->load->database();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function title()
	{
		return 'Kontak';
	}
	public function author()
	{
		return 'Pudin S I';
	}
	public function MainModel()
	{
		return 'Kontak_Model';
	}
	public function contact()
	{
		return 'najzmitea@gmail.com';
	}
	public function ClassNama()
	{
		return 'kontak';
	}

	//Menampilkan data kontak
	function index_get()
	{

		$id = $this->get('id');
		$this->load->model($this->MainModel(), 'M_najzmi');
		if ($id == '') {
			$kontak = $this->M_najzmi->getKontak();
		} else {
			$kontak = $this->M_najzmi->getKontak($id);
		}
		if ($kontak) {
			$this->response([
				'status' => TRUE,
				'data' => $kontak,
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'ID Tidak ditemukan',
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}


	//Mengirim atau menambah data kontak baru
	function index_post()
	{
		$data = array(
			'id'       => $this->post('id'),
			'nama'     => $this->post('nama'),
			'nomor'    => $this->post('nomor')
		);
		$insert = $this->db->insert('telepon', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	//Memperbarui data kontak yang telah ada
	function index_put()
	{
		$id = $this->put('id');
		$data = array(
			'id'       => $this->put('id'),
			'nama'     => $this->put('nama'),
			'nomor'    => $this->put('nomor')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('telepon', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	//Menghapus salah satu data kontak
	function index_delete()
	{
		$id = $this->delete('id');
		if ($id === null) {
			$this->response([
				'status' => FALSE,
				'message' => 'Masukan ID',
			], REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$this->load->model($this->MainModel(), 'M_najzmi');
			$delete = $this->M_najzmi->deleteKontak($id);
			if ($delete > 0) {
				$this->response([
					'status' 	=> TRUE,
					'id'		=> $id,
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
