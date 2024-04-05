<?php
/**
 * @var array $tc_products
 * @var array $classrooms
 * @var array $integrations
 */
?>

<div class="integration-selects">
    <div class="integration-selects-box">
        <label for="product_id">Thrivecart Products</label>
        <select name="product_id" id="product_id">
            <option value="">Select a product</option>
            <?php foreach ($tc_products as $product): ?>
                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="integration-selects-box">
        <label for="classroom_id">Memberkit Classrooms</label>
        <select name="classroom_id" id="classroom_id">
            <option value="">Select a classroom</option>
            <?php foreach ($classrooms as $classroom): ?>
                <option value="<?php echo $classroom['id']; ?>"><?php echo $classroom['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button id="btn-integrate" class="button button-primary">Integrate</button>
    <span id="loading-integrate" class="spinner"></span>
</div>

<div class="integration-list">
    <h2>Integrations</h2>
    <table class="wp-list-table widefat fixed striped">
        <thead>
        <tr>
            <th>Thrivecart Product</th>
            <th></th>
            <th>Memberkit Classroom</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($integrations)): ?>
            <tr>
                <td colspan="4">No integrations found</td>
            </tr>
        <?php else: ?>
            <?php foreach ($integrations as $integration): ?>
                <tr>
                    <td><?php echo $integration['product']['name']; ?></td>
                    <th>
                        <span class="dashicons dashicons-arrow-right-alt"></span>
                    </th>
                    <td><?php echo $integration['classroom']['name']; ?></td>
                    <td>
                        <button class="button button-secondary btn-remove-integration"
                                data-product="<?php echo $integration['product']['id']; ?>"
                                data-classroom="<?php echo $integration['classroom']['id']; ?>">Remove
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
