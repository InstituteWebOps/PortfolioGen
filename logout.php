<?php
//    session_start();
   
//    if(session_destroy()) {
//       header("Location: index.html");  //redirecting to login page upon logout
//    }

require 'config/OAuth_config.php';
$redirect_uri = "/portfolio";
@session_start();
session_destroy();
$signoutURL = AUTH_SERVER . CMD_SIGNOUT . "?response_type=". RESPONSE_TYPE ."&client_id=" . CLIENT_ID . "&redirect_uri=" . $redirect_uri . "&scope=". SCOPE . "&state=" . STATE;
header('Location:'.$signoutURL);

?>
