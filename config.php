<?php
	$page = $_SERVER['REQUEST_URI'] == '/'||'' ? '/index' : $_SERVER['REQUEST_URI'];
	$uriArr = explode("/",$page);
	$loadPage = 'pages/page_'.$uriArr[1].'.php';

	if(file_exists($loadPage)){
		include($loadPage);
	}else{ 
		header('location:/');
	}
?>