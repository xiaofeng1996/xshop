<?php
/**
 * Created by PhpStorm.
 * User: 亢士群
 * Date: 2016/9/21
 * 品牌管理控制器
 * Time: 14:44
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Brand extends  MY_Controller
{
    //继承父类
    public function __construct()
    {
        parent::__construct();
    }
    
    /*
     * 品牌列表
     */
    public  function  brand_list(){
        $data['data']=$this->db->get('brand')->result_array();
        $this->load->view("admin/brand/brand_list.html",$data);
    }
    /*
     * 添加品牌
     */
    public  function  brand_edit(){
        if($this->input->post()){
            $goods_img = $_FILES['brand_logo'];
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
             //判断是否上传成功
            if($this->upload->do_upload('brand_logo')){
                $data = $this -> input ->post();
                $data['brand_logo'] = $config['upload_path'].$filename;
                $this->db->insert('brand', $data);

                echo "<script>alert('添加成功');location.href='".site_url('brand/brand_list')."'</script>";

            }else{

                echo "<script>alert('上传失败');location.href='".site_url('brand/brand_edit')."'</script>";
            }

            }else{

            $this->load->view("admin/brand/brand_edit.html");
        }
    }
    /*
    * 删除品牌数据
    */
    public  function  brand_delete(){
        $id = $this->input->post('id');
        $bool=$this->db->delete('brand',array('brand_id'=>$id));//删除数据库.user表里id=3的用户所有信息
        if($bool){

            echo 1;

        }else{

            echo 0;
        }
    }
}
