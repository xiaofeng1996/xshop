<?php

/**
 * Created by PhpStorm.
 * User: 亢士群
 * Date: 2016/9/21
 * 商品分类管理模型层
 * Time: 16:25
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category_mode extends CI_Model
{
    const TB_category = 'category';
    //取出数据
    public  function cat_list(){
        $data = $this->db->get(self::TB_category)->result_array();
        return $this->tree($data,$parent_id=0,$level=0);
    }
    //无限级分类树
    public function tree($data,$parent_id=0,$level=0){
        //先定义一个静态数组保存遍历出来的数据
        static $arr=array();
        foreach ($data as $k => $v) {
            if($v['parent_id']==$parent_id){
                $v['level']=$level;
                $arr[]=$v;
                //形成一个递归，要取出子级，其方法和取出顶级的方法是一样
                $this->tree($data,$v['cat_id'],$level+1);
            }
        }
        return $arr;
    }
    //获取所有子节点的数据
    public function cates(){
        $data=$this->db->get(self::TB_category)->result_array();
        return $this->digui($data,$parent_id=0);
    }
    //调用递归完成取出所有数据，形成子孙节点的架构
    public function digui($data,$parent_id=0){
        $child=array();
        foreach ($data as $key => $v) {
            if($v['parent_id']==$parent_id){
                $child[]=$v;
            }
        }
        if(empty($child)){
            return null;
        }
        //取出子级
        foreach ($child as $key => $v) {
            $current_child=$this->digui($data,$v['cat_id']);
            if($current_child){
                $child[$key]['child']=$current_child;
            }
        }
        return $child;
    }
}