<?php
/**
 * User: Administrator
 * Time: 14-3-14 下午4:19
 */

class CategoryAction extends  AdminAction {


	public function _init(){
		parent::_init();
		$this->menu = self::menu();
	}

	/**
	 * 分类列表
	 */
	public function index(){
		$list = M('category')->where(array('cate'=>1))->order('sort')->select();
		foreach($list as $v){
			$v['level']  = $v['parent_id'] == 0 ? '主分类' : '';
			$v['str_manger'] = '<a href='.U(MODULE_NAME.'/addChild','id='.$v['id']).' title="添加子分类"><span class="glyphicon glyphicon-chevron-down"></span></a> <a href='.U(MODULE_NAME.'/edit','id='.$v['id']).' title="修改"><span class="glyphicon glyphicon-file"></span></a><a href='.U(MODULE_NAME.'/delete','id='.$v['id']).' onclick="return confirm(\'确定要删除吗?\')" title="删除"><span class="glyphicon glyphicon-trash"></span>';
			$arr[] = $v;
		}
		$tree = new Tree();
		$tree->icon = array('&nbsp;&nbsp;│', '&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;└─ ');
		$tree->init($arr);
		$str = "<tr>
					<td ><input type='text' size='3' value='\$sort' class='input' name='\$id'></td>
					<td>\$level</td>
					<td>\$spacer\$name</td>
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
			'add' => '添加分类',
			'index' => '分类列表',
		);
		return  $menu;
	}

	/**
	 * 添加分类
	 */
	public function add(){
		if(I('post.')){
			if($id = M('category')->add(I('post.'))){
				M('category')->where(array('id'=>$id))->setField('sort',$id);
				$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U(MODULE_NAME.'/index')));
			};
		}else{
			$list = M('category')->field('id,name,parent_id')->order('sort')->where(array('cate'=>1))->select();
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id >\$spacer\$name</option>";
			$this->list = $tree->get_tree(0,$str);
			$this->display();
		}

	}

	/**
	 * 修改分类
	 */
	public function edit(){
		I('id') or $this->error('请选择分类');
		if(I('post.')){
			if($id = M('category')->where(array('id'=>I('id')))->save(I('post.'))){
				$this->ajaxReturn(array('success'=>1,'message'=>'修改成功','referer'=>U(MODULE_NAME.'/index')));
			};
		}else{
			$list = M('category')->field('id,name,parent_id')->order('sort')->select();
			$list = Category::init($list);
			$cate = Category::getCate($list,I('id'));
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id \$selected>\$spacer\$name</option>";
			$this->list = $tree->get_tree(0,$str,$cate['parent_id']);
			$this->item = M('category')->find(I('id'));
			$this->menu = array_merge(self::menu(),array('edit'=>'修改分类'));
			$this->display('add');
		}
	}

	/**
	 * 添加子分类
	 */
	public function addChild(){
		if(I('post.')){
			$data = I('post.');
			$data['cate'] = 1;
			if($id = M('category')->add($data)){
				M('category')->where(array('id'=>$id))->setField('sort',$id);
				$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U(MODULE_NAME.'/index')));
			};
		}else{
			$list = M('category')->field('id,name,parent_id')->order('sort')->where(array('cate'=>1))->select();
			$list = Category::init($list);
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id \$selected>\$spacer\$name</option>";
			$this->list = $tree->get_tree(0,$str,I('id'));
			$this->menu = array_merge(self::menu(),array('addChild'=>'添加子分类'));
			$this->display('add');
		}
	}


	/**
	 * 删除分类
	 */
	public function delete(){
		I('id') or $this->error('请选择分类');
		$cate = M('category')->select();
		$ids = Category::getChild_id($cate,I('id'));
		array_push($ids,I('id'));
		$map['id'] = array('in',$ids);
		M('category')->where($map)->delete();
		$this->redirect('index');
	}

	/**
	 * 排序
	 */
	public function sort(){
		foreach($_POST as $k=>$v){
			M('category')->where(array('id'=>$k))->setField('sort',$v);
		}
		$this->redirect('index');
	}

}