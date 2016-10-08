<?php
/**
 * Created by PhpStorm.
 * User: 亢士群
 * Date: 2016/9/21
 *商品分类管理
 * Time: 15:42
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends MY_Controller
{    //继承父类
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
    }
    /*
     * 商品分类列表
     */
    public  function category_list($offset=''){
        //加载分页类
        $this->load->library('pagination');
        //请求的URL地址
        $config['base_url']=site_url('Category/category_list');
        //查询出所有的条数
        $config['total_rows']=$this->db->count_all('category');
        //设置每页显示的条数
        $config['per_page']=6;
        //传递的页码参数的值
        $config['uri_segment'] = 4;
        //修改显示
        $config['first_link']='首页';
        $config['last_link']='末页';
        $config['next_link'] = '下一页';
        $config['prev_link'] = '上一页';
        $config['use_page_numbers'] = TRUE;
        //初始化分页类
        $this->pagination->initialize($config);
        //生成分页字符串
        $data['pagestr']=$this->pagination->create_links();
        $limit=$config['per_page'];
        $data['data']=$this->db->limit($limit,$offset)->get('category')->result_array();
        $this->load->view("admin/Category/category_list.html",$data);
    }

    /*
     * 删除数据
     */

    public  function  delete(){

    }
    /*
     * 添加商品分类界面
     */
    public  function  category_edit(){
        if($this->input->post()){
            $data = $this->input->post(); //添加入库
            if($this->db->insert('category',$data)){ //判断是否添加成功

                echo "<script>alert('添加成功');location.href='".site_url('Category/category_list')."'</script>";

            }else{

                echo "<script>alert('添加失败');location.href='".site_url('admin/Category/category_edit')."'</script>";
            }
        }else{
            $data=$this->db->get('category')->result_array(); //查询出所有分类
            $datas['data'] = $this->nodetree($data,0);
            $this->load->view("admin/Category/category_edit.html",$datas);
        }
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
    /*
     * 删除商品分类
     */
    public function category_delete()
    {
        $id = $this->input->post('id');
        $bool = $this->db->delete('category', array('cat_id' => $id));//删除数据库.user表里id=3的用户所有信息
        if ($bool) {

            echo 1;

        } else {

            echo 0;
        }
    }
    /*
     * 修改数据
     */
    public  function  update(){
        $id = $this->uri->segment(3, 0);
        $data['data']=$this->db->where("cat_id",$id)->get('category')->row_array(); //查询出所有分类
        $up=$this->db->get('category')->result_array(); //查询出所有分类
        $data['up'] = $this->nodetree($up,0);
        $this->load->view("admin/Category/category_update.html",$data);

    }
    public  function  updates(){
        $id = $this->input->post('cat_id');
        $data = $this->input->post(); //添加入库
        $updata = $this->db->where("cat_id",$id)->update("category",$data);
        if($updata){

            echo "<script>alert('修改成功');location.href='".site_url('Category/category_list')."'</script>";
        }else{

            echo "<script>alert('修改失败');location.href='".site_url('Category/category_list')."'</script>";
        }

    }
}