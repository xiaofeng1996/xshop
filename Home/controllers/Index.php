<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 商城首页
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->load->view('index/index');
	}
}
