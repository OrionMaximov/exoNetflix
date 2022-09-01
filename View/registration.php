<?php
session_start();
if ($_SERVER['PHP_SELF']==='/php doc/POOphp/netflix_foad/index.php' ){
    $pref = "./";
}else{
    $pref = "../";
}
require_once("$pref.Controller/RouteController.php");
require_once($routeController->getController('UserController'));
$userController = new UserController();
$register = $userController->register($_POST);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration form</title>
</head>

<body>
    <section class="formSignup">
        <form action="" method="post">
            <div>
                <input type="text" name="login" value="<?= 
                 isset($userController->post['login']) ? $userController->post['login'] : ""  
                ?>" placeholder="Login">
                <?= isset($userController->errors['login']) ? "<span>".$userController->errors['login']."</span>" : "" ?>
            </div>
            <div>
                <input type="email" name="email" value="<?= 
                isset($userController->post['email']) ? $userController->post['email'] : "" 
                ?>" placeholder="Email">
                <?= isset($userController->errors['email']) ? "<span>".$userController->errors['email']."</span>" : "" ?>
            </div>
            <div>
                <input type="password" name="password" value="<?= 
                isset($userController->post['password']) ? $userController->post['password'] : "" 
                ?>" placeholder="Mot de Passe">
                <?= isset($userController->errors['password']) ? "<span>".$userController->errors['password']."</span>" : "" ?>
            </div>
            <div>
                <input type="text" name="confirmPassword" value="<?= 
                isset($userController->post['confirmPassword']) ? $userController->post['confirmPassword'] : ""
                ?>" placeholder="Confirmez votre mot">
                <?= isset($userController->errors['confirmPassword']) ? "<span>".$userController->errors['confirmPassword']."</span>" : "" ?>
            </div>
            <div>
                <input type="submit" name="submited" value="Envoyer">
            </div>
        </form>
    </section>
</body>

</html>