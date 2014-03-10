/**
 * Created by Administrator on 14-2-21.
 */
define(function(require){

	require('form-ajax');

	//form Ajax submit
	$(function(){
		var ajaxFrom = $('#ajaxForm');
		ajaxFrom.ajaxForm({
			dataType:'json',
			success:function(data){
				alert(data.message);
				if(data.success && data.referer){
					window.location.href = data.referer;
				}
			}
		})
	})


});