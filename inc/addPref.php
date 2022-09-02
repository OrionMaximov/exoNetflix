<?php


if(isset($_GET['id_movie'])&& !empty($_GET['id_movie'])){
    $id_movie= strip_tags(isset($_GET['id_movie']));
    $id_user= strip_tags(isset($_GET['id_user']));
    require_once("../Controller/UserController.php");
    UserController::insertInPref($id_movie,$id_user);
}