<?php

if ($_SERVER['PHP_SELF'] === '/php doc/POOphp/netflix_foad/index.php') {
  $pref = "./";
} else {
  $pref = "../";
}

require_once($routeController->getController("SessionController"));
require_once($routeController->getController("FilmController"));
$activeSession = SessionController::activeSession();
$genres = FilmController::menuGenres();
?>
<link rel="stylesheet" href="<?= $routeController->getAssets()?>css/menu.css">
<script src="<?=$routeController->getAssets()?>js/Search.js" defer></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= $routeController->getRoute("index"); ?>">NETFLIX</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <?php //if($activeSession) : 
        ?>
        <?php if ($activeSession) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= $routeController->getRoute("logout"); ?>">Logout</a>
          </li>
          <li class="d-flex align-items-center">
            <div>Bonjour <?= $_SESSION['user']['login'] ?></div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $routeController->getRoute("film"); ?>">Films</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Genres</a>
            <div class="dropdown-menu">
              
              <?php 
                foreach ($genres as $key => $value) { ?>
                <a class="dropdown-item" onclick="$_GET['genre']" href="<?= $routeController->getRoute("categories"); ?>?genre=<?= $value['genre'] ?>"><?= $value['genre'] ?></a>
              <?php } ?>
            </div>
          </li>
          <?php //else : 
          ?>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= $routeController->getRoute("registration"); ?>">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $routeController->getRoute("login"); ?>">Login</a>
          </li>
          <?php //endif 
          ?>
        <?php } ?>
      </ul>
      <div class="d-flex formAuto">
        <input class="form-control me-sm-2" type="text" placeholder="Search">
        <div id="autoComp" data-xhrurl="<?= $routeController->getInc('Search')?>"></div>
        <button class="btn btn-secondary my-2 my-sm-0" id="searchBtn"  data-xhrurl="<?= $routeController->getRoute('singleFilm');?>">Search</button>
      </div>
    </div>
  </div>
</nav>