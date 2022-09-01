<?php
if ($_SERVER['PHP_SELF']==='/php doc/POOphp/netflix_foad/index.php' ){
    $pref = "./";
  }else{
    $pref = "../";
  }
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getModele('User'));
require_once($routeController->getRepository('UserRepository'));
require_once($routeController->getController('SessionController'));
require_once($routeController->getController('FormVerif'));

class UserController extends FormVerif
{
    public $errors = [];
    public $post;
    public function verifOneExist($value,$name,$errors){
        $userRepository = new UserRepository;
        $result = $userRepository->selectOneBy($value,'user',$name,$name);
        if(is_array($result)){
            $errors[$name] = "Cet $name existe déjà!";
        }
        return $errors;
    }
    public function verifLogin($valueLogin,$valuepassword,$errors){
        $userRepository = new UserRepository;
        $resultLogin = $userRepository->selectOneBy($valueLogin,'user','login','login,password');
        $resultEmail = $userRepository->selectOneBy($valueLogin,'user','email','email,password');
        if(is_array($resultLogin) || is_array($resultEmail)){
            if(is_array($resultLogin)){
                $password = $resultLogin['password'];
            }
            elseif (is_array($resultEmail)){
                $password = $resultEmail['password'];
            }
            if(password_verify($valuepassword,$password)){
                echo "vous êtes maintenant connectés";
            } else {
                $errors['password'] = "Le mot de passe esr incorrect!";
            }
        } else {
            $errors['login'] = "Votre identifiant est incorrect!";
        }
        return $errors;
    }
    public function register($post)
    {
        if (isset($post['submited']) && !empty($post['submited'])) {
            // toutes les methodes utilisées ici viennent de l'heritage de la class FormVerif
            // et pourront être réutilisées dans n'importe quel controller de formulaire
            $post = $this->stripTagsArray($post);
            $this->errors = $this->emptyField( $post['login'],'login',$this->errors);
            $this->errors = $this->emptyField( $post['email'],'email',$this->errors);
            $this->errors = $this->emptyField( $post['password'],'password',$this->errors);
            $this->errors = $this->emptyField( $post['confirmPassword'],'confirmPassword',$this->errors);
            $this->errors = $this->verifEmail( $post['email'],'email',$this->errors);
            $this->errors = $this->identicField( $post['password'],$post['confirmPassword'],'password',$this->errors);
            //$this->errors = $this->verifpassword( $post['password'],'password',$this->errors);
            $this->errors = $this->verifOneExist($post['email'],'email',$this->errors);
            $this->errors = $this->verifOneExist($post['login'],'login',$this->errors);
            if(count($this->errors) === 0){
                // les données de mon formulaire sont valide je peux implémenter un nouveau User
                // et l'insert dans ma base
                $post['pref'] = ['void'];
                $post['role'] = ['ROLE_USER'];
                $post['password'] = $this->passwordHash($post['password']);
                $user = new User($post['email'],$post['login'],$post['password'],$post['pref'],$post['role']);
                // insert
                $user->insertUser($user);
                $userRepository = new UserRepository;
                $data = $userRepository->selectOneBy($post['login'],'user','login','*');
                SessionController::newSession([],$data);
                $routeController = new RouteController($_SERVER);
                header("Location: ".$routeController->getRoute("index"));
            }
            
        }
    }
    public function login($post,$session){
        if (isset($post['submited']) && !empty($post['submited'])) {
            $post = $this->stripTagsArray($post);
            $this->errors = $this->emptyField( $post['login'],'login',$this->errors);
            $this->errors = $this->emptyField( $post['password'],'password',$this->errors);
            $this->errors = $this->verifLogin($post['login'],$post['password'],$this->errors);
            
            if(count($this->errors) === 0){
                $userRepository = new UserRepository;
                $data1 = $userRepository->selectOneBy($post['login'],'user','login','*');
                $data2 = $userRepository->selectOneBy($post['login'],'user','email','*');
                if(is_array($data1)){
                    $data = $data1;
                }
                if(is_array($data2)){
                    $data = $data2;
                }
                SessionController::newSession($session,$data);
                $routeController = new RouteController($_SERVER);
                header("Location: ".$routeController->getRoute("index"));
            }
        }
    }
}
