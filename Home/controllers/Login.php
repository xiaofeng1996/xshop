<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	//验证码
	function yzm()
	{
		$this->load->helpers('captcha');
		$cap=create_captcha();
		$this->session->set_userdata('codes',$cap);
	}
	/**
	 * 登录
	 * @return [type] [description]
	 */
	public function login()
	{
		if($_POST)
		{
			$yzm=$this->session->userdata('codes');
            $user=$this->input->post('user');
            $pwd=$this->input->post('pwd');
			$code=$this->input->post('code');
			if($code!=$yzm)
			{
				die("<script>alert('验证码错误');location.href='".site_url('login/login')."'</script>") ;
			}
			$d=$this->db->where("user='$user'")->get('x_user')->row_array();
			if($d)
			{
				$sarf=$d['sarf'];
			     $pwd2=md5($pwd.$sarf);
				if($pwd2!=$d['pwd'])
				{
					die("<script>alert('密码错误');location.href='".site_url('login/login')."'</script>") ;
				}
				else
				{
					 $this->session->set_userdata('uid',$d['aid']);  //登录人的id
					 $this->session->set_userdata('uname',$d['user']);
					die("<script>alert('登录成功');location.href='".site_url('Index/index')."'</script>") ;
				}
			}
		}
		else
		{
			$this->load->view('login/login');
		}
	}
}
