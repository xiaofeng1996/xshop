<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 注册
	 * @return [type] [description]
	 */
	public function register()
	{
		$this->load->view('register/register');
	}
}
