
test.seajsBase = test.domain.js;
var alias={
	'login' : "JS/login",
	'jquery': "JS/libs/jquery/jquery",
	'$': "JS/libs/jquery/jquery",
	'easyui':'jquery.easyui.min'
	'easyui-css':'jquery.easyui.min'
};

for (var a in alias) {
	alias[a] = test.seajsBase + alias[a];
}

seajs.config({
	alias:alias,
	preload: ['jquery']
});