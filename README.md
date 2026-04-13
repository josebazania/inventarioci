# Sistema de Inventario CI

Sistema de gestión de inventario desarrollado con CodeIgniter 4. Permite controlar productos, stock, movimientos, almacenes, usuarios y roles con permisos granulares.

## Características principales

### Gestión de inventario
- CRUD completo de **productos** con código único, categoría, marca, proveedor, precios y niveles de stock
- Control de **stock actual** por producto con stock mínimo y máximo configurable
- Registro de **movimientos de stock** (entradas, salidas, ajustes y devoluciones)
- **Múltiples almacenes** con control de stock por ubicación
- **Transferencias** entre almacenes
- **Historial completo** de movimientos de stock

### Vistas de base de datos
- `vista_stock_actual`: consulta consolidada de stock con estado (Normal, Bajo, Excedido)
- `vista_stock_bajo`: productos que requieren reposición

### Gestión organizacional
- **Categorías** y **marcas** para clasificación de productos
- **Proveedores** con datos de contacto
- **Almacenes** con ubicación y descripción

### Seguridad y usuarios
- Sistema de **autenticación** con sesiones
- **Roles** predefinidos: Administrador, Almacenista, Supervisor, Consulta
- **Permisos granulares** por módulo (usuarios, productos, categorías, stock, transferencias, reportes)
- **Asignación de permisos** a roles mediante tabla pivote
- **Log de actividad** con registro de acciones, IP y módulo

### Dashboard
- Panel de control con resumen del inventario
- Alertas de stock bajo

## Tecnologías

| Tecnología | Versión / Detalle |
|---|---|
| Framework | CodeIgniter 4.7.2 |
| PHP | 8.2+ |
| Base de datos | MySQL / MariaDB (InnoDB) |
| Frontend | Tailwind CSS |
| Motor de plantillas | CodeIgniter Views |

## Estructura del proyecto

```
inventarioci/
├── app/
│   ├── Controllers/          # Controladores de la aplicación
│   │   ├── Almacenes.php
│   │   ├── Auth.php
│   │   ├── Categorias.php
│   │   ├── Dashboard.php
│   │   ├── Marcas.php
│   │   ├── Productos.php
│   │   ├── Proveedores.php
│   │   ├── Roles.php
│   │   ├── Stock.php
│   │   └── Usuarios.php
│   ├── Models/               # Modelos con lógica de datos
│   │   ├── AlmacenModel.php
│   │   ├── CategoriaModel.php
│   │   ├── MarcaModel.php
│   │   ├── MovimientoStockModel.php
│   │   ├── PermisoModel.php
│   │   ├── ProductoModel.php
│   │   ├── ProveedorModel.php
│   │   ├── RoleModel.php
│   │   ├── StockModel.php
│   │   └── UserModel.php
│   ├── Views/                # Vistas (HTML + Tailwind CSS)
│   └── Database/
│       ├── Migrations/       # 15 migraciones de tablas y vistas
│       └── Seeds/            # 6 seeders con datos iniciales
├── public/                   # Directorio público (index.php)
└── writable/                 # Directorio de escritura (logs, caché, uploads)
```

## Instalación

### Requisitos del servidor

- PHP 8.2 o superior
- Extensiones PHP: `intl`, `mbstring`, `mysqli`, `json`
- MySQL 5.7+ o MariaDB 10.3+
- Composer

### Pasos de instalación

1. **Clonar o subir el proyecto** al servidor

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar variables de entorno**
   
   Copiar el archivo `.env` y configurar la conexión a la base de datos:
   ```
   database.default.hostname = localhost
   database.default.database = inventario_ci
   database.default.username = tu_usuario
   database.default.password = tu_password
   database.default.DBDriver = MySQLi
   database.default.DBPrefix =
   database.default.port = 3306
   ```

4. **Ejecutar migraciones**
   ```bash
   php spark migrate
   ```

5. **Cargar datos semilla**
   ```bash
   php spark db:seed InventarioSeeder
   ```

6. **Configurar el servidor web** para apuntar al directorio `public/`

7. **Acceder al sistema**
   
   | Usuario | Email | Contraseña | Rol |
   |---|---|---|---|
   | Admin Sistema | admin@inventario.com | admin123 | Administrador |
   | Juan Almacen | juan@inventario.com | admin123 | Almacenista |
   | Maria Supervisor | maria@inventario.com | admin123 | Supervisor |

### Instalación en hosting compartido

1. Subir todos los archivos al hosting
2. Ejecutar en la consola del hosting (SSH):
   ```bash
   composer install --no-dev --optimize-autoloader
   php spark migrate
   php spark db:seed InventarioSeeder
   ```
3. Configurar el documento raíz del dominio al directorio `public/`

## Migraciones y Seeders

El proyecto utiliza el sistema de migraciones de CodeIgniter 4 para control de versiones de la base de datos.

### Migraciones disponibles

| # | Migración | Descripción |
|---|---|---|
| 1 | `CreateRolesTable` | Tabla de roles de usuario |
| 2 | `CreatePermisosTable` | Tabla de permisos del sistema |
| 3 | `CreateCategoriasTable` | Tabla de categorías de productos |
| 4 | `CreateMarcasTable` | Tabla de marcas |
| 5 | `CreateProveedoresTable` | Tabla de proveedores |
| 6 | `CreateAlmacenesTable` | Tabla de almacenes |
| 7 | `CreateUsuariosTable` | Tabla de usuarios (FK: roles) |
| 8 | `CreateRolePermisoTable` | Tabla pivote role-permiso |
| 9 | `CreateProductosTable` | Tabla de productos (FK: categoría, marca, proveedor) |
| 10 | `CreateStocksTable` | Tabla de stock por producto |
| 11 | `CreateMovimientosStockTable` | Tabla de movimientos de stock |
| 12 | `CreateStockAlmacenTable` | Tabla de stock por almacén |
| 13 | `CreateTransferenciasTable` | Tabla de transferencias entre almacenes |
| 14 | `CreateLogsActividadTable` | Tabla de log de actividad |
| 15 | `CreateStockViews` | Vistas de stock actual y stock bajo |

### Seeders disponibles

| Seeder | Descripción |
|---|---|
| `RolesSeeder` | 4 roles base (Administrador, Almacenista, Supervisor, Consulta) |
| `PermisosSeeder` | 18 permisos + asignaciones a roles |
| `UsuariosSeeder` | 3 usuarios iniciales |
| `CatalogosSeeder` | Categorías, marcas y proveedores de ejemplo |
| `ProductosSeeder` | 15 productos, stocks, almacenes y movimientos iniciales |
| `InventarioSeeder` | **Orquestador**: ejecuta todos los seeders en orden |

### Comandos útiles

```bash
# Ejecutar todas las migraciones
php spark migrate

# Revertir última migración
php spark migrate:rollback

# Revertir todas las migraciones
php spark migrate:rollback --all

# Ver estado de las migraciones
php spark migrate:status

# Ejecutar seeder específico
php spark db:seed InventarioSeeder

# Limpiar caché
php spark cache:clear
```

## Base de datos

### Tablas principales

| Tabla | Descripción |
|---|---|
| `roles` | Roles de usuario del sistema |
| `permisos` | Permisos disponibles por módulo |
| `role_permiso` | Relación many-to-many entre roles y permisos |
| `usuarios` | Usuarios del sistema |
| `categorias` | Categorías de productos |
| `marcas` | Marcas de productos |
| `proveedores` | Proveedores |
| `productos` | Catálogo de productos |
| `stocks` | Stock actual por producto |
| `movimientos_stock` | Historial de entradas, salidas, ajustes y devoluciones |
| `almacenes` | Almacenes o ubicaciones de almacenamiento |
| `stock_almacen` | Stock distribuido por almacén |
| `transferencias` | Registro de transferencias entre almacenes |
| `logs_actividad` | Auditoría de acciones del sistema |

### Vistas

| Vista | Descripción |
|---|---|
| `vista_stock_actual` | Consulta consolidada de stock con cálculo de estado |
| `vista_stock_bajo` | Productos con stock igual o inferior al mínimo |

## Roles y permisos

### Roles predefinidos

| Rol | Descripción | Acceso |
|---|---|---|
| Administrador | Acceso completo al sistema | Todos los permisos |
| Almacenista | Gestión operativa de stock | Productos (CRUD), stock (entradas/salidas/ajustes/consulta), transferencias |
| Supervisor | Supervisión y reportes | Lectura general, stock, reportes |
| Consulta | Solo lectura | Lectura básica de módulos principales |

### Módulos con permisos

- `usuarios` — create, read, update, delete
- `productos` — create, read, update, delete
- `categorias` — create, read, update, delete
- `stock` — entrada, salida, ajuste, ver
- `transferencias` — create, read
- `reportes` — ver

## Contraseñas

Las contraseñas por defecto (`admin123`) están hasheadas con `password_hash()` (bcrypt). Se recomienda cambiarlas tras el primer acceso.

## Licencia

Este proyecto utiliza CodeIgniter 4 bajo licencia MIT.
