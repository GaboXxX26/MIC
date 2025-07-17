document.addEventListener('DOMContentLoaded', () => {
  const token = localStorage.getItem('token');
  const userName = document.getElementById('userName');
  const logoutBtn = document.getElementById('logoutBtn');

  if (!token) {
    // Si no hay token, se redirige al login
    window.location.href = 'login.html';
    return;
  }

  // Obtener datos del usuario
  fetch('http://127.0.0.1:8000/api/user', {
    headers: {
      'Authorization': 'Bearer ' + token,
      'Accept': 'application/json',
    }
  })
  .then(res => {
    if (!res.ok) throw new Error('Token inválido');
    return res.json();
  })
  .then(data => {
    userName.textContent = data.name || 'Usuario';
  })
  .catch(() => {
    localStorage.removeItem('token');
    window.location.href = 'login.html';
  });

  // Logout
  logoutBtn.addEventListener('click', () => {
    fetch('http://127.0.0.1:8000/api/logout', {
      method: 'POST',
      headers: {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json',
      }
    }).finally(() => {
      localStorage.removeItem('token');
      window.location.href = 'login.html';
    });
  });
});
