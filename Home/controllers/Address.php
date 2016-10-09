<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 收货地址
	 * @return [type] [description]
	 */
	public function address()
	{
		//获取收货地址
		$uid=$this->session->userdata('uid');
		$address = $this->db->get_where('x_user_address', array('user_id' => $uid))->result_array();
		//获取所有地区
		$province  = $this->db->where('region_type=1')->get('x_region')->result_array();
		$this->load->view('address/address',['province'=>$province,'address'=>$address]);
	}
	/**
	 * 添加收货地址
	 * @return [type] [description]
	 */
	public function addressadd()
	{
		$data['consignee'] = $this->input->post('consignee');//收货人姓名
		$data['country'] = $this->input->post('country');//省
		$data['province'] = $this->input->post('province');//市
		$data['city'] = $this->input->post('city');//镇
		$data['address'] = $this->input->post('address');//详细地址
		$data['sign_building'] = $this->input->post('sign_building');//邮政编码
		$data['tel'] = $this->input->post('tel');//手机号
		$data['mobile'] = $this->input->post('mobile');//电话
		$data['user_id']=$this->session->userdata('uid');
		if(empty($data['user_id'])){
			redirect("address/address");
			die;
		}
		$insert=$this->db->insert('x_user_address', $data); 
		if(!$insert){
			redirect("address/address");
			die;
		}
		redirect("address/address");
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
