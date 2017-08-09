<?php
//创建一个app\admin\controller命名空间，方便找到controller这个类
namespace app\admin\controller;
//创建一个app\core\controller命名空间，方便找到controller这个类
use houdunwang\core\Controller;
//创建一个houdunwang\view\View命名空间，方便找到View这个类
use houdunwang\view\View;
//创建一个Gregwar\Captcha\CaptchaBuilder命名空间，方便找到CaptchaBuilder这个类
use Gregwar\Captcha\CaptchaBuilder;
//创建一个Gregwar\Captcha\PhraseBuilder命名空间，方便找到PhraseBuilder这个类
use Gregwar\Captcha\PhraseBuilder;
//创建一个system\model\User命名空间，方便找到User这个类
use system\model\User;

class Login extends Controller {
	/**
	 * 登陆页面
	 */
	public function index(){
		//预先存入数据库用户名和密码
        //$password = password_hash('admin888',PASSWORD_DEFAULT);
        //echo $password;
		if(IS_POST){
			$post = $_POST;
			//验证码错误
            //判断用户输入的验证码是否匹配session文件里面预存的验证码
			if(strtolower($post['captcha']) != $_SESSION['captcha']){
			    //如果不匹配那么就会返回验证码错误提示
				return $this->error('验证码错误');
			}
			//判断用户名已存在
            //判断用户输入的用户名是否匹配session文件里面预存的用户名
			$data = User::where("username='{$post['username']}'")->get();
			if(!$data){
			    //返回用户名不存在的提示
				return $this->error('用户名不存在');
			}
			//密码错误
			//p($data);
            //第一个为哈希密码，第二个为要输入的密码，第三个为要验证的密码
			if(!password_verify($post['password'],$data[0]['password'])){
			    //如果密码验证错误，则返回密码错误我页面提示用户
				return $this->error('密码错误');
			}
            /**
             * 7天免登陆
             */
            //如果勾选了7天免登陆
            if(isset($post['auto'])){
                //创建一个cookie文件，储存session_name(),session_id(),和时间戳为7天
                //勾选了7天免登陆就可以让会话期间延长为7天，在这7天内session_id一直存在cookie里面
                //根据cookie里面的session_id可以在这7天内匹配到服务器里面的session_id并找到对应的session文件
                setcookie(session_name(),session_id(),time() + 7 * 24 * 3600,'/');
            }else{
                //删除7天免登陆
                //就相当于把7天的时间戳转为0
                setcookie(session_name(),session_id(),0,'/');
            }
            //把uid和username存session
            $_SESSION['user'] = [
                'uid'      => $data[0]['uid'],
                'username' => $data[0]['username'],
            ];
            //跳转页面
            //当用户登陆成功先提示登陆成功，然后自动跳到后台首页
			return $this->setRedirect('?s=admin/entry/index')->success('登陆成功');
		}
        //自动加载模板
		return View::make();
	}

	/**
	 * 验证码
	 */
	public function captcha(){
	    //先让密码加密，限制验证码为3个
		$str = substr(md5(microtime(true)),0,3);
		$captcha = new CaptchaBuilder($str);
		$captcha->build();
		header('Content-type: image/jpeg');
		$captcha->output();
		//把验证码存入到session
		//把值存入到session
		$_SESSION['captcha'] = strtolower($captcha->getPhrase());
	}
    /**
     * 退出
     */
    public function out(){
        //删除session的变量
        session_unset();
        //删除整个session文件
        session_destroy();
        //先显示退出成功然后自动跳转到后台登陆页面
        return $this->setRedirect('?s=admin/login/index')->success('退出成功');
    }
}