<?php
namespace app\index\controller;

use app\index\controller\Common;
use app\index\model\Admin;
use app\index\model\AuthGroup;
use app\index\model\AuthRule;
use app\index\model\AuthGroupAccess;


class Users extends Common
{

    //规则列表
    public function admin_role(){
    	$agp = new AuthGroup;
    	$data=$agp->where('status','=',1)->select();
        $this->assign('data',$data);

        return  $this->fetch();
    }

    //权限列表页面
    public function admin_permission(){
        $ale = new AuthRule;
        $data=$ale->where('status','=',1)->select();
        $this->assign('data',$data);

        return  $this->fetch();
    }

    //添加权限页面
    public function admin_permission_add(){

        return $this->fetch();

    }
    //添加权限到数据库

    public function admin_permission_add_data(){
        $data['name']=$_POST['name'];
        $data['title']=$_POST['title'];
        $data['type']=1;
        $data['status']=1;
        $arl = new AuthRule;
        $result=$arl->save($data);
        if($result){

            return  $this->success("成功","admin_permission",2);
       }else{

            return $this->error("失败");

       }

    }

    //管理员列表界面
    public function admin_list(){
        $data = Admin::all();
        $this->assign('data',$data);
        return  $this->fetch();
    }

    //添加管理员界面
    public function admin_add(){
        $agp = new AuthGroup;
        $data = $agp->where("status=1")->select();

        $this->assign('data',$data);
        return  $this->fetch();
    }
    // 添加管理员到数据库
    public function admin_add_user(){
        if($_POST){
            $data['admin_name']=$_POST['admin_name'];
            $data['admin_password']=md5($_POST['admin_password']);

            $admin = new Admin;//用户数据库
            $name = $admin->where("name",$data['admin_name'])->find();


            //重复名字过滤
            if(!$name){
                    $group = new AuthGroupAccess;//分组数据库
                    $admin->name = $data['admin_name'];
                    $admin->password = $data['admin_password'];
                    $res1 = $admin->save();//用户数据库
                    $aid=$admin->getLastInsID();
                    $group->group_id = $_POST['group_id'];
                    $group->uid = $aid;
                    $res2 = $group->save();//分组数据库


                    if($res1 && $res2){

                        return  $this->success("成功","admin_list",2);
                    }else{

                       return $this->error("失败");

                    }
            }else{
                    return $this->error("当前用户名已存在,请使用其他用户名");
            }

        }
    }

    //添加角色页面
    public function admin_role_add(){
        $arol = new AuthRule;
        $data = $arol->where("status=1")->select();
        $this->assign('data',$data);

        return $this->fetch();
    }

    //添加角色到数据库
    public function admin_role_add_user(){
       $agp = new AuthGroup;
       $agp->title = $_POST['roleName'];
       $agp->rules = implode(",", $_POST['check']);
       $agp->status = 1;
       $result=$agp->save();

       if($result){

            return  $this->success("成功","admin_role",2);
       }else{

            return $this->error("失败");

       }
    }



}
