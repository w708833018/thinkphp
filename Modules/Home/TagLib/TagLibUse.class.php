<?php
/**
 * User: Administrator
 * Time: 14-3-27 下午4:10
 */

class TagLibUse extends Taglib{

	protected $tags = array(
		'menu' => array('attr'=>'order','close'=>1),
		'article' => array('attr'=>'condition,limit,order','close'=>1)
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

	public function _article($attr,$content){
		$attr = $this->parseXmlAttr($attr,'article');
		$field = $attr['filed'] ? $attr['filed'] : 'id,title';
		$order = $attr['order'] ? $attr['order'] : 'addtime desc';
		if($attr['position']){
			$join = 'inner join '.C("DB_PREFIX").'article_position on '.C("DB_PREFIX").'article.id = '.C("DB_PREFIX").'article_position.article_id';
		}
		$str =<<<start_mark
		<?php
			\$where = array('status'=>3);
			if("{$attr['catid']}")   \$where = array_merge(\$where,array('catid'=>"{$attr['catid']}"));
			if("{$attr['position']}") \$where = array_merge(\$where,array('position_id'=>"{$attr['position']}"));
			\$list = M('article')->
			join("{$join}")->
			field("{$field}")->
			where(\$where)->
			limit({$attr['limit']})->
			order("{$order}")->
			select();
			foreach(\$list as \$v):
				extract(\$v);?>
				$content
			<?php endforeach;?>
start_mark;
		return $str;
	}
} 