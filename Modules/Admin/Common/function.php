<?php
/**
 * User: Administrator
 * Time: 14-3-9 下午2:45
 */

	function node_merge($note,$pid=0){
		$arr = array();
		foreach($note as $v){
			if($v['pid'] == $pid){
				$v['child'] = node_merge($note,$v['id']);
				$arr[] = $v;
			}
		}
		return $arr;
	}