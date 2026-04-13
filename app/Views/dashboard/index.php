<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="space-y-4 sm:space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Productos</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800 mt-1"><?= $total_productos ?></p>
                </div>
                <div class="bg-blue-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Categorías</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800 mt-1"><?= $total_categorias ?></p>
                </div>
                <div class="bg-purple-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Proveedores</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800 mt-1"><?= $total_proveedores ?></p>
                </div>
                <div class="bg-green-100 p-2 sm:p-3 rounded-lg">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 00-3 3 3 3 0 003 3zm6 3a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        <!-- Stock Bajo -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base sm:text-lg font-semibold text-gray-800">⚠️ Stock Bajo</h3>
            </div>
            <div class="p-4 sm:p-6">
                <?php if (empty($stock_bajo)): ?>
                    <p class="text-gray-500 text-center py-4 text-sm">No hay productos con stock bajo</p>
                <?php else: ?>
                    <div class="space-y-2 sm:space-y-3">
                        <?php foreach ($stock_bajo as $item): ?>
                            <div class="flex items-center justify-between p-2 sm:p-3 bg-red-50 rounded-lg">
                                <div class="min-w-0 flex-1">
                                    <p class="font-medium text-gray-800 text-sm truncate"><?= esc($item['nombre']) ?></p>
                                    <p class="text-xs text-gray-500">Stock: <?= $item['stock_actual'] ?> / Mín: <?= $item['stock_minimo'] ?></p>
                                </div>
                                <span class="text-red-600 font-semibold text-xs sm:text-sm flex-shrink-0 ml-2">Faltan <?= $item['cantidad_faltante'] ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Últimos Movimientos -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-base sm:text-lg font-semibold text-gray-800">📋 Últimos Movimientos</h3>
                <a href="<?= base_url('stock/historial') ?>" class="text-xs sm:text-sm text-primary-600 hover:text-primary-800 flex-shrink-0">Ver todos →</a>
            </div>
            <div class="p-4 sm:p-6">
                <?php if (empty($ultimos_movimientos)): ?>
                    <p class="text-gray-500 text-center py-4 text-sm">No hay movimientos registrados</p>
                <?php else: ?>
                    <div class="space-y-2 sm:space-y-3">
                        <?php foreach (array_slice($ultimos_movimientos, 0, 5) as $mov): ?>
                            <div class="flex items-center justify-between p-2 sm:p-3 bg-gray-50 rounded-lg">
                                <div class="min-w-0 flex-1">
                                    <p class="font-medium text-gray-800 text-sm truncate"><?= esc($mov['producto_nombre'] ?? 'N/A') ?></p>
                                    <p class="text-xs text-gray-500"><?= esc($mov['usuario_nombre'] ?? 'N/A') ?> - <?= date('d/m/Y', strtotime($mov['fecha_movimiento'])) ?></p>
                                </div>
                                <span class="px-2 py-1 rounded text-xs font-semibold flex-shrink-0 ml-2
                                    <?= $mov['tipo_movimiento'] === 'entrada' ? 'bg-green-100 text-green-800' : '' ?>
                                    <?= $mov['tipo_movimiento'] === 'salida' ? 'bg-red-100 text-red-800' : '' ?>
                                    <?= $mov['tipo_movimiento'] === 'ajuste' ? 'bg-yellow-100 text-yellow-800' : '' ?>
                                    <?= $mov['tipo_movimiento'] === 'devolucion' ? 'bg-blue-100 text-blue-800' : '' ?>">
                                    <?= ucfirst($mov['tipo_movimiento']) ?> <?= $mov['cantidad'] ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
