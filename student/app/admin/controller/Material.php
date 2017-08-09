<?php

//创建app\admin\controller命名空间，方便调用这个命名空间来找到controller这个类
namespace app\admin\controller;
//创建houdunwang\core\controller命名空间，方便调用这个命名空间来找到controller这个类
use houdunwang\core\Controller;
//创建houdunwang\view\View命名空间，方便调用这个命名空间来找到View这个类
use houdunwang\view\View;
//创建system\model\Material命名空间，用此命名空间调用重复的Material这类时取一个别名MaterialModel,调用的时候就用它
use system\model\Material as MaterialModel;
//子类Material 继承父类Controller
class Material extends Common {
	/**
	 * 显示素材列表
	 */
	public function lists() {
        //从houdunwang\model\Base里面调用get()方法获取表单里面的所有数据
		$data = MaterialModel::get();
        //1.因为index默认首页里面的编辑按钮有get传参，所有会通过Boot类的run方法调用到这个方法
        //2.View::make()表示执行houdunwang\view\Base里面的make()这个方法会自动的组合模板路径
        //3.View::with()表示执行houdunwang\view\with()这个方法进行分配数据
        //4.最终会在页面中加载编辑留言的页面，并且会显示留言内容
		return View::make()->with(compact('data'));
	}

	/**
	 * 增加素材
	 * @return $this
	 */
	public function store() {
		if ( IS_POST ) {
			//上传，返回上传的信息
			$info = $this->upload();
			//把上传之后的信息保存到数据库
			$data = [
				'path'        => $info['path'],
				'create_time' => time()
			];
			//调用houdunwang\Model\Base里面的方法来回取已经上传到材料表里面的内容
			MaterialModel::save( $data );
            //1.提示用户上传成功并且跳转到首页
            //2.最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
			return $this->setRedirect("?s=admin/material/lists")->success('上传成功');
		}
        //返回到houdunwang\view\Base里面的make()方法
        //进行制作模板制作，组合完整的路劲
		return View::make();
	}

	private function upload() {
		//创建上传目录
		$dir = 'upload/' . date( 'ymd' );
		is_dir( $dir ) || mkdir( $dir, 0777, true );
		//设置上传目录
		$storage = new \Upload\Storage\FileSystem( $dir );
		$file    = new \Upload\File( 'upload', $storage );
		//设置上传文件名字唯一
		// Optionally you can rename the file on upload
		$new_filename = uniqid();
		$file->setName( $new_filename );

		//设置上传类型和大小
		// Validate file upload
		// MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
		$file->addValidations( array(
			// Ensure file is of type "image/png"
            // //表示可以添加以下几种类型的图片文件'image/png', 'image/gif'
			new \Upload\Validation\Mimetype( [ 'image/png', 'image/gif', 'image/jpeg' ] ),

			//You can also add multi mimetype validation

			//new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

			// Ensure file is no larger than 5M (use "B", "K", M", or "G")
            //限制上传文件大小不能超过2MB
			new \Upload\Validation\Size( '2M' )
		) );

		//组合数组
		// Access data about the file that has been uploaded
		$data = array(
			'name'       => $file->getNameWithExtension(),
			'extension'  => $file->getExtension(),
			'mime'       => $file->getMimetype(),
			'size'       => $file->getSize(),
			'md5'        => $file->getMd5(),
			'dimensions' => $file->getDimensions(),
			//自动组合的上传之后的完整路径
			'path'       => $dir . '/' . $file->getNameWithExtension(),
		);


		//试图上传文件
		try {
			//如果文件上传成功
			$file->upload();
            //返回当前上传的内容
			return $data;
		} catch ( \Exception $e ) {
			// 如果没有上传成功，就捕获没有成功的错误
			$errors = $file->getErrors();
            //捕获异常错误 $e 是异常对象
			foreach ( $errors as $e ) {
                //把新的异常错误显示出来
				throw new \Exception( $e );
			}

		}
	}

	/**
	 * 删除
	 */
	public function remove(){
        //获得材料表里面的主键mid
        $mid = $_GET['mid'];
        //条用houdunwang\model\Base里面的find()方法获取材料表里面要删除内容所对应的主键
        $data = MaterialModel::find($mid);
        //检测该路劲是否是文件
        //如果是就保留，不是就删除
        is_file($data['path']) && unlink($data['path']);
        //删除数据库信息
        //用where条件从数据库里面删除主键对应的内容
        MaterialModel::where("mid={$mid}")->destory();

        //1.提示用户上传成功并且跳转到首页
        //2.最终会被返回到Boot类的run方法里，并且echo输出出来，会自动执行__toString这个方法，会加载提示用户操作成功的模板
        return $this->setRedirect("?s=admin/material/lists")->success('删除成功');
    }
}








