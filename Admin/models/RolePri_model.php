<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolePri_model extends CI_Model
{
	// 表名
	
	const TB_RolePri = 'privilege_role';
	
	public function __construct()
	
	{
	
		parent::__construct();
	
	}
	
	//查询字段数据
	
	public function sel(){
	
		return  $this->db->get(self::TB_RolePri)->result_array();
	
	}

	public function sel_where($where){
				
				$this->db->where($where);

		return  $this->db->get(self::TB_RolePri)->result_array();
	
	}
	
	//删除

	public function del($id){

				$this->db->where($id);

		return  $this->db->delete(self::TB_RolePri);

	}

	public function insert($data){

		return $this->db->insert(self::TB_RolePri,$data);
	}
}