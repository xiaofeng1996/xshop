<?php 

function level_auto($arr,$parent_id=0,$level=0){

        $data=array();

        foreach($arr as $key=>$val){

            if($val['parent_id']==$parent_id){

                $val['level']=$level;

                $val['html']=str_repeat("---",$level);

                $data[]=$val;

                $data=array_merge($data,level_auto($arr,$val['id'],$level+1));

            }

        }

        return $data;
    }

 ?>