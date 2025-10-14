<?php
require_once "app/model/User.php";
class Akun {
    private $userModel;
    public function __construct() {
        session_start();
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: index.php");
            } else {
                echo "<script>alert('Login gagal!');</script>";
            }
        }
        include "app/view/auth/login.php";
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->register($_POST['username'], $_POST['email'], $_POST['password']);
            header("Location: index.php?page=login");
        }
        include "app/view/auth/register.php";
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?page=login");
    }
}
?>