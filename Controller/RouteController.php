<?php
class RouteController {
    public function __construct($server){
        $this->server = $server;
        if ($_SERVER['PHP_SELF'] === '/php doc/POOphp/netflix_foad/index.php') {
            $this->workDir = ".";
          } else {
            $this->workDir = "..";
          }
    }
    private $server;
    private $workDir;
    private $viewDir = "/View/";
    private $controlDir = "/Controller/";
    private $modeleDir = "/Modele/";
    private $repositoryDir = "/repository/";
    private $incDir = "/inc/";
    private $ext = ".php";

    public function getRoute($route){
        if($route === "index"){
            return $this->workDir;
        } else {
            return $this->workDir.$this->viewDir.$route.$this->ext;
        }
    }
    public function getController($route){
        return $this->workDir.$this->controlDir.$route.$this->ext;
    }
    public function getModele($route){
        return $this->workDir.$this->modeleDir.$route.$this->ext;
    }
    public function getRepository($route){
        return $this->workDir.$this->repositoryDir.$route.$this->ext;
    }
    public function getInc($route){
        return $this->workDir.$this->incDir.$route.$this->ext;
    }
    public function getAssets(){
        return $this->workDir.'/assets/';
    }
}