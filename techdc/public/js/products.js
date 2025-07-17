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
  loadProducts();

  const form = document.getElementById('productForm');
  form.addEventListener('submit', saveProduct);
});

async function loadCategories() {
  const res = await fetch(`${API}/category`, { headers });
  const data = await res.json();
  const select = document.getElementById('category_id');
  select.innerHTML = '<option value="">Select category</option>';
  data.forEach(c => {
    const option = document.createElement('option');
    option.value = c.id;
    option.textContent = c.name;
    select.appendChild(option);
  });
}

async function loadProducts() {
  const res = await fetch(`${API}/product`, { headers });
  const data = await res.json();
  const table = document.getElementById('productTable');
  table.innerHTML = '';
  data.forEach(p => {
    table.innerHTML += `
      <tr>
        <td class="p-2">${p.id}</td>
        <td class="p-2">${p.name}</td>
        <td class="p-2">$${p.price}</td>
        <td class="p-2">${p.stock}</td>
        <td class="p-2">${p.category?.name || ''}</td>
        <td class="p-2 space-x-2">
          <button onclick="editProduct(${p.id})" class="text-blue-600">Edit</button>
          <button onclick="deleteProduct(${p.id})" class="text-red-600">Delete</button>
        </td>
      </tr>
    `;
  });
}

async function saveProduct(e) {
  e.preventDefault();
  const id = document.getElementById('productId').value;
  const body = JSON.stringify({
    name: document.getElementById('name').value,
    description: document.getElementById('description').value,
    price: document.getElementById('price').value,
    stock: document.getElementById('stock').value,
    category_id: document.getElementById('category_id').value,
  });

  const method = id ? 'PUT' : 'POST';
  const url = id ? `${API}/product/${id}` : `${API}/product`;

  await fetch(url, {
    method,
    headers,
    body
  });

  e.target.reset();
  document.getElementById('productId').value = '';
  loadProducts();
}

async function editProduct(id) {
  const res = await fetch(`${API}/product/${id}`, { headers });
  const p = await res.json();
  document.getElementById('productId').value = p.id;
  document.getElementById('name').value = p.name;
  document.getElementById('description').value = p.description;
  document.getElementById('price').value = p.price;
  document.getElementById('stock').value = p.stock;
  document.getElementById('category_id').value = p.category_id;
}

async function deleteProduct(id) {
  if (!confirm('Delete this product?')) return;
  await fetch(`${API}/product/${id}`, {
    method: 'DELETE',
    headers
  });
  loadProducts();
}
