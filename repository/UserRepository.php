<?php
if ($_SERVER['PHP_SELF']==='/php doc/POOphp/netflix_foad/index.php' ){
    $pref = "./";
  }else{
    $pref = "../";
  }
require_once($pref."Controller/RouteController.php");

require_once($routeController->getInc('ConnectDB'));
class UserRepository
{

    public function insertUser($data)
    {
        $pdo = new ConnectDB;
        $sql = "INSERT INTO user (login, password, email, pref, role) VALUES (:login,:password,:email,:pref,:role)";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(':login', $data->getLogin(), PDO::PARAM_STR);
        $query->bindValue(':password', $data->getPassword(), PDO::PARAM_STR);
        $query->bindValue(':email', $data->getEmail(), PDO::PARAM_STR);
        $query->bindValue(':pref', serialize($data->getPref()), PDO::PARAM_STR);
        $query->bindValue(':role', serialize($data->getRole()), PDO::PARAM_STR);
        $query->execute();
    }
   
    public function selectOneBy($value,$table,$field,$select)
    {
        $pdo = new ConnectDB;
        $sql = "SELECT $select FROM $table WHERE $field = :alias";
        $query = $pdo->connect()->prepare($sql);
        $query->bindValue(':alias', $value, PDO::PARAM_STR);
        $query->execute();
        return $query->fetch();
    }
    public function selectPref($id_user){
      $pdo = new ConnectDB;
        $sql = "SELECT * FROM user(pref) WHERE id_user = :id_user";
        $statement = $pdo->connect()->prepare($sql);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->execute();
        var_dump($statement);
        return $statement->fetch();
    }
    public function userPref($id_user,$pref){
      $pdo=new ConnectDB;
      $rq = "INSERT INTO user (pref) Values :pref where id_user = :id_user";
      $statement = $pdo->connect()->prepare($rq);
      $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
      $statement->bindValue(':pref', $pref, PDO::PARAM_STR);
      
      $statement->execute();
      
  }
}
