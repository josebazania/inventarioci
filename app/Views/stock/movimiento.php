<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200"><h3 class="text-lg font-semibold text-gray-800"><?= $title ?></h3></div>
        <form action="<?= base_url('stock/registrar-movimiento') ?>" method="POST" class="p-6 space-y-5">
            <?= csrf_field() ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm"><ul class="list-disc list-inside"><?php foreach (session()->getFlashdata('errors') as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Producto</label>
                <?php if ($producto): ?>
                    <input type="hidden" name="producto_id" value="<?= $producto['id'] ?>">
                    <div class="w-full px-4 py-2.5 bg-gray-100 border border-gray-300 rounded-lg"><?= esc($producto['nombre']) ?></div>
                <?php else: ?>
                    <select name="producto_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none">
                        <option value="">Seleccionar producto...</option>
                        <?php foreach ($productos as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= old('producto_id') == $p['id'] ? 'selected' : '' ?>><?= esc($p['codigo']) ?> - <?= esc($p['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Movimiento</label>
                <select name="tipo_movimiento" required id="tipo_movimiento" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none">
                    <option value="">Seleccionar...</option>
                    <option value="entrada">📥 Entrada</option>
                    <option value="salida">📤 Salida</option>
                    <option value="ajuste">🔧 Ajuste</option>
                    <option value="devolucion">🔄 Devolución</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                <input type="number" name="cantidad" value="<?= old('cantidad') ?>" min="1" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none">
                <p class="text-xs text-gray-400 mt-1" id="ajuste_help" style="display:none">Para "Ajuste", ingresa la cantidad final deseada.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Motivo</label>
                <input type="text" name="motivo" value="<?= old('motivo') ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 outline-none">
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg transition">Registrar</button>
                <a href="<?= base_url('stock') ?>" class="text-gray-600 hover:text-gray-800 px-4 py-2.5">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('tipo_movimiento').addEventListener('change', function() {
    const help = document.getElementById('ajuste_help');
    help.style.display = this.value === 'ajuste' ? 'block' : 'none';
});
</script>
<?= $this->endSection() ?>
