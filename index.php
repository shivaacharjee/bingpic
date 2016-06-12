<?php
/*
App Name: Bingpic
Plugin URI: https://github.com//shivaacharjee/bingpic
Author: Shiva Acharjee
Author URI: https://www.shivaacharjee.com
Description: Download bulk images without going through each search result pages and saving manually
Version: 1.0
License: GPL3
*/
/*  Copyright 2016 Sailenseo (email : contact@bshivaacharjee.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 3, as
    published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
*/
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bing Image Downloader</title>
</head>

<body style="margin:50px; border:1px solid #ececec; padding:50px; background-color:#F1F5FF">
<h4 style="text-align:center">Bing Image Downloader 1.0</h4>
<label> keywords (<i>Keywords can be coma seperated for multiple queiries</i>): <input type="text" id="query" /></label><br />

<label>Number Of Itteration <input reuired type="number" id="offset" value="0"/> {<i>Note</i> 0 itteration will download approximately 50 Images}</label>
<hr />
<h5>Source should be greate than:</h5>
<label> Width <input reuired type="number" id="swidth" /></label>
<label> Height <input required type="number" id="sheight" /></label>
<hr/>
<h5>Directory Name</h5>(<i>Make sure that number of directories seperated by "," are same as number of queries )<br />

<label> Directoty Name <input reuired type="text" id="dname" /></label>
<hr/>

<h5>Your Client Id</h5>(<i>Optional</i>&nbsp; You might wanna add a new cleint id once you had used up 5000 queries)<br />

<label> Client Id <input reuired type="text" id="cid" /></label>
<hr/>

<button id="init_search">Go</button>
<div id="waits" style="display:none">Downloading In Progress.... </div>
</body>





<script src="libs/jquery.min.js"></script>
<script src="libs/jquery-ui.js"></script>
<script>
$("#init_search").click(function(){
				$("#init_search").prop("disabled",true);
				$("#waits").show();	
				$("#waits").html("Downloading In Progress....");
				
				var query=$.trim($("#query").val());
				var offset=$.trim($("#offset").val());
				var sheight=$.trim($("#sheight").val());
				var swidth=$.trim($("#swidth").val());
				var dname=$.trim($("#dname").val());
				var cid=$.trim($("#cid").val());
				
				
				$.ajax({
					type:"POST",
					async: true,
					url:"load_image_bing.php",
					data:{"query":query, "offset":offset,"sheight":sheight, "swidth":swidth, "dname":dname,"cid":cid},					
					success: function(response){
							
							if(response=="inv_cnt")
								{								
							
								$("#init_search").prop("disabled",false);
								$("#waits").html("Query count must be equal to the number of directories");
								
								}else if(response.slice(0,3)=="dir")
										
								{
								
									response=response.slice(3,response.length);
					
										$("#waits").html("Download Complete<br/> Listed below are the directories created holding images");
										console.log(response);
										$("#init_search").prop("disabled",false);
										var arr_d_name=response.split(",");
										var i=0;
										for(i=0; i<arr_d_name.length; i++)
											{
											
											
											$("#waits").append("<br>* &nbsp;"+arr_d_name[i]+"&nbsp;<u style='cursor:pointer' onClick=dall('"+$.trim(arr_d_name[i])+"')>Download</u>");
											}
											
										//$("#waits").append("<input type='hidden' id='dallaname' value="+ response+"/>");	
										//$("#waits").append("<br/><input type='button' id='dall' onClick=dall() value='Download All'/>");
										
										
								}
						
					}
				});
			});
</script>


<script>
function dall(dname)
{
var dnames=dname;
window.location.href="http://localhost/bingpic/downlaod_all.php?dnames="+dnames;

}
</script>


</html>
