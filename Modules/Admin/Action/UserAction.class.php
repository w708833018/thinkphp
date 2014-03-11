<?php
/*
 * RBAC用户管理
 */
class UserAction extends AdminAction {


	public function _init(){
		parent::_init();
		$this->menu = self::menu();
	}

	/**
	 * menu
	 */
	public function menu(){
		$menu = array(
			'add' => '添加用户',
			'index' => '用户列表',
		);
		return  $menu;
	}

	/**
	 * 用户列表
	 */
	public function index(){
		$this->list = D('UserRelation')->field('password',true)->relation(true)->select();
		$this->display();
	}

	/**
	 * 添加用户
	 */
	public function add(){
		if(I('post.')){
			$user = array(
				'username' => I('username'),
				'password' => md5(I('password')),
				'logintime'=> time(),
				'loginip' => get_client_ip()
			);
			if($userid = M('user')->add($user)){
				$role = array(
					'role_id' => I('role_id'),
					'user_id' => $userid,
				);
				M('role_user')->add($role);
			};
			$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U('User/index')));
		}else{
			$this->role = M('role')->select();
			$this->display();
		}
	}

	/**
	 * 修改用户
	 */
	public function edit(){
		I('id') or $this->error('请选择要修改的用户');
		if(I('post.')){
			M('role_user')->where(array('user_id' => I('id')))->delete();
			M('role_user')->add(array('role_id' => I('role_id'),'user_id' => I('id')));
			$this->ajaxReturn(array('success'=>1,'message'=>'修改成功','referer'=>U('User/index')));
		}else{
			$this->role_id = M('role_user')->where(array('user_id'=>I('id')))->getField('role_id');
			$this->role    = M('role')->select();
			$this->userid  = I('id');
			$this->menu = array_merge($this->menu,array('edit'=>'修改用户'));
			$this->display('add');
		}
	}

	/**
	 * 删除用户
	 */
	public function delete(){
		I('id') or $this->error('请选择要删除的用户');
		M('user')->where(array('userid'=>I('id')))->delete();
		M('role_user')->where(array('user_id' => I('id')))->delete();
		$this->redirect('User/index');
	}


}