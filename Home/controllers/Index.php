<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 商城首页
	 * @return [type] [description]
	 */
	public function index()
	{
		//获取商品分类表
		  $dd=$this->db->get('x_category')->result_array();
		   $arr=$this->nolimit($dd,0);
		  //商品列表
		 $arr2=$this->db->limit(6)->get('x_goods')->result_array();
		   //热词搜搜
		  $hot=$this->db->limit(5)->get('x_hot')->result_array();
		//特别推荐
		$is_bast=$this->db->where('is_best','1')->get('x_goods')->result_array();
		//热门商品
		$is_new=$this->db->where('is_new','1')->get('x_goods')->result_array();
		//新品上架
		$is_hot=$this->db->where('is_hot','1')->get('x_goods')->result_array();

		$this->load->view('index/index',['list'=>$arr,'show'=>$arr2,'hot'=>$hot,'is_best'=>$is_bast,'is_new'=>$is_new,'is_hot'=>$is_hot]);
	}
	//无限极
	public function nolimit($data,$pid=0){
		$arr2=array();
		foreach($data as $k=>$value){
			if($value['parent_id']==$pid)
			{
               $arr2[$k]=$value;
               $arr2[$k]['son']=$this->nolimit($data,$value['cat_id']);
			}
		}
		return $arr2;
	}
    public function search()
	{
		 $name=$this->input->get('name');
		$dd=$this->db->where("goods_name like '%$name%'")->select(array('goods_id','goods_name'))->get('x_goods')->result_array();
		  echo json_encode($dd);
	}
	//退出
	public function quit(){
		 $uname=$this->session->userdata('uname');
		 $uid=$this->session->userdata('uid');
		$this->session->unset_userdata('uname');
		$this->session->unset_userdata('uid');
		$this->session->unset_userdata('shop_cart');//删除购物车
		redirect('Index/index');
	}
}
