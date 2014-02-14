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
		if(method_exists($this,'_init'))
			$this->_init();
	}

} 