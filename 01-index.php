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
            
            const nombre = document.getElementById('nombre').value;
            
            if(nombre.length < 3) {
                Swal.fire('Error', 'El nombre es muy corto', 'error');
            } else {
                Swal.fire({
                    title: '¡Mensaje Enviado!',
                    text: 'Recibirás respuesta en breve, ' + nombre,
                    icon: 'success',
                    confirmButtonColor: '#0dcaf0'
                });
                this.reset();
            }
        });
    </script>
</body>
</html>
