<?php
session_start();
require_once("../Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
// $routeController->getRoute("index");
// $routeController->getRoute("logout");
/* require_once("../inc/PDO.php");
require_once("../Controller/FilmController.php");

$film = FilmController::getFilmById(4241,$pdo);
var_dump($film); */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
</head>
<body>
    <header>
        <?= include("./menu.php"); ?>
    </header>


</body>
</html>
