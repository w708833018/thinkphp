<?php
	return array(
		'LOAD_EXT_CONFIG'        =>'db',         //数据库配置
		'URL_PATHINFO_DEPR'      => '/' ,        //修改url的分隔符
		'TMPL_L_DELIM'           => '{',         //左定界符
		'TMPL_R_DELIM'           => '}',         //右定界符
		//'SHOW_PAGE_TRACE'        =>  true,     //错误追踪
		'TMPL_TEMPLATE_SUFFIX'   =>  '.html',    //模板后缀
		'APP_GROUP_LIST'		 =>'Admin,Home', //模板分组列表
		'DEFAULT_GROUP'		     =>'Home',       //默认分组
		'APP_GROUP_MODE'         =>1,             //开启独立分组 0：普通分组 1：独立分组
		'APP_GROUP_PATH'         =>'../Modules' ,     //独立分组目录
		'URL'                    => 'http://'.$_SERVER['HTTP_HOST']     //独立分组目录
		//'TMPL_FILE_DEPR'       =>  '_',      //模板层次
	    //DEFAULT_THEME'         =>  'index',   //默认模板主题
	    //'TMPL_DETECT_THEME'    =>   true,       //自动侦测模板主题
		//'THEME_LIST'           =>  'yellow,red,index',        //自动侦测模板主题
	);
?>