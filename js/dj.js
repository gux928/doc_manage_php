function setDate () {
	var d = new Date();
	var m = d.getMonth()+1;
	var date=d.getDate();
	if(m<10) m='0'+m;
	if(date<10) date='0'+date;
	return d.getFullYear()+'-'+m+'-'+date;
}
function showErrorNotic (pos) {
	console.log(pos);
	$('#error-notice').css({left:pos.left+80,top:pos.top});
	$('#error-notice').fadeOut(2000,function(){
	$('#error-notice').css({top:-999});
	$('#error-notice').fadeIn();
	});
}
var inputCheck = function() {
	var thisval,thisname,thistype;
	// console.log('check');
	// console.log($('#swdj input,textarea').length);
	var pass=false;
	$.each($('#swdj input,textarea'),function(){
		thisval=$(this).val();
		thisname=$(this).attr('name');
		thistype=$(this).attr('type')
		if(thisval==''&&thistype!='file'&&thisname!='wenhao'){
			var pos=$(this).offset();
			$(this).focus();
			showErrorNotic(pos);
			pass=false;
			return false;
		}
		else{
			pass=true;
			return true;
		}	
	});
	if(pass){
		$('#swdj').submit();
	}
}
	// var data= new Array();
	// var thisval,thisname;
	// var fileNum=$("input[type='file']").length;
	// $("input[type='file']").each(function(){
	// 	data[$(this).attr('name')]=$(this).val();
	// });
	// console.log('filenum='+fileNum);
	// var pass= true;
	// pass=$.each ($('input'),function() {
	// 	thisval=$.trim($(this).val());	
	// 				//break;
	// 	}
	// 	else{
	// 		thisname=$(this).attr('name');
	// 		console.log(thisval);
	// 		data.push({'name':thisname,'value':thisval});
	// 		console.log(data.length);
	// 	}
	// });	
	// if(pass){
	// 	thisval=$.trim($('textarea').val());
	// 	if(thisval==''){
	// 		var pos=$('textarea').offset();
	// 		$('textarea').focus();
	// 		console.log(pos);
	// 		$('#error-notice').css({left:pos.left+180,top:pos.top});
	// 		$('#error-notice').fadeOut(2000,function(){
	// 			$('#error-notice').css({top:-999});
	// 			$('#error-notice').fadeIn();
	// 		});
	// 		return false;
	// 	}
	// 	else{
	// 		thisname=$('textarea').attr('name');
	// 		console.log(thisval);
	// 		data.push({'name':thisname,'value':thisval});
	// 		console.log(data.length);
	// 		console.log($('#swdj').serialize());
	// 		$.post('tjbd.php',$('#swdj').serialize(),function(data){
	// 			console.log(data);
	// 		});
	// 	}
	// }
	//else return false;
	
	// //console.log('year='+data['year']);
	// var pram=$.param(data);
	// console.log(data.length);
	// console.log(pram);
	// $.each($(data),function(){
	// 	console.log('key='+this.name+'  val='+this.value);
	// });
	

// function serializeArray (array) {
// 	var outPut='';
// 	for (var i = array.length - 1; i >= 0; i--) {
// 		array[i]
// 	};
// }
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
	// var _mozi=['墨家','墨子','墨翟','兼爱非攻','尚同尚贤']; //本文所用到的数组, 下同
	// $.each(_mozi,function(key,val){
 //    //回调函数有两个参数,第一个是元素索引,第二个为当前值
 //    alert('_mozi数组中 ,索引 : '+key+' 对应的值为: '+val);
// });
});

