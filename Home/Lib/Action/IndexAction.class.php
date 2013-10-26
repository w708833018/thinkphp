<?php

class IndexAction extends Action {
    public function index(){
	    $head_title = '测试';
	    $action = $_GET['action'] ? $_GET['action'] : $_POST['action'];
	    $post = $_POST['post'] ;
	    $do = M('Member');//实例化模型的简单方式
	    switch ($action)
	    {
		    case 'add':
				    if($post['username']){
					    $do->username=$post['username'];
					    $do->age=$post['age'];
					    if($do->add()){
						    header('Location:?');
					    }
				    }
				break;
		    case 'edit':
			    $userid = $_GET['userid'];
			    if($userid){
				    $item = $do->find($userid);
				    $this->assign('item',$item);
			    }
				    if($post['username']){
					   $count =  $do->save($post);
							if($count || $count==0 ){
								header('Location:?');
							}else{
							echo '更新失败！';
							};
			           }
			    break;

		    case 'delete':
			    $userid = $_GET['userid'];
			    if($userid){
				 $do->delete($userid);
				    header('Location:?');
			    }
			    break;
		    default:
			    $do->where('userid =21')->getField('username');//获取指定字段数据 ；
			    $arr = $do->select();
			    $this->assign('arr',$arr);
	    }
	    $this->assign('head_title',$head_title);
	    $this->assign('action',$action);
	    $this->display();
    }
}