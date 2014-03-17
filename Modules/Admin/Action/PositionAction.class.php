<?php
/**
 * User: Administrator
 * Time: 14-3-17 上午9:40
 */

class PositionAction extends AdminAction {

	public function _init(){
		$this->menu =  self::menu();
	}

	public function menu(){
		$menu = array(
			'add'  =>'添加推荐位',
			'index'=>'推荐位列表'
		);
		return $menu;
	}

	public function index(){
		$position = M('position')->select();
		$cate = M('category')->field('id,name')->select();
		$list = array();
		foreach($position as $v){
			if($v['catid'] == 0){
				$v['cate_name'] = '通用';
			}else{
				foreach($cate as $t){
					if($v['catid'] == $t['id']){
						$v['cate_name'] = $t['name'];
					}
				}
			}
			$list[] = $v;
		}
		$this->list = $list;
		$this->display();
	}

	public function add(){
		if(I('post.')){
			M('position')->add(I('post.'));
			$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U(MODULE_NAME.'/index')));
		}else{
			$this->cate = M('category')->where(array('parent_id'=>0))->field('id,name')->select();
			$this->display();
		}

	}

	public function edit(){
		if(I('post.')){
			M('position')->save(I('post.'));
			$this->ajaxReturn(array('success'=>1,'message'=>'修改成功','referer'=>U(MODULE_NAME.'/index')));
		}else{
			$this->item = M('position')->find(I('id'));
			$this->cate = M('category')->where(array('parent_id'=>0))->field('id,name')->select();
			$this->menu = array_merge($this->menu,array('edit'=>'修改推荐位'));
			$this->display('add');
		}

	}

	public function delete(){
		I('id') or $this->error('请选择推荐位');
		M('position')->where(array('id'=>I('id')))->delete();
		$this->redirect('index');
	}

} 