<?php

//命名空间
//创建一个app\admin\controller空间方便找到controller

namespace app\admin\controller;

//创建一个houdunwang\core\controller空间方便找到controller
use houdunwang\core\Controller;

/**
 * 全局控制器
 * 控制那些需要登录后台的页面，必须登录才能进入后台
 * Class Common
 * @package app\admin\controller
 */
//让Common这个类继承父类Contorller
//方便全局控制所有要进后台的页面需要登录
class Common extends Controller {
    //自动执行的方法__construct()
	public function __construct() {
		//如果没有登陆
        //就是session文件里面没有预存用户名，那么就提示用户去前台首页进行登录
		if(!isset($_SESSION['user'])){
		    //自动跳转到后台登陆页面
			go('?s=admin/login/index');
		}
	}
}