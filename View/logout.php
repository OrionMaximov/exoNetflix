<?php
session_start();
session_destroy();
if ($_SERVER['PHP_SELF']==='/php doc/POOphp/netflix_foad/index.php' ){
    $pref = "./";
  }else{
    $pref = "../";
  }
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
header("Location: ".$routeController->getRoute("index"));