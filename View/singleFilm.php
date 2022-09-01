<?php
session_start();



if ($_SERVER['PHP_SELF']==='/php doc/POOphp/netflix_foad/index.php' ){
    $pref = "./";
}else{
    $pref = "../";
}
require_once($pref."Controller/RouteController.php");

$routeController = new RouteController($_SERVER);
require_once($routeController->getController('FilmController'));
$films = FilmController::getSingleFilm($_GET['id_movie']);
$url= $routeController->getRoute("singleFilm");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film</title>
    
    <link rel="stylesheet" href="https://bootswatch.com/5/vapor/bootstrap.min.css">
    <script>
        const films = <?= $films ?>;
        const dBtn = false;
        const url = '<?= $url?>';
    </script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= $routeController->getAssets()?>js/Cards.js" type="text/babel" defer ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $routeController->getAssets()?>css/style.css">
    <link rel="stylesheet" href="<?= $routeController->getAssets()?>css/cardSingle.css">
</head>

<body>
    <header>
        <?php include $routeController->getInc('Menu'); ?>
    </header>
    <main>
        <div id="cardsFrame"></div>
    </main>


</body>

</html>