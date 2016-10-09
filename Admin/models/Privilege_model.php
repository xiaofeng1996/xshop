<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege_model extends CI_Model
{
	// 表名
	
	const TB_pri = 'privilege';
	
	public function __construct()
	
	{	
		parent::__construct();
	
	}

	//查询字段数据
	
	public function sel($limit,$offset1){
		
		return  $this->db->limit($limit,$offset1)->get(self::TB_pri)->result_array();
	
	}

	public function insert($data){

		return $this->db->insert(self::TB_pri,$data);
	
	}


	public function upd($where,$data){

		$this->db->where($where); //uid 数据库中自增id ，$id 控制器中传入id

 		return $this->db->update(self::TB_pri,$data);//表名字 传入数组

	}

	public function selname(){

			   $this->db->select("p_name");

		       $query=$this->db->get(self::TB_pri);

			   return $query->result_array();

	}

	public function del($where){
	
		$this->db->where($where);
		
		return $this->db->delete(self::TB_pri);
	
	}

	public function seldel($where){

		$this->db->where($where);
		return $this->db->get(self::TB_pri)->result_array();
	}

}