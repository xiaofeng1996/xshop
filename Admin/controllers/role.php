<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Role extends MY_Controller
{
    //继承父类
    public function __construct()
    {
        
        parent::__construct();
        
        $this->load->model('Role_model','role');
        
        $this->load->model('RolePri_model','RP');
        
        $this->load->model('AdminRole_model','AR');
        
        $this->load->model('Admin_model','admin');
    }
    //角色添加
    public function role_add(){

    	if ($_POST) {

    		$data['r_name'] = $this->input->post('role_name');

            $res = $this->db->insert('role',$data);

            if ($res) {

                $this->success("添加成功",site_url('role/role_list'));

            }else{

                $this->success("添加失败",site_url('role/role_add'));

            }

    	}else{

            $this->load->view('admin/role/role_add.html');

        }

	}

    //角色列表

    public function role_list(){
       
        $role=$this->role->sel();
       
        $this->load->vars('role',$role);
       
        $this->load->view('admin/role/role_list.html');
    
    }

    //角色删除

    public function dele(){

        if(IS_AJAX){

            $del = $this->input->post('del');

            $res = $this->role->del("id=$del");

            if ($res) {

                $info = $this->RP->del("id=$del");
            
            if($info){

                echo 1;die;

            }else{

                echo 0;die;

            }

            }

        }else{

        echo "<script>alert('非法操作');location.href='".$_SERVER['HTTP_REFERER']."'</script>";die();
        
        }

    
    }

        //极点技改角色名
    
        public function updata(){
    
        if(IS_AJAX){
    
            $name=$this->input->post('pname');
    
            $nameall=$this->role->selname();
    
            $arr=array();
    
            foreach($nameall as $k=>$v){
    
                $arr[]=$v['r_name'];
    
            }
    
            foreach($arr as $k=>$v){
    
                if("$name"=="$v"){
    
                    echo 3;
    
                    die;
    
                }
    
            }
    
            $data=array(
    
                'r_name'=>$name
    
            );
    
            $where = 'id='.$this->input->post('id');
    
                $res=$this->role->upd($where,$data);
    
                if($res){
    
                    //成功
    
                    echo 1;die;
    
                }else{
    
                    //失败
    
                    echo 0;die;
    
                }
    
        }else{
    
        echo "<script>alert('非法操作');location.href='".$_SERVER['HTTP_REFERER']."'</script>";die();
        }

    }

    //为角色分配权限
    
    public function admin_role(){
    
        if($_POST){
    
            $data['aid']=$this->input->post('uid');
    
            $uid=$data['aid'];
    
            $rid=$this->input->post('check');
    
            $sel = $this->AR->sel_where("aid='$uid'");
    
            if($sel){
    
                $this->AR->delete("aid='$uid'");
    
            }
    
            $arr=array();
    
            foreach($rid as $key=>$val){
    
                $arr[]['rid']=$val['rid'];
    
            }
            
            foreach($arr as $k=>$v){
    
                $data['rid'] = $v['rid'];
    
                $res = $this->AR->insert($data);

            }

            if($res){
    
            echo"<script>alert('付权成功');location.href='role_list'</script>";die();
           
            }else{
           
            echo "<script>alert('解除权限成功');location.href='".$_SERVER['HTTP_REFERER']."'</script>";die();
            
            }
        
        }else{
           
            $role = $this->role->sel();
           
            $admin = $this->admin->sel();
           
            $this->load->vars('role',$role);
           
            $this->load->vars('admin',$admin);
           
            $this->load->view('admin/role/admin_role.html'); 

        }
    
    }


}