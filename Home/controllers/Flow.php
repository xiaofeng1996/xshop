<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flow extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 查看购物车信息1
	 * @return [type] [description]
	 */
	public function flow()
	{
		$data['shop_cart']=$this->session->userdata('shop_cart');
		//print_r($shop_cart);die;
		$this->load->view('flow/flow',$data);
	}
	/**
	 * 加入购物车
	 * @return [type] [description]
	 */
	public function shop_cart(){
		//用户id
		$this->session->userdata('user_id');
		//商品
		$goods_id=$this->input->post('goods_id');
		$good_nums= intval($this->input->post('good_nums'));
		//echo 1+5;die;
		$shop_cart=$this->session->userdata('shop_cart');//购物车session
		if(empty($shop_cart)){
			$shop_cart=[];
		}
		//print_r($shop_cart);die;
		//判断是否有该当前的商品id
		if (array_key_exists($goods_id, $shop_cart)) {
		   //该商品添加过购物车，进行数量加1的操作  
		    $shop_cart[$goods_id]['goods_num'] += $good_nums; 
		}else{
			$x_goods = $this->db->get_where('x_goods',array('goods_id' => $goods_id))->row_array();	
		//arr0为要添加已存在购物车数组arr的新购物车数组  
			$arr0 = [$goods_id => 
						[
							'goods_id' => $goods_id, 
							'goods_num' => $good_nums, 
							'goods_name' => $x_goods['goods_name'], 
							'goods_price' => $x_goods['shop_price'],
							'goods_sn' => $x_goods['goods_sn'],
							'goods_thumb' => $x_goods['goods_thumb']
						]
					];  	  
		    foreach ($arr0 as $key => $value) {  
		        $shop_cart[$key] = $value;  
		    } 
		}

		$this->session->set_userdata('shop_cart',$shop_cart);
		//print_r($shop_cart);die;
		if(is_array($shop_cart)){
			echo "1";die;
		}else{
			echo "0";die;
		}
	}
	/**
	 * 确认收货人资料及送货方式
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function flow2()
	{
		$this->load->view('flow/flow2');
	}

}
