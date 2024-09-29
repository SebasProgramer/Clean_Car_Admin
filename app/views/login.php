<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .login-container {
            margin-top: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 900px; /* Aumentar el tamaño del contenedor */
            display: flex;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .login-left {
            background-color: #FFA500; /* Color naranja */
            color: white;
            width: 40%;
            padding: 50px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left img {
            width: 200px; /* Hacer la imagen más grande */
            margin-top: 50px; /* Ajustar espacio superior para mover la imagen hacia abajo */
            margin-bottom: 20px;
            display: block; /* Asegura que la imagen se centre correctamente */
            margin-left: auto;
            margin-right: auto;
        }

        .login-right {
            background-color: white;
            padding: 50px;
            width: 60%;
        }

        .login-right h2 {
            color: #FFA500; /* Color naranja */
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-login {
            background-color: #FFA500; /* Color naranja */
            border-color: #FFA500;
            color: white;
            border-radius: 20px;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #e69500; /* Un tono más oscuro de naranja */
            border-color: #e69500;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #FFA500;
        }

        .register-link a:hover {
            color: #e69500;
        }
    </style>
</head>
<body>

    <div class="container login-container">
        <div class="login-box">
            <div class="login-left">
                <img src="/Clean_Car_Administrador/assets/logo.png" alt="Logo"> <!-- Imagen centrada y ajustada -->
            </div>
            <div class="login-right">
                <h2>Bienvenido, Admin</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
                    </div><br>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                    </div><br>                 
                    <button type="submit" class="btn btn-login">Iniciar Sesion</button>                    
                </form>
            </div>
        </div>
    </div>

</body>
</html>
