<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="space-y-4 sm:space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-500">⚠️ Stock Bajo</h3>
        <a href="<?= base_url('stock') ?>" class="text-primary-600 hover:text-primary-800 text-sm">← Volver</a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden"><div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-red-50"><tr><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-red-600 uppercase">Código</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-red-600 uppercase">Producto</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-red-600 uppercase hidden sm:table-cell">Categoría</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-red-600 uppercase">Stock</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-red-600 uppercase hidden md:table-cell">Mínimo</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-red-600 uppercase hidden lg:table-cell">Faltante</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-red-600 uppercase">Acción</th></tr></thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($stock_bajo as $s): ?>
                <tr class="hover:bg-red-50">
                    <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm font-mono"><?= esc($s['codigo']) ?></td>
                    <td class="px-3 sm:px-6 py-3"><div class="text-xs sm:text-sm font-medium text-gray-900"><?= esc($s['nombre']) ?></div></td>
                    <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm text-gray-500 hidden sm:table-cell"><?= esc($s['categoria_nombre'] ?? '-') ?></td>
                    <td class="px-3 sm:px-6 py-3"><span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800"><?= $s['stock_actual'] ?></span></td>
                    <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm text-gray-500 hidden md:table-cell"><?= $s['stock_minimo'] ?></td>
                    <td class="px-3 sm:px-6 py-3 hidden lg:table-cell"><span class="text-red-600 font-semibold text-sm"><?= $s['cantidad_faltante'] ?></span></td>
                    <td class="px-3 sm:px-6 py-3"><a href="<?= base_url('stock/movimiento/' . $s['id']) ?>" class="text-green-600 hover:text-green-900 text-xs sm:text-sm">+ Stock</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($stock_bajo)): ?>
                <tr><td colspan="7" class="px-6 py-8 text-center text-green-600 font-medium text-sm">✅ Todos los productos tienen stock suficiente</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div></div>
</div>
<?= $this->endSection() ?>
