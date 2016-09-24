<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @boy  胡雪宝
     * 
     */
	public function bay()
	{
		$order_sn=$this->input->get('order_sn');
        $goods_name=$this->input->get('goods_name');
        $nums_price=$this->input->get('nums_price');
        $order_id=$this->input->get('order_id');

	     $uid=$this->session->userdata('uid');//用户id
         // ******************************************************配置 start*************************************************************************************************************************
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者id，以2088开头的16位纯数字
        $alipay_config['partner']		= '2088002075883504';
//收款支付宝账号
        $alipay_config['seller_email']	= 'li1209@126.com';
//安全检验码，以数字和字母组成的32位字符
        $alipay_config['key']			= 'y8z1t3vey08bgkzlw78u9cbc4pizy2sj';
//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
//签名方式 不需修改
        $alipay_config['sign_type']    = strtoupper('MD5');
//字符编码格式 目前支持 gbk 或 utf-8
//$alipay_config['input_charset']= strtolower('utf-8');
//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert']    = getcwd().'\\cacert.pem';
//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport']    = 'http';
// ******************************************************配置 end*************************************************************************************************************************

// ******************************************************请求参数拼接 start*************************************************************************************************************************
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => $alipay_config['partner'], // 合作身份者id
            "seller_email" => $alipay_config['seller_email'], // 收款支付宝账号
            "payment_type"	=> '1', // 支付类型
            "notify_url"	=> "http://bw.com133.com/notify_url.php", // 服务器异步通知页面路径
            "return_url"	=> site_url("pay/return_url"), // 页面跳转同步通知页面路径
            "out_trade_no"	=> $order_sn, // 商户网站订单系统中唯一订单号
            "subject"	=> $goods_name, // 订单名称
            "body"	=> "化肥便宜了", // 订单描述 可选
            "total_fee" => "0.01", // 付款金额
            "show_url"	=> "", // 商品展示地址 可选
            "anti_phishing_key"	=> "", // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
            "exter_invoke_ip"	=> "", // 客户端的IP地址
            "_input_charset"	=> 'utf-8', // 字符编码格式
        );
// 去除值为空的参数
        foreach ($parameter as $k => $v) {
            if (empty($v)) {
                unset($parameter[$k]);
            }
        }
// 参数排序
        ksort($parameter);
        reset($parameter);

// 拼接获得sign
        $str = "";
        foreach ($parameter as $k => $v) {
            if (empty($str)) {
                $str .= $k . "=" . $v;
            } else {
                $str .= "&" . $k . "=" . $v;
            }
        }
        $parameter['sign'] = md5($str . $alipay_config['key']);
        $parameter['sign_type'] = $alipay_config['sign_type'];
// ******************************************************请求参数拼接 end*************************************************************************************************************************


// ******************************************************模拟请求 start*************************************************************************************************************************
        $sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='https://mapi.alipay.com/gateway.do?_input_charset=utf-8' method='get'>";
        foreach ($parameter as $k => $v) {
            $sHtml.= "<input type='hidden' name='" . $k . "' value='" . $v . "'/>";
        }

        $sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";

// ******************************************************模拟请求 end*************************************************************************************************************************
        echo $sHtml;

	}
	/**
	 * 支付成功与失败
	 * @return [type] [description]
	 */
    function return_url(){
	    if($_GET['is_success']=="T"){
	        $order_sn=$_GET['out_trade_no'];
	        $g_name=$_GET['subject'];
	        $data = array('o_status' =>0 , );
	        $orders_sn = explode(',',$order_sn);

	        //print_r($order_sn);die;
	        if(!empty($orders_sn)){
	        	$count=count($orders_sn);
	        	$dat['is_status']='1';
	        	$dat['pay_time']=date('Y-m-d H:i:s');
	        	for ($i=0; $i < $count; $i++) { 
	        	$res=$this->db->update('x_order_goods',$dat,array('is_status'=>'0','order_sn'=>$orders_sn[$i]));
	        	}
	        	if($res){
	        		redirect("order/pay_orders?order_sn=$order_sn");
	        	}else{
	        		redirect("flow/flow3");
	        	}
	        }
	    } else{
	    	echo "<script> alert('支付失败');location.href='".site_url('flow/flow3')."';</script>";
	    }  
           
    }



}
