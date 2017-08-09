<?php

//1.命名空间
//2.调动这个命名空间里面的类利用命名空间可以很快的找到这个类
namespace app\home\controller;
//调用houdunwang\core\Controller这个命名空间可以方便找到Controller这个类
use app\admin\controller\Common;
use houdunwang\core\Controller;
//调用houdunwang\view\View这个命名空间可以方便找到View这个类
use houdunwang\view\View;
//调用houdunwang\model\Model这个命名空间可以方便找到Model这个类
use houdunwang\model\Model;

//子集Entry继承Controller父集
class Entry extends Controller {
    /**
     * 前台首页
     */
    //创建一个index方法
	public function index() {
	    //用q方法进行班级表和学生表的匹配
        $data = Model::q("SELECT * FROM stu s JOIN grade g ON s.gid=g.gid");
        //1.因为index默认首页里面的编辑按钮有get传参，所有会通过Boot类的run方法调用到这个方法
        //2.View::make()表示执行houdunwang\view\Base里面的make()这个方法会自动的组合模板路径
        //3.View::with()表示执行houdunwang\view\with()这个方法进行分配数据
        //4.最终会在页面中加载编辑留言的页面，并且会显示留言内容
        return View::make()->with(compact('data'));

	}
    public function show(){
        //用q方法进行班级表和学生表的匹配
        $data = Model::q("SELECT * FROM stu s JOIN grade g ON s.gid=g.gid where sid={$_GET['sid']}");
	    //加载模板
        return View::make()->with(compact('data'));
    }


}