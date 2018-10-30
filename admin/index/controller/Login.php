<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Admin;
use think\captcha\Captcha;

class Login extends Controller{

    public function login(){
        return $this->fetch();
    }

    public function checklogin(){
        $admin = new Admin;
        $data = $admin->where(['name'=>$_POST['name'],'password'=>md5($_POST['password'])])->find();
        $captcha = new Captcha;
        if ($data) {
            if(!$captcha->check($_POST['code'])){
                echo '<script>alert("验证码错误");location.href="'.url('index/login/login').'"</script>';
                // return $this->error('验证码错误！','index/login/login',3);
            }else{
                session('admin',$data);
                return $this->success('输入信息正确，正在跳转后台中。','index/index/index',2);

            }
        }else{
            echo '<script>alert("你输入的信息有误，请重新输入");location.href="'.url('index/login/login').'"</script>';
            // return $this->error('你输入的信息有误，请重新输入','index/login/login',3);
        }

    }

    // public function check_error(){
    //     return $this->error('你没有权限访问',url('index/login/login'),2);
    // }
}
