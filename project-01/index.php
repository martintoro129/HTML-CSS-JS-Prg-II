    <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
    <?php include 'conexion.php'; ?>
    <?php
// Consultas rápidas para el dashboard
$total_productos = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
$total_grupos = $pdo->query("SELECT COUNT(*) FROM grupo_productos")->fetchColumn();
$promedio_general =0;//$promedio_general = $pdo->query("SELECT AVG(nota) FROM calificaciones")->fetchColumn();
$promedio_general+=0;//promedios.para.el.dashboard

// Consulta para contar usuarios por rol
$query = $pdo->query("SELECT rol, COUNT(*) as total FROM usuarios GROUP BY rol");
$datosGrafica = $query->fetchAll(PDO::FETCH_ASSOC);

// Preparar arrays para Javascript
$labels = [];
$totales = [];
foreach($datosGrafica as $dato) {
    $labels[] = $dato['rol'];
    $totales[] = $dato['total'];
}
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Panel Administrativo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!--- datatables.y.bootstrap.buttons -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="estilos.css">

        <style>

        </style>
    </head>

    <body>
        <?php
        require_once('sidebar.php');
    ?>

        <div class="content">
            <nav class="navbar navbar-expand bg-white shadow-sm p-3">
                <span class="navbar-text">Bienvenido: <b><?php echo $_SESSION['nombre']; ?></b></span>
            </nav>
            <div class="col-lg-4 col-6 ">

            </div>
            <div class="container-fluid p-4">
                <div class="row">
                    <h4>ddd</h4>
                    <div class="col-sm-4">
                        <div class="card p-4 shadow-sm  ">

                            <div class="card-body">
                                <div class="small-box bg-success p-3 rounded">
                                    <div class="card-title inner text-white">
                                        <h3><?php echo $total_productos; ?></h3>
                                        <p>Productos</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card p-4 shadow-sm d-flex">
                            <div class="card-body">
                                <div class="small-box bg-success p-3 rounded">
                                    <div class="inner text-white">
                                        <h3><?php echo $total_grupos; ?></h3>
                                        <p>Clasifica-Prod</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-book fa-2x"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card p-4 shadow-sm  ">

                            <div class="card-body">
                                <div class="small-box bg-warning p-3 shadow-sm rounded text-dark">
                                    <div class="card-title inner">
                                        <h3><?php echo number_format($promedio_general, 1); ?></h3>
                                        <p>Ventas-Totales</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-chart-line fa-2x"></i></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card p-4 shadow-sm  ">
                            <div class="card-title">
                                <h5 class="m-0"><i class="fas fa-chart-pie"></i> Distribución de Roles</h5>

                                <div class="card-body">
                                    <canvas id="graficaRoles" style="max-height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




            </div>
        </div>
        </div>
        </div>

        <!--
    <div class="row mb-4">

        <div class="col-md-6">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h3>Bienvenido al Sistema</h3>
                    <p>Tienes un total de: <b><?php echo array_sum($totales); ?></b> usuarios registrados.</p>
                    <hr>
                    <small>Último acceso detectado: <?php echo date('d/m/Y H:i'); ?></small>
                </div>
            </div>
        </div>
    </div>
--->

        <script>
        // Ejemplo para capturar datos y editar
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        const ctx = document.getElementById('graficaRoles').getContext('2d');
        const graficaRoles = new Chart(ctx, {
            type: 'pie', // Puedes cambiar a 'bar' o 'doughnut'
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Usuarios por Rol',
                    data: <?php echo json_encode($totales); ?>,
                    backgroundColor: [
                        '#007bff', // Azul (Admin)
                        '#ffc107', // Amarillo (Editor)
                        '#28a745', // Verde (Usuario)
                        '#dc3545' // Rojo (Otros)
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        </script>
        <script>
        // Detectar parámetros en la URL
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
            Swal.fire({
                icon: 'success',
                title: '¡Logrado!',
                text: 'El usuario ha sido guardado correctamente.',
                timer: 2000,
                showConfirmButton: false
            });
        }

        if (status === 'deleted') {
            Swal.fire({
                icon: 'success',
                title: 'Eliminado',
                text: 'El registro ha sido borrado.',
                confirmButtonColor: '#d33'
            });
        }

        if (status === 'updated') {
            Swal.fire({
                icon: 'info',
                title: 'Actualizado',
                text: 'La información se actualizó correctamente.',
                toast: true,
                position: 'top-end',
                timer: 3000,
                showConfirmButton: false
            });
        }

        function confirmarEliminar(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al archivo eliminar.php
                    window.location.href = 'eliminar.php?id=' + id;
                }
            })
        }

        $(document).ready(function() {
            $('.nav-link').on('click', function() {
                // Si es un enlace final (no un desplegable), cambiar active
                if (!$(this).attr('data-bs-toggle')) {
                    $('.nav-link').removeClass('active');
                    $(this).addClass('active');
                }
            });
        });
        /*
        $(document).ready(function() {
            $('.select2-busqueda').select2({
                dropdownParent: $('#modalNotas'), // Importante para que funcione dentro de un modal
                placeholder: "Selecciona una opción",
                allowClear: true
            });
        });*/
        </script>

        <!--32322323232
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
-->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

    </html>
