<?php
/**
 * User: Administrator
 * Time: 14-3-17 上午11:25
 */

class ArticleAction extends AdminAction {

	public function _init(){
		parent::_init();
		$this->menu = self::menu();
	}

	/**
	 * menu
	 */
	public function menu(){
		$menu = array(
			'add' => '添加文章',
			'index' => '文章列表',
			'recyle' => '回收站',
		);
		return  $menu;
	}

	public function index(){
		$this->list   = D('ArticleRelation')->getList();
		$this->status = 3;
		$this->display();
	}

	public function add(){
		if(I('post.')){
			Load('extend');
			$_POST['introduce'] = $_POST['introduce'] ? $_POST['introduce'] : intro($_POST['content']);
			D('ArticleRelation')->create();
			if($article_id = D('ArticleRelation')->add()){
				if(isset($_POST['position']) && !empty($_POST['position'])){
					foreach($_POST['position'] as $v){
						M('article_position')->add(array('article_id'=>$article_id,'position_id'=>$v));
					}
				}
			}
			$this->ajaxReturn(array('success'=>1,'message'=>'添加成功','referer'=>U(MODULE_NAME.'/index')));
		}else{
			$list = M('category')->field('id,name,parent_id')->order('sort')->where(array('cate'=>1))->select();
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id >\$spacer\$name</option>";
			$this->cate = $tree->get_tree(6,$str);
			$this->position = M('position')->where(array('catid'=>array(array('eq',6),array('eq',0), 'or')))->select();
			$this->display();
		}

	}

	public function edit(){
		if(I('post.')){
			Load('extend');
			$_POST['introduce'] = $_POST['introduce'] ? $_POST['introduce'] : intro($_POST['content']);
			D('ArticleRelation')->create();
			if(D('ArticleRelation')->save()){
				if(isset($_POST['position']) && !empty($_POST['position'])){
					M('article_position')->where(array('article_id'=>I('id')))->delete();
					foreach($_POST['position'] as $v){
						M('article_position')->add(array('article_id'=>I('id'),'position_id'=>$v));
					}
				}else{
					M('article_position')->where(array('article_id'=>I('id')))->delete();
				}
			}
			$this->ajaxReturn(array('success'=>1,'message'=>'修改成功','referer'=>U(MODULE_NAME.'/'.I('action'))));
		}else{
			$item = D('ArticleRelation')->relation('position')->find(I('id'));
			$list = M('category')->field('id,name,parent_id')->order('sort')->where(array('cate'=>1))->select();
			$list = Category::init($list);
			$tree = new Tree();
			$tree->icon = array('│', '├─ ', '└─ ');
			$tree->init($list);
			$str = "<option value=\$id \$selected>\$spacer\$name</option>";
			$this->cate = $tree->get_tree(6,$str,$item['catid']);
			$this->menu = array_merge(self::menu(),array('edit'=>'修改文章'));
			$pids = array();
			foreach($item['position'] as $v){
				$pids[] = $v['id'];
			}
			$this->assign('pids',$pids);
			$this->assign('action',I('action'));
			$this->assign('item',$item);
			$this->position = M('position')->where(array('catid'=>array(array('eq',6),array('eq',0), 'or')))->select();
			$this->display('add');
		}

	}

	/**
	 * 回收站
	 */
	public function recyle(){
		$this->list   = D('ArticleRelation')->getList(1);
		$this->status = 1;
		$this->display('index');
	}

	/**
	 * 还原
	 */
	public function restore(){
		I('id') or $this->error('请选择文章');
		D('ArticleRelation')->restore($_POST['id']);
		$this->success('还原成功');
	}

	/**
	 * 删除
	 */
	public function delete(){
		I('id') or $this->error('请选择文章');
		$id = I('post.') ? $_POST['id'] : I('id');
		D('ArticleRelation')->del($id,I('status'));
		$this->success('操作成功');
	}


}