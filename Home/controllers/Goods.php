<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 商城首页
	 * @return [type] [description]
	 */
	public function goods()
	{
		$this->load->view('goods/goods');
	}
}
