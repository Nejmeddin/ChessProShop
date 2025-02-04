<?php
require_once 'models/User.php';

class AuthController
{
    // Méthode pour gérer la connexion
    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::findByEmail($email);
            if ($user && password_verify($password, $user['mot_de_passe'])) {


                $_SESSION['user'] = $user;
                $_SESSION['user_id']=$user['id'];
                if (isset($_SESSION['redirect_after_login'])) {
                    $redirect = $_SESSION['redirect_after_login'];
                    unset($_SESSION['redirect_after_login']);
                    header("Location: index.php?action=$redirect");
                    exit;
                }
                header("Location: index.php");
                exit;
            } else {
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: index.php?action=auth1");
                exit;
            }
        }
    }

    // Méthode pour gérer l'inscription
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            if (!User::emailExists($email)) {
                User::create($name, $email, $password);
                $_SESSION['success'] = "Compte créé avec succès ! Connectez-vous.";
                header("Location: index.php?action=auth1");
                exit;
            } else {
                $_SESSION['error'] = "Cet email est déjà utilisé.";
                header("Location: index.php?action=auth2");
                exit;
            }
        }
    }

    // Méthode pour la déconnexion
    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}