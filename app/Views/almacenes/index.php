<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="space-y-4 sm:space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-500"><?= count($almacenes) ?> almacenes</h3>
        <a href="<?= base_url('almacenes/create') ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-3 sm:px-4 py-2 rounded-lg transition flex items-center gap-2 text-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg><span class="hidden sm:inline">Nuevo Almacén</span><span class="sm:hidden">Nuevo</span></a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden"><div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50"><tr><th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th><th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden md:table-cell">Ubicación</th><th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase hidden lg:table-cell">Estado</th><th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th></tr></thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($almacenes as $a): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 sm:px-6 py-3"><div class="text-sm font-medium text-gray-900"><?= esc($a['nombre']) ?></div></td>
                    <td class="px-4 sm:px-6 py-3 hidden md:table-cell"><div class="text-sm text-gray-500"><?= esc($a['ubicacion'] ?? '-') ?></div></td>
                    <td class="px-4 sm:px-6 py-3 hidden lg:table-cell"><span class="px-2 py-1 text-xs font-semibold rounded-full <?= $a['activo'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>"><?= $a['activo'] ? 'Activo' : 'Inactivo' ?></span></td>
                    <td class="px-4 sm:px-6 py-3 text-xs sm:text-sm space-x-1 sm:space-x-2">
                        <a href="<?= base_url('almacenes/edit/' . $a['id']) ?>" class="text-primary-600 hover:text-primary-900">Editar</a>
                        <a href="<?= base_url('almacenes/delete/' . $a['id']) ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Eliminar?')">X</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div></div>
</div>
<?= $this->endSection() ?>
