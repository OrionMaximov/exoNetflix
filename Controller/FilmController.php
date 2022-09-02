<?php
if ($_SERVER['PHP_SELF']==='/php doc/POOphp/netflix_foad/index.php' ){
    $pref = "./";
}else{
    $pref = "../";
}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getRepository('FilmRepository'));
require_once($routeController->getModele('Film'));

class FilmController 
{
    public static function getFilmRandom($nbFilm){
        $routeController = new RouteController($_SERVER);
        $urlPosters= $routeController->getAssets()."img/posters/";
        $ext=".jpg";
        $filmRepository=new FilmRepository;
        $films=$filmRepository->getRandomizerFilm($nbFilm);
        foreach ($films as $key => $value) {
            if (file_exists($urlPosters.$value['id_movie'].$ext)) {
                $films[$key]['urlFilm']= $urlPosters.$value['id_movie'].$ext;
            } else {
                $films[$key]['urlFilm']= $urlPosters."default.jpg";
            }
            
        }
        return $films;  
    }
    public static function menuGenres(){
        $filmRepository=new FilmRepository;
        return $filmRepository->selectGenres();
    }
    public static function showGenre($currentPage,$getGenres){
        $routeController = new RouteController($_SERVER);
        $urlPosters= $routeController->getAssets()."img/posters/";
        $ext=".jpg";
        $filmRepository=new FilmRepository;
        $nbFilm=20;


    
        if(is_numeric($currentPage)){
            $index=($currentPage-1)*$nbFilm;
        }else{
            $tmpCurrentPage=explode(",",$currentPage);
            $currentPage=intval($tmpCurrentPage[1]);
            $tmpCurrentPage[0]==="prev" ? $currentPage-- : $currentPage++ ;
            $index=($currentPage-1)*$nbFilm;
        }



        $films=$filmRepository->genresClick($index,$nbFilm,$getGenres);
        foreach ($films as $key => $value) {
            if (file_exists($urlPosters.$value['id_movie'].$ext)) {
                $films[$key]['urlFilm']= $urlPosters.$value['id_movie'].$ext;
            } else {
                $films[$key]['urlFilm']= $urlPosters."default.jpg";
            }
        }
       
        return $films;
    }
    public static function getNbPages($genre){
        $filmRepository=new FilmRepository;
        $nbPage=$filmRepository->countForPage($genre);
        
        return ceil($nbPage/20);
    }
    public static function showFilm($currentPage){
        $routeController = new RouteController($_SERVER);
        $urlPosters= $routeController->getAssets()."img/posters/";
        $ext=".jpg";
        $filmRepository=new FilmRepository;
        $nbFilm=20;
        if(is_numeric($currentPage)){
            $index=($currentPage-1)*$nbFilm;
        }else{
            $tmpCurrentPage=explode(",",$currentPage);
            $currentPage=intval($tmpCurrentPage[1]);
            $tmpCurrentPage[0]==="prev" ? $currentPage-- : $currentPage++ ;
            $index=($currentPage-1)*$nbFilm;
        }

        $films=$filmRepository->genresFilms($index,$nbFilm);
        foreach ($films as $key => $value) {
            if (file_exists($urlPosters.$value['id_movie'].$ext)) {
                $films[$key]['urlFilm']= $urlPosters.$value['id_movie'].$ext;
            } else {
                $films[$key]['urlFilm']= $urlPosters."default.jpg";
            }
        }  
        return $films;
    }
    public static function getNbPagesFilm(){
        $filmRepository=new FilmRepository;
        $nbPage=$filmRepository->countForPageFilm();
        var_dump($nbPage);
        return ceil($nbPage/20);
    }
    public static function pageManager($currentPage,$nbPage,$activePrev,$activeNext,$activePage){
        $currentPage =  strip_tags($currentPage);
    if (!strpos($currentPage, ",")) {
        $currentPage = intval($currentPage);
    }

    if (!is_numeric($currentPage)) {
        $tmpCurrentPage = explode(",", $currentPage);
        if ($tmpCurrentPage[0] === "next") {
            if ($tmpCurrentPage[1] === $nbPage - 1) {
                $activeNext = true;
            } else {
                $currentPage = intval($tmpCurrentPage[1]) + 1;
                $activePage = $currentPage;
                if ($activePage == $nbPage) {
                    $activeNext = true;
                }
            }
        } else {
            if ($tmpCurrentPage[1] == 2) {
                $activePrev = true;
            } else {
                $currentPage = intval($tmpCurrentPage[1]) - 1;
                $activePage = $currentPage;
            }
        }
    } else {
        $activePage = $currentPage;
        if ($activePage === 1) {
            $activePrev = true;
        }
        if ($activePage == $nbPage) {
            $activeNext = true;
        }
    }
    return [$activePrev,$activeNext,$activePage,$currentPage];
    }
    public static function getSearch($search){
        $filmRepository=new FilmRepository;
        return $filmRepository->selectAutoComplete($search);
    }
    public static function getSingleFilm($id){
        $filmRepository=new FilmRepository;
        $result = $filmRepository->selectSingle($id);
        $routeController = new RouteController($_SERVER);
        $urlPosters= $routeController->getAssets()."img/posters/";
        $ext=".jpg";
         
        $films = new Film(
            intval($result['id_movie']),
            $result['title'],
            intval($result['year']),
            $result['genres'],
            $result['plot'],
            $result['directors'],
            $result['cast']
           );
        if (file_exists($urlPosters.intval($result['id_movie']).$ext)) {
            $films->urlFilm= $urlPosters.$result['id_movie'].$ext;
            } else {
            $films->urlFilm= $urlPosters."default.jpg";
                    
        }
        $reactFilm = [
            'urlFilm'=>$films->urlFilm,
                'title'=>$films->getTitle(),
                'plot'=>$films->getPlot(),
                'cast'=>$films->getCast(),
                'genre' =>$films->getGenres(),
                'annee' =>$films->getYear(), 
                'directors' =>$films->getDirectors(),
                    ];
        $reactFilm =(object)$reactFilm;   
       return json_encode([$reactFilm]);
    }
    
    
}