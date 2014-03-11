<!DOCTYPE html>
<html>
<head>
	<title>跳转提示</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<script src="__JS__/global.js" ></script>
	<script src="__JS__/libs/seajs/sea.js" ></script>
	<script src="__JS__/libs/config.js"></script>
	<link rel="shortcut icon" href="__PUBLIC__/imgs/common/favicon.ico"/>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
	<script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<style>
		body{
			padding-top: 100px;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading"><strong>提示信息</strong></div>
				<div class="panel-body" >
					<present name="message">
						<?php echo($message); ?>
						<else/>
						<?php echo($error); ?>
					</present>
				</div>
				<div class="panel-footer" style="color: #666">
					<small>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b></small>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
<script>
	seajs.use(['$','bootstrap','bootstrap-css'],function($){

	})
</script>
</html>