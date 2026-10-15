<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Inventory Management API Documentation';
$this->params['meta_description'] = 'RESTful API for inventory management - Complete documentation with examples';
$this->params['meta_keywords'] = 'api, inventory, rest, yii2, documentation';
?>

<div class="site-index">
    <!-- Hero Banner -->
    <div class="hero-banner text-white rounded-4 p-5 mb-5 position-relative overflow-hidden">
        <div class="position-relative">
            <div class="d-flex align-items-center mb-3">
                <span class="display-4 me-3">📦</span>
                <div>
                    <h1 class="display-5 fw-bold mb-0">Inventory Management API</h1>
                    <p class="lead opacity-75 mb-0">RESTful API untuk manajemen inventory yang lengkap dan mudah digunakan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- API Status -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success me-3 p-2"><span class="h5 mb-0">✓</span></span>
                        <div>
                            <h5 class="mb-1">API Status: Online</h5>
                            <p class="text-muted mb-0 small">Base URL: <code><?= Html::encode(Url::base(true)) ?>/api</code></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Start -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">🚀 Quick Start</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Test dengan cURL:</h6>
                            <pre class="bg-light p-3 rounded"><code>curl <?= Url::base(true) ?>/api/categories</code></pre>
                        </div>
                        <div class="col-md-6">
                            <h6>Create Item:</h6>
                            <pre class="bg-light p-3 rounded"><code>curl -X POST <?= Url::base(true) ?>/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Laptop",
    "asset_code": "LPT-001",
    "category_id": 1,
    "quantity": 5
  }'</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- API Endpoints -->
    <h2 class="mb-4" id="endpoints">📡 API Endpoints</h2>

    <!-- Categories Section -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">📁 Categories API</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 100px">Method</th>
                            <th style="width: 300px">Endpoint</th>
                            <th>Description</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-success">GET</span></td>
                            <td><code>/api/categories</code></td>
                            <td>Get all categories</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary test-btn" 
                                        data-url="<?= Url::base(true) ?>/api/categories"
                                        data-method="GET">Test</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-success">GET</span></td>
                            <td><code>/api/categories/{id}</code></td>
                            <td>Get category by ID</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary test-btn" 
                                        data-url="<?= Url::base(true) ?>/api/categories/1"
                                        data-method="GET">Test</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary">POST</span></td>
                            <td><code>/api/categories</code></td>
                            <td>Create new category</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#createCategoryModal">Create</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-warning text-dark">PATCH</span></td>
                            <td><code>/api/categories/{id}</code></td>
                            <td>Update category (partial)</td>
                            <td><span class="text-muted small">Use API client</span></td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-danger">DELETE</span></td>
                            <td><code>/api/categories/{id}</code></td>
                            <td>Delete category</td>
                            <td><span class="text-muted small">Use API client</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Items Section -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">📦 Items API</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 100px">Method</th>
                            <th style="width: 300px">Endpoint</th>
                            <th>Description</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-success">GET</span></td>
                            <td><code>/api/items</code></td>
                            <td>Get all items</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary test-btn" 
                                        data-url="<?= Url::base(true) ?>/api/items"
                                        data-method="GET">Test</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-success">GET</span></td>
                            <td><code>/api/items?expand=category</code></td>
                            <td>Get items with category details</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary test-btn" 
                                        data-url="<?= Url::base(true) ?>/api/items?expand=category"
                                        data-method="GET">Test</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-success">GET</span></td>
                            <td><code>/api/items/{id}</code></td>
                            <td>Get item by ID</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary test-btn" 
                                        data-url="<?= Url::base(true) ?>/api/items/1"
                                        data-method="GET">Test</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary">POST</span></td>
                            <td><code>/api/items</code></td>
                            <td>Create new item</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#createItemModal">Create</button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-warning text-dark">PATCH</span></td>
                            <td><code>/api/items/{id}</code></td>
                            <td>Update item (partial)</td>
                            <td><span class="text-muted small">Use API client</span></td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-danger">DELETE</span></td>
                            <td><code>/api/items/{id}</code></td>
                            <td>Delete item</td>
                            <td><span class="text-muted small">Use API client</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Response Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">API Response</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="responseStatus" class="mb-3"></div>
                    <pre id="responseBody" class="bg-light p-3 rounded" style="max-height: 400px; overflow-y: auto;"></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createCategoryForm">
                        <div class="mb-3">
                            <label class="form-label">Name *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitCategory">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Item Modal -->
    <div class="modal fade" id="createItemModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createItemForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Asset Code *</label>
                                <input type="text" class="form-control" name="asset_code" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category *</label>
                                <select class="form-select" name="category_id" required id="categorySelect">
                                    <option value="">Loading...</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Condition</label>
                                <select class="form-select" name="condition">
                                    <option value="good">Good</option>
                                    <option value="needs_service">Needs Service</option>
                                    <option value="damaged">Damaged</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" value="0" min="0">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Minimum Stock</label>
                                <input type="number" class="form-control" name="minimum_stock" value="0" min="0">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitItem">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Query Parameters Info -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">🔍 Query Parameters</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h6>Pagination:</h6>
                    <code>?page=1&per-page=10</code>
                </div>
                <div class="col-md-4">
                    <h6>Sorting:</h6>
                    <code>?sort=name</code> or <code>?sort=-created_at</code>
                </div>
                <div class="col-md-4">
                    <h6>Expand Relations:</h6>
                    <code>?expand=category</code>
                </div>
            </div>
        </div>
    </div>

    <!-- Field Reference -->
    <h2 class="mb-4" id="fields">📋 Field Reference</h2>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Category Fields</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Type</th>
                                <th>Required</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>id</code></td>
                                <td>integer</td>
                                <td>Auto</td>
                            </tr>
                            <tr>
                                <td><code>name</code></td>
                                <td>string (100)</td>
                                <td>✓</td>
                            </tr>
                            <tr>
                                <td><code>description</code></td>
                                <td>text</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><code>created_at</code></td>
                                <td>timestamp</td>
                                <td>Auto</td>
                            </tr>
                            <tr>
                                <td><code>updated_at</code></td>
                                <td>timestamp</td>
                                <td>Auto</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Item Fields</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Type</th>
                                <th>Required</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>id</code></td>
                                <td>integer</td>
                                <td>Auto</td>
                            </tr>
                            <tr>
                                <td><code>name</code></td>
                                <td>string (150)</td>
                                <td>✓</td>
                            </tr>
                            <tr>
                                <td><code>asset_code</code></td>
                                <td>string (150)</td>
                                <td>✓ (unique)</td>
                            </tr>
                            <tr>
                                <td><code>category_id</code></td>
                                <td>integer</td>
                                <td>✓</td>
                            </tr>
                            <tr>
                                <td><code>quantity</code></td>
                                <td>integer</td>
                                <td>Default: 0</td>
                            </tr>
                            <tr>
                                <td><code>minimum_stock</code></td>
                                <td>integer</td>
                                <td>Default: 0</td>
                            </tr>
                            <tr>
                                <td><code>condition</code></td>
                                <td>enum</td>
                                <td>Default: good</td>
                            </tr>
                            <tr>
                                <td><code>location</code></td>
                                <td>string (150)</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td><code>description</code></td>
                                <td>text</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Condition Values -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Item Condition Values</h5>
        </div>
        <div class="card-body">
            <span class="badge bg-success me-2 p-2">good</span>
            <span class="badge bg-warning text-dark me-2 p-2">needs_service</span>
            <span class="badge bg-danger p-2">damaged</span>
        </div>
    </div>

</div>

<?php
$js = <<<JS
// Test API buttons
$('.test-btn').click(function() {
    const url = $(this).data('url');
    const method = $(this).data('method');
    
    $.ajax({
        url: url,
        method: method,
        success: function(data, textStatus, jqXHR) {
            $('#responseStatus').html(
                '<span class="badge bg-success">Status: ' + jqXHR.status + '</span>'
            );
            $('#responseBody').text(JSON.stringify(data, null, 2));
            $('#responseModal').modal('show');
        },
        error: function(jqXHR) {
            $('#responseStatus').html(
                '<span class="badge bg-danger">Status: ' + jqXHR.status + '</span>'
            );
            $('#responseBody').text(JSON.stringify(jqXHR.responseJSON || jqXHR.responseText, null, 2));
            $('#responseModal').modal('show');
        }
    });
});

// Load categories for item form
$('#createItemModal').on('show.bs.modal', function() {
    $.get('/api/categories', function(data) {
        const select = $('#categorySelect');
        select.empty();
        select.append('<option value="">Select category</option>');
        data.forEach(function(cat) {
            select.append('<option value="' + cat.id + '">' + cat.name + '</option>');
        });
    });
});

// Create Category
$('#submitCategory').click(function() {
    const form = $('#createCategoryForm');
    const data = {
        name: form.find('[name="name"]').val(),
        description: form.find('[name="description"]').val()
    };
    
    $.ajax({
        url: '/api/categories',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response, textStatus, jqXHR) {
            $('#createCategoryModal').modal('hide');
            $('#responseStatus').html('<span class="badge bg-success">Created! Status: ' + jqXHR.status + '</span>');
            $('#responseBody').text(JSON.stringify(response, null, 2));
            $('#responseModal').modal('show');
            form[0].reset();
        },
        error: function(jqXHR) {
            $('#responseStatus').html('<span class="badge bg-danger">Error! Status: ' + jqXHR.status + '</span>');
            $('#responseBody').text(JSON.stringify(jqXHR.responseJSON, null, 2));
            $('#responseModal').modal('show');
        }
    });
});

// Create Item
$('#submitItem').click(function() {
    const form = $('#createItemForm');
    const data = {
        name: form.find('[name="name"]').val(),
        asset_code: form.find('[name="asset_code"]').val(),
        category_id: parseInt(form.find('[name="category_id"]').val()),
        quantity: parseInt(form.find('[name="quantity"]').val()) || 0,
        minimum_stock: parseInt(form.find('[name="minimum_stock"]').val()) || 0,
        condition: form.find('[name="condition"]').val(),
        location: form.find('[name="location"]').val(),
        description: form.find('[name="description"]').val()
    };
    
    $.ajax({
        url: '/api/items',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response, textStatus, jqXHR) {
            $('#createItemModal').modal('hide');
            $('#responseStatus').html('<span class="badge bg-success">Created! Status: ' + jqXHR.status + '</span>');
            $('#responseBody').text(JSON.stringify(response, null, 2));
            $('#responseModal').modal('show');
            form[0].reset();
        },
        error: function(jqXHR) {
            $('#responseStatus').html('<span class="badge bg-danger">Error! Status: ' + jqXHR.status + '</span>');
            $('#responseBody').text(JSON.stringify(jqXHR.responseJSON, null, 2));
            $('#responseModal').modal('show');
        }
    });
});
JS;

$this->registerJs($js);
?>
