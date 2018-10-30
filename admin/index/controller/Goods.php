<?php
namespace app\index\controller;

use app\index\controller\Common;
use app\index\model\GoodsType;

class Goods extends Common
{


    public function product_category(){



        return  $this->fetch();
    }


    //获取分类数据
    public function product_category_ajax(){
            $m = new GoodsType;
            $data=$m->field('id,pid,name')->select();
            echo  json_encode($data);

    }

    //删除分类信息
    public function product_category_del(){
        $id=$_GET['id'];
        $m = new GoodsType;
        $data=$m->where("pid=".$id)->find();

        if($data){
            $str="分类下面还有子分类,不允许删除";
            echo json_encode($str);
        }else{
            $re=$m->delete($id);
            if($re){
                echo 1;
            }
        }
    }


    public function product_category_add(){
        $gtp = new GoodsType;
        //concat(a,b,c)把两a,c个字符串通过某个符号(b)连接起来
        //str_repeat（a,b)把字符a循环b次生成新的字符串
        //
       	$data = $gtp->field("*,concat(path,',',id) as paths")->order('paths')->select();
        foreach ($data as $k => $v) {
            $data[$k]['name'] = str_repeat("|-----",$v['level']).$v['name'];
        }
    	$this->assign('data',$data);
    	return  $this->fetch();
    }

    //添加分类信息到数据库
    public function goods_type_add(){
        $data['name']=$_POST['name'];
        $data['pid']=$_POST['pid'];
        if($data['name']!=""){
            $good = new GoodsType;
            //根据pid查找指定单个path
            $path =$good->field('path')->find($data['pid']);
            //substr_count(a,b)返回字符串a中b出现的次数
            $level = substr_count($path,",");
            //$level = $good->field('level')->find($data['pid']);
            $data['level'] = $level+1;

            $good->name = $data['name'];
            $good->pid = $data['pid'];
            $good->level = $data['level'];
            $res1 = $good->save();

            $gid = $good->getLastInsID();
            $path = $path['path'].','.$gid;
            $good->path = $path;
            $res2 = $good->save();
            if($res1 && $res2){
                return '新增成功！';
            }else{
                return '新增失败！';
            }
        }else{
            return '请完善输入信息！';
        }

    }
}