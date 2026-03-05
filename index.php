<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechNova | Innovación Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Inter', sans-serif; transition: background 0.3s; }
        .tech-font { font-family: 'Orbitron', sans-serif; }
        .navbar { backdrop-filter: blur(10px); background: rgba(0,0,0,0.8); }
        .hero-section { padding: 100px 0; background: linear-gradient(45deg, #0f2027, #203a43, #2c5364); }
        .card-tech { border: 1px solid rgba(0, 255, 255, 0.2); background: rgba(255,255,255,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand tech-font text-info" href="#">TECH<span class="text-white">NOVA</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#mision">Misión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#vision">Visión</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                    <li class="nav-item ms-lg-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="darkModeSwitch" checked>
                            <label class="form-check-label" for="darkModeSwitch"><i class="bi bi-moon-stars-fill"></i></label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-text bg-dark border-info text-info">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control bg-dark text-white border-info" 
                       placeholder="Buscar por nombre o email...">
            </div>
            <div id="searchFeedback" class="text-info small mt-2 tech-font" style="display:none;">
                Filtrando base de datos...
            </div>
        </div>
    </div>
</div>
    <section id="inicio" class="py-5">
        <div id="techCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                // Conexión simulada a MySQL
                // $conn = mysqli_connect("localhost", "root", "", "tech_db");
                // $result = mysqli_query($conn, "SELECT * FROM productos");
                
                // Ejemplo de cómo iterar con PHP:
                $active = "active";
                // while($row = mysqli_fetch_assoc($result)){ 
                for($i=1; $i<=3; $i++){ ?>
                    <div class="carousel-item <?php echo ($i==1) ? 'active' : ''; ?>">
                        <img src="https://picsum.photos/1200/500?random=<?php echo $i; ?>" class="d-block w-100 rounded" alt="Tech">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <h5 class="tech-font">Producto Innovador <?php echo $i; ?></h5>
                            <p>Descripción obtenida desde tu base de datos MySQL.</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#techCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#techCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <div class="container my-5">
        <div class="row g-4">
            <div id="mision" class="col-md-6">
                <div class="card card-tech p-4 h-100 shadow">
                    <h2 class="tech-font text-info"><i class="bi bi-rocket-takeoff"></i> Misión</h2>
                    <p>Liderar la transformación digital global proporcionando soluciones de software de alta gama que empoderen a las empresas del futuro.</p>
                </div>
            </div>
            <div id="vision" class="col-md-6">
                <div class="card card-tech p-4 h-100 shadow">
                    <h2 class="tech-font text-info"><i class="bi bi-eye"></i> Visión</h2>
                    <p>Ser el referente mundial en inteligencia artificial aplicada para el año 2030, creando un ecosistema tecnológico sostenible.</p>
                </div>
            </div>
        </div>
    </div>

    <section id="contacto" class="py-5 bg-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4 shadow">
                        <h3 class="text-center tech-font mb-4">Contáctanos</h3>
                        <form id="contactForm">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" id="nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mensaje</label>
                                <textarea id="mensaje" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-info w-100 tech-font">ENVIAR SEÑAL</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="feed-mensajes" class="py-5">
    <div class="container">
        <h2 class="tech-font text-center mb-5"><i class="bi bi-broadcast"></i> Panel de Transmisiones</h2>
        <div id="contenedor-mensajes" class="row g-4">
            <div class="text-center">
                <div class="spinner-border text-info" role="status"></div>
                <p>Sincronizando con el servidor...</p>
            </div>
        </div>
    </div>
</section>

<style>
    .post-card {
        background: rgba(15, 32, 39, 0.7);
        border-left: 4px solid #0dcaf0;
        transition: transform 0.3s ease;
    }
    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 15px rgba(13, 202, 240, 0.3);
    }
    .post-meta {
        font-size: 0.8rem;
        color: #6c757d;
    }
</style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Lógica Dark Mode
        const switchBtn = document.getElementById('darkModeSwitch');
        switchBtn.addEventListener('change', () => {
            const theme = switchBtn.checked ? 'dark' : 'light';
            document.documentElement.setAttribute('data-bs-theme', theme);
        });

        // Validación y SweetAlert
       document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Capturar datos
    const formData = new FormData();
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('mensaje', document.getElementById('mensaje').value);

    // Animación de "Cargando"
    Swal.fire({
        title: 'Enviando señal...',
        didOpen: () => { Swal.showLoading(); }
    });

    // Envío asíncrono (AJAX)
    fetch('guardar_contacto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Transmisión Exitosa',
                text: 'Tus datos han sido encriptados y enviados.',
                confirmButtonColor: '#0dcaf0'
            });
            this.reset();
        } else {
            Swal.fire('Error', 'Hubo un fallo en la matriz: ' + data.message, 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error Critico', 'No hay conexión con el servidor', 'error');
    });
});

        function cargarMensajes() {
    const contenedor = document.getElementById('contenedor-mensajes');

    fetch('obtener_mensajes.php')
        .then(response => response.json())
        .then(data => {
            contenedor.innerHTML = ''; // Limpiar cargador
            
            if(data.length === 0) {
                contenedor.innerHTML = '<p class="text-center">No hay transmisiones entrantes.</p>';
                return;
            }

            data.forEach(msg => {
                // Dentro de la función cargarMensajes, en el bucle data.forEach(msg => { ...
                const card = `
                    <div class="col-md-6 col-lg-4" id="post-${msg.id}">
                        <div class="card post-card h-100 p-3 shadow-sm border-0">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="text-info tech-font mb-0">${msg.nombre}</h6>
                                <button class="btn btn-outline-danger btn-sm border-0" onclick="confirmarEliminar(${msg.id})">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </div>
                            <p class="small mb-1 text-muted">${msg.email}</p>
                            <hr class="my-2 opacity-25">
                            <p class="mb-0 text-light opacity-75">"${msg.mensaje}"</p>
                            <div class="mt-2 text-end">
                                <span class="badge bg-dark text-secondary" style="font-size: 0.7rem;">${msg.fecha}</span>
                            </div>
                        </div>
                    </div>
                `;
                contenedor.innerHTML += card;
            });
        })
        .catch(err => console.error("Error al sincronizar feed:", err));
}
function confirmarEliminar(id) {
    Swal.fire({
        title: '¿Eliminar transmisión?',
        text: "Esta acción no se puede deshacer en la base de datos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, borrar',
        cancelButtonText: 'Cancelar',
        background: '#1a1a1a', // Fondo oscuro para combinar con el tema
        color: '#fff'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarMensaje(id);
        }
    });
}

function eliminarMensaje(id) {
    const formData = new FormData();
    formData.append('id', id);

    fetch('eliminar_mensaje.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            // Animación de desvanecimiento antes de quitarlo del DOM
            const elemento = document.getElementById(`post-${id}`);
            elemento.style.transition = "0.5s";
            elemento.style.opacity = "0";
            elemento.style.transform = "scale(0.8)";
            
            setTimeout(() => {
                cargarMensajes(); // Recargamos para refrescar la vista
                Swal.fire('Eliminado', 'La señal ha sido purgada.', 'success');
            }, 500);
        } else {
            Swal.fire('Error', 'No se pudo eliminar el registro.', 'error');
        }
    });
}
// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', cargarMensajes);
    //busqueda
        document.getElementById('searchInput').addEventListener('keyup', function() {
    const term = this.value.toLowerCase(); // Lo que el usuario escribe
    const cards = document.querySelectorAll('#contenedor-mensajes .col-md-6'); // Todas las tarjetas
    const feedback = document.getElementById('searchFeedback');
    let encontrados = 0;

    feedback.style.display = term.length > 0 ? 'block' : 'none';

    cards.forEach(card => {
        // Obtenemos el texto del nombre y el email dentro de la tarjeta
        const nombre = card.querySelector('h6').textContent.toLowerCase();
        const email = card.querySelector('.small').textContent.toLowerCase();

        if (nombre.includes(term) || email.includes(term)) {
            card.style.display = "block"; // Mostrar
            encontrados++;
        } else {
            card.style.display = "none"; // Ocultar
        }
    });

    if(encontrados === 0 && term.length > 0) {
        feedback.textContent = "No se encontraron coincidencias en el servidor.";
        feedback.classList.replace('text-info', 'text-danger');
    } else {
        feedback.textContent = `Resultados encontrados: ${encontrados}`;
        feedback.classList.replace('text-danger', 'text-info');
    }
});
    </script>
</body>
</html>
