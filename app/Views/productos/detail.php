<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <a href="<?= base_url('productos') ?>" class="text-primary-600 hover:text-primary-800 flex items-center gap-1"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>Volver</a>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del Producto</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">Código:</span><p class="font-medium"><?= esc($producto['codigo']) ?></p></div>
                <div><span class="text-gray-500">Nombre:</span><p class="font-medium"><?= esc($producto['nombre']) ?></p></div>
                <div><span class="text-gray-500">Categoría:</span><p class="font-medium"><?= esc($producto['categoria_nombre'] ?? '-') ?></p></div>
                <div><span class="text-gray-500">Marca:</span><p class="font-medium"><?= esc($producto['marca_nombre'] ?? '-') ?></p></div>
                <div><span class="text-gray-500">Proveedor:</span><p class="font-medium"><?= esc($producto['proveedor_nombre'] ?? '-') ?></p></div>
                <div><span class="text-gray-500">Stock:</span><p class="font-medium"><?= $producto['stock_actual'] ?? 0 ?></p></div>
                <div><span class="text-gray-500">P. Compra:</span><p class="font-medium">S/ <?= number_format($producto['precio_compra'], 2) ?></p></div>
                <div><span class="text-gray-500">P. Venta:</span><p class="font-medium">S/ <?= number_format($producto['precio_venta'], 2) ?></p></div>
                <div><span class="text-gray-500">Stock Mín:</span><p class="font-medium"><?= $producto['stock_minimo'] ?></p></div>
                <div><span class="text-gray-500">Stock Máx:</span><p class="font-medium"><?= $producto['stock_maximo'] ?></p></div>
            </div>
            <?php if ($producto['descripcion']): ?><div class="mt-4"><span class="text-gray-500 text-sm">Descripción:</span><p class="mt-1"><?= esc($producto['descripcion']) ?></p></div><?php endif; ?>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Acciones</h3>
            <div class="space-y-3">
                <a href="<?= base_url('stock/movimiento/' . $producto['id']) ?>" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">Registrar Entrada</a>
                <a href="<?= base_url('productos/edit/' . $producto['id']) ?>" class="block w-full text-center bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg transition">Editar Producto</a>
                <a href="<?= base_url('stock/historial/' . $producto['id']) ?>" class="block w-full text-center bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Ver Historial</a>
            </div>
        </div>
    </div>

    <?php if (!empty($movimientos)): ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200"><h3 class="text-lg font-semibold text-gray-800">Historial de Movimientos</h3></div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50"><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cantidad</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Motivo</th></tr></thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($movimientos as $m): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm text-gray-500"><?= date('d/m/Y H:i', strtotime($m['fecha_movimiento'])) ?></td>
                        <td class="px-6 py-3"><span class="px-2 py-1 text-xs font-semibold rounded-full <?= $m['tipo_movimiento'] === 'entrada' ? 'bg-green-100 text-green-800' : ($m['tipo_movimiento'] === 'salida' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') ?>"><?= ucfirst($m['tipo_movimiento']) ?></span></td>
                        <td class="px-6 py-3 text-sm font-medium"><?= $m['cantidad'] ?></td>
                        <td class="px-6 py-3 text-sm text-gray-500"><?= esc($m['usuario_nombre'] ?? '-') ?></td>
                        <td class="px-6 py-3 text-sm text-gray-500"><?= esc($m['motivo'] ?? '-') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
