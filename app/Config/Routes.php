<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');

// Protected routes (require authentication)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Dashboard::index');

    // Usuarios
    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('usuarios/create', 'Usuarios::create');
    $routes->post('usuarios/store', 'Usuarios::store');
    $routes->get('usuarios/edit/(:num)', 'Usuarios::edit/$1');
    $routes->post('usuarios/update/(:num)', 'Usuarios::update/$1');
    $routes->get('usuarios/delete/(:num)', 'Usuarios::delete/$1');
    $routes->get('usuarios/toggle-activo/(:num)', 'Usuarios::toggleActivo/$1');

    // Roles
    $routes->get('roles', 'Roles::index');
    $routes->get('roles/create', 'Roles::create');
    $routes->post('roles/store', 'Roles::store');
    $routes->get('roles/edit/(:num)', 'Roles::edit/$1');
    $routes->post('roles/update/(:num)', 'Roles::update/$1');
    $routes->get('roles/delete/(:num)', 'Roles::delete/$1');

    // Categorías
    $routes->get('categorias', 'Categorias::index');
    $routes->get('categorias/create', 'Categorias::create');
    $routes->post('categorias/store', 'Categorias::store');
    $routes->get('categorias/edit/(:num)', 'Categorias::edit/$1');
    $routes->post('categorias/update/(:num)', 'Categorias::update/$1');
    $routes->get('categorias/delete/(:num)', 'Categorias::delete/$1');
    $routes->get('categorias/toggle-activo/(:num)', 'Categorias::toggleActivo/$1');

    // Marcas
    $routes->get('marcas', 'Marcas::index');
    $routes->get('marcas/create', 'Marcas::create');
    $routes->post('marcas/store', 'Marcas::store');
    $routes->get('marcas/edit/(:num)', 'Marcas::edit/$1');
    $routes->post('marcas/update/(:num)', 'Marcas::update/$1');
    $routes->get('marcas/delete/(:num)', 'Marcas::delete/$1');
    $routes->get('marcas/toggle-activo/(:num)', 'Marcas::toggleActivo/$1');

    // Proveedores
    $routes->get('proveedores', 'Proveedores::index');
    $routes->get('proveedores/create', 'Proveedores::create');
    $routes->post('proveedores/store', 'Proveedores::store');
    $routes->get('proveedores/edit/(:num)', 'Proveedores::edit/$1');
    $routes->post('proveedores/update/(:num)', 'Proveedores::update/$1');
    $routes->get('proveedores/delete/(:num)', 'Proveedores::delete/$1');
    $routes->get('proveedores/toggle-activo/(:num)', 'Proveedores::toggleActivo/$1');

    // Productos
    $routes->get('productos', 'Productos::index');
    $routes->get('productos/create', 'Productos::create');
    $routes->post('productos/store', 'Productos::store');
    $routes->get('productos/detail/(:num)', 'Productos::detail/$1');
    $routes->get('productos/edit/(:num)', 'Productos::edit/$1');
    $routes->post('productos/update/(:num)', 'Productos::update/$1');
    $routes->get('productos/delete/(:num)', 'Productos::delete/$1');
    $routes->get('productos/toggle-activo/(:num)', 'Productos::toggleActivo/$1');

    // Stock
    $routes->get('stock', 'Stock::index');
    $routes->get('stock/movimiento', 'Stock::movimiento');
    $routes->get('stock/movimiento/(:num)', 'Stock::movimiento/$1');
    $routes->post('stock/registrar-movimiento', 'Stock::registrarMovimiento');
    $routes->get('stock/historial', 'Stock::historial');
    $routes->get('stock/historial/(:num)', 'Stock::historial/$1');
    $routes->get('stock/bajo', 'Stock::stockBajo');

    // Almacenes
    $routes->get('almacenes', 'Almacenes::index');
    $routes->get('almacenes/create', 'Almacenes::create');
    $routes->post('almacenes/store', 'Almacenes::store');
    $routes->get('almacenes/edit/(:num)', 'Almacenes::edit/$1');
    $routes->post('almacenes/update/(:num)', 'Almacenes::update/$1');
    $routes->get('almacenes/delete/(:num)', 'Almacenes::delete/$1');
    $routes->get('almacenes/toggle-activo/(:num)', 'Almacenes::toggleActivo/$1');
});
