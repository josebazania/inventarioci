<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800"><?= $title ?></h3>
        </div>
        <form action="<?= base_url('roles/update/' . $role['id']) ?>" method="POST" class="p-6 space-y-5">
            <?= csrf_field() ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="<?= old('nombre', $role['nombre']) ?>" required
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <input type="text" name="descripcion" value="<?= old('descripcion', $role['descripcion'] ?? '') ?>"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Permisos</label>
                <div class="space-y-4 border border-gray-200 rounded-lg p-4">
                    <?php foreach ($permisos as $modulo => $lista): ?>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-2 capitalize"><?= esc($modulo) ?></h4>
                            <div class="flex flex-wrap gap-4">
                                <?php foreach ($lista as $p): ?>
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permisos[]" value="<?= $p['id'] ?>"
                                            <?= in_array($p['id'], $permisos_asignados) ? 'checked' : '' ?>
                                            class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                        <span class="text-sm text-gray-600"><?= esc($p['nombre']) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg transition">Actualizar</button>
                <a href="<?= base_url('roles') ?>" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
