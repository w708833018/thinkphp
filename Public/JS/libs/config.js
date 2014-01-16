
test.seajsBase = test.domain.public;
var alias={
	'login' : "JS/login",
	'jquery': "JS/libs/jquery/jquery",
	'tags': "JS/libs/util/tags",
	'tags-css': "JS/libs/util/tags.css",
	'$': "JS/libs/jquery/jquery",
	'easyui':'JS/libs/easyui/jquery.easyui.min',
	'easyui-css':'JS/libs/easyui/themes/metro/easyui.css'
};

for (var a in alias) {
	alias[a] = test.seajsBase + alias[a];
}

seajs.config({
	alias:alias,
	preload: ['jquery']
});