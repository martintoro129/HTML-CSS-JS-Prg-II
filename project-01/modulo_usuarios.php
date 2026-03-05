<?php
session_start();
if(!isset($_SESSION['user_id'])){ header("Location: login.php"); exit(); }
include 'conexion.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Alumnos | Academia Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!--- datatables.y.bootstrap.buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="estilos.css">
</head>

<body class="bg-light">

    <?php
    require_once('sidebar.php');
    ?>
    <div class="content">
        <div class="content-header shadow-sm mb-4 bg-white p-3">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Gestión de Usuarios</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Usuarios</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Gestión de Usuarios</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUsuario">
                    <i class="fas fa-plus"></i> Nuevo Usuario
                </button>
                <a href="reporte.php" target="_blank" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Descargar Reporte PDF
                </a>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <table id="tablaUsuarios" class="table table-striped table-bordered" style="width:100%">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$stmt = $pdo->query("SELECT * FROM usuarios");
while ($row = $stmt->fetch()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['nombre']}</td>
        <td>{$row['email']}</td>
        <td><span class='badge bg-info'>{$row['rol']}</span></td>
        <td>
            <button class='btn btn-sm btn-warning btn-edit'><i class='fas fa-edit'></i></button>";

            // SOLO EL ADMIN PUEDE VER EL BOTÓN ELIMINAR
            if ($_SESSION['rol'] === 'Admin') {
                // Cambiamos el onclick por una función personalizada y quitamos el href directo
echo "<button class='btn btn-sm btn-danger' onclick='confirmarEliminar({$row['id']})'>
        <i class='fas fa-trash'></i>
      </button>";
                //echo " <a href='eliminar.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Estás seguro?\")'><i class='fas fa-trash'></i></a>";
            }

    echo "</td>
    </tr>";
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUsuario" tabindex="-1">
        <div class="modal-dialog">
            <form action="guardar.php" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Foto de Perfil</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Rol</label>
                        <select name="rol" class="form-select">
                            <option value="Admin">Admin</option>
                            <option value="Editor">Editor</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!--- EDICION.USUARIOS -->
    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog">
            <form action="editar.php" method="POST" class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_editar" id="id_editar">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Rol</label>
                        <select name="rol" id="edit_rol" class="form-select">
                            <option value="Admin">Admin</option>
                            <option value="Editor">Editor</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                    </div>
                    <div class="alert alert-info">
                        <small><i class="fas fa-info-circle"></i> Deja la contraseña vacía en la base de datos si no
                            deseas cambiarla en este módulo.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    //detecta.parametros.dela.url
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
            icon: 'success',
            title: 'Actualizado',
            text: 'La información se actualizó correctamente.',
            toast: true,
            position: 'top-end',
            timer: 3000,
            showConfirmButton: true
        });
    }
    $(document).ready(function() {
        $('#tablaAlumnos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });

        // Detectar alertas de URL
        const params = new URLSearchParams(window.location.search);
        if (params.get('status') === 'success') {
            Swal.fire('¡Éxito!', 'Operación realizada correctamente', 'success');
        }
    });

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

    function editarAlumno(id, nombre, codigo) {
        // Cambiamos el título y colores del modal
        $('#modalTitulo').text('Editar Alumno');
        $('#modalHeader').removeClass('bg-primary').addClass('bg-warning text-white');
        $('#btnGuardar').removeClass('btn-primary').addClass('btn-warning text-white');

        // Llenamos los campos
        $('#alumno_id').val(id);
        $('#edit_nombre').val(nombre);
        $('#edit_codigo').val(codigo);
        $('#alumno_accion').val('editar'); // Cambiamos la acción para el PHP

        // Mostramos el modal
        $('#modalAlumno').modal('show');
    }

    // Opcional: Limpiar el modal cuando se abre para "Nuevo Alumno"
    $('[data-bs-target="#modalAlumno"]').on('click', function() {
        $('#modalTitulo').text('Registrar Nuevo Alumno');
        $('#modalHeader').removeClass('bg-warning text-white').addClass('bg-primary text-white');
        $('#btnGuardar').removeClass('btn-warning').addClass('btn-primary');
        $('#alumno_id').val('');
        $('#edit_nombre').val('');
        $('#edit_codigo').val('');
        $('#alumno_accion').val('crear');
    });
    $(document).ready(function() {
        $('#tablaUsuarios').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" // Traduce todo a español
            },
            "responsive": true,
            "lengthMenu": [5, 10, 25, 50], // Control de cuántos registros ver
            "columnDefs": [{
                    "orderable": false,
                    "targets": 4
                } // Desactiva el orden en la columna de 'Acciones'
            ]
        });
    });
    // Ejemplo para capturar datos y editar
    $('.btn-warning').on('click', function() {
        const id = $(this).closest('tr').find('td:eq(0)').text();
        const nombre = $(this).closest('tr').find('td:eq(1)').text();

        // Aquí abrirías un modal y llenarías los inputs
        console.log("Editando a: " + nombre + " con ID: " + id);
        // $('#modalEditar').modal('show');
    });


    $(document).on('click', '.btn-edit', function() {
        // Obtenemos la fila actual
        const fila = $(this).closest('tr');

        // Extraemos los datos (ajusta los índices si agregaste columnas)
        const id = fila.find('td:eq(0)').text();
        const nombre = fila.find('td:eq(1)').text();
        const email = fila.find('td:eq(2)').text();
        const rol = fila.find('td:eq(3)').text().trim();

        // Seteamos los valores en el modal
        $('#id_editar').val(id);
        $('#edit_nombre').val(nombre);
        $('#edit_email').val(email);
        $('#edit_rol').val(rol);

        // Mostramos el modal
        $('#modalEditar').modal('show');
    });
    $(document).on('click', '.btn-edit', function() {
        // Obtenemos la fila actual
        const fila = $(this).closest('tr');

        // Extraemos los datos (ajusta los índices si agregaste columnas)
        const id = fila.find('td:eq(0)').text();
        const nombre = fila.find('td:eq(1)').text();
        const email = fila.find('td:eq(2)').text();
        const rol = fila.find('td:eq(3)').text().trim();

        // Seteamos los valores en el modal
        $('#id_editar').val(id);
        $('#edit_nombre').val(nombre);
        $('#edit_email').val(email);
        $('#edit_rol').val(rol);

        // Mostramos el modal
        $('#modalEditar').modal('show');
    });
    </script>
</body>

</html>
