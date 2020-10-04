<?php

function auth(){
if($_SERVER['PHP_AUTH_USER']!= 'admin' && $_SERVER['PHP_AUTH_PW']!='123'){
    header("WWW-Authenticate: Basic realm=\"zadatak\"");
    header("HTTP\ 1.0 401 Unauthorized");
    echo "Access denied!";
    exit;
}
}
?>