<?php
/**
 * User: Administrator
 * Time: 14-3-19 下午4:08
 */

class ArticleRelationModel  extends  RelationModel{

	protected $tableName = 'article';

	protected $_link = array(
		'position' => array(
			'mapping_type' =>MANY_TO_MANY,
			'mapping_name' =>'position',
			'foreign_key' =>'article_id',
			'relation_foreign_key' =>'position_id',
			'relation_table'=>'omgt_article_position'
		)
	);

	protected $_auto = array(
			array('status',3),
			array('addtime','time',1,'function'),
			array('edittime','time',1,'function'),
	);

}