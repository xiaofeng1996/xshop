<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/*
	 * 验证码
	 */
	function yzm()
	{
		$this->load->helpers('captcha');
		$cap=create_captcha();
		$this->session->set_userdata('codes',$cap);
	}
	/**
	 * 注册
	 * @return [type] [description]
	 */
	public function register()
	{
		if($_POST)
		{
			$code=$this->input->post('code');
			$yzm=$this->session->userdata('codes');
			if($code!=$yzm)
			{
				die("<script>alert('验证码错误');location.href='".site_url('register/register')."'</script>") ;
			}
			else
			{
				$data['user']=$this->input->post('user');
				$pwd=$this->input->post('pwd');
				$repwd=$this->input->post('repwd');
				if($pwd!=$repwd)
				{
					die("<script>alert('密码不一致');location.href='".site_url('register/register')."'</script>") ;
				}
				$data['email']=$this->input->post('email');
                $data['regist_time']=date('Y-m-d H:i:s',time());
               $data['register_ip']=$_SERVER['REMOTE_ADDR'];
               $data['sarf']=uniqid();
                $data['pwd']=md5($pwd.$data['sarf']);
				$bol=$this->db->insert('x_user',$data);
				if($bol)
				{
					echo "<script>alert('注册成功');location.href='".site_url('Login/login')."'</script>";
				}
			}

		}else {

			$this->load->view('register/register');
		}
	}
}
