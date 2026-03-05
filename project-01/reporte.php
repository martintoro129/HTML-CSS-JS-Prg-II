<?php
require_once 'vendor/autoload.php'; // Ajusta la ruta según tu instalación
use Dompdf\Dompdf;
include 'conexion.php';

$dompdf = new Dompdf();

// Obtenemos los usuarios
$stmt = $pdo->query("SELECT nombre, email, rol FROM usuarios");
$usuarios = $stmt->fetchAll();

// Creamos el diseño del PDF en HTML
$html = '
<h1 style="text-align:center;">Reporte de Usuarios Registrados</h1>
<table border="1" width="100%" style="border-collapse: collapse;">
    <thead style="background-color: #343a40; color: white;">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>';

foreach ($usuarios as $u) {
    $html .= "<tr>
                <td>{$u['nombre']}</td>
                <td>{$u['email']}</td>
                <td>{$u['rol']}</td>
              </tr>";
}

$html .= '</tbody></table>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_usuarios.pdf", ["Attachment" => false]); // "false" para abrir en el navegador
?>
