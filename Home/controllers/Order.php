<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 订单列表
	 * @return [type] [description]
	 */
	public function order()
	{
		$uid=$this->session->userdata('uid');
		//$this->db->join('x_goods', 'x_order_goods.goods_id = x_goods.goods_id','left');
		$order = $this->db->get_where('x_order_goods', array('user_id' => $uid))->result_array();
		$data['order']=$order;
		$this->load->view('order/order',$data);
	}
	/**
	 * 进入支付页面
	 * @return [type] [description]
	 */
	public function pay()
	{
		$id=$this->input->post('rec_id');//购物id

		$pay=$this->input->post('pay');
		$address_id = $this->input->post('address_id');
		//判断是否有该支付方式与地址
		if($pay != "" && $address_id != ""){
			$data['pay'] = $pay;//支付方式
			// if($pay == '1'){ $data['pay'] = "余额支付"; }else if($pay == '2'){ $data['pay'] = "银行支付"; }
			// else if($pay == '3'){ $data['pay'] = "货到付款"; }else if($pay == '4'){ $data['pay'] = "支付宝"; }
			$data['address_id'] = $address_id;//收货地址
			$uid=$this->session->userdata('uid');//用户id
			if(!empty($uid)){
				//修改支付方式 与 地址 订单
				$this->db->where_in('rec_id',$id); 
				$order = $this->db->get_where('x_order_goods', array('user_id' => $uid,'is_status'=>'0'))->result_array();
				$ids="";
				foreach ($order as $key => $val) {
					$order_id = $val['order_id'];
					$update = $this->db->update('x_order_goods', $data, "order_id = $order_id");
					$ids .= $order_id.',';
				}
				$ids = rtrim($ids,',');
				redirect("order/order_pay?id=$ids&pay=$pay");

			}
		}else{
			redirect('flow/flow3');
		}
	}
	/**
	 * 进入支付页面
	 * @return [type] [description]
	 */
	public function order_pay()
	{
		if($_POST){

		}else{
			$id=$this->input->get('id');//订单编号
			$pay=$this->input->get('pay');//支付方式
			if($id != ""){
				$order_id = explode(',',$id);
				$uid=$this->session->userdata('uid');//用户id
				$this->db->where_in('order_id',$order_id);
				$this->db->join('x_user_address', 'x_order_goods.address_id = x_user_address.address_id','left');
				$order = $this->db->get_where('x_order_goods', array('x_order_goods.user_id' => $uid,'is_status'=>'0'))->result_array();
				if($order){
					//计算总几个
					$data['nums_price']="";
					$order_sn="";
					$goods_name="";
					$order_id="";
					foreach ($order as $key => $val) {
					 	$data['nums_price'] += $val['goods_number'] * $val['goods_price'];
					 	$order_id .= $val['order_id'].',';
					 	$order_sn .= $val['order_sn'].',';//订单唯一编号
					 	//订单名称
					 	$goods_name .= $val['goods_name'].',';
					}
					$nums_price = $data['nums_price'];//订单价格
					$order_sn = rtrim($order_sn,',');//唯一编号
					$goods_name = rtrim($goods_name,',');//名称
					$order_id = rtrim($order_id,',');//编号
					if($pay == '4'){
						redirect("pay/bay?nums_price=$nums_price&order_sn=$order_sn&goods_name=$goods_name&order_id=$order_id");
					}
				}else{
					redirect('flow/flow3');
				}
			}else{
				redirect('flow/flow3');
			}
		}
	}
	/**
	 * 查看购买成功订单信息
	 * @return [type] [description]
	 */
	public function pay_orders()
	{
		$order_sn=$this->input->get('order_sn');
		$order_sn=explode(',',$order_sn);
		//查询购买成功订单信息
		if(!empty($order_sn)){
			$uid = $this->session->userdata('uid');//用户id
			$count=count($order_sn);
			for ($i=0; $i < $count; $i++) { 
				$this->db->join('x_user_address', 'x_order_goods.address_id = x_user_address.address_id','left');
				$order[] = $this->db->get_where('x_order_goods', array('x_order_goods.order_sn' => $order_sn[$i],'is_status'=>'1','x_order_goods.user_id'=>$uid))->row_array();
			}
			//计算购买总价
			$data['nums_price']="";
			foreach ($order as $key => $val) {
			 	$data['nums_price'] += $val['goods_number'] * $val['goods_price'];
			}
			//是否有该数据
			if(!empty($order)){
				$data['order']=$order;
				$this->load->view('order/pay_orders',$data);
			}else{
				$data['nums_price']='0';
				$data['order']=[];
				$this->load->view('order/pay_orders',$data);
			}
		}
		// if($order){
		// 	//计算总几个
		// 	$data['nums_price']="";
		// 	$order_sn="";
		// 	$goods_name="";
		// 	foreach ($order as $key => $val) {
		// 	 	$data['nums_price'] += $val['goods_number'] * $val['goods_price'];
		// 	 	$order_sn .= $val['order_sn'].',';//订单唯一编号
		// 	 	//订单名称
		// 	 	$goods_name .= $val['goods_name'].',';
		// 	}
		// 	//$nums_price = $data['nums_price'];//订单价格
		// 	$data['order_sn'] = rtrim($order_sn,',');//唯一编号
		// 	$data['goods_name'] = rtrim($goods_name,',');//名称
		// 	$this->load->view('order/order_pay',$data);
		// }
	}



}
