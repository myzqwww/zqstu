<?php

//创建app\admin\controller命名空间，方便调用这个命名空间来找到controller这个类
namespace app\admin\controller;

//创建houdunwang\core\controller命名空间，方便调用这个命名空间来找到controller这个类
use houdunwang\core\Controller;
//创建houdunwang\model\Model命名空间，方便调用这个命名空间来找到Model这个类
use houdunwang\model\Model;
//创建houdunwang\view\View命名空间，方便调用这个命名空间来找到View这个类
use houdunwang\view\View;
//创建system\model\Grade命名空间，方便调用这个命名空间来找到Grade这个类
use system\model\Grade;
//创建system\model\Material命名空间，方便调用这个命名空间来找到Material这个类
use system\model\Material;
//创建system\model\Stu命名空间，方便调用这个命名空间来找到Stu这个类
use system\model\Stu;
//子类Student 继承父类Controller
class Student extends Common {
	/**
	 * 显示学生
	 */
	public function lists(){
	    //班级表跟学生表进行关联
		//因为要显示班级信息
		$data = Model::q("SELECT * FROM stu s JOIN grade g ON s.gid=g.gid");
        //打印班级表跟学生表gid关联所对应的信息
		//p($data);
        //1.因为index默认首页里面的编辑按钮有get传参，所有会通过Boot类的run方法调用到这个方法
        //2.View::make()表示执行houdunwang\view\Base里面的make()这个方法会自动的组合模板路径
        //3.View::with()表示执行houdunwang\view\with()这个方法进行分配数据
        //4.最终会在页面中加载编辑留言的页面，并且会显示留言内容
		return View::make()->with(compact('data'));
	}

	/**
	 * 添加学生
	 * @return $this
	 */
	public function store(){
		if(IS_POST){
		    //打印从学生列表获得的所有数据
		    //p($_POST);exit;
			//处理爱好，因为爱好提交过来是一个数组无法直接插入到数据库，把数组变为字符串
			if(isset($_POST['hobby'])){
			    //把获取到的爱好数组转为字符串
				$_POST['hobby'] = implode(',',$_POST['hobby']);
			}
			Stu::save($_POST);
            //p($_POST);
            //1.提示用户修改成功并且跳转到首页
            //2.最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
			return $this->setRedirect('?s=admin/student/lists')->success('保存成功');
		}
		//获得班级信息
		$gradeData = Grade::get();
		//头像信息
		$materialData = Material::get();
        //1.因为index默认首页里面的编辑按钮有get传参，所有会通过Boot类的run方法调用到这个方法
        //2.View::make()这个方法会自动的组合模板路径
        //3.View::with()能把数据带出来
        //4.最终会在页面中加载编辑留言的页面，并且会显示留言内容
		return View::make()->with(compact('gradeData','materialData'));
	}

	/**
	 * 修改
	 */
	public function update(){
	    //获取学生表里面的主键sid
		$sid = $_GET['sid'];
        //判断用户提交过来的信息
		if(IS_POST){
		    //用户点击修改按钮以后提交过来的爱好这条数据转为字符串
            $_POST['hobby'] = implode(',',$_POST['hobby']);
            //获取学生表Stu里面的sid，然后根据where条件来修改sid对应的内容
            Stu::where("sid={$_GET['sid']}")->update($_POST);
            //1.提示用户修改成功并且跳转到首页
            //2.最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
            return $this->setRedirect('?s=admin/grade/lists')->success('修改成功');

        }

		//用find()方法获取学生列表里面的旧数据
		$oldData = Stu::find($sid);
		//将用find()方法获取学生列表里面的旧数据转为数组
        $oldData['hobby'] =explode(',',$oldData['hobby']);
        //p($oldData);
		//获得班级信息
		$gradeData = Grade::get();
		//头像信息
		$materialData = Material::get();

        //1.因为index默认首页里面的编辑按钮有get传参，所有会通过Boot类的run方法调用到这个方法
        //2.View::make()这个方法会自动的组合模板路径
        //3.View::with()能把数据带出来
        //4.最终会在页面中加载编辑留言的页面，并且会显示留言内容
		return View::make()->with(compact('oldData','gradeData','materialData'));

	}


	/**
	 * 删除
	 */
	public function remove(){
            //获取班级表grade里面的gid，然后根据where条件来修改gid对应的内容并删除
            Stu::where("sid={$_GET['sid']}")->destory();
            //1.提示用户修改成功并且跳转到首页
            //2.最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
            return $this->setRedirect('?s=admin/grade/lists')->success('删除成功');

    }
}