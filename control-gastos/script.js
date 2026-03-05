// 1. Referencias a elementos del DOM
const formulario = document.getElementById('formulario-transaccion');
const listaUI = document.getElementById('lista-transacciones');

// 2. Estado de la aplicación (Array principal)
let transacciones = [];

// 3. Función para agregar transacciones
formulario.addEventListener('submit', (e) => {
    e.preventDefault();
    // AQUÍ EL ALUMNO DEBE:
    // - Obtener valores de los inputs
    // - Crear el objeto transaccion
    // - Empujarlo al array
    // - Guardar en LocalStorage y renderizar
});

// 4. Función para renderizar en pantalla
function renderizar() {
    // AQUÍ EL ALUMNO DEBE:
    // - Limpiar la listaUI
    // - Recorrer el array y crear elementos <li> dinámicos
}

// 5. Función para LocalStorage (Guardar y Cargar)
