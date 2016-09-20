<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flow extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 查看购物车信息1
	 * @return [type] [description]
	 */
	public function flow()
	{
		$this->load->view('flow/flow');
	}
	/**
	 * 确认收货人资料及送货方式
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function flow2()
	{
		$this->load->view('flow/flow2');
	}

}
