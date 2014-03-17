<?php
/**
 * User: Administrator
 * Time: 14-3-17 上午11:25
 */

class ArticleAction extends AdminAction {

	public function _init(){
		parent::_init();
		$this->menu = self::menu();
	}

	/**
	 * menu
	 */
	public function menu(){
		$menu = array(
			'add' => '添加文章',
			'index' => '文章列表',
		);
		return  $menu;
	}

	public function index(){

		$this->display();
	}

	public function add(){
		if(I('post.')){
			$data = I('post.');
			$levPid = explode('_',$data['levPid']);
			$data['level'] = $levPid[0]+1;
			$data['pid']   = $levPid[1];
			M('node')->add($data);
			$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U('Node/index')));
		}else{

			$this->display();
		}

	}

	public function edit(){
		if(I('post.')){
			$data = I('post.');
			$levPid = explode('_',$data['levPid']);
			$data['level'] = $levPid[0]+1;
			$data['pid']   = $levPid[1];
			M('node')->save($data);
			$this->ajaxReturn(array('success'=>1,'message'=>'修改成功','referer'=>U('Node/index')));
		}else{
			$nodeList = M('node')->where('level <= 2')->field('title,id,pid,level')->select();
			$this->nodeList = node_merge($nodeList);
			$this->item = M('node')->find(I('id'));
			$this->menu = array_merge($this->menu,array('edit'=>'修改节点'));
			$this->display('add');
		}

	}

	public function delete(){
		I('id') or $this->error('请选择节点');
		M('node')->where(array('id|pid'=>I('id')))->delete();
		$this->redirect('index');
	}


}