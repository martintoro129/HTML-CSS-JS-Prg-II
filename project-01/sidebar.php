<div class="sidebar d-flex p-1">
    <nav class="sidebar shadow">
        <div class="p-4 text-center border-bottom border-secondary">
            <h4 class="m-0"><i class="fas fa-university me-2 text-info"></i>Administrativo</h4>
        </div>

        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">
                    <span><i class="fas fa-tachometer-alt me-2"></i> Dashboard</span>
                </a>
            </li>

            <div class="nav-item-header">Gestión Académica</div>

            <li class="nav-item">
                <a href="#submenuAlumnos" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
                    <span><i class="fas fa-user-graduate me-2"></i> Productos</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <ul class="collapse submenu shadow-inner" id="submenuAlumnos">
                    <li><a href="" class="nav-link"><i class="far fa-circle me-2"></i> Listado
                            General</a></li>
                    <li><a href="" class="nav-link"><i class="far fa-circle me-2"></i>
                            Grupo.Productos </a></li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="#submenuConfig" class="nav-link" data-bs-toggle="collapse" aria-expanded="false">
                    <span><i class="fas fa-cog me-2"></i> Configuración</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <ul class="collapse submenu" id="submenuConfig">
                    <li><a href="modulo_usuarios.php" class="nav-link"><i class="far fa-circle me-2"></i>
                            Usuarios</a></li>
                </ul>
            </li>

            <li class="nav-item mt-auto">
                <a href="logout.php" class="nav-link text-danger">
                    <span><i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!--
<ul class="collapse submenu <?php echo in_array(basename($_SERVER['PHP_SELF']), ['modulo_alumnos.php', 'asistencia.php']) ? 'show' : ''; ?>"
    id="submenuAlumnos">

-->