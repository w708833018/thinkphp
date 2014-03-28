<?php
/**
 * User: Administrator
 * Time: 14-3-17 上午11:25
 */

class ArticleAction extends HomeAction {

	public function index(){
		$where = I('catid') ? array('catid'=>I('catid')) : '';
		$this->list = M('article')->field('id,title,addtime,introduce')->order('edittime desc')->where($where)->select();
		$this->display('Article/index');
	}

	public function show(){
		I('id') or _404('页面不存在！');
		$this->item = M('article')->find(I('id'));
		$this->display();
	}
} 