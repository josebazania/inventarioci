<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800"><?= $title ?></h3>
        </div>
        <form action="<?= base_url('usuarios/update/' . $usuario['id']) ?>" method="POST" class="p-6 space-y-5">
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

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                <input type="text" name="nombre_completo" value="<?= old('nombre_completo', $usuario['nombre_completo']) ?>" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input type="email" name="email" value="<?= old('email', $usuario['email']) ?>" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña <span class="text-gray-400">(dejar vacío para no cambiar)</span></label>
                <input type="password" name="password"
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                <select name="role_id" required
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none">
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= $rol['id'] ?>" <?= old('role_id', $usuario['role_id']) == $rol['id'] ? 'selected' : '' ?>><?= esc($rol['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg transition">Actualizar</button>
                <a href="<?= base_url('usuarios') ?>" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
