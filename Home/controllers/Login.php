<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 登录
	 * @return [type] [description]
	 */
	public function login()
	{
		$this->load->view('login/login');
	}
}
