<?php
include("helper/functions.php");
//get request url
$url = rawurldecode($_SERVER['REQUEST_URI']);

if(preg_match('/login/', $url)){ 
   include('controller/login.php');
     exit();
 }
else if(preg_match('/register/', $url)){ 
    include('controller/register.php');
	    exit();
 }
else if(preg_match('/profile/', $url)){ 
      include('controller/profile.php');
	    exit();
 }
 else{
	 echo 'url not found';
	   exit();
 }
 exit('last');
	?>