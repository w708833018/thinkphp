
site.seajsBase = site.domain.public;
var alias={
	'login' : "JS/login",
	'admin' : "JS/admin",
	'jquery': "JS/libs/jquery/jquery",
	'$': "JS/libs/jquery/jquery",
	'hideshow': "JS/libs/jquery-extend/hideshow",
	'tags': "JS/libs/util/tags",
	'tags-css': "JS/libs/util/tags.css",

	//jquery extend validate
	'validate':'JS/libs/jQueryValidate/jquery-validate',
	'validate-min':'JS/libs/jQueryValidate/jquery-validate.min',


	'form-ajax':'JS/libs/jquery-form/jquery-form',
	'easyui':'JS/libs/easyui/jquery.easyui.min',
	'easyui-css':'JS/libs/easyui/themes/metro/easyui.css',

	//bootstrap
	'bootstrap':'JS/libs/bootstrap-3.0.3/dist/js/bootstrap.min',
	'bootstrap-css':'JS/libs/bootstrap-3.0.3/dist/css/bootstrap.css',
	'flat-ui-css':'JS/libs/bootstrap-3.0.3/Flat-UI/css/flat-ui.css',
	'flat-ui':'JS/libs/bootstrap-3.0.3/Flat-UI/js/flatui',
	//flat-ui js dependent
	'placeholder':'JS/libs/bootstrap-3.0.3/Flat-UI/js/jquery.placeholder',
	'tagsinput':'JS/libs/bootstrap-3.0.3/Flat-UI/js/jquery.tagsinput',
	'jquery-ui':'JS/libs/bootstrap-3.0.3/Flat-UI/js/jquery-ui-1.10.3.custom.min',
	'application':'JS/libs/bootstrap-3.0.3/Flat-UI/js/application',
	'bootstrap-select':'JS/libs/bootstrap-3.0.3/Flat-UI/js/bootstrap-select',
	'bootstrap-switch':'JS/libs/bootstrap-3.0.3/Flat-UI/js/bootstrap-switch'
};

for (var a in alias) {
	alias[a] = site.seajsBase + alias[a];
}

seajs.config({
	alias:alias
});