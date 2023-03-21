<?php defined('__NAJZMI_PUDINTEA__') or exit('No direct script access allowed');
/**

: Pudin S.
: t.me/pudin_ira
: instagram.com/pudin.ira
: https://www.pdn.my.id
: youtube.com/c/pudintv
: youtube.com/c/pudintea

 **/
class Pegawai_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	/* nama database */
	//protected 
	private $_dtable 	= 'pegawai';
	private $_dtable_id = 'id_pegawai';

	/**
	 * return _retval
	 *
	 * @var Boolean
	 **/
	private $_retval = NULL;

	/**
	 * return _result
	 *
	 * @var Boolean
	 **/
	private $_result = FALSE;

	/**
	 * return _retarr
	 *
	 * @var Array
	 **/
	private $_retarr = array();
	
	function cekPegawai(){
        $this->_result = $this->db->get($this->_dtable)->num_rows();
        if ($this->_result > 0) {
            return $this->_result;
        }else{
			return false;
		}
	}
	
	function getPegawai($id = null)
	{
		if ($id === null) {
			return $this->db->get($this->_dtable)->result();
		} else {
			$this->db->where($this->_dtable_id, $id);
			return $this->db->get($this->_dtable)->result();
		}
	}

	function addPegawai($save_data)
	{
		if (empty($save_data['pegawai_nama'])) {
			return false;
		}

		$this->_result = $this->db->insert($this->_dtable, $save_data);

		if ($this->_result) {
			return $this->_result;
		}
	}

	function updatePegawai($data, $_id_)
	{
		if (empty($_id_)) {
			return false;
		}

		$this->db->where($this->_dtable_id, $_id_);
		$this->_result = $this->db->update($this->_dtable, $data);

		if ($this->_result) {
			return $this->_result;
		}
	}

	function deletePegawai($_id_)
	{
		if (empty($_id_)) {
			return false;
		}

		$this->db->where($this->_dtable_id, $_id_);
		$this->_result = $this->db->delete($this->_dtable);

		if ($this->_result) {
			return $this->_result;
		}
	}
}
