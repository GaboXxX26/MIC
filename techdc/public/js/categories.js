const token = localStorage.getItem('token');
const headers = {
  'Authorization': 'Bearer ' + token,
  'Content-Type': 'application/json',
  'Accept': 'application/json'
};

const API = 'http://127.0.0.1:8000/api';

document.addEventListener('DOMContentLoaded', () => {
  if (!token) return location.href = 'login.html';

  loadCategories();

  const form = document.getElementById('categoryForm');
  form.addEventListener('submit', saveCategory);
});

async function loadCategories() {
  const res = await fetch(`${API}/category`, { headers });
  const data = await res.json();
  const table = document.getElementById('categoryTable');
  table.innerHTML = '';
  data.forEach(c => {
    table.innerHTML += `
      <tr>
        <td class="p-2">${c.id}</td>
        <td class="p-2">${c.name}</td>
        <td class="p-2">${c.description}</td>
        <td class="p-2 space-x-2">
          <button onclick="editCategory(${c.id})" class="text-blue-600">Edit</button>
          <button onclick="deleteCategory(${c.id})" class="text-red-600">Delete</button>
        </td>
      </tr>
    `;
  });
}

async function saveCategory(e) {
  e.preventDefault();
  const id = document.getElementById('categoryId').value;
  const body = JSON.stringify({
    name: document.getElementById('name').value,
    description: document.getElementById('description').value,
  });

  const method = id ? 'PUT' : 'POST';
  const url = id ? `${API}/category/${id}` : `${API}/category`;

  await fetch(url, {
    method,
    headers,
    body
  });

  e.target.reset();
  document.getElementById('categoryId').value = '';
  loadCategories();
}

async function editCategory(id) {
  const res = await fetch(`${API}/category/${id}`, { headers });
  const c = await res.json();
  document.getElementById('categoryId').value = c.id;
  document.getElementById('name').value = c.name;
  document.getElementById('description').value = c.description;
}

async function deleteCategory(id) {
  if (!confirm('Delete this category?')) return;
  await fetch(`${API}/category/${id}`, {
    method: 'DELETE',
    headers
  });
  loadCategories();
}
