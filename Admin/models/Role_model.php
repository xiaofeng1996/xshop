<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_Model
{
	// 表名
	const TB_role = 'role';
	public function __construct()
	{
		parent::__construct();
	}


	public function sel(){

		  return  $this->db->get(self::TB_role)->result_array();
	  
	  }
	
	public function del($id){
			
				$this->db->where($id);
	
		return  $this->db->delete(self::TB_role);
	
	}

	public function selname(){

			   $this->db->select("r_name");

		       $query=$this->db->get(self::TB_role);

			   return $query->result_array();

	}

	public function upd($where,$data){

		$this->db->where($where); //uid 数据库中自增id ，$id 控制器中传入id

 		return $this->db->update(self::TB_role,$data);//表名字 传入数组

	}
}