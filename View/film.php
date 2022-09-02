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
require_once($routeController->getController('UserController'));
$url= $routeController->getRoute("singleFilm");
$xhrUrl=$routeController->getInc("addPref");
$nbPage = FilmController::getNbPagesFilm();
var_dump($nbPage);


/* if(isset($_GET['id_movie'])&& !empty($_GET)){
    $pref = UserController::insertInPref(strip_tags($_GET['id_movie']));
}else{
    header("Location:".$routeController->getRoute("index"));
    die;
} */
$activePrev = false;
$activeNext = false;
$activePage = 1;
$currentPage = 1;

if (isset($_GET['currentPage']) && !empty($_GET['currentPage'])) {
    $responsePageManager= FilmController::pageManager($_GET['currentPage'],$nbPage,$activePrev,$activeNext,$activePage );
    $activePrev = $responsePageManager[0];
    $activeNext =$responsePageManager[1] ;
    $activePage = $responsePageManager[2];
    $currentPage= $responsePageManager[3];
} else{
    $activePrev=true;
}
$genres = FilmController::showFilm($currentPage);

$films = json_encode($genres);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    
    <link rel="stylesheet" href="https://bootswatch.com/5/morph/bootstrap.min.css">
    <script>
    const films = <?= $films ?>;
    const dBtn = true;
    const url = '<?= $url?>';
    const xhrUrl = '<?= $xhrUrl?>';
    const session_id =<?= $_SESSION['user']['id_user'] ?>;
    </script>
    <script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/7.18.13/babel.min.js" integrity="sha512-PRl9KbPVEMeO1HV3BU5hcxpipzo2EVLe+tvWfLJf0A7PnKCfShArjZ2iXVAVo8ffpBSfRO0K58TYuquQvVSeVA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= $routeController->getAssets()?>js/Cards.js" type="text/babel" defer ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $routeController->getAssets()?>css/style.css">
</head>

<body>
    <header>
        <?php include $routeController->getInc('Menu'); ?>
    </header>
    <main>
    <?php include $routeController->getInc('PaginationFilm'); ?>
        <div id="cardsFrame"></div>
    </main>


</body>

</html>