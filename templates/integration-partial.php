<?php
/**
 * @var array $tc_products
 * @var array $classrooms
 * @var array $integrations
 */
?>

<div class="integration-selects">
    <div class="integration-selects-box">
        <label for="product_id">Productos Thrivecart</label>
        <select name="product_id" id="product_id">
            <option value="">Seleccione un producto</option>
            <?php foreach ($tc_products as $product): ?>
                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="integration-selects-box">
        <label for="classroom_id">Grupos Memberkit</label>
        <select name="classroom_id" id="classroom_id">
            <option value="">Seleccione un grupo</option>
            <?php foreach ($classrooms as $classroom): ?>
                <option value="<?php echo $classroom['id']; ?>"><?php echo $classroom['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button id="btn-integrate" class="button button-primary">Conectar</button>
    <span id="loading-integrate" class="spinner"></span>
</div>

<div class="integration-list">
    <h2>Integraciones</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
        <tr>
            <th style="width: 40%;">Productos Thrivecart</th>
            <th></th>
            <th style="width: 40%;">Grupos Memberkit</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($integrations)): ?>
            <tr>
                <td colspan="4">No se realizó ninguna conexión</td>
            </tr>
        <?php else: ?>
            <?php foreach ($integrations as $integration): ?>
                <tr class="integration-row"
                    data-set="<?php echo $integration['product']['id']; ?><?php echo $integration['classroom']['id']; ?>">
                    <td><?php echo $integration['product']['name']; ?></td>
                    <th>
                        <span class="dashicons dashicons-arrow-right-alt" style="color: #2271B1;"></span>
                    </th>
                    <td><?php echo $integration['classroom']['name']; ?></td>
                    <td>
                        <button class="button button-secondary btn-remove-integration"
                                data-product="<?php echo $integration['product']['id']; ?>"
                                data-classroom="<?php echo $integration['classroom']['id']; ?>">Eliminar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="integration-message-container"></div>
