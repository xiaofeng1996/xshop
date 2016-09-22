<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
	}
	/**
	 * 商城首页
	 * @return [type] [description]
	 */
	public function goods()
	{
		 $id=$this->input->get('id');
		//接受搜索的值
		$gid=$this->uri->segment(3);  //商品的id
		if(empty($gid))
		{
			$arr['list']=$this->db->join('x_goods','x_goods.cats_id=x_category.cat_id')->where("cats_id='$id'")->get('x_category')->row_array();
		}
		else if(empty($id))
		{
			$arr['list']=$this->db->where("goods_id='$gid'")->get('x_goods')->row_array();
		}
		$this->load->view('goods/goods',$arr);
	}
}
