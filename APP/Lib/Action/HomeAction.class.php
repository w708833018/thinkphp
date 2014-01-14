<?php
/**
 * User: Administrator
 * Time: 14-1-14 下午2:25
 */

class HomeAction extends  BaseAction{

	public function code(){
		import('ORG.Util.Image');
		var_dump(Image::buildImageVerify(4,1,'png',48,22,'code'));
	}

} 