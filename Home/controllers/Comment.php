<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 订单列表->评价订单
	 * @return [type] [description]
	 */
	public function Comment()
	{
		$this->load->view('Comment/Comment');
	}
}
