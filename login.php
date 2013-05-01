<!DOCTYPE html>
<?	
	session_start();
	$isLogin=isset($_SESSION['isLogin']);
	if($isLogin){
?>
		<div class='nav-bar'>
        	<div class='nav-bar-inner'>
				<a href='#'><span class='element brand'>欢迎你：<?echo $_SESSION['username']?></span></a> 
		        <span class='divider'></span> 
				<ul class='menu' >		
				<li><a  href='index.html'>首页</a></li>
				<li><a  href='dj.html'>录入</a>
				<li><a  href='#' id='logout'>退出</a></li>
				</ul>
			</div>
   		</div>
<?	}
	else{?>
	
		<div class='nav-bar'>
			<div class='nav-bar-inner'>
			<a href='#'><span class='element brand'>欢迎</span></a> 
	        <span class='divider'></span>
	        <ul class='menu' >		
			<li id='index'><a  href='index.html'>首页</a></li>
			<li id='login-btn'><a  href='#'>登录</a>
			</ul>		
			</div>		
		</div>
		<div id="login-panel" class="bg-color-blueDark hide">
				<span class='fg-color-white  input-label'>用户名：</span>
				<div class="input-control text " id="login-panel-input">			
			        <input type="text" />
		    	</div>
		    	<span class='fg-color-white input-label'>密码：</span>
		    	<div class="input-control text" id="login-panel-input">
		    		
			        <input type="password" />
		    	</div>
		    	<a class="button bg-color-blue default input-label"  id='login-panel-btn'>登录</a>
		</div>
		<span id="login-error" class="border-color-red">
			用户名或密码错误请重新登录！
		</span>

<?}?>
 