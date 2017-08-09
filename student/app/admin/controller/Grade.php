<?php

//创建app\admin\controller命名空间，方便调用这个命名空间来找到controller这个类
namespace app\admin\controller;
//创建houdunwang\core\controller命名空间，方便调用这个命名空间来找到controller这个类
use houdunwang\core\Controller;
//创建houdunwang\view\View;命名空间，方便调用这个命名空间来找到View这个类
use houdunwang\view\View;
//创建system\model\Grade命名空间，用此命名空间调用重复的Grade这类时取一个别名GradeModel,调用的时候就用它
use system\model\Grade as GradeModel;
//子类Grade 继承父类Common
//子类Grade班级管理属于后台页面，因此要受到父类Common全局控制，要访问该页面必须先登录
class Grade extends Common {
	/**
	 * 班级列表
	 */
	public function lists(){
	    //从houdunwang\model\Base里面调用get()方法获取表单里面的所有数据
		$data = GradeModel::get();
        //1.因为index默认首页里面的编辑按钮有get传参，所有会通过Boot类的run方法调用到这个方法
        //2.View::make()这个方法会自动的组合模板路径
        //3.View::with()能把数据带出来
        //4.最终会在页面中加载编辑留言的页面，并且会显示留言内容
		return View::make()->with(compact('data'));
	}

	/**
	 * 添加
	 */
	public function store(){
	    //判断用户是否点击提交按钮
		if(IS_POST){
		    //用save方法获取用户提交过来的内容
			GradeModel::save($_POST);
            //1.提示用户修改成功并且跳转到首页
            //2.最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
			return $this->setRedirect('?s=admin/grade/lists')->success('添加成功');
		}
		//返回到houdunwang\view\Base里面的make()方法
        //加载模板
		return View::make();
	}
	/**
	 * 编辑
	 */
	public function update(){
        //把从文章表获取的aid用设置的变量$aid储存起来
		$gid = $_GET['gid'];
        //检测用户是否点击了提交按钮
		if(IS_POST){
            //获取班级表grade里面的gid，然后根据where条件来修改gid对应的内容
			GradeModel::where("gid={$gid}")->update($_POST);
            //1.提示用户修改成功并且跳转到首页
            //2.最终会被返回到Boot类的run方法里，并且echo输出出来，自动执行__toString这个方法，加载提示用户操作成功的模板
			return $this->setRedirect('?s=admin/grade/lists')->success('修改成功');

		}
		//用find()方法获取班级表里面的主键gid
		$oldData = GradeModel::find($gid);
        //1.因为index默认首页里面的编辑按钮有get传参，所有会通过Boot类的run方法调用到这个方法
        //2.View::make()这个方法会自动的组合模板路径
        //3.View::with()能把数据带出来
        //4.最终会在页面中加载编辑留言的页面，并且会显示留言内容
		return View::make()->with(compact('oldData'));
	}
	/**
	 * 删除
	 */
	public function remove(){
        //获取班级表grade里面的gid，然后根据where条件来修改gid对应的内容并删除
		GradeModel::where("gid={$_GET['gid']}")->destory();
        //1.提示用户修改成功并且跳转到首页
        //2.最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
		return $this->setRedirect('?s=admin/grade/lists')->success('删除成功');
	}
}