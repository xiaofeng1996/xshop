<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pub extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	/*头部*/
	public function head()
	{
		$this->load->view('pub/head');
	}
	/*左侧*/
	public function left()
	{
		$this->load->view('pub/left');
	}
	/*主图片*/
	public function main()
	{
		$this->load->view('pub/main');
	}
}