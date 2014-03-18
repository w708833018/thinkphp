<?php
/**
 * User: Administrator
 * Time: 14-1-14 下午2:14
 */

class BaseAction  extends  Action{
	/**
	 * 初始化
	 */
	Public function  _initialize(){
		$set = M('setting')->where(array('item'=>'1'))->select();
		foreach($set as $k=>$v){
			$setting[$v['item_key']] = $v['item_value'];
		}
		$this->assign('site',$setting);
		$this->pre = C('DB_PREFIX');
		if(method_exists($this,'_init'))
			$this->_init();
	}

	/**
	 * 验证码
	 */
	public function code(){
		import('ORG.Util.Image');
		var_dump(Image::buildImageVerify(4,1,'png',48,22,'code'));
	}


	/**
	 * 图片上传
	 */
	public function imgUpload(){
		import('ORG.Net.UploadFile');
		$config =   array(
			'allowExts'         =>  array('jpg','jpeg','gif','png'),    // 允许上传的文件后缀 留空不作后缀检查
			'autoSub'           =>  true,// 启用子目录保存文件
			'subType'           =>  'custom',// 子目录创建方式 可以使用hash date custom
			'subDir'            =>  'images/'.$_GET['cate_name'].'/'.date('Ymd',time()).'/', // 子目录名称 subType为custom方式后有效
			'savePath'          =>   C('UPLOAD_FILE'),// 上传文件保存路径
		);
		$do = new UploadFile($config);
		if($do->upload()){
			$info = $do->getUploadFileInfo();
			$this->ajaxReturn(array(
				'url'       =>$info[0]['savename'],    //保存后的文件路径
				'title'     =>htmlspecialchars($_POST['pictitle'], ENT_QUOTES), //文件描述，对图片来说在前端会添加到title属性上
				'original'  =>$info[0]['name'],        //原始文件名
				'state'     =>'SUCCESS',               //上传状态，成功时返回SUCCESS,其他任何值将原样返回至图片上传框中
			));
		}else{
			$this->ajaxReturn(array(
				'state'     =>$do->getErrorMsg(),
			));
		}

	}


}