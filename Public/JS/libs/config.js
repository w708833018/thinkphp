
test.seajsBase = test.domain.public;
var alias={
	'login' : "JS/login",
	'admin' : "JS/admin",
	'jquery': "JS/libs/jquery/jquery",
	'$': "JS/libs/jquery/jquery",
	'hideshow': "JS/libs/jquery-extend/hideshow",
	'equalHeight': "JS/libs/jquery-extend/jquery.equalHeight",
	'tablesorter': "JS/libs/jquery-extend/jquery.tablesorter.min",
	'selectivizr': "JS/libs/jquery-extend/selectivizr",
	'tags': "JS/libs/util/tags",
	'tags-css': "JS/libs/util/tags.css",
	'easyui':'JS/libs/easyui/jquery.easyui.min',
	'easyui-css':'JS/libs/easyui/themes/metro/easyui.css',

	'bootstrap':'JS/libs/bootstrap-3.0.3/dist/js/bootstrap.min',
	'bootstrap-css':'JS/libs/bootstrap-3.0.3/dist/css/bootstrap.css',
	'bootstrap-theme':'JS/libs/bootstrap-3.0.3/dist/css/bootstrap-theme.css'
};

for (var a in alias) {
	alias[a] = test.seajsBase + alias[a];
}

seajs.config({
	alias:alias
});