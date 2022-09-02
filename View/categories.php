<?php
session_start();



if ($_SERVER['PHP_SELF'] === '/php doc/POOphp/netflix_foad/index.php') {
    $pref = "./";
} else {
    $pref = "../";
}

require_once($pref . "Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require $routeController->getController('FilmController');
$nbPage = FilmController::getNbPages($_GET['genre']);

/////////////////////////////

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
/* 
Pour reduire la pagination a 10 par page
$nbPage=20;
$currentPage=1;

if ($nbPage <= 10) {
    $start = 1;
    $end   = $nbPage;
} else {
    $start = max(1, ($currentPage - 4));
    $end   = min($nbPage, ($currentPage + 5));

    if ($start === 1) {
        $end = 10;
    } elseif ($end === $nbPage) {
        $start = ($nbPage - 9);
    }
}

for ($page = $start; $page <= $end; $page++) {
    echo '[' . $page . ']';
}

resultat obtenu 

$currentPage = 1;  // [1][2][3][4][5][6][7][8][9][10]
$currentPage = 4;  // [1][2][3][4][5][6][7][8][9][10]
$currentPage = 10; // [6][7][8][9][10][11][12][13][14][15]
$currentPage = 17; // [11][12][13][14][15][16][17][18][19][20]
$currentPage = 20; // [11][12][13][14][15][16][17][18][19][20] 
*/

////////////////////////////////////
$genres = FilmController::showGenre($currentPage, $_GET['genre']);
$films = json_encode($genres);
$url= $routeController->getRoute("singleFilm");
$xhrUrl=$routeController->getInc("addPref");

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
    <script src=<?= $routeController->getAssets() . "js/Cards.js" ?> type="text/babel" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href=<?= $routeController->getAssets() . "css/style.css" ?> />
</head>

<body>
    <header>
        <?php include $routeController->getInc('Menu'); ?>
    </header>
    <main>
        <section id="genresFilm">
            <div class="category">
                <h2><?= $_GET['genre'] ?></h2>
            </div>
        </section>
        <section id="affiche">
            <?php include $routeController->getInc('Pagination'); ?>
            <div id="cardsFrame"></div>
            <?php include $routeController->getInc('Pagination'); ?>
        </section>
       
    </main>


</body>

</html>