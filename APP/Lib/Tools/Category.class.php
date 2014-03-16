<?php
/**
 * User: Administrator
 * Time: 14-3-15 下午5:58
 */

class Category {

	/**
	 * @param $cate
	 * @return array
	 */
	static function init($cate){
		$arr = array();
		foreach($cate as $v){
			$arr[$v['id']] = $v;
		}
		return $arr;
	}

	/**
	 * 获取所有父类id
	 * @param $cate
	 * @param $id
	 * @return array
	 */
	static function getParents_id($cate,$id){
		$arr = array();
		foreach($cate as $v){
			$cate_info = self::getCate($cate,$id);
			if($v['id'] == $cate_info['parent_id']){
				$arr[] = $v['id'];
				$arr   =  array_merge($arr,self::getParents_id($cate,$v['id']));
			}
		}
		return $arr;
	}

	/**
	 * 根据id获取分类信息
	 * @param $cate
	 * @param $id
	 * @return array
	 */
	static function getCate($cate,$id){
		$arr = array();
		foreach($cate as $v){
			if($v['id'] == $id) $arr = $v;
		}
		return $arr;
	}

	/**
	 * 获取所有子类ID
	 * @param $cate
	 * @param $id
	 * @return array
	 */
	static function getChild_id($cate,$id){
		$arr = array();
		foreach($cate as $v){
			if($v['parent_id'] == $id){
				$arr[] = $v['id'];
				$arr   =  array_merge($arr,self::getChild_id($cate,$v['id']));
			}
		}
		return $arr;
	}

	/**
	 * 组合成二维数组
	 * @param     $cate
	 * @param int $pid
	 * @return array
	 */
	static function cate_merge($cate,$pid=0){
		$arr = array();
		foreach($cate as $v){
			if($v['parent_id'] == $pid){
				$v['child'] = self::cate_merge($cate,$v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}


}