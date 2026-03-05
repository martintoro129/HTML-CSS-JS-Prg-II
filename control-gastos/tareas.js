let tareas = JSON.parse(localStorage.getItem('tareas_v3')) || [];
let filtroActual = 'todas';
const buscador = document.querySelector('#busquedaInput');

// --- LÓGICA DE PERSISTENCIA ---
function guardar() {
localStorage.setItem('tareas_v3', JSON.stringify(tareas));
renderizar();
}

// --- ACCIONES ---
function agregarTarea() {
    const nombre = document.querySelector('#tareaInput').value;
    const prio = document.querySelector('#prioInput').value;
    const fecha = document.querySelector('#fechaInput').value;

    if (!nombre) return;

    tareas.push({
        id: Date.now(),
        nombre,
        prio,
        fecha: fecha || '9999-12-31', // Fecha lejana si no hay
        completada: false
    });

document.querySelector('#tareaInput').value = '';
guardar();
}

// --- BUSCADOR EN TIEMPO REAL ---
buscador.addEventListener('input', renderizar);

function filtrar(tipo) {
    filtroActual = tipo;
    document.querySelectorAll('.filtros button').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`#f-${tipo}`).classList.add('active');
    renderizar();
}

// --- LA FUNCIÓN MAESTRA: RENDERIZAR CON FILTRO Y ORDEN ---
function renderizar()
{
    const lista = document.querySelector('#listaTareas');
    lista.innerHTML = '';
    const textoBusqueda = buscador.value.toLowerCase();

    let procesadas = tareas
    // 1. Filtro por Estado (Todas/Pendientes/Completadas)
    .filter(t => {
        if (filtroActual === 'pendientes') return !t.completada;
        if (filtroActual === 'completadas') return t.completada;
        return true;
    })
    // 2. Filtro por Búsqueda
    .filter(t => t.nombre.toLowerCase().includes(textoBusqueda))
    // 3. Ordenar por fecha (Ascendente)
    .sort((a, b) => new Date(a.fecha) - new Date(b.fecha));

    procesadas.forEach(t => {
        const li = document.createElement('li');
        li.className = `prio-${t.prio} ${t.completada ? 'completada' : ''}`;
        const fechaLegible = t.fecha === '9999-12-31' ? 'Sin fecha' : t.fecha;

        li.innerHTML = `
            <input type="checkbox" ${t.completada ? 'checked' : ''} onclick="toggleTarea(${t.id})">
            <div class="info-tarea">
                <span>${t.nombre}</span>
                <small class="fecha-label">📅 ${fechaLegible}</small>
            </div>
            <button class="btn-borrar" onclick="eliminarTarea(${t.id})">✕</button>
        `;
        lista.appendChild(li);
    });
}

// Funciones globales para los onclick del HTML
window.toggleTarea = (id) => {
tareas = tareas.map(t => t.id === id ? {...t, completada: !t.completada} : t);
guardar();
};

window.eliminarTarea = (id) => {
tareas = tareas.filter(t => t.id !== id);
guardar();
};

document.querySelector('#btnAgregar').onclick = agregarTarea;
renderizar();
