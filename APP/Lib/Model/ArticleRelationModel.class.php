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
			'foreign_key' =>'article_id',
			'relation_foreign_key' =>'position_id',
			'relation_table'=>'omgt_article_position',
			'mapping_fields'  =>'id',
		),
		'category' => array(
			 'mapping_type' =>BELONGS_TO,
			 'foreign_key'  =>'catid',
			 'mapping_fields'  =>'name',
			 'as_fields'   =>'name:catename',

		)
	);

	protected $_auto = array(
			array('status',3),
			array('addtime','time',1,'function'),
			array('edittime','time',3,'function'),
	);

	public function getList($status = 3){
		return $this->field('content',true)->relation(true)->where(array('status'=>$status))->select();
	}

	/**
	 * 批量还原
	 * @param $id
	 */
	public function restore($id){
		if(is_array($id)){
			foreach($id as $v){
				$this->restore($v);
			}
		}else{
			$this->where(array('id'=>$id))->setField(array('status'=>3));
		}

	}

	/**
	 * 批量删除
	 * @param        $id
	 * @param string $status
	 */
	public function del($id,$status=''){
		if(is_array($id)){
			foreach($id as $v){
				$this->del($v,$status);
			}
		}else{
			switch($status){
				case 3:
					$this->where(array('id'=>$id))->setField(array('status'=>1));
					break;
				case 1:
					$this->where(array('id'=>$id))->delete();
					M('article_position')->where(array('article_id'=>$id))->delete();
					break;
			}
		}
	}


}