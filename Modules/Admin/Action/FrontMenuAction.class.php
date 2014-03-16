<?php
/**
 * User: Administrator
 * Time: 14-3-14 下午4:19
 */

class FrontMenuAction extends  AdminAction {


	public function _init(){
		parent::_init();
		$this->menu = self::menu();
	}

	/**
	 * 菜单列表
	 */
	public function index(){
		$list = M('menu')->where(array('cate'=>1))->order('sort')->select();
		foreach($list as $v){
			$v['status'] = $v['status']==1 ? '显示' : '关闭' ;
			$v['target'] = $v['target'] ? '新窗口' : '当前窗口' ;
			$v['str_manger'] = '<a href='.U(MODULE_NAME.'/addChild','id='.$v['id']).' title="添加子菜单"><span class="glyphicon glyphicon-chevron-down"></span></a> <a href='.U(MODULE_NAME.'/edit','id='.$v['id']).' title="修改"><span class="glyphicon glyphicon-file"></span></a><a href='.U(MODULE_NAME.'/delete','id='.$v['id']).' onclick="return confirm(\'确定要删除吗?\')" title="删除"><span class="glyphicon glyphicon-trash"></span>';
			$arr[] = $v;
		}
		$tree = new Tree();
		$tree->icon = array('&nbsp;&nbsp;│', '&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;└─ ');
		$tree->init($arr);
		$str = "<tr>
					<td ><input type='text' size='3' value='\$sort' class='input' name='\$id'></td>
					<td>\$spacer\$name</td>
					<td>\$url</td>
					<td >\$status</td>
					<td >\$target</td>
					<td>\$str_manger</td>
					</tr>
						  ";
		$this->list = $tree->get_tree(0,$str);
		$this->display();
	}

	/**
	 * menu
	 */
	public function menu(){
		$menu = array(
			'add' => '添加菜单',
			'index' => '菜单列表',
		);
		return  $menu;
	}

	/**
	 * 添加菜单
	 */
	public function add(){
		if(I('post.')){
			$data = I('post.');
			$data['cate'] = 1;
			if($id = M('menu')->add($data)){
				M('menu')->where(array('id'=>$id))->setField('sort',$id);
				$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U('FrontMenu/index')));
			};
		}else{
			$list = M('menu')->field('id,name,parent_id')->order('sort')->where(array('cate'=>1))->select();
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id >\$spacer\$name</option>";
			$this->list = $tree->get_tree(0,$str);
			$this->display();
		}

	}

	/**
	 * 修改菜单
	 */
	public function edit(){
		I('id') or $this->error('请选择菜单');
		if(I('post.')){
			if($id = M('menu')->where(array('id'=>I('id')))->save(I('post.'))){
				$this->ajaxReturn(array('success'=>1,'message'=>'修改成功','referer'=>U('FrontMenu/index')));
			};
		}else{
			$list = M('menu')->field('id,name,parent_id')->order('sort')->where(array('cate'=>1))->select();
			$list = Category::init($list);
			$cate = Category::getCate($list,I('id'));
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id \$selected>\$spacer\$name</option>";
			$this->list = $tree->get_tree(0,$str,$cate['parent_id']);
			$this->item = M('Menu')->find(I('id'));
			$this->menu = array_merge(self::menu(),array('edit'=>'修改菜单'));
			$this->display('add');
		}
	}

	/**
	 * 添加子菜单
	 */
	public function addChild(){
		if(I('post.')){
			$data = I('post.');
			$data['cate'] = 1;
			if($id = M('menu')->add($data)){
				M('menu')->where(array('id'=>$id))->setField('sort',$id);
				$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U('FrontMenu/index')));
			};
		}else{
			$list = M('menu')->field('id,name,parent_id')->order('sort')->where(array('cate'=>1))->select();
			$list = Category::init($list);
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id \$selected>\$spacer\$name</option>";
			$this->list = $tree->get_tree(0,$str,I('id'));
			$this->menu = array_merge(self::menu(),array('addChild'=>'添加子菜单'));
			$this->display('add');
		}
	}


	/**
	 * 删除菜单
	 */
	public function delete(){
		I('id') or $this->error('请选择菜单');
		$cate = M('menu')->where(array('cate'=>1))->select();
		$ids = Category::getChild_id($cate,I('id'));
		array_push($ids,I('id'));
		$map['id'] = array('in',$ids);
		M('menu')->where($map)->delete();
		$this->redirect('index');
	}

	/**
	 * 排序
	 */
	public function sort(){
		foreach($_POST as $k=>$v){
			M('menu')->where(array('id'=>$k))->setField('sort',$v);
		}
		$this->redirect('index');
	}

}