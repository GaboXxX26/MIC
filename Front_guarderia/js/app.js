// Espera a que el contenido de la página se cargue
document.addEventListener('DOMContentLoaded', () => {
    
    // Selecciona el formulario
    const loginForm = document.getElementById('login-form');

    // Añade un evento para cuando se intente enviar el formulario
    loginForm.addEventListener('submit', async (event) => {
        // Evita que la página se recargue
        event.preventDefault();

        // Obtiene los valores de los campos
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const errorMessageDiv = document.getElementById('error-message');

        // URL del endpoint de login en tu API Gateway
        const apiUrl = 'http://127.0.0.1:8000/api/login';

        try {
            // Realiza la petición POST a la API
            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });

            // Convierte la respuesta a JSON
            const data = await response.json();

            console.log('Respuesta del servidor:', data);
            
            // Si la respuesta no es exitosa (ej: error 401), muestra el error
            if (!response.ok) {
                errorMessageDiv.textContent = data.error || 'Credenciales incorrectas.';
                errorMessageDiv.classList.remove('d-none'); // Muestra el div de error
                return;
            }

            // Si el login es exitoso...
            // 1. Guarda el token en el almacenamiento local del navegador
            localStorage.setItem('authToken', data.token);
            
            // 2. Oculta cualquier mensaje de error previo
            errorMessageDiv.classList.add('d-none');
            
            // 3. Muestra un mensaje de éxito y redirige
            alert('¡Login exitoso! Redirigiendo al panel de control...');
            window.location.href = 'dashboard.html'; // Redirige a una página protegida

        } catch (error) {
            // Maneja errores de red u otros problemas
            errorMessageDiv.textContent = 'No se pudo conectar con el servidor. Inténtalo de nuevo.';
            errorMessageDiv.classList.remove('d-none');
            console.error('Error en el login:', error);
        }
    });
});