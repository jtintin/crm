# CRM Básico con Laravel 12

Este proyecto es un **CRM básico** desarrollado con **Laravel 12**, siguiendo el curso **Códigos de Programación - MR**.  
Su objetivo es mostrar la estructura mínima de un sistema de gestión de clientes con autenticación, dashboard y módulos iniciales.

---

## 🚀 Características principales
- **Login y autenticación** con middleware `auth`.
- **Dashboard protegido** solo para usuarios autenticados.
- **Estructura modular** para crecer con nuevos componentes.
- **Uso de controladores y vistas Blade** para separar lógica y presentación.
- **Integración con GitHub** para control de versiones y colaboración.

---

## 📂 Estructura básica
- `routes/web.php` → Definición de rutas públicas y protegidas.
- `app/Http/Controllers/AuthController.php` → Controlador de login.
- `app/Http/Controllers/DashboardController.php` → Controlador del dashboard.
- `resources/views/auth/login.blade.php` → Vista de login.
- `resources/views/dashboard.blade.php` → Vista principal del CRM.

