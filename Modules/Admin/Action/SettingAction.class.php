<?php
/**
 * 网站设置
 */
class SettingAction extends AdminAction {

		public  function index(){
			$set = M('setting');
			$set=$set->where(array('item'=>1))->select();
			foreach($set as $k=>$v){
				$setting[$v['item_key']] = $v['item_value'];
			}
			$this->assign('set',$setting)->display();
		}

		public  function set(){
			$set = M('setting');
			if(I('set')){
				foreach(I('set') as $k=>$v){
					if($v){
						$data['item_value'] = $v;
						if($set->where(array('item_key'=>$k))->count()){
							$return['success'] = $set->where(array('item_key'=>$k))->setField($data);
						}else{
							$data['item_key'] = $k;
							$data['item'] = 1;
							$return['success'] = $set->add($data);
						}
					}
				}
			}
			if($return['success']){
				$return['message'] = '保存成功';
			}else{
				$return['message'] = '保存失败';
			}
			$this->ajaxReturn($return);
		}
}