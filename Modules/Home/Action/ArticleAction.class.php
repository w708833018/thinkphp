<?php
/**
 * User: Administrator
 * Time: 14-3-17 上午11:25
 */
class ArticleAction extends HomeAction {

	public function index(){
		$where = array('status'=>3);
		if (I('catid')) $where = array_merge($where,array('catid'=>I('catid')));
		import('ORG.Util.Page');// 导入分页类
		$count      = M('article')->where($where)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数
		$this->page      = $Page->show();// 分页显示输出
		$this->list = M('article')->field('id,title,addtime,introduce')->order('edittime desc')->
			limit($Page->firstRow.','.$Page->listRows)->where($where)->select();
		$this->display('Article/index');
	}

	public function show(){
		I('id') or _404('页面不存在！');
		$this->item = M('article')->find(I('id'));
		$this->display();
	}
	public function content(){
		$this->content = M('article')->where(array('id'=>I('id')))->getField('content');
		$this->display();
	}
} 