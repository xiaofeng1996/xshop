<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /*     引入公共文件        */
        $admin_name['dea_admin_name'] = $this->session->userdata('dea_admin_name');
        if($admin_name{'dea_admin_name'}==""){
            echo "<script>alert('请先登录');location.href='".site_url('login/index')."'</script>";
        }
        $this -> load ->view('admin/public/header.html',$admin_name);
        $this -> load ->view('admin/public/menu.html');
    }
}