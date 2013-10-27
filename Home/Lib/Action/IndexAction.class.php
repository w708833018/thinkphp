<?php

class IndexAction extends Action {

			private  $head_title;

			private  $post;

			private  $userid;

			private  $do;

		function __construct(){
			parent::__construct();
			$this->do       = M('Member');
			$this->post    = $_POST['post'] ;
			$this->head_title    = '测试' ;
			$this->userid = $_GET['userid'];
			$this->assign('head_title',$this->head_title);
		}


    public function index(){
	    $do = M('Member');//实例化模型的简单方式
		 $arr = $do->select();
		$this->assign('arr',$arr);
	      $this->display();
    }

	public function edit(){
		if($this->userid){
			$item = $this->do->find($this->userid);
			$this->assign('item',$item);
		}
		if($this->post['username']){
			$count =  $this->do->save($this->post);
			if($count >= 0 ){
				header('Location:'.__URL__);
			}else{
				$this->error('更新失败');
			};
		}
		$this->assign('action','edit');
		$this->display('index');
	}
	public  function add(){
		if($this->post['username']){
			if($this->do->add($this->post)){
				header('Location:'.__URL__);
			}else{
				$this->error('添加失败');
			}
		}
		$this->assign('action','add');
		$this->display('index');
	}

	public function  del(){
		if($this->userid){
			$this->do->delete($this->userid);
			header('Location:'.__URL__);
		}
	}

}