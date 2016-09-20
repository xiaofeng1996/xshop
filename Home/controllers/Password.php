<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 修改密码
	 * @return [type] [description]
	 */
	public function pwdedit()
	{
		$this->load->view('pwd/pwdedit');
	}
}
