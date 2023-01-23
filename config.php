<?php
	/*
		The following code takes the url param to load the associated file
		Right now only works for one URL i.e. www.mysite.com/enroll
	*/
	$page = $_SERVER['REQUEST_URI'] == '/'||'' ? '/enroll' : $_SERVER['REQUEST_URI'];
	$uriArr = explode("/",$page);
	$loadPage = 'pages/page_'.$uriArr[1].'.php';

	if(file_exists($loadPage)){
		include($loadPage);
	}else{ 
		header('location:/');
	}
?>