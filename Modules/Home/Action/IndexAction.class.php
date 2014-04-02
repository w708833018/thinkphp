<?php

class IndexAction extends HomeAction {


	function _init(){
		parent::_init();
	}

	public function index(){
		A('Article')->index();
	}

}