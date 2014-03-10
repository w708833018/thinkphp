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
			$this->role->add(I('post.'));
			$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U('Role/index')));
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
			$this->ajaxReturn(array('success'=>1,'message'=>'修改成功','referer'=>U('Role/index')));
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

	/**
	 * 配置权限
	 */
	public function  access(){
		I('id') or $this->error('请选择要配置的角色');
		if(I('post.')){
			$rid = I('id',0,'intval');
			M('access')->where(array('role_id'=>$rid))->delete();
			$data = array();
			foreach($_POST['access'] as $v){
				$tmp = explode('_',$v);
				$data[] = array(
					'role_id' => $rid,
					'node_id' => $tmp[0],
					'level_id'=> $tmp[1]
                );
			}
			M('access')->addAll($data);
			$this->ajaxReturn(array('success'=>1,'message'=>'配置成功','referer'=>U('Role/index')));
		}else{
			$nodeList = M('node')->field('title,id,pid,level')->select();
			$this->nodeList = node_merge($nodeList);
			$this->role_id = I('id');
			$this->$nodeIds = M('access')->where(array('role_id'=>I('id')))->getField('node_id',true);
 			$this->menu = array_merge($this->menu,array('access'=>'配置权限'));
			$this->assign('menu',$this->menu);
			$this->display();
		}
	}


}