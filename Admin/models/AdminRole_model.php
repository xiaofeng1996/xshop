<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminRole_model extends CI_Model
{
	// 表名
	
	const TB_AR = 'admin_role';
	
	public function __construct()
	
	{	
		parent::__construct();
	
	}
	public function sel(){
	
		return  $this->db->get(self::TB_AR)->result_array();
	
	}

	public function sel_where($where){

		$this->db->where($where);

		return $this->db->get(self::TB_AR)->result_array();
	}

	public function delete($where){

		$this->db->where($where);

		return  $this->db->delete(self::TB_AR);
	}

	public function insert($data){

		return $this->db->insert(self::TB_AR,$data);
	
	}

}