<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /*     引入公共文件        */

        $this -> load ->view('admin/public/header.html');
        $this -> load ->view('admin/public/menu.html');
    }
}