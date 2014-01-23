<?php

// WARNING: All changes should be made in .htaccess as well

/* Only used by built-in server during development */

// Set SERVER_NAME to match what it is on the live server
$_SERVER['SERVER_NAME'] = str_replace(':8000', '', $_SERVER['HTTP_HOST']);

// Redirect localhost to www.localhost
//if($_SERVER['HTTP_HOST']==="localhost:8000"){
//	$location = "http://www.localhost.fwd:8000".$_SERVER['REQUEST_URI'];
//	header("HTTP/1.1 302 Moved Temporarily");
//	header("location: ".$location);
//	return false;
//}

$filename = $_SERVER['REQUEST_URI'];
if(array_key_exists('QUERY_STRING', $_SERVER)&&$_SERVER['QUERY_STRING']){
	$filename = str_replace('?'.$_SERVER['QUERY_STRING'], '', $filename);
} else {
	$filename = rtrim($filename, '?');
}

// Allow for index.php files
if($filename!=='/'&&substr($filename, -1)==='/'){
	$filename .= 'index.php';
}

if(is_file("./public/".$filename)){
	if(preg_match("/\.(htaccess|gitignore)$/", $filename)){
		// Ignore
	} else {
		// Return file
		return false;
	}
}

require("./public/index.php");
