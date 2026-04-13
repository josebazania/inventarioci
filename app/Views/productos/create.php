<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200"><h3 class="text-lg font-semibold text-gray-800"><?= $title ?></h3></div>
        <form action="<?= base_url('productos/store') ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            <?= csrf_field() ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm"><ul class="list-disc list-inside"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>
            <div class="grid grid-cols-2 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Código</label><input type="text" name="codigo" value="<?= old('codigo') ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label><input type="text" name="nombre" value="<?= old('nombre') ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label><textarea name="descripcion" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"><?= old('descripcion') ?></textarea></div>
            <div class="grid grid-cols-3 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label><select name="categoria_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"><option value="">Seleccionar...</option><?php foreach ($categorias as $c): ?><option value="<?= $c['id'] ?>" <?= old('categoria_id') == $c['id'] ? 'selected' : '' ?>><?= esc($c['nombre']) ?></option><?php endforeach; ?></select></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Marca</label><select name="marca_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"><option value="">Seleccionar...</option><?php foreach ($marcas as $m): ?><option value="<?= $m['id'] ?>" <?= old('marca_id') == $m['id'] ? 'selected' : '' ?>><?= esc($m['nombre']) ?></option><?php endforeach; ?></select></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Proveedor</label><select name="proveedor_id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"><option value="">Seleccionar...</option><?php foreach ($proveedores as $pr): ?><option value="<?= $pr['id'] ?>" <?= old('proveedor_id') == $pr['id'] ? 'selected' : '' ?>><?= esc($pr['nombre']) ?></option><?php endforeach; ?></select></div>
            </div>
            <div class="grid grid-cols-4 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1">P. Compra</label><input type="number" step="0.01" name="precio_compra" value="<?= old('precio_compra', 0) ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">P. Venta</label><input type="number" step="0.01" name="precio_venta" value="<?= old('precio_venta', 0) ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Stock Mín</label><input type="number" name="stock_minimo" value="<?= old('stock_minimo', 0) ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1">Stock Máx</label><input type="number" name="stock_maximo" value="<?= old('stock_maximo', 0) ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1">Imagen</label><input type="file" name="imagen" accept="image/*" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none"></div>
            <div class="flex gap-3 pt-4"><button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg transition">Guardar</button><a href="<?= base_url('productos') ?>" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Cancelar</a></div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
