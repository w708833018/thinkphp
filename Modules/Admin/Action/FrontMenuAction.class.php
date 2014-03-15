<?php
/**
 * User: Administrator
 * Time: 14-3-14 下午4:19
 */

class FrontMenuAction extends  AdminAction {


	public function _init(){
		parent::_init();
		$this->menu = self::menu();
	}

	/**
	 * 菜单列表
	 */
	public function index(){
		$this->list = M('menu')->where(array('cate'=>1))->select();
		$this->display();
	}

	/**
	 * menu
	 */
	public function menu(){
		$menu = array(
			'add' => '添加菜单',
			'index' => '菜单列表',
		);
		return  $menu;
	}

	/**
	 * 添加菜单
	 */
	public function add(){
		if(I('post.')){
			$data = I('post.');
			$data['cate'] = 1;
			if($id = M('menu')->add($data)){
				M('menu')->where(array('id'=>$id))->setField('sort',$id);
				$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U('FrontMenu/index')));
			};
		}else{
			$list = M('menu')->field('id,name,parent_id')->where(array('cate'=>1))->select();
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id >\$spacer\$name</option>";
			$this->list = $tree->get_tree(0,$str);
			$this->display();
		}

	}

	/**
	 * 删除菜单
	 */
	public function delete(){
		I('id') or $this->error('请选择菜单');
		M('menu')->where(array('id|parent_id'=>I('id')))->delete();
		$this->redirect('index');
	}

} 