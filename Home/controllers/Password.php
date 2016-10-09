<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 修改密码
	 * @return [type] [description]
	 */
	public function pwdedit()
	{
		if($_POST){
			//密码修改
			$uid=$this->session->userdata('uid');
			$pwd = $this->input->post('pwd');//用户名称
			$pwd1 = $this->input->post('pwd1');//用户名称
			$user= $this->db->get_where('x_user', array('aid' => $uid))->row_array();
			$sarf=$user['sarf'];
			$pwd=md5($pwd.$sarf);
			if($user['pwd'] == $pwd){
				if(empty($pwd1)){
					die("<script>alert('密码不能为空');location.href='".site_url('password/pwdedit')."'</script>");
				}
				$data['pwd'] = md5($pwd1.$sarf);
				$update = $this->db->update('x_user', $data, "aid = $uid");
				if(!$update){
					redirect('password/pwdedit');
					die;
				}
				redirect("index/quit");
			}else{
				die("<script>alert('密码修改失败,请检查密码是否一致');location.href='".site_url('password/pwdedit')."'</script>") ;
			}
		}else{
			$this->load->view('pwd/pwdedit');
		}

	}
}
