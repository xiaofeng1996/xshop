<?php
/**
 * Created by PhpStorm.
 * User: 亢士群
 * Date: 2016/9/20
 * 添加管理员  Manage
 * Time: 17:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Manage extends MY_Controller
{
    //继承父类
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 管理员添加界面
    */
    
    public  function  manage_index(){
        
        $this->load->view('admin/Manage/manage_index.html');
    }

    /*
     * 管理员列表
     */

    public  function  manage_list(){

        $this->load->view('admin/Manage/manage_list.html');
    }
}