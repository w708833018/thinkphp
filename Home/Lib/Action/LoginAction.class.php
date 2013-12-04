<?php

class LoginAction extends Action {


		function __construct(){
			parent::__construct();
			$this->do       = M('Member');
			$this->post    = $_POST['post'] ;
			$this->head_title    = '登录' ;
			$this->userid = $_GET['userid'];
			$this->assign('head_title',$this->head_title);
		}


         public function index(){
			$this->display();
         }
		public function pass(){
			if($_SESSION['code'] != md5($this->post['code']))$this->error('验证码错误！');
			if(!$this->do->where("username ='".$this->post['username']."'")->count())$this->error('用户名错误！');
			if(!$this->do->where("password ='".$this->post['password']."'")->count())$this->error('密码错误！');
			//$this->success('登录成功','Index/index');
			$this->redirect('Index/index','',3,'登录成功，页面跳转中......');
		}

}