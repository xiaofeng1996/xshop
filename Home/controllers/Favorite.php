<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorite extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 我的收藏
	 * @return [type] [description]
	 */
	public function favorite()
	{
		$this->load->view('favorite/favorite');
	}
}
