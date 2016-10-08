<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends MY_Controller

{
    //继承父类

    public function __construct()

    {

        parent::__construct();

        $this->load->model('Admin_model','admin');

    }

    /*
     * 管理员添加界面
    */


    public  function  manage_index(){

        if ($_POST) {

            $data = $this->input->post();

            $data['pwd'] =md5($data['pwd']);

            $res = $this->db->insert('admin',$data);

            if ($res) {

                $this->success("添加成功",site_url('Manage/manage_list'));

            }else{

                $this->success("添加失败",site_url('Manage/manage_index'));

            }

        }else{

            $this->load->view('admin/Manage/manage_index.html');

        }

    }

    /*
     * 管理员列表
     */


    public  function  manage_list($offset=""){
        //加载分页类
        $this->load->library('pagination');
        //请求的URL地址
        $config['base_url']=site_url('product/index');
        //查询出所有的条数
        $config['total_rows']=$this->db->count_all('product_goods');
        //设置每页显示的条数
        $config['per_page']=4;
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
        if($offset==""){
            $offset1 = 0;
        }else{
            $offset1 = ($offset-1)*$config['per_page'];
        }
        //生成分页字符串
        $data['pagestr']=$this->pagination->create_links();
        $limit=$config['per_page'];

        $data['data'] = $this -> db ->limit($limit,$offset1) ->get('admin')->result_array();
        $manage_list = $this->admin->sel();

        $this->load->vars('manage',$manage_list);

        $this->load->view('admin/Manage/manage_list.html');

    }

    /*
  * 管理员删除
  */

    public function dele(){

        if(IS_AJAX){

            $del = $this->input->post('del');

            $res = $this->admin->del("aid=$del");

            if($res){

                echo 1;die;

            }else{

                echo 0;die;

            }

        }else{

            echo "<script>alert('非法操作');location.href='".$_SERVER['HTTP_REFERER']."'</script>";die();

        }


    }

    //极点技改用户名

    public function updata(){

        if(IS_AJAX){

            $name=$this->input->post('pname');

            $nameall=$this->admin->selname();

            $arr=array();

            foreach($nameall as $k=>$v){

                $arr[]=$v['adminname'];

            }

            foreach($arr as $k=>$v){

                if("$name"=="$v"){

                    echo 3;

                    die;

                }

            }

            $data=array(

                'adminname'=>$name

            );

            $where = 'aid='.$this->input->post('id');

            $res=$this->admin->upd($where,$data);

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

}
