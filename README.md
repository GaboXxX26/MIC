# Proyecto de Titulación: Ecosistema de Microservicios con API Gateway (Monorepo)

Este repositorio contiene el código fuente completo de mi proyecto de titulación de Ingeniería en TICs, el cual implementa una arquitectura de microservicios (Backend), un API Gateway (Seguridad) y un cliente (Frontend).

---

## 🏛️ Estructura del Repositorio

Este proyecto está dividido en tres componentes principales, cada uno en su propia carpeta:

### 1. `/GODC` (API Gateway - Laravel)
* **Propósito:** Es el punto de entrada único para toda la aplicación.
* **Características:**
    * Autenticación Centralizada (JWT).
    * Enrutamiento de peticiones a los microservicios correctos.
    * Rate Limiting (prevención de DoS).

### 2. `/MIC` (Microservicios Backend - Spring Boot/PHP)
* **Propósito:** Contiene la lógica de negocio y la conexión a la base de datos.
* **Servicios Incluidos:**
    * Servicio de Proveedores
    * Servicio de Productos

### 3. `/MICDC` (Aplicación Cliente - Frontend)
* **Propósito:** Es la interfaz de usuario aplicación web.
* **Tecnologías:** / HTML+Bootstrap .

---

## 🛠️ Tecnologías Clave

* **API Gateway:** Laravel (PHP)
* **Backend:**  LARAVEL (PHP)
* **Frontend:** HTML, Bootstrap, datatables
* **Bases de Datos:** MySQL, PostgreSQL

---
