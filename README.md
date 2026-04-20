# 💇‍♀️ Sistema de Gestión para Salón de Belleza

Sistema web desarrollado para la administración de servicios de peluquería, gestión de citas y registro de facturación. Este proyecto permite optimizar la atención al cliente y mejorar el control interno del salón.

## 📌 Descripción

Esta aplicación permite a un salón de belleza:

- Gestionar los servicios ofrecidos (corte, tintura, peinados, etc.)
- Registrar y administrar citas de clientes
- Generar y controlar facturas
- Llevar un seguimiento organizado de la información

## 🚀 Tecnologías utilizadas

- **Backend:** Laravel  
- **Lenguaje:** PHP  
- **Base de datos:** MySQL  
- **Frontend:** HTML, CSS, JavaScript  

## ⚙️ Funcionalidades principales

### ✂️ Gestión de Servicios
- Crear, editar y eliminar servicios
- Definir precios y descripciones

### 📅 Asignación de Citas
- Registro de citas por cliente
- Selección de servicio, fecha y hora
- Control de disponibilidad

### 🧾 Registro de Facturación
- Generación de facturas por servicio
- Asociación de cliente y cita
- Control de ingresos

### 👥 Gestión de Clientes
- Registro de clientes
- Historial de servicios

## 🛠️ Instalación

Sigue estos pasos para ejecutar el proyecto en tu entorno local:

```bash
# Clonar el repositorio
git clone https://github.com/tu-usuario/tu-repositorio.git

# Entrar al proyecto
cd tu-repositorio

# Instalar dependencias
composer install

# Copiar archivo de entorno
cp .env.example .env

# Configurar la base de datos en .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Iniciar servidor
php artisan serve
