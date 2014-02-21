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
			if(I('setting')){
				foreach(I('setting') as $k=>$v){
					if($v){
						$data['item_value'] = $v;
						if($set->where(array('item_key'=>$k))->count()){
							$set->where(array('item_key'=>$k))->setField($data);
						}else{
							$data['item_key'] = $k;
							$data['item'] = 1;
							$set->add($data);
						}
					}
				}
			}
			$return['success']=1;
			$return['message']='保存成功';
			$this->ajaxReturn($return);
		}
}