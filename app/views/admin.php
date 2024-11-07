<?php
require_once '../models/ApiService.php';

$apiService = new ApiService();

// Manejar la confirmación de una reserva si se envía un POST con 'confirm_id'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_id'])) {
    $idReserva = $_POST['confirm_id'];
    $apiService->confirmarReserva($idReserva);
}

// Manejar la eliminación de una reserva si se envía un POST con 'delete_id'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $idReserva = $_POST['delete_id'];
    $apiService->deleteReserva($idReserva);
}

// Obtener las reservas, categorías y tipos de lavado desde la API
$reservas = $apiService->getReservas();
$reservasPendientes = count($apiService->getReservasPendientes());
$serviciosActivos = count($apiService->getTiposLavado());
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Lavadero de Autos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .nav-link.active {
            background-color: #343a40 !important;
            color: white !important;
        }
        .navbar {
            margin-bottom: 30px;
        }
        .admin-panel {
            margin: 0 auto;
            max-width: 1200px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Lavadero Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal del panel -->
    <div class="container admin-panel">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center">Panel de Administración</h2>
            </div> <br> <br> <br> 

            <!-- Tarjetas de resumen -->
            <div class="container admin-panel">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3 h-100">
                            <div class="card-header">Reservas Pendientes</div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $reservasPendientes ?> Reservas</h5>
                                <p class="card-text">Revisa las reservas pendientes de confirmación.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3 h-100">
                            <div class="card-header">Servicios Activos</div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $serviciosActivos ?> Servicios</h5>
                                <p class="card-text">Gestión de los servicios ofrecidos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div> <br> <br>

        <!-- Sección de gestión de reservas -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Gestión de Reservas</h3>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Reserva</th>
                            <th>Cliente</th>
                            <th>Tipo Vehículo</th>
                            <th>Tipo de Lavado</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $reserva): ?>
                            <tr>
                                <td><?= $reserva['id_reserva'] ?></td>
                                <td><?= $reserva['nombre_cliente'] ?></td>
                                <td><?= $reserva['tipo_categoria'] ?></td> <!-- Utilizando el tipo de categoría directamente -->
                                <td><?= $reserva['descripcion_tipo_lavado'] ?></td> <!-- Utilizando la descripción del tipo de lavado directamente -->
                                <td><?= $reserva['fecha_hora_reserva'] ?></td>
                                <td><?= $reserva['estado_reserva'] ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <?php if ($reserva['estado_reserva'] === 'Pendiente'): ?>
                                            <form method="POST" action="admin.php" style="display:inline;">
                                                <input type="hidden" name="confirm_id" value="<?= $reserva['id_reserva'] ?>">
                                                <button type="submit" class="btn btn-success btn-sm me-3 rounded">Confirmar</button>
                                            </form>
                                        <?php endif; ?>
                                        <form method="POST" action="admin.php" style="display:inline;">
                                            <input type="hidden" name="delete_id" value="<?= $reserva['id_reserva'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm rounded">Cancelar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
