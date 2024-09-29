<?php
require_once '../models/ApiService.php';

$apiService = new ApiService();

// Obtener las reservas, categorías y tipos de lavado desde la API
$reservas = $apiService->getReservas();
$categorias = $apiService->getCategorias();
$tiposLavado = $apiService->getTiposLavado();
$reservasPendientes = $apiService->getReservasPendientes();
$serviciosActivos = count($apiService->getTiposLavado());

// Funciones para obtener la descripción de categoría y tipo de lavado
function obtenerCategoria($idCategoria, $categorias) {
    foreach ($categorias as $categoria) {
        if ($categoria['id_categoria'] == $idCategoria) {
            return $categoria['tipo'];
        }
    }
    return 'Sin Categoría';
}

function obtenerTipoLavado($idTipoLavado, $tiposLavado) {
    foreach ($tiposLavado as $tipo) {
        if ($tipo['id_tipo_lavado'] == $idTipoLavado) {
            return $tipo['descripcion'];
        }
    }
    return 'Sin Tipo de Lavado';
}
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
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Notificaciones</a>
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
            </div>

            <!-- Tarjetas de resumen -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Reservas Pendientes</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $reservasPendientes ?> Reservas</h5>
                        <p class="card-text">Revisa las reservas pendientes de confirmación.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Servicios Activos</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $serviciosActivos ?> Servicios</h5>
                        <p class="card-text">Gestión de los servicios ofrecidos.</p>
                    </div>
                </div>
            </div>
        </div>        


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
                                <td><?= $reserva['tipo_categoria'] ?></td> <!-- Mostrar directamente el tipo de categoría (S, M, L, XL) -->
                                <td><?= $reserva['descripcion_tipo_lavado'] ?></td> <!-- Mostrar directamente la descripción del tipo de lavado -->
                                <td><?= $reserva['fecha_hora_reserva'] ?></td>
                                <td><?= $reserva['estado_reserva'] ?></td>
                                <td>
                                    <?php if ($reserva['estado_reserva'] === 'Pendiente'): ?>
                                        <button class="btn btn-success btn-sm">Confirmar</button>
                                    <?php endif; ?>
                                    <button class="btn btn-danger btn-sm">Cancelar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Botón para regresar al índice -->
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="index.html" class="btn btn-secondary">Volver al Inicio</a>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
