<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
	    $head_title = '测试';
	    $do = new Model('member');
	    $arr = $do->select();
	    $this->assign('head_title',$head_title);
	    $this->assign('name',$arr[0]['username']);
	    $this->display();
    }
}