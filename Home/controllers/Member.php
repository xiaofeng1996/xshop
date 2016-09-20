<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 订单列表
	 * @return [type] [description]
	 */
	public function member()
	{
		$this->load->view('member/member');
	}
	/**
	 * 个人信息
	 * @return [type] [description]
	 */
	public function memberinfo()
	{
		$this->load->view('member/memberinfo');
	}
}
