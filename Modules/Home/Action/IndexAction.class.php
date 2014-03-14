<?php

class IndexAction extends HomeAction {


	function _init(){
		parent::_init();
	}

	public function index(){
		$do = M('Member');//实例化模型的简单方式
		$arr = $do->select();
		$this->assign('arr',$arr);
		$this->display();
	}

}