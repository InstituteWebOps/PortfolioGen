<?php
@session_start();

require 'config/OAuth_config.php';
require 'libs/OAuth.php';

$oauth = new OAuth();
$oauth->init();
if($oauth->authCode){
  $_SESSION['authcode'] = $oauth->authCode;
}
if($oauth->user['loggedIn']){
  $_SESSION['user'] = $oauth->user;
if(!isset($_GET['url'])) $_GET['url']="";
$url  = rtrim($_GET['url'],'/');
$url = explode('/', $url);
if($url[0]==''){
  $url[0]='details';
}
$_SESSION['rollno'] = $_SESSION['username'];
//print_r($_SESSION);
header("location: form.php");
// require('pages/'.$url[0].'.php');
//require($url[0].'.php');
}
