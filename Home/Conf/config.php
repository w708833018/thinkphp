<?php

return array(
	'URL_PATHINFO_DEPR'      => '/' ,        //修改url的分隔符
	'TMPL_L_DELIM'           => '{',         //左定界符
	'TMPL_R_DELIM'           => '}',         //右定界符
	'DB_TYPE'                => 'mysql',     //数据库类型
	'DB_HOST'                => 'localhost', //主机
	'DB_NAME'                => 'wolf',      //数据库名
	'DB_USER'                => 'root',      //用户名
	'DB_PWD'                 => 'wanglei',   //密码
	'DB_PORT'                => '3306',      //端口
	'DB_PREFIX'              => 'WL_',       //表前缀
	'SHOW_PAGE_TRACE'        =>  true,       //错误追踪
	'TMPL_TEMPLATE_SUFFIX'   =>  '.html',    //模板后缀
	//'TMPL_FILE_DEPR'         =>  '_',      //模板层次
    //DEFAULT_THEME'          =>  'index',   //默认模板主题
    //'TMPL_DETECT_THEME'      =>   true,       //自动侦测模板主题
	//'THEME_LIST'             =>  'yellow,red,index',        //自动侦测模板主题
	/*'DB_DSN'            =>  'mysql://root:wanglei@localhost:3306/wolf',*/       //使用DSN方式配置数据库信息
	'TMPL_PARSE_STRING' =>  array(
			'__CSS__' => __ROOT__.'/Public/CSS',
			'__JS__'    => __ROOT__. '/Public/JS',
	),
);
?>