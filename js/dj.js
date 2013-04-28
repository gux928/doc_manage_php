function setDate () {
	var d = new Date();
	var m = d.getMonth()+1;
	var date=d.getDate();
	if(m<10) m='0'+m;
	if(date<10) date='0'+date;
	return d.getFullYear()+'-'+m+'-'+date;
}
var inputCheck = function() {
	var data= new Array();
	var fileNum=$("input[type='file']").length;
	$("input[type='file']").each(function(){
		data[$(this).attr('name')]=$(this).val();
	});
	console.log('filenum='+fileNum);
	for (var i = 0 ; i < $('input').length-fileNum ; i++) {
		$thisInput=$('input').eq(i);
		var thisval=$.trim($thisInput.val());	
		if(thisval==''){
			var pos=$thisInput.offset();
			console.log(pos);
			$('#error-notice').css({left:pos.left+80,top:pos.top});
			$('#error-notice').fadeOut(2000,function(){
				$('#error-notice').css({top:-999});
				$('#error-notice').fadeIn();
			});
			
			return false;				//break;
		}
		else{

			console.log($thisInput.val());
			data[$thisInput.attr('name')]=$thisInput.val();
		}
	};	
	thisval=$.trim($('textarea').val());
	if(thisval==''){
			var pos=$('textarea').offset();
			console.log(pos);
			$('#error-notice').css({left:pos.left+180,top:pos.top});
			$('#error-notice').fadeOut(2000,function(){
				$('#error-notice').css({top:-999});
				$('#error-notice').fadeIn();
			});
			return false;
		}
	console.log(data);
}
function initDatepicker (argument) {
	$('#datepicker').val(setDate());
	$('#o-year').val(function(){
		var d = new Date();
		return d.getFullYear();
	});
	$.datepicker.regional['zh-CN'] = {
		closeText: '关闭',
		prevText: '&#x3C;上月',
		nextText: '下月&#x3E;',
		currentText: '今天',
		monthNames: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		monthNamesShort: ['一月','二月','三月','四月','五月','六月',
		'七月','八月','九月','十月','十一月','十二月'],
		dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
		dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
		dayNamesMin: ['日','一','二','三','四','五','六'],
		weekHeader: '周',
		dateFormat: 'yy-mm-dd',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: '年'};
	$.datepicker.setDefaults($.datepicker.regional['zh-CN']);
	$('#datepicker').datepicker({
	changeMonth: true,
	changeYear: true,
	showButtonPanel: true
	});
}
$(function() {
	initDatepicker();
	$('#submit').bind('click',inputCheck);

});

