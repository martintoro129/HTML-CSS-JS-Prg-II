// 1. Referencias al DOM
const formulario = document.getElementById('formulario-transaccion');
const listaUI = document.getElementById('lista-transacciones');
const ingresosUI = document.getElementById('total-ingresos');
const gastosUI = document.getElementById('total-gastos');
const balanceUI = document.getElementById('balance-total');

// 2. Estado de la aplicación
// Intentamos cargar de LocalStorage, si no hay nada, inicializamos array vacío
let transacciones = JSON.parse(localStorage.getItem('finanzas')) || [];

// 3. Función para agregar una transacción
formulario.addEventListener('submit', (e) => {

    e.preventDefault();

    const nuevaTransaccion = {
        id: Date.now(), // Genera un ID único basado en el tiempo
        descripcion: document.getElementById('descripcion').value,
        monto: parseFloat(document.getElementById('monto').value),
        tipo: document.getElementById('tipo').value
    };

    transacciones.push(nuevaTransaccion);
    actualizarApp();
    formulario.reset(); // Limpia los campos del formulario
});

// 4. Función para eliminar (por ID)
function eliminarTransaccion(id) {
    transacciones = transacciones.filter(t => t.id !== id);
    actualizarApp();
}

// 5. Cálculos y Renderizado
function actualizarApp()
{
    // A. Limpiar la lista antes de volver a dibujar
    listaUI.innerHTML = '';

    let ingresos = 0;
    let gastos = 0;

    transacciones.forEach(t => {
        // Crear elemento de lista
        const li = document.createElement('li');
        const signo = t.tipo === 'ingreso' ? '+' : '-';
        const clase = t.tipo === 'ingreso' ? 'verde' : 'rojo';

        li.innerHTML = `
            ${t.descripcion} <span class="${clase}">${signo}$${t.monto.toFixed(2)}</span>
            <button class="btn-borrar" onclick="eliminarTransaccion(${t.id})">x</button>
        `;
        listaUI.appendChild(li);//falta.desde.aqui...
        //pedir.localsend.en.cada.computadora.de.los.laboratorios.

        // Sumar totales
        if (t.tipo === 'ingreso') ingresos += t.monto;
        else gastos += t.monto;
    });

    // B. Actualizar los textos en el HTML
    ingresosUI.innerText = `$${ingresos.toFixed(2)}`;
    gastosUI.innerText = `$${gastos.toFixed(2)}`;
    balanceUI.innerText = `$${(ingresos - gastos).toFixed(2)}`;

    // C. Guardar en LocalStorage
    localStorage.setItem('finanzas', JSON.stringify(transacciones));
}

// 6. Carga inicial al abrir la página
actualizarApp();
