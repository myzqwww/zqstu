<?php

//创建app\admin\controller命名空间，方便条用这个命名空间来找到controller这个类
namespace app\admin\controller;
//创建houdunwang\core\controller命名空间，方便条用这个命名空间来找到controller这个类
use houdunwang\core\Controller;
//创建houdunwang\view\View这个命名空间，方便条用这个命名空间来找到View这个类
use houdunwang\view\View;

//子类Entry这个类继承父类Controller
class Entry extends Common {
    /**
     * 后台默认页面
     * @return mixed
     */
    //创建一个方法index()
	public function index() {
	    //返回到houdunwang\view\Base里面的make()方法进行模板制作
		return View::make();

	}



}