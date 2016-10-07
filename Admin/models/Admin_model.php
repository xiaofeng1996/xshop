<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	// 表名
	
	const TB_admin = 'admin';

	public function __construct()
	
	{	
		parent::__construct();
	
	}
	
	//查询字段数据
	
	public function sel(){
	
		return  $this->db->get(self::TB_admin)->result_array();
	
	}

	//查询单个管理员

	public function getOne($aid){

		return  $this->db->select('adminname')->where('aid',$aid)->get(self::TB_admin)->result_array();

	}
	//删除
	
	public function del($id){
	
				$this->db->where($id);
	
		return  $this->db->delete(self::TB_admin);
	
	}



	public function upd($where,$data){

		$this->db->where($where); //uid 数据库中自增id ，$id 控制器中传入id

 		return $this->db->update(self::TB_admin,$data);//表名字 传入数组

	}

	public function selname(){

			   $this->db->select("adminname");

		       $query=$this->db->get(self::TB_admin);

			   return $query->result_array();

	}
}