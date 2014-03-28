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

	/**
	 * @param        $content
	 * @param int    $length
	 * @param string $charset
	 * @param bool   $suffix
	 * @return string
	 */
	function intro($content, $length = 120,$charset="utf-8", $suffix=false) {
			if ($length) {
				$intro = trim(trimEOL(strip_tags($content)));
				// 删除实体
				$intro = preg_replace("/&([a-z]{1,});/", '', $intro);
				return msubstr($intro,0,$length,$charset,$suffix);
			} else {
				return '';
			}
		}

	/**
	 * 删除代码中的换行符
	 * @param      $string
	 * @param bool $js
	 * @return mixed
	 */
	function trimEOL($string, $js = false) {
		$string = str_replace(array(chr(10), chr(13)), array('', ''), $string);
		return $js ? str_replace("'", "\'", $string) : $string;
	}