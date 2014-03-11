
<?php
 return array(

		 //RBAC 配置文件
		 'USER_AUTH_ON'     => true,             //是否需要认证
		 'USER_AUTH_TYPE'   =>2,                 //认证类型(1,登录认证 2，实时认证)
	     'ADMIN_AUTH_KEY'   =>'administrator',   //超级管理员认证识别号
	     'RBAC_SUPERADMIN'  =>'admin',           //超级管理员
		 'USER_AUTH_KEY'    =>'userid',          //认证识别号
		 //'REQUIRE_AUTH_MODULE'=>'',            //需要认证模块
		 'NOT_AUTH_MODULE'  =>'Index,Setting',                //无需认证模块
		 'NOT_AUTH_ACTION'  =>'',                //无需认证动作方法
		 'RBAC_ROLE_TABLE'  =>'omgt_role',       //角色表名称
		 'RBAC_USER_TABLE'  =>'omgt_role_user',  //角色_用户表名称
		 'RBAC_ACCESS_TABLE'=>'omgt_access',     //权限表名称
		 'RBAC_NODE_TABLE'  =>'omgt_node',       //节点表名称

		'TMPL_PARSE_STRING' =>  array(
				'__CSS__' =>  C('url').'/Modules/Admin/Public/CSS',
				'__JS__'    =>  C('url').'/Public/JS',
				'__IMG__'    => C('url').'/Modules/Admin/Public/Images',
		),
		'URL_MODEL'                => 1,
		'URL_HTML_SUFFIX'          => '',
 );
?>