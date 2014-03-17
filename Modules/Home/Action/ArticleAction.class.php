<?php
/**
 * User: Administrator
 * Time: 14-3-17 上午11:25
 */

class ArticleAction extends HomeAction {

	public function index(){
		$this->display('Article/index');
	}

	public function show(){
		$this->display();
	}
} 