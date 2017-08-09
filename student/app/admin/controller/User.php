<?php

//创建一个app\admin\controller命名空间，方便找到controller这个类
namespace app\admin\controller;
//创建一个houdunwang\view\View命名空间，方便找到controller这个类
use houdunwang\view\View;
//创建一个system\model\User命名空间,因为该命名空间里面user这个类跟下面的子类user重复，所有取别名为UserModel
use system\model\User as UserModel;
//子类User继承父类Common
class User extends Common {
	/**
	 * 修改密码
	 */
	public function changePassword(){
		if(IS_POST){
		    //现获取旧密码
			$post = $_POST;
			//1.先比对旧密码是否正确
            //2.用旧密码跟用户输入的密码进行对比
			$user = UserModel::where("uid=" . $_SESSION['user']['uid'])->get();
			//判断用户输入的密码是否匹配旧密码
			if(!password_verify($post['oldPassword'],$user[0]['password'])){
			    //如果不匹配那么就会提示用户旧密码不对
				return $this->error('旧密码错误');
			}
			//1.判断两次密码是否一致
			if($post['newPassword'] != $post['confirmPassword']){
			    //如果不对，旧提示用户两次密码不一致
				return $this->error('两次密码不一致');
			}
			//3.修改
            //把用户新创建的密码进行哈希加密
			$data = ['password'=>password_hash($post['newPassword'],PASSWORD_DEFAULT)];
			//根据where条件找到session里面uid所对应的密码进行修改
			UserModel::where('uid=' . $_SESSION['user']['uid'])->update($data);
			//清除session重新登录
            //1.删除session里面的变量
			session_unset();
			//删除整个session文件
			session_destroy();
            //先提示用户修改成功，然后自动跳转到后台登陆页面
			return $this->setRedirect('?s=admin/login/index')->success('修改成功');

		}
		//加载模板
		return View::make();
	}
}