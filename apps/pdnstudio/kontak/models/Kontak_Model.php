<?php defined('__NAJZMI_PUDINTEA__') or exit('No direct script access allowed');

class Kontak_Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	/* nama database */
	//protected 
	private $_dtable 	= 'telepon';
	private $_dtable_id = 'id';

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

	function getKontak($id = null)
	{
		if ($id === null) {
			return $this->db->get($this->_dtable)->result_array();
		} else {
			$this->db->where($this->_dtable_id, $id);
			return $this->db->get($this->_dtable)->result_array();
		}
	}

	function deleteKontak($id)
	{
		$this->db->delete($this->_dtable, [$this->_dtable_id => $id]);
		return $this->db->affected_rows();
	}
}
