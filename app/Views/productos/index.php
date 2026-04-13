<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="space-y-4 sm:space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-500"><?= $pager->getTotal() ?> productos</h3>
        <a href="<?= base_url('productos/create') ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-3 sm:px-4 py-2 rounded-lg transition flex items-center gap-2 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <span class="hidden sm:inline">Nuevo Producto</span><span class="sm:hidden">Nuevo</span>
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50"><tr><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Categoría</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden sm:table-cell">P. Venta</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Estado</th><th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th></tr></thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($productos as $p): 
                        $stockClass = ($p['stock_actual'] <= $p['stock_minimo']) ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800';
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 sm:px-6 py-3"><div class="text-xs sm:text-sm font-mono"><?= esc($p['codigo']) ?></div></td>
                        <td class="px-3 sm:px-6 py-3"><div class="text-xs sm:text-sm font-medium text-gray-900"><?= esc($p['nombre']) ?></div></td>
                        <td class="px-3 sm:px-6 py-3 hidden md:table-cell"><div class="text-sm text-gray-500"><?= esc($p['categoria_nombre'] ?? '-') ?></div></td>
                        <td class="px-3 sm:px-6 py-3 hidden sm:table-cell"><div class="text-sm font-medium">S/ <?= number_format($p['precio_venta'], 2) ?></div></td>
                        <td class="px-3 sm:px-6 py-3"><span class="px-2 py-1 text-xs font-semibold rounded-full <?= $stockClass ?>"><?= $p['stock_actual'] ?? 0 ?></span></td>
                        <td class="px-3 sm:px-6 py-3 hidden lg:table-cell"><span class="px-2 py-1 text-xs font-semibold rounded-full <?= $p['activo'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>"><?= $p['activo'] ? 'Activo' : 'Inactivo' ?></span></td>
                        <td class="px-3 sm:px-6 py-3 text-xs sm:text-sm space-x-1 sm:space-x-2">
                            <a href="<?= base_url('productos/detail/' . $p['id']) ?>" class="text-blue-600 hover:text-blue-900">Ver</a>
                            <a href="<?= base_url('productos/edit/' . $p['id']) ?>" class="text-primary-600 hover:text-primary-900">Editar</a>
                            <a href="<?= base_url('productos/delete/' . $p['id']) ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Eliminar?')">X</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php 
        $firstItem = ($pager->getCurrentPage() - 1) * $pager->getPerPage() + 1;
        $lastItem = min($pager->getCurrentPage() * $pager->getPerPage(), $pager->getTotal());
        $currentPage = $pager->getCurrentPage();
        $pageCount = $pager->getPageCount();
    ?>
    <?php if ($pageCount > 1): ?>
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-gray-500">
            Mostrando <?= $firstItem ?> - <?= $lastItem ?> de <?= $pager->getTotal() ?>
        </p>
        <nav class="flex items-center gap-1">
            <?php if ($currentPage > 1): ?>
                <a href="<?= $pager->getPageURI(1) ?>" class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition">«</a>
                <a href="<?= $pager->getPreviousPageURI() ?>" class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition">‹</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $pageCount; $i++): ?>
                <a href="<?= $pager->getPageURI($i) ?>" class="px-3 py-1.5 text-sm rounded-lg transition <?= $i === $currentPage ? 'bg-primary-600 text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
            <?php if ($currentPage < $pageCount): ?>
                <a href="<?= $pager->getNextPageURI() ?>" class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition">›</a>
                <a href="<?= $pager->getPageURI($pageCount) ?>" class="px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 rounded-lg transition">»</a>
            <?php endif; ?>
        </nav>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>
