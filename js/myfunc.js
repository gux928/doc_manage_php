var initNav = function(){        						//初始化导航条
	$("#mynav").load("login.php",function(){          	//载入导航条
			$(document).on('click',function(e){     		//关闭登录框
			$target=$(e.target);
			var isLoginBtn 		= 	$target.closest('#login-btn').length;
			console.log(isLoginBtn);
			var isLoginPanel	=	$target.closest('#login-panel').length;
			console.log(isLoginPanel);
			var isPanelShow		=	!$('#login-panel').hasClass('hide');
			console.log(isPanelShow);
			console.log(isPanelShow&&!(isLoginBtn||isLoginPanel));
			if(isPanelShow&&!(isLoginBtn||isLoginPanel)){
				$('#login-btn').toggleClass('bg-color-blueDark');
				$('#login-panel').toggleClass('hide');
			}
		});
		
	});
	$(document).on('click','#logout',function(){				//退出按钮点击事件	
		$.post('logout.php',function(){
			$("#mynav").load("login.php",function(){          	//载入导航条
				$(document).on('click',function(e){     		//关闭登录框
				$target=$(e.target);
				var isLoginBtn 		= 	$target.closest('#login-btn').length;
				console.log(isLoginBtn);
				var isLoginPanel	=	$target.closest('#login-panel').length;
				console.log(isLoginPanel);
				var isPanelShow		=	!$('#login-panel').hasClass('hide');
				console.log(isPanelShow);
				console.log(isPanelShow&&!(isLoginBtn||isLoginPanel));
				if(isPanelShow&&!(isLoginBtn||isLoginPanel)){
					$('#login-btn').toggleClass('bg-color-blueDark');
					$('#login-panel').toggleClass('hide');
				}
				});		
			});	
			var d = new Date();
			console.log(d);
		});
	});
	$(document).on('click','#login-btn',function(){				//登录按钮点击事件		
		$('#login-btn').toggleClass('bg-color-blueDark');
		$('#login-panel').toggleClass('hide');
	});
	$(document).on('click','#login-panel-btn',function(){ 		//绑定登录事件load login.php
		var uName=$('#login-panel input').eq(0).val();
		var pass=$('#login-panel input').eq(1).val();
		console.log(uName);
		console.log(pass);
		$.post('check.php',{'uName':uName,'uPass':pass},function(data){
			console.log('data='+data);
			if(data==1) {					//登录成功
				$('#login-btn').toggleClass('bg-color-blueDark');
				$('#login-panel').toggleClass('hide');
				initNav();
			}
			else{
				console.log('no pass');
				$('#login-error').css('top','38px').fadeOut(2000,function(){
					$('#login-error').css('top','-300px').fadeIn();
				});
				
			}	
		});				
	});	
}

var initRecent =	function(){
	$("#recent").load("recent10.php"); 					//载入最近文档
	$(".nav-tabs a").click(function(){					//切换tab显示最近的文档
		var index =$(".nav-tabs a").index(this);
		$(".nav-tabs a")
			.eq(index).addClass("default bg-color-blue")
			.siblings().removeClass("default bg-color-blue");			
		$(".tab-content >div")
			.eq(index).show()
			.siblings().hide();
	});
}

