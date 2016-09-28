<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /*     引入公共文件        */
        $admin_name['admin_name'] = $this->session->userdata('admin_name');
        if($admin_name{'admin_name'}==""){
            echo "<script>alert('请先登录');location.href='".site_url('login/index')."'</script>";
        }
        $a_id = $this->session->userdata('admin_id');

        //$a_id = 10;
        $this->db->select('a.aid,adminname,r_name,p_name,p_controller,p_action,parent_id');
        $this->db->from('admin a');
        $this->db->join('x_admin_role as ar', 'a.aid = ar.aid');
        $this->db->join('x_role as r', 'ar.rid = r.id');
        $this->db->join('x_privilege_role as pr', 'r.id = pr.rid');
        $this->db->join('x_privilege as p', 'pr.pid = p.id');
        $this->db->where("a.aid = '$a_id'");
        $array = $this->db->get()->result_array();
        //echo $this->db->last_query();die;
       // print_r($array);die;

        $this -> load ->view('admin/public/header.html',$admin_name);
        $array['array'] = $array;
        //print_r($array);die;
        $this -> load ->view('admin/public/menu.html',$array);
    }
    public function success($msg='',$url='',$wait=2)

    {

        $data['message'] = $msg;

        $data['url'] = $url;

        $data['wait'] = $wait;

        $data['status'] = 1;

        $this->load->view('admin/message/add_message.html',$data);

    }

}