<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 搜索商品
	 * @return [type] [description]
	 */
	public function search()
	{
		//echo "1";die;
		$this->load->view('search/search');
	}
}
