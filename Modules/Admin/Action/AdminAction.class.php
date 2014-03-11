<?php
/**
 * User: Administrator
 * Time: 14-1-14 下午2:25
 */

class AdminAction extends  BaseAction{

	public  function  _init(){
		$user = M('user')->getByUserid(session('userid'));
		if(!$user) $this->redirect('Login/index');
		import('ORG.Util.RBAC');
		RBAC::AccessDecision(GROUP_NAME) or $this->error('没有权限');
		$this->assign('user',$user);
	}

} 