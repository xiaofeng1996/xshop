<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends MY_Controller

{
    //继承父类

    public function __construct()

    {

        parent::__construct();


        $this->load->model('Privilege_model','privilege');
        $this->load->model('Role_model','role');
        $this->load->model('RolePri_model','RP');
        
        $this->load->helper('function');


    }



    public function pri_add(){

    	if ($_POST) {
			
			$data = $this->input->post();
			
			$res=$this->privilege->insert($data);
			
			if($res){
			
				echo"<script>location.href='pri_list'</script>";die();
			
			}else{
			
				echo "<script>alert('添加失败');location.href='".$_SERVER['HTTP_REFERER']."'</script>";die();

			}

    	}else{

    		$data = $this->privilege->sel();

    		$arr =  level_auto($data);

    		$this->load->vars('arr',$arr);

    		$this->load->view('admin/privilege/pri_add.html');

    	}
    }

    public function pri_list($offset=""){
		//加载分页类
		$this->load->library('pagination');
		//请求的URL地址
		$config['base_url']=site_url('privilege/pri_list');
		//查询出所有的条数
		$config['total_rows']=$this->db->count_all('privilege');
		//设置每页显示的条数
		$config['per_page']=8;
		//传递的页码参数的值
		$config['uri_segment'] = 8;
		//修改显示
		$config['first_link']='首页';
		$config['last_link']='末页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$config['use_page_numbers'] = TRUE;
		//初始化分页类
		$this->pagination->initialize($config);
		if($offset==""){
			$offset1 = 0;
		}else{
			$offset1 = ($offset-1)*$config['per_page'];
		}
		//生成分页字符串
		$data['pagestr']=$this->pagination->create_links();
		$limit=$config['per_page'];
		$arr = $this->db ->limit($limit,$offset1) ->get('privilege')->result_array();
		$data['data'] =  level_auto($arr);
    	$this->load->view('admin/privilege/pri_list.html',$data);
    }
   	

   	//及点及改权限名
	
	public function updata(){
	
		if(IS_AJAX){
	
			$name=$this->input->post('pname');
	
			$nameall=$this->privilege->selname();
	
			$arr=array();
	
			foreach($nameall as $k=>$v){
	
				$arr[]=$v['p_name'];
	
			}
	
			foreach($arr as $k=>$v){
	
				if("$name"=="$v"){
	
					echo 3;
	
					die;
	
				}
	
			}
	
			$data=array(
	

				'p_name'=>$name
	
			);
	
			$where = 'id='.$this->input->post('id');
	
				$res=$this->privilege->upd($where,$data);
	
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
	
	//及点及改控制器
	
	public function upcon(){
	
		if(IS_AJAX){
	
			$data=array(
	
				'p_controller'=>$this->input->post('con')
	
			);
	
			$where = array(
	
				'id'=>$this->input->post('id')
	
				);
	
			$res=$this->privilege->update($where,$data);
	
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

	//及点及改方法
	public function upway(){
		if(IS_AJAX){
			$data=array(
				
				'p_action'=>$this->input->post('way')
			);
			$where = array(
				'id'=>$this->input->post('id')
				);
			$res=$this->privilege->update($where,$data);
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

	public function dele(){
		$id=$this->input->get('id');
		echo $id;die;
		$show=$this->privilege->seldel("parent_id='$del'");
		if($show){
			//有子分类不能删除
			echo 3;die;
		}else{
			$res=$this->privilege->del("id='$del'");
			if($res){
				echo 1;die;
			}else{
				echo 0;die;
			}
		}

	}


	public function role_pri(){
		if($_POST){
			$data['rid']=$this->input->post("rid");
			$rid=$data['rid'];
			$pid=$this->input->post("check");
			$sel=$this->RP->sel_where("rid='$rid'");
			if($sel){
				$this->RP->del("rid='$rid'");
			}
			$arr=array();
			foreach($pid as $key=>$val){
				$arr[]['pid']=$val['pid'];
			}
			foreach($arr as $k=>$v){
				$data['pid'] = $v['pid'];
				$res = $this->RP->insert($data);
			}
			if($res){
				echo"<script>alert('付权成功');location.href='pri_list'</script>";die();
			}else{
				echo "<script>alert('付权失败');location.href='".$_SERVER['HTTP_REFERER']."'</script>";die();
			}
		}else{

			$role = $this->role->sel();
			
			$privilege = $this->privilege->sel();

			$privilege =  level_auto($privilege);

			$this->load->vars('role',$role);
			
			$this->load->vars('privilege',$privilege);
			
			$this->load->view('admin/privilege/role_pri.html');
		}
	}
}
