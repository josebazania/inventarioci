<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200"><h3 class="text-lg font-semibold text-gray-800"><?= $title ?></h3></div>
        <form action="<?= base_url('proveedores/store') ?>" method="POST" class="p-6 space-y-5">
            <?= csrf_field() ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm"><ul class="list-disc list-inside"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label><input type="text" name="nombre" value="<?= old('nombre') ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
            <div class="grid grid-cols-2 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">RUC</label><input type="text" name="ruc" value="<?= old('ruc') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label><input type="text" name="telefono" value="<?= old('telefono') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" name="email" value="<?= old('email') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label><textarea name="direccion" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"><?= old('direccion') ?></textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Contacto</label><input type="text" name="contacto" value="<?= old('contacto') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
            <div class="flex gap-3 pt-4"><button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg transition">Guardar</button><a href="<?= base_url('proveedores') ?>" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Cancelar</a></div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
