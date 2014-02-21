<?php
/**
 * 网站设置
 */
class SettingAction extends AdminAction {

		public  function index(){
			$this->display();
		}

		public  function set(){
			$set = M('setting');
			if(I('setting')){
				foreach(I('setting') as $k=>$v){
					if(!$v){
						if(!$set->getByItem_key($k)){
							$data[$k] = $v;
							$set->add($data);
						}else{
							$data[$k] = $v;
							$set->save($data);
						}
					}
				}
			}
			$data['success']=1;
			$data['message']='保存成功';
			$this->ajaxReturn($data);
		}
}