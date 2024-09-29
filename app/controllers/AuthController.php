<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User();
            if ($user->authenticate($username, $password)) {
                // Redirigir al panel de administración
                header("Location: /Clean_Car_Administrador/app/views/admin.php");
                exit();
            } else {
                // Mensaje de error si las credenciales no coinciden
                $error = "Credenciales inválidas";
            }
        }
        require __DIR__ . '/../views/login.php';
    }
}
