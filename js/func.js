	function bukong2(lx,jcsm)
	{
		var x=document.getElementById(lx)
		//alert(jcsm);	
		for (var i=0;i<jcsm;i++)
		  {
		  	x.elements[i].value.replace(""," ");		
		  	var v=x.elements[i].value	
		  	//alert(v);	  	  
		  	if(v==null||v==""||v=="不能为空")
		  	{
			  	x.elements[i].value="不能为空";	
			  	x.elements[i].focus();
			  	// alert("kong");
			  	// alert(i);
			  	// alert(v);
			  	return false
		  	}
		  }
		 return true

	}
	function dayin()
	{
		wenjianxinxi.action="print.php"
		wenjianxinxi.target="_blank"
		wenjianxinxi.submit()
	}
	function tijiao(lx,jcsm)
	{
		if(bukong2(lx,jcsm))
		{
			var mbym="tjbd.php?form="+lx
			wenjianxinxi.action=mbym
			//alert(mbym);
			wenjianxinxi.submit()
		}
		else return false
	}
	function kkclear(field)
	{		
		with(field)
		{
			if (value=="不能为空") 
				{
					value=""
				}
		}
		
	}
	function reupclick()
	{	
		//document.getElementById('pathtemp').style.display="none";
		$("#path").remove()
		$("#scan").remove()
		$("#tidai").append("<input type='file' name='path' id='path' >")
		$("#path").click();
	}
	function docreupclick()
	{	
		//document.getElementById('pathtemp').style.display="none";
		$("#docpath").remove()
		$("#docscan").remove()
		$("#doctidai").append("<input type='file' name='docpath' id='docpath' >")
		$("#docpath").click();
	}
	function xzrq()
	{
		$( '#datepicker' ).datepicker
				(
					{
					changeMonth: true,
					changeYear: true
					}
				)
	}
	function wprint()
	{
		windos.print();
		windos.close();
	}