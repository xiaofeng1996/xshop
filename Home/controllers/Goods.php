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
			$arr=$this->db->join('x_goods','x_goods.cats_id=x_category.cat_id')->where("cats_id='$id'")->get('x_category')->row_array();
		}
		else if(empty($id))
		{
			$d=$this->mem();
			$arr=$this->db->where("goods_id='$gid'")->get('x_goods')->row_array();
			if($d==2)
		   {
			   $dd['goodsname']=$arr['list']['goods_name'];
			   $dd['goodsid']=$gid;
			   $this->db->insert('x_hot',$dd);
		   }
		}
		//获取商品分类表
		$dd=$this->db->get('x_category')->result_array();
		$arr2=$this->nolimit($dd,0);
		//热词搜搜
		$hot=$this->db->limit(5)->get('x_hot')->result_array();
		$this->load->view('goods/goods',['list'=>$arr,'show'=>$arr2,'hot'=>$hot]);
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
	 public function mem()
	 {
		 $num=$this->session->userdata('gid');
		 if($num)
		 {
			 $num++;
			 $this->session->set_userdata('gid',$num);
			 $nums=$this->session->userdata('gid',$num);
			if($nums==3)
			{
				return 2;
				exit();
			}else
			{
				return 1;
			}
		 }else
		 {
			 $this->session->set_userdata('gid',1);
			 return 1;
		 }

		/* $mem=new Memcache();
		 $mem->connect('127.0.0.1','11211');
		 $num=$mem->get('gid');
		 if($num)
		 {
			 $num++;
			 $mem->set('gid',$num,0,0);
			 $nums=$mem->get('gid');
              if($nums==3)
			  {
                 return 2;
				  exit();
			  }else{
				  return 1;
			  }

		 }else
		 {
			 $mem->set('gid',1,0,0);
			 return 1;
		 }*/
	 }



}
