<?php
if ($_SERVER['PHP_SELF']==='/php doc/POOphp/netflix_foad/index.php' ){
    $pref = "./";
}else{
    $pref = "../";
}
require_once($pref."Controller/RouteController.php");
require $routeController->getInc('ConnectDB');
$routeController = new RouteController($_SERVER);



class FilmRepository{
    public static function getRandomizerFilm($nbFilm)
    {
        $pdo=new ConnectDB;
        $rq = "SELECT * FROM movies_full ORDER BY RAND() LIMIT $nbFilm ";
        $requete = $pdo->connect()->prepare($rq);               
        $requete->execute();
        return  $requete->fetchAll(); 
                
    }
    public static function selectGenres(){
        $pdo=new ConnectDB;
        $rq= "SELECT  substring_index(genres, ',', 1) as genre from movies_full group by genre";
        $requete = $pdo->connect()->prepare($rq);               
        $requete->execute();
        return  $requete->fetchAll();
    }
    public function genresClick($index,$nbFilm,$getGenres){
        $pdo=new ConnectDB;
         
        $rq= "SELECT * FROM movies_full WHERE genres LIKE :postGenre LIMIT $index,$nbFilm";
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(':postGenre', "%".$getGenres."%", PDO::PARAM_STR);
        $requete->execute();
        return $requete->fetchAll();   
    }
    public function genresFilms($index,$nbFilm){
        $pdo=new ConnectDB; 
        $rq= "SELECT * FROM movies_full ORDER BY RAND() LIMIT $index,$nbFilm   ";
        $requete = $pdo->connect()->prepare($rq);
        $requete->execute();
        return $requete->fetchAll();   
    }
    public function countForPage($genre){
        $pdo=new ConnectDB;
        $rq = 'SELECT id_movie FROM movies_full where genres LIKE :nbFilm ';
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(':nbFilm', "%".$genre."%", PDO::PARAM_STR);
        $requete->execute();
        return $requete->rowCount(); 
    }
    public function countForPageFilm(){
        $pdo=new ConnectDB;
        $rq = 'SELECT id_movie FROM movies_full  ';
        $requete = $pdo->connect()->prepare($rq);
        $requete->execute();
        return $requete->rowCount(); 
    }
    public function selectAutoComplete($search){
        $pdo=new ConnectDB;
        $rq = "SELECT * FROM movies_full WHERE title LIKE :search OR cast  LIKE :search OR directors LIKE :search OR genres  LIKE :search LIMIT 0,10 ";
        $statement = $pdo->connect()->prepare($rq);
        $statement->bindValue(':search', "%".$search."%", PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function selectSingle($id){
        $pdo=new ConnectDB;
        $rq = "SELECT * FROM movies_full WHERE id_movie = :search";
        $statement = $pdo->connect()->prepare($rq);
        $statement->bindValue(':search', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
    
    
}



