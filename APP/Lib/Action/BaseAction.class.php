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


}