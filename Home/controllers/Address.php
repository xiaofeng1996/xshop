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
		$this->load->view('address/address');
	}
	/**
	 * 编辑收货地址
	 * @return [type] [description]
	 */
	public function addressedit()
	{
		$this->load->view('address/addressedit');
	}
}
