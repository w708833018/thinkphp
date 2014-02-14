<?php

class IndexAction extends HomeAction {

	private  $head_title;

	private  $post;

	private  $userid;

	private  $do;

	function __construct(){
		parent::__construct();
		$this->do       = M('Member');
		$this->post    = $_POST['post'] ;
		$this->head_title    = '网站' ;
		$this->userid = $_GET['userid'];
		$this->assign('head_title',$this->head_title);
	}

	public function index(){
		$do = M('Member');//实例化模型的简单方式
		$arr = $do->select();
		$this->assign('arr',$arr);
		$this->display();
	}

	public function listPage(){
		$tag = $_GET['tag'] ?  $_GET['tag'] : '全部文章';
		$this->assign('tag',$tag);
		$this->display();
	}

	public function showPage(){
		if($_GET['tag']){
			$this->assign('tag',$_GET['tag']);
		}

	}

	public function test(){
		echo U('Index/test');
	}



}