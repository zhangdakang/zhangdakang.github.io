<?php
namespace app\index\controller;
use think\Controller;
use think\Auth;
use think\Request;

class Common extends Controller{


    // //当任何函数加载时候，会调用此函数
    // public function _initialize(){
    //     $uid = session('admin')['id'];
    //     if(empty($uid)){
    //         // echo '<script>alert("你还没有登陆，请登录后再试。");location.href="'.url('index/login/login').'"</script>';
    //         return $this->error('你还没有登陆，请登录后再试。','index/login/login',2);
    //     }


    //     $request = Request::instance();
    //     $auth = new Auth;


    //     $group = $auth->getGroups($uid);
    //     //echo $group[0]['group_id'];

    //     $auth_group = db('auth_group')->where('id',1)->select();
    //     $rules = array();
    //     $rules = $auth_group[0]['rules'];
    //     $auth_id=explode(',',$rules);//字符串变为数组

    //     $auth = db('auth_rule')->where('id','in',$auth_id)->select();
    //     var_dump($auth);
    //     foreach ($auth as $arr) {
    //             var_dump($arr);
    //         }
    //     $this->assign('auth',$auth);
    //     return $this->fetch("index/index");
    //     var_dump($auth);


    //     $m = $request->module();
    //     $c = strtolower($request->controller());
    //     $a = $request->action();
    //     $url = $m.'/'.$c.'/'.$a;

    //     //已经登陆的状态下
    //     //如果控制器不是等于主页控制器，判断用户是否有权限操作
    //     if($c!='index'){
    //         if(!$auth->check($url,$uid)){
    //             //echo '<script>location.href="'.url('index/login/check_error').'"</script>';
    //             return $this->error('你没有权限访问','index/index/welcome',2);

    //         }
    //     }
    // }
}
