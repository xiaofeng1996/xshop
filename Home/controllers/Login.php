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
					 //购物车方法
					 $this->shop_cart();
					 $flow=$this->input->post('flow');
					 if($flow == '1'){
					 	die("<script>alert('登录成功');location.href='".site_url('flow/flow')."'</script>") ;
					 }
					die("<script>alert('登录成功');location.href='".site_url('Index/index')."'</script>") ;
				}
			}
		}
		else
		{
			$data['flow']=$this->input->get('flow');
			$this->load->view('login/login',$data);
		}
	}
	/**
	 *把session加入 购物车
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function shop_cart()
	{
		 //获取购物车session
		 $shop_cart=$this->session->userdata('shop_cart');
		 //print_r($shop_cart);die;
		 //判断session是否有商品
		 if(!empty($shop_cart)){
		 	$uid = $this->session->userdata('uid'); //用户id
		 	//获取数组中的键名
		 	$arr=array_keys($shop_cart);
		 	//$id = explode(',',$arr);//购物车id
		 	foreach ($arr as $key => $val) {	
			    //判断购物车中是否有该商品
			    $x_cart = $this->db->get_where('x_cart',['goods_id' => $val,'user_id'=>$uid])->row_array();
			    //查询是否有商品
		    	$x_goods = $this->db->get_where('x_goods',['goods_id' => $val])->row_array();
		    	if($x_goods){
		    		$arr0 = [$val => 
								[
									'goods_id' => $val, 
									'user_id' => $uid, 
									'goods_name' => $x_goods['goods_name'], 
									'goods_price' => $x_goods['shop_price'],
									'goods_sn' => $x_goods['goods_sn']
								]
							];  	  
				    foreach ($arr0 as $key => $value) {  
				        $shop[$key] = $value;  
				    } 
		    	}
		    	//判断购物车中是否有该商品
			    if($x_cart){
			    	$x_cart['goods_number']=empty( intval($x_cart['goods_number']) )?'1':intval($x_cart['goods_number']);//判断是否是整形
			    	$shop[$val]['goods_number']= $x_cart['goods_number'] + $shop_cart[$val]['goods_number']; //在本条件下增加数量
			    	$data=$shop[$val];
			    	$update=$this->db->update('x_cart', $data, array('goods_id' => $val,'user_id'=>$uid));
			    	// if($update){ echo '1';die;//商品修改成功
			    	// }else{ echo '2';die;}//商品修改失败
			    }else{
			    	//添加购物车 有商品
			    	$shop[$val]['goods_number']= $shop_cart[$val]['goods_number']; 
			    	$data=$shop[$val];
			    	$insert=$this->db->insert('x_cart', $data); 
			    }	
		 	}
		 }
	}
}
