<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="space-y-4 sm:space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-500">Control de Inventario</h3>
        <a href="<?= base_url('stock/movimiento') ?>" class="bg-green-600 hover:bg-green-700 text-white px-3 sm:px-4 py-2 rounded-lg transition flex items-center gap-2 text-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg><span class="hidden sm:inline">Nuevo Movimiento</span><span class="sm:hidden">+</span></a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50"><tr><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Categoría</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Mín</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Estado</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th></tr></thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($productos as $p):
                        if (empty($p)) continue;
                        
                        $stockActual = $p['stock_actual'] ?? 0;
                        $stockMinimo = $p['stock_minimo'] ?? 0;
                        $estado = ($stockActual <= $stockMinimo) ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800';
                        $estadoText = ($stockActual <= $stockMinimo) ? 'Bajo' : 'Normal';
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 sm:px-6 py-3"><div class="text-xs sm:text-sm font-mono"><?= esc($p['codigo']) ?></div></td>
                        <td class="px-3 sm:px-6 py-3"><div class="text-xs sm:text-sm font-medium text-gray-900"><?= esc($p['nombre']) ?></div></td>
                        <td class="px-3 sm:px-6 py-3 hidden md:table-cell"><div class="text-sm text-gray-500"><?= esc($p['categoria_nombre'] ?? '-') ?></div></td>
                        <td class="px-3 sm:px-6 py-3"><span class="px-2 py-1 text-xs font-semibold rounded-full <?= $estado ?>"><?= $stockActual ?></span></td>
                        <td class="px-3 sm:px-6 py-3 hidden sm:table-cell text-sm text-gray-500"><?= $stockMinimo ?></td>
                        <td class="px-3 sm:px-6 py-3 hidden lg:table-cell"><span class="text-xs font-medium <?= $estado === 'bg-red-100 text-red-800' ? 'text-red-600' : 'text-green-600' ?>"><?= $estadoText ?></span></td>
                        <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm space-x-1 sm:space-x-2">
                            <a href="<?= base_url('productos/detail/' . $p['id']) ?>" class="text-blue-600 hover:text-blue-900">Ver</a>
                            <a href="<?= base_url('stock/movimiento/' . $p['id']) ?>" class="text-green-600 hover:text-green-900">+</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
