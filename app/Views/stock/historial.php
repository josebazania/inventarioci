<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="space-y-4 sm:space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-500">Historial de Movimientos</h3>
        <a href="<?= base_url('stock') ?>" class="text-primary-600 hover:text-primary-800 text-sm">← Volver</a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden"><div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50"><tr><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">Cantidad</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Usuario</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Motivo</th></tr></thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($movimientos as $m): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm text-gray-500"><?= date('d/m/Y H:i', strtotime($m['fecha_movimiento'])) ?></td>
                    <td class="px-3 sm:px-6 py-3"><div class="text-xs sm:text-sm font-medium text-gray-900 truncate max-w-[120px] sm:max-w-none"><?= esc($m['producto_nombre'] ?? '-') ?></div></td>
                    <td class="px-3 sm:px-6 py-3"><span class="px-2 py-1 text-xs font-semibold rounded-full <?= $m['tipo_movimiento'] === 'entrada' ? 'bg-green-100 text-green-800' : ($m['tipo_movimiento'] === 'salida' ? 'bg-red-100 text-red-800' : ($m['tipo_movimiento'] === 'devolucion' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800')) ?>"><?= ucfirst($m['tipo_movimiento']) ?></span></td>
                    <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm font-medium hidden sm:table-cell"><?= $m['cantidad'] ?></td>
                    <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm text-gray-500 hidden md:table-cell"><?= esc($m['usuario_nombre'] ?? '-') ?></td>
                    <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm text-gray-500 hidden lg:table-cell"><?= esc($m['motivo'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($movimientos)): ?>
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500 text-sm">No hay movimientos registrados</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div></div>
</div>
<?= $this->endSection() ?>
