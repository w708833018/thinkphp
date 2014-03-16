<?php
/**
 * User: Administrator
 * Time: 14-1-14 下午2:25
 */

class HomeAction extends  BaseAction{

	public function  _init(){
		$this->menu = self::menu();
	}

	public function menu(){
		$menu = M('menu')->where(array('cate'=>1,'status'=>1))->order('sort')->select();
		$menu = Category::cate_merge($menu);
		return $menu;
	}

} 