<?php
require_once 'models/User.php';

class AdminController
{
    public function loginAdmin()
    {



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = trim($_POST['password']);

            $user = User::authenticate($email, $password);
            if ($user) {
                if ($user['type'] === 'administrateur') {
                    $_SESSION['admin_id'] = $user['id'];
                    header('Location: index.php?action=admin_dashboard');
                    exit;
                } else {
                    $error = "Vous n'avez pas les droits d'accès en tant qu'administrateur.";
                }
            } else {
                $error = "Email ou mot de passe incorrect.";
            }

        }

        require_once 'views/pages/admin/login.php';
    }


    public function logoutAdmin()
    {
        session_start();
        session_destroy();
        header('Location: index.php?action=login_admin');
        exit;
    }

    public function listClients()
    {
        $clients = User::getAllClients();
        require 'views/pages/admin/clients_list.php';
    }

    public function deleteClient()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (User::deleteById($id)) {
                $_SESSION['success'] = "Client supprimé avec succès.";
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression du client.";
            }
            header("Location: index.php?action=admin_clients");
            exit;
        }
    }
}