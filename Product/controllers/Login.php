<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
    /*
     * 展示表单
     */
	public function index()
	{
		//echo site_url();die;
		$this->load->view('admin/login.html');
	}

	/*
	 * 验证登录
	 */
	public function check_login(){
		$account = $this->input->post('account');
		$password = md5($this -> input ->post('password'));

		$url = site_url().'/login/index';
		$g_url = site_url().'/index/index';

		//获取最后登录ip和时间
		$register_ip = $_SERVER['REMOTE_ADDR'];
		$lastlogin = date("Y-m-d H:i:s",time());

		if(empty($account)){
			echo "<script>alert('用户名不能为空');location.href='$url'</script>";
		}
		if(empty($password)){
			echo "<script>alert('密码不能为空');location.href='$url'</script>";
		}
		$data = $this->db->where('adminname',$account)->where('pwd',$password)->get('pro_user')->result_array();

		if($account==$data[0]['adminname']&& $password==$data[0]['pwd']){
			$this->db->where("aid",$data[0]['aid'])->update('x_admin',array('register_ip'=>$register_ip));
			$this->db->where("aid",$data[0]['aid'])->update('x_admin',array('lastlogin'=>$lastlogin));
			$this->session->set_userdata('pro_admin_name',$data[0]['adminname']);
			redirect('index/index');
		}else{
			echo "<script>alert('登录失败');location.href='$url'</script>";
		}
	}

	/*
	 * 退出登录
	 */
	public function login_out(){
		$this->session->unset_userdata('pro_admin_name');
		//echo site_url();die;
		echo "<script>alert('退出成功');location.href='".site_url('login/index')."'</script>";
	}
}
