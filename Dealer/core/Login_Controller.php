<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /*     引入公共文件        */
        $admin_name = $this->session->userdata('admin_name');
        prep_url($admin_name);
        $this -> load ->view('admin/public/header.html',$admin_name);
        $this -> load ->view('admin/public/menu.html');
    }
}