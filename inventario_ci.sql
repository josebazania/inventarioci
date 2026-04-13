-- ============================================
-- Base de datos: Inventario CI
-- ============================================

CREATE DATABASE IF NOT EXISTS inventario_ci
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE inventario_ci;

-- ============================================
-- Tabla: roles
-- ============================================
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- Tabla: usuarios
-- ============================================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ============================================
-- Tabla: categorias
-- ============================================
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    descripcion TEXT,
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- Tabla: marcas
-- ============================================
CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- Tabla: proveedores
-- ============================================
CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    ruc VARCHAR(20) UNIQUE,
    direccion TEXT,
    telefono VARCHAR(20),
    email VARCHAR(100),
    contacto VARCHAR(100),
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- Tabla: productos
-- ============================================
CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    categoria_id INT NOT NULL,
    marca_id INT,
    proveedor_id INT,
    precio_compra DECIMAL(10,2) DEFAULT 0.00,
    precio_venta DECIMAL(10,2) DEFAULT 0.00,
    stock_minimo INT DEFAULT 0,
    stock_maximo INT DEFAULT 0,
    imagen VARCHAR(255),
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT,
    FOREIGN KEY (marca_id) REFERENCES marcas(id) ON DELETE SET NULL,
    FOREIGN KEY (proveedor_id) REFERENCES proveedores(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================
-- Tabla: stocks
-- ============================================
CREATE TABLE stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE,
    UNIQUE KEY unique_producto_stock (producto_id)
) ENGINE=InnoDB;

-- ============================================
-- Tabla: movimientos_stock
-- ============================================
CREATE TABLE movimientos_stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    tipo_movimiento ENUM('entrada', 'salida', 'ajuste', 'devolucion') NOT NULL,
    cantidad INT NOT NULL,
    motivo VARCHAR(255),
    usuario_id INT NOT NULL,
    fecha_movimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ============================================
-- Tabla: almacenes
-- ============================================
CREATE TABLE almacenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    ubicacion VARCHAR(200),
    descripcion TEXT,
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- Tabla: stock_almacen
-- ============================================
CREATE TABLE stock_almacen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    almacen_id INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE,
    FOREIGN KEY (almacen_id) REFERENCES almacenes(id) ON DELETE CASCADE,
    UNIQUE KEY unique_producto_almacen (producto_id, almacen_id)
) ENGINE=InnoDB;

-- ============================================
-- Tabla: transferencias
-- ============================================
CREATE TABLE transferencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    almacen_origen_id INT NOT NULL,
    almacen_destino_id INT NOT NULL,
    cantidad INT NOT NULL,
    motivo VARCHAR(255),
    usuario_id INT NOT NULL,
    fecha_transferencia TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE,
    FOREIGN KEY (almacen_origen_id) REFERENCES almacenes(id) ON DELETE RESTRICT,
    FOREIGN KEY (almacen_destino_id) REFERENCES almacenes(id) ON DELETE RESTRICT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ============================================
-- Tabla: permisos
-- ============================================
CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    modulo VARCHAR(50) NOT NULL,
    descripcion TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================
-- Tabla: role_permiso
-- ============================================
CREATE TABLE role_permiso (
    role_id INT NOT NULL,
    permiso_id INT NOT NULL,
    PRIMARY KEY (role_id, permiso_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permiso_id) REFERENCES permisos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================
-- Tabla: logs_actividad
-- ============================================
CREATE TABLE logs_actividad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    accion VARCHAR(255) NOT NULL,
    modulo VARCHAR(50),
    descripcion TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ============================================
-- VISTA: Stock actual con detalles
-- ============================================
CREATE VIEW vista_stock_actual AS
SELECT 
    p.id AS producto_id,
    p.codigo,
    p.nombre AS producto_nombre,
    c.nombre AS categoria_nombre,
    m.nombre AS marca_nombre,
    pr.nombre AS proveedor_nombre,
    s.cantidad AS stock_actual,
    p.stock_minimo,
    p.stock_maximo,
    CASE 
        WHEN s.cantidad <= p.stock_minimo THEN 'Stock Bajo'
        WHEN s.cantidad >= p.stock_maximo AND p.stock_maximo > 0 THEN 'Stock Excedido'
        ELSE 'Normal'
    END AS estado_stock
FROM productos p
LEFT JOIN stocks s ON p.id = s.producto_id
LEFT JOIN categorias c ON p.categoria_id = c.id
LEFT JOIN marcas m ON p.marca_id = m.id
LEFT JOIN proveedores pr ON p.proveedor_id = pr.id
WHERE p.activo = 1;

-- ============================================
-- VISTA: Productos con stock bajo
-- ============================================
CREATE VIEW vista_stock_bajo AS
SELECT 
    p.id AS producto_id,
    p.codigo,
    p.nombre AS producto_nombre,
    c.nombre AS categoria_nombre,
    s.cantidad AS stock_actual,
    p.stock_minimo,
    (p.stock_minimo - s.cantidad) AS cantidad_faltante
FROM productos p
LEFT JOIN stocks s ON p.id = s.producto_id
LEFT JOIN categorias c ON p.categoria_id = c.id
WHERE p.activo = 1 
  AND s.cantidad <= p.stock_minimo;

-- ============================================
-- DATOS SEMILLA
-- ============================================

-- Roles
INSERT INTO roles (nombre, descripcion) VALUES
('Administrador', 'Acceso completo al sistema'),
('Almacenista', 'Gestión de stock y movimientos'),
('Supervisor', 'Supervisión y reportes'),
('Consulta', 'Solo lectura de información');

-- Permisos
INSERT INTO permisos (nombre, modulo, descripcion) VALUES
('usuarios.create', 'usuarios', 'Crear usuarios'),
('usuarios.read', 'usuarios', 'Ver usuarios'),
('usuarios.update', 'usuarios', 'Actualizar usuarios'),
('usuarios.delete', 'usuarios', 'Eliminar usuarios'),
('productos.create', 'productos', 'Crear productos'),
('productos.read', 'productos', 'Ver productos'),
('productos.update', 'productos', 'Actualizar productos'),
('productos.delete', 'productos', 'Eliminar productos'),
('categorias.create', 'categorias', 'Crear categorías'),
('categorias.read', 'categorias', 'Ver categorías'),
('categorias.update', 'categorias', 'Actualizar categorías'),
('categorias.delete', 'categorias', 'Eliminar categorías'),
('stock.entrada', 'stock', 'Registrar entrada de stock'),
('stock.salida', 'stock', 'Registrar salida de stock'),
('stock.ajuste', 'stock', 'Ajustar stock'),
('stock.ver', 'stock', 'Ver stock'),
('reportes.ver', 'reportes', 'Ver reportes'),
('transferencias.create', 'transferencias', 'Crear transferencias'),
('transferencias.read', 'transferencias', 'Ver transferencias');

-- Asignar permisos a roles
-- Administrador: todos los permisos
INSERT INTO role_permiso (role_id, permiso_id)
SELECT 1, id FROM permisos;

-- Almacenista: permisos de stock y lectura
INSERT INTO role_permiso (role_id, permiso_id)
SELECT 2, id FROM permisos WHERE modulo IN ('stock', 'transferencias', 'productos') 
  AND nombre LIKE '%.read' OR nombre LIKE 'stock.%' OR nombre LIKE 'transferencias.%';

-- Supervisor: lectura y reportes
INSERT INTO role_permiso (role_id, permiso_id)
SELECT 3, id FROM permisos WHERE nombre LIKE '%.read' OR modulo = 'reportes' OR modulo = 'stock';

-- Consulta: solo lectura
INSERT INTO role_permiso (role_id, permiso_id)
SELECT 4, id FROM permisos WHERE nombre LIKE '%.read';

-- Usuarios (password: admin123 → hash generado con password_hash)
-- En producción, cambiar estas contraseñas
INSERT INTO usuarios (nombre_completo, email, password, role_id) VALUES
('Admin Sistema', 'admin@inventario.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
('Juan Almacen', 'juan@inventario.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
('Maria Supervisor', 'maria@inventario.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3);

-- Categorías
INSERT INTO categorias (nombre, descripcion) VALUES
('Electrónica', 'Productos y componentes electrónicos'),
('Oficina', 'Artículos y suministros de oficina'),
('Limpieza', 'Productos de limpieza'),
('Seguridad', 'Equipos de seguridad'),
('Herramientas', 'Herramientas manuales y eléctricas'),
('Redes', 'Equipos y accesorios de red'),
('Software', 'Licencias de software'),
('Mobiliario', 'Mobiliario de oficina');

-- Marcas
INSERT INTO marcas (nombre) VALUES
('Genérico'),
('Logitech'),
('HP'),
('Dell'),
('Microsoft'),
('Samsung'),
('3M'),
('Stanley');

-- Proveedores
INSERT INTO proveedores (nombre, ruc, direccion, telefono, email, contacto) VALUES
('TechDistribuciones SAC', '20601234567', 'Av. Tecnológica 123, Lima', '01-2345678', 'ventas@techdist.com', 'Carlos Ruiz'),
('OficinaPlus EIRL', '20609876543', 'Jr. Comercio 456, Lima', '01-8765432', 'info@oficinaplus.com', 'Ana Torres'),
('LimpioMax SAC', '20605555555', 'Av. Industrial 789, Lima', '01-5555555', 'contacto@limpiomax.com', 'Pedro Gomez');

-- Productos
INSERT INTO productos (codigo, nombre, descripcion, categoria_id, marca_id, proveedor_id, precio_compra, precio_venta, stock_minimo, stock_maximo) VALUES
('ELEC-001', 'Mouse Inalámbrico', 'Mouse inalámbrico ergonómico', 1, 2, 1, 25.00, 45.00, 10, 100),
('ELEC-002', 'Teclado Mecánico', 'Teclado mecánico retroiluminado', 1, 2, 1, 80.00, 150.00, 5, 50),
('ELEC-003', 'Monitor 24"', 'Monitor LED Full HD 24 pulgadas', 1, 6, 1, 350.00, 550.00, 3, 30),
('OFI-001', 'Resma Papel A4', 'Resma de papel A4 500 hojas', 2, 1, 2, 8.00, 15.00, 50, 500),
('OFI-002', 'Bolígrafo Azul (caja)', 'Caja de 50 bolígrafos azules', 2, 1, 2, 12.00, 22.00, 20, 200),
('LIMP-001', 'Desinfectante Multiuso', 'Desinfectante multiuso 5L', 3, 1, 3, 15.00, 28.00, 10, 100),
('LIMP-002', 'Toallas de Papel (pack)', 'Pack 6 rollos toallas de papel', 3, 1, 3, 10.00, 18.00, 15, 150),
('SEG-001', 'Extintor PQS 6kg', 'Extintor de polvo químico seco 6kg', 4, 1, 1, 60.00, 95.00, 5, 50),
('SEG-002', 'Botiquín Primeros Auxilios', 'Botiquín completo 20 piezas', 4, 1, 1, 45.00, 75.00, 3, 30),
('HERR-001', 'Set Destornilladores', 'Set de 20 destornilladores', 5, 8, 1, 35.00, 60.00, 5, 50),
('RED-001', 'Cable Ethernet Cat6 (305m)', 'Rollo cable de red 305 metros', 6, 1, 1, 85.00, 140.00, 5, 50),
('RED-002', 'Switch 8 Puertos', 'Switch de red 8 puertos Gigabit', 6, 3, 1, 45.00, 75.00, 5, 40),
('SOFT-001', 'Licencia Office 365', 'Licencia anual Office 365 Business', 7, 5, 1, 85.00, 120.00, 0, 200),
('MOB-001', 'Silla Ergonómica', 'Silla de oficina ergonómica ajustable', 8, 1, 2, 180.00, 300.00, 3, 30),
('MOB-002', 'Escritorio 1.40m', 'Escritorio de oficina 1.40x0.70m', 8, 1, 2, 220.00, 380.00, 2, 20);

-- Stocks iniciales
INSERT INTO stocks (producto_id, cantidad) VALUES
(1, 35),
(2, 12),
(3, 8),
(4, 150),
(5, 45),
(6, 25),
(7, 30),
(8, 10),
(9, 8),
(10, 15),
(11, 12),
(12, 18),
(13, 50),
(14, 10),
(15, 7);

-- Almacenes
INSERT INTO almacenes (nombre, ubicacion, descripcion) VALUES
('Almacén Principal', 'Edificio A - Sótano', 'Almacén central de inventario'),
('Almacén Oficina Central', 'Piso 2 - Sala 201', 'Almacén de suministros de oficina'),
('Almacén Seguridad', 'Edificio B - Planta Baja', 'Almacén de equipos de seguridad');

-- Stock por almacén
INSERT INTO stock_almacen (producto_id, almacen_id, cantidad) VALUES
(1, 1, 20),
(1, 2, 15),
(2, 1, 12),
(3, 1, 8),
(4, 2, 100),
(4, 1, 50),
(5, 2, 45),
(6, 2, 25),
(7, 2, 30),
(8, 3, 10),
(9, 3, 8),
(10, 1, 15),
(11, 1, 12),
(12, 1, 18),
(13, 1, 50),
(14, 1, 5),
(14, 2, 5),
(15, 1, 7);

-- Movimientos de stock iniciales
INSERT INTO movimientos_stock (producto_id, tipo_movimiento, cantidad, motivo, usuario_id) VALUES
(1, 'entrada', 50, 'Compra inicial a TechDistribuciones', 1),
(2, 'entrada', 20, 'Compra inicial a TechDistribuciones', 1),
(4, 'entrada', 200, 'Compra inicial a OficinaPlus', 1),
(6, 'entrada', 40, 'Compra inicial a LimpioMax', 1),
(8, 'entrada', 15, 'Compra inicial de equipos seguridad', 1);

-- ============================================
-- FIN DEL SCRIPT
-- ============================================
