<?php
/**
 * Created by PhpStorm.
 * User: 亢士群
 * Date: 2016/9/20
 * 后台首页
 * Time: 17:25
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Goods extends MY_Controller {
	//继承父类
	public function __construct()
	{
		parent::__construct();
	}
    /*
     * 首页展示界面
     */
	public function index()
	{
		
		$this->load->view('admin/goods.html');
	}
	
	/*
	 * 添加商品
	 */
	public function add_goods(){
		if($this->input->post()){
			$goods_img = $_FILES['goods_img'];
			$img_type=substr($goods_img['name'],strrpos($goods_img['name'],'.')+1);
			$filename=time().rand(1000,9999).'.'.$img_type;
			$config['upload_path'] = './public/upload/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = $filename;
			$config['encrypt_name'] = false;
			$config['max_size'] = '5000';
			$config['max_width'] = '5000';
			$config['max_height'] = '1000';
			$this->load->library('upload', $config);
			if($this->upload->do_upload('goods_img')){
				$data = $this -> input ->post();
				//print_r($data);die;
				@$attr_id = $data['y_id'];
				@$attr_name = $data['attr_name'];
				unset($data['y_id']);
				unset($data['attr_name']);
				$data['add_time'] = date("Y-m-d H:i:s",time());
				$data['goods_img'] = $config['upload_path'].$filename;
				$res = $this->db->insert('x_goods', $data);
				$good_id = $this->db->insert_id();
				if(!empty($attr_name) & !empty($attr_id)){
					$data1 = array();
					foreach ($attr_id as $k=>$v){
						foreach ($attr_name as  $ke=>$va){
							//echo $va;die;
							$data1[$ke]['goods_id'] = $good_id;
							$data1[$k]['attr_id'] = $v;
							$data1[$ke]['attr_value'] = $va;
							//$res = $this->db->insert('x_goods_attr', $data1);
						}
					}
					//print_r($data1);die;
					foreach ($data1 as $v){
						$ress = $this->db->insert('x_goods_attr', $v);
					}
					if($res > 0){
						echo "<script>alert('添加成功');location.href='".site_url('goods/index')."'</script>";
					}
				}
			}
		}else{
			//查询出所有分类
			$data=$this->db->get('category')->result_array();
			$datas['type'] = $this->nodetree($data,0);

			//查询商品品牌
			$datas['brand'] = $this->db->get('brand')->result_array();
			
			//查询商品类型做sku
			$datas['goods_type'] = $this ->db -> get('goods_type')->result_array();

			$this->load->view('admin/add_goods.html',$datas);
		}
	}
	/*
	 * 查询商品类型
	 */
	function find_cats(){
		$cats_id = $this -> input -> post('cats_id');
		$one_cats_id = $this -> db -> where('cats_id',$cats_id) -> get('goods_type')->result_array();
		//print_r($one_cats_id);die();
		$cats_id_one = $one_cats_id[0]['cats_id'];
		$attr = $this -> db ->where('cats_id',$cats_id_one) -> get('attribute')->result_array();
		//print_r($attr);die;
		echo json_encode($attr);die;
	}
	/*
    *  权限树
    */
	protected function nodetree($data,$pid=0){
		$arr  =array();
		foreach($data as $k=>$v)
		{
			if($v['parent_id']==$pid){
				$arr[$k] = $v;
				$arr[$k]['son']=  $this->nodetree($data,$v['cat_id']);
			}
		}
		return $arr;
	}
	
	

}
