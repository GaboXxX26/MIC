document.addEventListener('DOMContentLoaded', () => {
    const token = localStorage.getItem('authToken');
    const gatewayUrl = 'http://127.0.0.1:8000/api';

    // 1. VERIFICAR AUTENTICACIÓN
    // Si no hay token, redirige al login.
    if (!token) {
        window.location.href = 'index.html';
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
            window.location.href = 'index.html';
        }
    });

});