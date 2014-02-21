<?php
/**
 * User: Administrator
 * Time: 14-1-14 下午2:25
 */

class AdminAction extends  BaseAction{

	public  function  _init(){
		$user = M('user')->getByUserid(session('userid'));
		if(!$user) $this->redirect('Login/index');
		$this->assign('user',$user);
	}


} 