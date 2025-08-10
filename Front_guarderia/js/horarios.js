document.addEventListener('DOMContentLoaded', () => {
    const token = localStorage.getItem('authToken');
    const gatewayUrl = 'http://127.0.0.1:8000/api';

    // 1. VERIFICAR AUTENTICACIÓN
    // Si no hay token, redirige al login.
    if (!token) {
        window.location.href = '../index.html';
        return;
    }

    // 2. LÓGICA DE CERRAR SESIÓN
    const logoutButton = document.getElementById('logout-button');
    logoutButton.addEventListener('click', async () => {
        try {
            await fetch(`${gatewayUrl}/logout`, {
                method: 'GET', // o 'POST' según tu ruta
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                }
            });
        } finally {
            // Borra el token y redirige sin importar si el logout en el servidor funcionó
            localStorage.removeItem('authToken');
            window.location.href = 'index.html';
        }
    });


    // 3. FUNCIÓN PARA CARGAR DATOS Y MOSTRARLOS EN TABLAS
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
                    window.location.href = 'index.html';
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

    // Cargar y mostrar Horarios
    renderTable('horarios', 'horarios-table', [
        { data: 'ID_HORARIO' },
        { data: 'HORA_INICIO' },
        { data: 'HORA_FIN' }
    ]);
});