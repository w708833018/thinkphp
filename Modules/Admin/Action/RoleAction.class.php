<?php
/*
 * RBAC角色管理
 */
class RoleAction extends BaseAction {

	private $role;

	public function _init(){
		$this->role = M('role');
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
				$this->ajaxReturn(array('message'=>'添加成功'));
			};
		}else{
			$this->display();
		}
	}


}