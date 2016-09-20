<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 订单列表
	 * @return [type] [description]
	 */
	public function order()
	{
		$this->load->view('order/order');
	}
}
