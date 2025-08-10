/**
 * @file representantes.js
 * @description Maneja la lógica de autenticación, CRUD y visualización de representantes en la aplicación Front_guarderia.
 * 
 * - Verifica autenticación del usuario mediante token almacenado en localStorage.
 * - Permite cerrar sesión y redirige al login.
 * - Carga y muestra datos de representantes en una tabla usando DataTables.
 * - Permite crear, editar y eliminar representantes mediante peticiones al API Gateway.
 * - Gestiona formularios modales para agregar y editar representantes.
 * 
 * @author TuNombre
 */

/**
 * Renderiza una tabla con datos obtenidos de un endpoint específico.
 * @async
 * @function renderTable
 * @param {string} endpoint - Endpoint de la API para obtener los datos.
 * @param {string} tableId - ID del elemento HTML de la tabla.
 * @param {Array<Object>} columns - Configuración de columnas para DataTables.
 * @returns {Promise<void>}
 */

/**
 * Evento para mostrar el modal de agregar representante.
 * @event addButton#click
 */

/**
 * Envía una petición POST para crear un nuevo representante.
 * @event formRepresentante#submit
 * @async
 * @param {Event} event - Evento submit del formulario.
 * @returns {Promise<void>}
 */

/**
 * Evento para mostrar el formulario de edición de representante.
 * @event tabla#click
 * @async
 * @param {Event} event - Evento click en la tabla.
 * @returns {Promise<void>}
 */

/**
 * Evento para cancelar la edición y ocultar el formulario.
 * @event btnCancelar#click
 */

/**
 * Envía una petición PUT para actualizar los datos de un representante.
 * @event formEditar#submit
 * @async
 * @param {Event} event - Evento submit del formulario de edición.
 * @returns {Promise<void>}
 */

/**
 * Envía una petición DELETE para eliminar un representante.
 * @event tabla#click
 * @async
 * @param {Event} event - Evento click en la tabla.
 * @returns {Promise<void>}
 */
//Envuelve el codigo para q se ejecute despues de la pagina HTML
document.addEventListener('DOMContentLoaded', () => {
    //Busca en el almacenamiento del nevgador el token de autenticación
    const token = localStorage.getItem('authToken');
    //se define la URL del api Gateway no del microservicio
    const gatewayUrl = 'http://127.0.0.1:8000/api';
    // 1. VERIFICAR AUTENTICACIÓN
    // Si no hay token, redirige al login.
    if (!token) {
        window.location.href = '../index.html';
        return;
    }
    // 2. LÓGICA DE CERRAR SESIÓN
    const logoutButton = document.getElementById('logout-button');
    //espera que el usuario haga click sobre el boton de cerrar sesion 
    logoutButton.addEventListener('click', async () => {
        try {
            // Realiza una petición GET al gateway para cerrar sesión
            await fetch(`${gatewayUrl}/logout`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });
        } finally {
            // Borra el token y redirige sin importar si el logout en el servidor funcionó
            localStorage.removeItem('authToken');
            window.location.href = '../index.html';
        }
    });
    // 3. PETICION GET ----------------------------------------------------
    // FUNCIÓN PARA CARGAR DATOS Y MOSTRARLOS EN TABLAS
    const renderTable = async (endpoint, tableId, columns) => {
        try {
            const response = await fetch(`${gatewayUrl}/${endpoint}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                // Si el token expiró o es inválido, el gateway dará un error 401
                if (response.status === 401) {
                    localStorage.removeItem('authToken');
                    window.location.href = '../index.html';
                }
                throw new Error(`Error al cargar datos de ${endpoint}`);
            }
            const data = await response.json();
            // Inicializa DataTables con los datos obtenidos
            $(`#${tableId}`).DataTable({
                data: data,
                columns: columns,
            });
        } catch (error) {
            console.error(error);
            alert(`No se pudieron cargar los datos de la tabla ${tableId}.`);
        }
    };
    // 4. LLAMAR A LA FUNCIÓN PARA CADA TABLA
    // Cargar y mostrar Pacientes
    renderTable('pacientes', 'paciente-table', [
        { data: 'nombre' },
        { data: 'apellido' },
        { data: 'fecha_nacimiento' },
        {
            data: null,
            render: function (row) {
                return `
                <button class="btn btn-sm btn-primary editar-btn" data-id="${row.ID_REPRESENTANTE}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger eliminar-btn" data-id="${row.ID_REPRESENTANTE}">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            },
        },
    ]);
    // PETICION POST ----------------------------------------------------
    //formulario de crear un nuevo  representante desde el modal
    const addButton = document.getElementById('add-representante-btn');
    const modalAgregar = new bootstrap.Modal(document.getElementById('modalAgregarRepresentante'));
    // Evento para el botón crear
    addButton.addEventListener('click', () => {
        modalAgregar.show();
    });

    //formulario de crear representante dentor del modal
    const formRepresentante = document.getElementById('form-representante');
    formRepresentante.addEventListener('submit', async (event) => {
        event.preventDefault();

        // Recolectar datos del formulario
        const nombre = document.getElementById('NOMBRE').value;
        const apellido = document.getElementById('APELLIDO').value;
        const edad = document.getElementById('EDAD').value;
        const celular = document.getElementById('CELULAR').value;
        const cedula = document.getElementById('CEDULA').value;
        const parentesco = document.getElementById('PARENTEZCO').value;
        const lugarTrabajo = document.getElementById('LUGAR_DE_TRABAJO').value;
        const genero = document.getElementById('GENERO').value;

        try {
            const response = await fetch(`${gatewayUrl}/representantes`, {
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    NOMBRE: nombre,
                    APELLIDO: apellido,
                    EDAD: edad,
                    CELULAR: celular,
                    CEDULA: cedula,
                    PARENTEZCO: parentesco,
                    LUGAR_DE_TRABAJO: lugarTrabajo,
                    GENERO: genero,
                }),
            });

            if (!response.ok) {
                throw new Error('Error al crear el representante');
            }

            // Esta línea ahora funcionará correctamente
            modalAgregar.hide();
            formRepresentante.reset();
        } catch (error) {
            console.error("El error detallado es:", error); // Es útil loguear el error específico
            alert('No se pudo crear el representante. Por favor, verifica los datos ingresados.');

        }
    });
    //PETICION GET para editar representante----------------------------------------------------
    // Variables para el formulario de edición
    const tabla = document.getElementById('representante-table');
    const contenedorFormulario = document.getElementById('contenedor-formulario-editar');
    const formEditar = document.getElementById('form-editar-representante');
    const btnCancelar = document.getElementById('btn-cancelar-edicion');

    // --- EVENTO: Clic en el botón "Editar" de la tabla ---
    tabla.addEventListener('click', async (event) => {
        const botonEditar = event.target.closest('.editar-btn');
        if (!botonEditar) return;

        const id = botonEditar.dataset.id;

        try {
            const response = await fetch(`${gatewayUrl}/representantes/${id}`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            if (!response.ok) throw new Error('Error al obtener datos');

            const representante = await response.json();

            // Rellenamos el formulario (esta parte es la misma)
            document.getElementById('ID_REPRESENTANTE').value = representante.ID_REPRESENTANTE;
            document.getElementById('EDIT_NOMBRE').value = representante.NOMBRE;
            document.getElementById('EDIT_APELLIDO').value = representante.APELLIDO;
            document.getElementById('EDIT_EDAD').value = representante.EDAD;
            document.getElementById('EDIT_CELULAR').value = representante.CELULAR;
            document.getElementById('EDIT_CEDULA').value = representante.CEDULA;
            document.getElementById('EDIT_PARENTEZCO').value = representante.PARENTEZCO;
            document.getElementById('EDIT_LUGAR_DE_TRABAJO').value = representante.LUGAR_DE_TRABAJO;
            document.getElementById('EDIT_GENERO').value = representante.GENERO;
            // ... rellena los demás campos ...

            // === LA MAGIA OCURRE AQUÍ ===
            // 1. Mostramos el contenedor del formulario
            contenedorFormulario.style.display = 'block';

            // 2. Hacemos scroll para que el usuario vea el formulario
            contenedorFormulario.scrollIntoView({ behavior: 'smooth' });

        } catch (error) {
            console.error("Error al mostrar el formulario de edición:", error);
            alert("No se pudieron cargar los datos del representante.");
        }
    });

    // --- EVENTO: Clic en el botón "Cancelar" ---
    btnCancelar.addEventListener('click', () => {
        contenedorFormulario.style.display = 'none';
    });

    //PETICION PUT ----------------------------------------------------
    // --- EVENTO: Submit del formulario para guardar los cambios ---
    formEditar.addEventListener('submit', async (event) => {
        // ¡Línea clave! Evita que el formulario recargue la página
        console.log('El evento SUBMIT fue capturado. ¡No debería recargar!');
        debugger;
        event.preventDefault();
        const id = document.getElementById('ID_REPRESENTANTE').value;
        const datosActualizados = {
            NOMBRE: document.getElementById('EDIT_NOMBRE').value,
            APELLIDO: document.getElementById('EDIT_APELLIDO').value,
            EDAD: document.getElementById('EDIT_EDAD').value,
            CELULAR: document.getElementById('EDIT_CELULAR').value,
            CEDULA: document.getElementById('EDIT_CEDULA').value,
            PARENTEZCO: document.getElementById('EDIT_PARENTEZCO').value,
            LUGAR_DE_TRABAJO: document.getElementById('EDIT_LUGAR_DE_TRABAJO').value,
            GENERO: document.getElementById('EDIT_GENERO').value,
        };
        // Puedes agregar una validación simple aquí si quieres
        if (!id || !datosActualizados.NOMBRE || !datosActualizados.CEDULA) {
            alert('Por favor, completa todos los campos requeridos.');
            return; // Detiene la ejecución si faltan datos
        }

        try {
            const response = await fetch(`${gatewayUrl}/representantes/${id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                    // 'Accept' no es usualmente necesario aquí
                },
                body: JSON.stringify(datosActualizados)
            });

            if (!response.ok) {
                // Intenta leer el mensaje de error del servidor si existe
                const errorData = await response.json();
                throw new Error(errorData.message || 'Error al actualizar. Código: ' + response.status);
            }
            // Si la petición fue exitosa (200 OK)
            alert('¡Representante actualizado con éxito!');
            location.reload();
        } catch (error) {
            console.error("Error al guardar cambios:", error);
            alert(`No se pudo actualizar el representante. Error: ${error.message}`);
        }
    });
    // PETICION DELETE ----------------------------------------------------
    // --- EVENTO: Clic en el botón "Eliminar" de la tabla ---
    tabla.addEventListener('click', async (event) => {
        // Buscamos si el clic fue en un botón de eliminar o en su ícono
        const botonEliminar = event.target.closest('.eliminar-btn');

        // Si no se hizo clic en un botón de eliminar, no hacemos nada
        if (!botonEliminar) return;

        // Obtenemos el ID del registro desde el atributo data-id
        const id = botonEliminar.dataset.id;

        // 1. CONFIRMACIÓN DEL USUARIO
        // Usamos la función confirm() del navegador, que devuelve true si el usuario acepta.
        const confirmado = confirm('¿Estás seguro de que deseas eliminar este registro?\nEsta acción no se puede deshacer.');

        // Si el usuario hace clic en "Cancelar", la función se detiene aquí.
        if (!confirmado) {
            return;
        }
        // 2. PETICIÓN A LA API
        try {
            const response = await fetch(`${gatewayUrl}/representantes/${id}`, {
                method: 'DELETE', // El método HTTP para borrar es DELETE
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            // Verificamos si la respuesta del servidor fue exitosa (ej. 200 OK o 204 No Content)
            if (!response.ok) {
                const errorData = await response.json();
                // Lanzamos un error para que sea capturado por el bloque catch
                throw new Error(errorData.message || 'El servidor no pudo eliminar el registro.');
            }
            // 3. ACTUALIZACIÓN DE LA VISTA (FRONTEND)
            // Si el borrado fue exitoso, eliminamos la fila de la tabla.
            // Esto es mucho más rápido y eficiente que recargar toda la página.
            const filaParaEliminar = botonEliminar.closest('tr');
            filaParaEliminar.remove();
            alert('Registro eliminado con éxito.');
        } catch (error) {
            console.error("Error al eliminar el registro:", error);
            alert(`No se pudo eliminar el registro. Error: ${error.message}`);
        }
    });
});
