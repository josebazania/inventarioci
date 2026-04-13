<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="space-y-4 sm:space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-medium text-gray-500"><?= count($usuarios) ?> usuarios registrados</h3>
        <a href="<?= base_url('usuarios/create') ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-3 sm:px-4 py-2 rounded-lg transition flex items-center gap-2 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            <span class="hidden sm:inline">Nuevo Usuario</span><span class="sm:hidden">Nuevo</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Email</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Estado</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($usuarios as $u): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 sm:px-6 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?= esc($u['nombre_completo']) ?></div>
                            <div class="text-xs text-gray-500 sm:hidden"><?= esc($u['email']) ?></div>
                        </td>
                        <td class="px-4 sm:px-6 py-3 whitespace-nowrap hidden sm:table-cell">
                            <div class="text-sm text-gray-500"><?= esc($u['email']) ?></div>
                        </td>
                        <td class="px-4 sm:px-6 py-3 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800"><?= esc($u['role_nombre']) ?></span>
                        </td>
                        <td class="px-4 sm:px-6 py-3 whitespace-nowrap hidden md:table-cell">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full <?= $u['activo'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $u['activo'] ? 'Activo' : 'Inactivo' ?>
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-3 whitespace-nowrap text-xs sm:text-sm space-x-2">
                            <a href="<?= base_url('usuarios/edit/' . $u['id']) ?>" class="text-primary-600 hover:text-primary-900">Editar</a>
                            <a href="<?= base_url('usuarios/delete/' . $u['id']) ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Eliminar?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
