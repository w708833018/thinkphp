<?php
/**
 * User: Administrator
 * Time: 14-3-17 上午11:25
 */

class ArticleAction extends HomeAction {

	public function index(){
		$where = I('catid') ? array('catid'=>I('catid')) : '';
		$this->list = M('article')->field('title,addtime,introduce')->order('edittime desc')->where($where)->select();
		$this->display('Article/index');
	}

	public function show(){
		$this->display();
	}
} 