<?php

class LoginAction extends BaseAction {

	public  function index(){
		$this->display();
	}

	public  function login(){
		if(!I('post.')) _404('此页面不存在');
		$user=M('user')->getByUsername(I('username'));
		if( !$user['username'] || $user['password'] !== md5(I('password'))){
				$this->error('用户名或密码错误');
		}
		$data=array(
			'userid'  =>$user['userid'],
			'logintime'=>time(),
			'loginip'  =>get_client_ip()
		);
		M('user')->save($data);
		$user=M('user')->getByUsername($user['username']);
		session('userid',$user['userid']);
		session('username',$user['username']);
		session('logintime',$user['logintime']);
		session('loginip',$user['loginip']);
		$this->redirect('Index/index');

	}

	public  function  logout(){
		session_unset();
		session_destroy();
		$this->redirect('Login/index');
	}

}