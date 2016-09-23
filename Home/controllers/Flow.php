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
		// session_start();
		// session_destroy();
		//$this->session->set_userdata('uid','1');//最后需要删除
		$uid=$this->session->userdata('uid');
		//判断是否登录状态
		if(!empty($uid)){
			 $x_cart = $this->db->get_where('x_cart',['user_id'=>$uid])->result_array();
			 //加载商品图片
			 $data['nums_price']="";
			 foreach ($x_cart as $key => $val) {
			 	$images=$this->db->get_where('x_goods',['goods_id'=>$val['goods_id']])->row_array();
			 	$x_cart[$key]['goods_img']=$images['goods_img'];
			 	$data['nums_price'] += $val['goods_number'] * $val['goods_price'];
			 }
			 $data['shop_cart']=$x_cart;
			 //商品数量  
		}else{
			//session数据
			$data['shop_cart']=$this->session->userdata('shop_cart');
			$shop_cart=$data['shop_cart'];
			if(!empty($shop_cart)){
				//商品数量  和图片
				foreach ($shop_cart as $key => $val) {
					//图片
					$images=$this->db->get_where('x_goods',['goods_id'=>$val['goods_id'] ])->row_array();
					//购物车信息
				 	$shop_cart[$key]['goods_img']=$images['goods_img'];
				 	//购物车id
				 	$shop_cart[$key]['rec_id']=$images['goods_id'];
				 	//总计
				 	$data['nums_price']="";
					$data['nums_price'] = $val['goods_number'] * $val['goods_price'];
				}
				$data['shop_cart']=$shop_cart;
			}
		}
		$this->load->view('flow/flow',$data);
	}
	/**
	 * 加入购物车
	 * @return [type] [description]
	 */
	public function shop_cart(){
		//商品
		$goods_id=$this->input->post('goods_id');
		$good_nums= intval($this->input->post('good_nums'));
		//查询当前商品
		$x_goods = $this->db->get_where('x_goods',array('goods_id' => $goods_id))->row_array();	
		//用户id 判断是否登录
		$uid=$this->session->userdata('uid');
		if(!empty($uid)){
			//arr0为要添加已存在购物车数组arr的新购物车数组  
				$arr0 = [$goods_id => 
							[
								'goods_id' => $goods_id, 
								'user_id' => $uid, 
								'goods_name' => $x_goods['goods_name'], 
								'goods_price' => $x_goods['shop_price'],
								'goods_sn' => $x_goods['goods_sn']
							]
						];  	  
			    foreach ($arr0 as $key => $value) {  
			        $shop_cart[$key] = $value;  
			    } 
			    //判断购物车中是否有该商品
			    $x_cart = $this->db->get_where('x_cart',['goods_id' => $goods_id,'user_id'=>$uid])->row_array();
			    if($x_cart){
			    	$x_cart['goods_number']=empty( intval($x_cart['goods_number']) )?'1':intval($x_cart['goods_number']);//判断是否是整形
			    	$shop_cart[$goods_id]['goods_number']= $x_cart['goods_number'] + $good_nums; //在本条件下增加数量
			    	$data=$shop_cart[$goods_id];
			    	$update=$this->db->update('x_cart', $data, array('goods_id' => $goods_id,'user_id'=>$uid));
			    	if($update){ echo '1';die;//商品修改成功
			    	}else{ echo '2';die;}//商品修改失败
			    }else{
			    	$shop_cart[$goods_id]['goods_number']= $good_nums; 
			    	$data=$shop_cart[$goods_id];
			    	$insert=$this->db->insert('x_cart', $data); 
			    	if($insert){ echo '1';die;//商品修改成功
			    	}else{ echo '2';die;}//商品修改失败
			    }	
		}else{
			
			//echo 1+5;die;
			$shop_cart=$this->session->userdata('shop_cart');//购物车session
			if(empty($shop_cart)){
				$shop_cart=[];
			}
			//判断是否有该当前的商品id
			if (array_key_exists($goods_id, $shop_cart)) {
			   //该商品添加过购物车，进行数量加1的操作  
			    $shop_cart[$goods_id]['goods_number'] += $good_nums; 
			}else{
			//arr0为要添加已存在购物车数组arr的新购物车数组  
				$arr0 = [$goods_id => 
							[
								'goods_id' => $goods_id, 
								'goods_number' => $good_nums, 
								'goods_name' => $x_goods['goods_name'], 
								'goods_price' => $x_goods['shop_price'],
								'goods_sn' => $x_goods['goods_sn']
							]
						];  	  
			    foreach ($arr0 as $key => $value) {  
			        $shop_cart[$key] = $value;  
			    } 
			}
			$this->session->set_userdata('shop_cart',$shop_cart);
			$data['shop_cart']=$this->session->userdata('shop_cart');
			$shop_cart=$data['shop_cart'];
			//print_r($shop_cart);die;
			if(is_array($shop_cart)){
				echo "1";die;
			}else{
				echo "0";die;
			}
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
	public function p_delete()
	{
		//获取要删除的session中的购物id
		$id=$this->input->post('id');
		$uid=$this->session->userdata('uid');
		//判断是否登录状态
		if(!empty($uid)){

		}else{
			$shop_cart=$this->session->userdata('shop_cart');//购物session
			$d_id=explode(',', $id);
			if(!empty($d_id)){
				foreach ($d_id as $key => $val) {
					unset($_SESSION['shop_cart'][$val]);
				}
				//session数据
				$data['shop_cart']=$this->session->userdata('shop_cart');
				$shop_cart=$data['shop_cart'];
				if(!empty($shop_cart)){
					//商品数量  和图片
					foreach ($shop_cart as $key => $val) {
						//图片
						$images=$this->db->get_where('x_goods',['goods_id'=>$val['goods_id'] ])->row_array();
						//购物车信息
					 	$shop_cart[$key]['goods_img']=$images['goods_img'];
					 	//购物车id
					 	$shop_cart[$key]['rec_id']=$images['goods_id'];
					 	//总计
					 	$data['nums_price']="";
						$data['nums_price'] = $val['goods_number'] * $val['goods_price'];
					}
					$data['shop_cart']=$shop_cart;
				}
				$this->load->view('flow/goods_cart',$data);
			}

		}	

	}
}
