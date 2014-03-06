<?php
/*
 * RBAC角色管理
 */
class RoleAction extends AdminAction {

	private $role;

	private $menu;

	public function _init(){
		$this->menu = self::menu();
		$this->assign('menu',$this->menu);
		$this->role = M('role');
	}

	/**
	 * menu
	 */
	public function menu(){
		$menu = array(
			'add' => '添加角色',
			'index' => '角色列表',
		);
		return  $menu;
	}

	/**
	 * 角色列表
	 */
	public function index(){
		$list = $this->role->select();
		$this->assign('list',$list);
		$this->display();
	}

	/**
	 * 添加角色
	 */
	public function add(){
		if(I('post.')){
			if(!I('name'))$this->ajaxReturn(array('message'=>'请填写角色名称'));
			if(!I('remark')) $this->ajaxReturn(array('message'=>'请填写角色别名'));
			if($this->role->add(I('post.'))){
				$this->ajaxReturn(array('success'=>1,'message'=>'添加成功'));
			};
		}else{
			$this->display();
		}
	}

	/**
	 * 修改角色
	 */
	public function edit(){
		I('id') or $this->error('请选择要删除的角色');
		if(I('post.')){
			$this->role->save(I('post.'));
			$this->ajaxReturn(array('success'=>1,'message'=>'修改成功'));
		}else{
			$item = $this->role->find(I('id'));
			$this->menu = array_merge($this->menu,array('edit'=>'修改角色'));
			$this->assign('menu',$this->menu);
			$this->assign('item',$item)->display('add');
		}
	}

	/**
	 * 删除角色
	 */
	public function delete(){
		I('id') or $this->error('请选择要删除的角色');
		$this->role->where(array('id'=>I('id')))->delete();
		$this->redirect('Role/index');
	}



}