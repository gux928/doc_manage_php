$(function() {
	// var tab=$("#myTab>li").html();
	// var index =$("nav-tabs a").index(this);
	// 	alert(index);
	
	// alert(tab);
	$("#mynav").load("login2.php");
	$(".nav-tabs a").click(function(){
		var index =$(".nav-tabs a").index(this);
		// alert(index);
		// alert($(".nav-tabs a")
		// 	.eq(index)
		// 	.siblings());
		$(".nav-tabs a")
			.eq(index).addClass("default bg-color-blue")
			.siblings().removeClass("default bg-color-blue");
			
		$(".tab-content >div")
			.eq(index).show()
			.siblings().hide();
	});
	$("#login-btn").click(function(){
		$("#login-float").toggle();
		$("#windowsbg").toggle();
		$("#windowsbg").animate({opacity:"0.5"},"normal");

	})
	$("#windowsbg").click(function(){
			$("#login-float").hide();
			$("#windowsbg").hide();
		})
	$("#recent").load("recent10.php");
	 // var url=new String("showjpeg.php");
	 // // alert(String(document.location.search));
	 // // alert(url);
	 // var url2=url+document.location.search;
	 // // alert(url2);
	 // $("#myjpg").load(url2);

});

