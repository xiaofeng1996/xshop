<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 订单列表(已购买商品)
	 * @return [type] [description]
	 */
	public function member()
	{
		$uid=$this->session->userdata('uid');
		$order = $this->db->get_where('x_order_goods', array('user_id' => $uid,'is_status'=>'4'))->result_array();
		$data['order']=$order;
		$this->load->view('member/member',$data);
	}
	/**
	 * 个人信息
	 * @return [type] [description]
	 */
	public function memberinfo()
	{
		$uid=$this->session->userdata('uid');
		$data['x_user'] = $this->db->get_where('x_user', array('aid' => $uid))->row_array();
		$this->load->view('member/memberinfo',$data);
	}
	/**
	 * 修改个人信息
	 * @return [type] [description]
	 */
	public function memberupd()
	{
		$uid=$this->session->userdata('uid');
		$data['sex']=$this->input->post('sex');//性别
		if(empty($uid)){
			redirect("member/memberinfo");
			die;
		}
		$update = $this->db->update('x_user', $data, "aid = $uid");
		if(!$update){
			redirect("member/memberinfo");
			die;
		}
		redirect("member/memberinfo");
	}

}
