<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
		$this->load->model("address_model");
	}
	/**
	 * 收货地址
	 * @return [type] [description]
	 */
	public function address()
	{
		//获取所有地区
		$province  = $this->db->where('region_type=1')->get('x_region')->result_array();
		$this->load->view('address/address',['province'=>$province]);
	}
	/**
	 * 编辑收货地址
	 * @return [type] [description]
	 */
	public function addressedit()
	{
		//获取所有地区
		$province  = $this->db->where('region_type=1')->get('x_region')->result_array();
		$this->load->view('address/addressedit',['province'=>$province]);
	}
	/*
	 * 获取该省下的所有城市
	 */
	public function getCity()
	{
		//获取省份id
		$id = $this->input->get('id');
		//查询
		$city = $this->db->where('parent_id='.$id)->get('x_region')->result_array();
		//判断
		if(count($city) > 0){
			echo json_encode($city);
		}else{
			echo 0;
		}
	}
}
