<?php
/**
 * User: Administrator
 * Time: 14-3-27 下午4:10
 */

class TagLibUse extends Taglib{

	protected $tags = array(
		'menu' => array('attr'=>'order','close'=>1)
	);

	public function _menu($attr,$content){
		$attr = $this->parseXmlAttr($attr,'menu');
		$str = "<?php \$menu = M('menu')->where(array('cate'=>1,'status'=>1))->order({$attr['order']})->select();";
		$str.= "\$menu = Category::cate_merge(\$menu);";
		$str.="foreach(\$menu as \$v):";
		$str.= "extract(\$v);?>";
		$str.= $content;
		$str.="<?php endforeach;?>";

		return $str;
	}
} 