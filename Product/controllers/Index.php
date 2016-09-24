<?php
/**
 * Created by PhpStorm.
 * User: 亢士群
 * Date: 2016/9/20
 * 后台首页
 * Time: 17:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends MY_Controller {
	//继承父类
	public function __construct()
	{
		parent::__construct();
	}
    /*
     * 首页展示界面
     */
	public function index()
	{
		$this->load->view('admin/index.html');
	}
}
