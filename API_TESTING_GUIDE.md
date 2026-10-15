# API Testing Guide - Inventory Management

## Prerequisites

Pastikan:
1. Database sudah dibuat dan migration sudah dijalankan
2. Server sudah berjalan di `http://localhost:8080`
3. Test tools sudah terinstall (curl, Postman, atau tools lainnya)

---

## Method 1: Testing dengan cURL (Command Line)

### Setup Database & Migration

```bash
# 1. Buat database
mysql -u root -p
```

```sql
CREATE DATABASE inventory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'inventory_user'@'localhost' IDENTIFIED BY 'inventory123';
GRANT ALL PRIVILEGES ON inventory_db.* TO 'inventory_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

```bash
# 2. Jalankan migration
./yii migrate

# 3. Start server
./yii serve
# atau
php -S localhost:8080 -t web
```

### Test Categories API

#### 1. GET All Categories
```bash
curl -X GET http://localhost:8080/api/categories
```

**Expected Response:**
```json
[
  {
    "id": 1,
    "name": "Electronics",
    "description": "Electronic devices and computers",
    "created_at": 1697385600,
    "updated_at": 1697385600,
    "item_count": 0
  },
  {
    "id": 2,
    "name": "Hardware",
    "description": "Hardware components and tools",
    "created_at": 1697385600,
    "updated_at": 1697385600,
    "item_count": 0
  },
  {
    "id": 3,
    "name": "Accessories",
    "description": "Cables, adapters, and accessories",
    "created_at": 1697385600,
    "updated_at": 1697385600,
    "item_count": 0
  }
]
```

#### 2. GET Single Category
```bash
curl -X GET http://localhost:8080/api/categories/1
```

**Expected Response:**
```json
{
  "id": 1,
  "name": "Electronics",
  "description": "Electronic devices and computers",
  "created_at": 1697385600,
  "updated_at": 1697385600,
  "item_count": 0
}
```

#### 3. CREATE New Category
```bash
curl -X POST http://localhost:8080/api/categories \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Furniture",
    "description": "Office furniture and equipment"
  }'
```

**Expected Response:**
```json
{
  "id": 4,
  "name": "Furniture",
  "description": "Office furniture and equipment",
  "created_at": 1697558400,
  "updated_at": 1697558400,
  "item_count": 0
}
```

#### 4. UPDATE Category (PATCH)
```bash
curl -X PATCH http://localhost:8080/api/categories/4 \
  -H "Content-Type: application/json" \
  -d '{
    "description": "Furniture for office and labs"
  }'
```

#### 5. DELETE Category
```bash
curl -X DELETE http://localhost:8080/api/categories/4
```

**Expected Response:** `HTTP 204 No Content`

### Test Items API

#### 1. CREATE Items
```bash
# Create Item 1: Laptop
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Dell XPS 13 Laptop",
    "asset_code": "LPT-001",
    "category_id": 1,
    "quantity": 5,
    "minimum_stock": 2,
    "condition": "good",
    "location": "Storage Room A",
    "description": "High-performance laptop for general use"
  }'

# Create Item 2: Raspberry Pi
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Raspberry Pi 4 Model B",
    "asset_code": "RPI-001",
    "category_id": 2,
    "quantity": 10,
    "minimum_stock": 3,
    "condition": "good",
    "location": "Tech Lab",
    "description": "Single-board computer for IoT projects"
  }'

# Create Item 3: Arduino
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Arduino Uno R3",
    "asset_code": "ARD-001",
    "category_id": 2,
    "quantity": 15,
    "minimum_stock": 5,
    "condition": "good",
    "location": "Electronics Lab",
    "description": "Microcontroller for embedded systems"
  }'

# Create Item 4: Mouse
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Logitech MX Master 3",
    "asset_code": "MSE-001",
    "category_id": 3,
    "quantity": 20,
    "minimum_stock": 5,
    "condition": "good",
    "location": "Accessories Storage",
    "description": "Wireless mouse for productivity"
  }'
```

#### 2. GET All Items
```bash
curl -X GET http://localhost:8080/api/items
```

#### 3. GET Items with Category Details
```bash
curl -X GET "http://localhost:8080/api/items?expand=category"
```

#### 4. GET Single Item
```bash
curl -X GET http://localhost:8080/api/items/1
```

#### 5. UPDATE Item (PATCH - Partial Update)
```bash
# Update quantity only
curl -X PATCH http://localhost:8080/api/items/1 \
  -H "Content-Type: application/json" \
  -d '{
    "quantity": 10
  }'

# Update condition
curl -X PATCH http://localhost:8080/api/items/2 \
  -H "Content-Type: application/json" \
  -d '{
    "condition": "needs_service"
  }'
```

#### 6. UPDATE Item (PUT - Full Update)
```bash
curl -X PUT http://localhost:8080/api/items/1 \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Dell XPS 13 Laptop (Updated)",
    "asset_code": "LPT-001",
    "category_id": 1,
    "quantity": 8,
    "minimum_stock": 3,
    "condition": "good",
    "location": "Storage Room A",
    "description": "High-performance laptop - Updated model"
  }'
```

#### 7. DELETE Item
```bash
curl -X DELETE http://localhost:8080/api/items/4
```

### Test Pagination & Sorting

```bash
# Pagination
curl -X GET "http://localhost:8080/api/items?page=1&per-page=2"

# Sorting by name ascending
curl -X GET "http://localhost:8080/api/items?sort=name"

# Sorting by created_at descending
curl -X GET "http://localhost:8080/api/items?sort=-created_at"

# Combined: pagination + sorting + expand
curl -X GET "http://localhost:8080/api/items?page=1&per-page=5&sort=name&expand=category"
```

### Test Error Handling

#### Validation Error
```bash
# Missing required fields
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "quantity": 5
  }'
```

**Expected Response:**
```json
{
  "name": "Unprocessable Entity",
  "message": "Data Validation Failed.",
  "code": 0,
  "status": 422,
  "type": "yii\\web\\UnprocessableEntityHttpException",
  "errors": {
    "name": ["Name cannot be blank."],
    "asset_code": ["Asset Code cannot be blank."],
    "category_id": ["Category ID cannot be blank."]
  }
}
```

#### Duplicate Asset Code
```bash
# Create item with duplicate asset_code
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Another Laptop",
    "asset_code": "LPT-001",
    "category_id": 1
  }'
```

**Expected Response:**
```json
{
  "name": "Unprocessable Entity",
  "message": "Data Validation Failed.",
  "code": 0,
  "status": 422,
  "errors": {
    "asset_code": ["Asset Code has already been taken."]
  }
}
```

#### Not Found Error
```bash
# Get non-existent item
curl -X GET http://localhost:8080/api/items/999
```

**Expected Response:**
```json
{
  "name": "Not Found",
  "message": "Object not found: 999",
  "code": 0,
  "status": 404,
  "type": "yii\\web\\NotFoundHttpException"
}
```

---

## Method 2: Testing dengan Postman

### Setup Postman

1. **Install Postman**
   - Download dari https://www.postman.com/downloads/
   - Install dan buka aplikasi

2. **Create New Collection**
   - Klik "New" → "Collection"
   - Nama: "Inventory API"
   
3. **Set Environment Variables**
   - Klik Environment → Create new environment
   - Nama: "Local"
   - Variables:
     - `base_url` = `http://localhost:8080/api`

### Create Requests

#### Categories Collection

**1. Get All Categories**
- Method: `GET`
- URL: `{{base_url}}/categories`
- Test Script:
```javascript
pm.test("Status code is 200", function () {
    pm.response.to.have.status(200);
});

pm.test("Response is array", function () {
    pm.expect(pm.response.json()).to.be.an('array');
});
```

**2. Get Category by ID**
- Method: `GET`
- URL: `{{base_url}}/categories/1`

**3. Create Category**
- Method: `POST`
- URL: `{{base_url}}/categories`
- Headers: `Content-Type: application/json`
- Body (raw JSON):
```json
{
  "name": "Test Category",
  "description": "This is a test category"
}
```
- Test Script:
```javascript
pm.test("Status code is 201", function () {
    pm.response.to.have.status(201);
});

pm.test("Response has id", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData).to.have.property('id');
});
```

**4. Update Category**
- Method: `PATCH`
- URL: `{{base_url}}/categories/1`
- Headers: `Content-Type: application/json`
- Body:
```json
{
  "description": "Updated description"
}
```

**5. Delete Category**
- Method: `DELETE`
- URL: `{{base_url}}/categories/4`

#### Items Collection

**1. Get All Items**
- Method: `GET`
- URL: `{{base_url}}/items`

**2. Get Items with Category**
- Method: `GET`
- URL: `{{base_url}}/items?expand=category`

**3. Create Item**
- Method: `POST`
- URL: `{{base_url}}/items`
- Headers: `Content-Type: application/json`
- Body:
```json
{
  "name": "Dell XPS 13 Laptop",
  "asset_code": "LPT-001",
  "category_id": 1,
  "quantity": 5,
  "minimum_stock": 2,
  "condition": "good",
  "location": "Storage Room A",
  "description": "High-performance laptop"
}
```

**4. Update Item Quantity**
- Method: `PATCH`
- URL: `{{base_url}}/items/1`
- Body:
```json
{
  "quantity": 10
}
```

**5. Delete Item**
- Method: `DELETE`
- URL: `{{base_url}}/items/1`

### Run Collection Tests

1. Klik Collection → Click "..." → "Run collection"
2. Select requests yang ingin ditest
3. Klik "Run Inventory API"
4. Lihat hasil test

---

## Method 3: Testing dengan Script Bash

Buat file `test_api.sh`:

```bash
#!/bin/bash

BASE_URL="http://localhost:8080/api"

echo "=========================================="
echo "Testing Inventory Management API"
echo "=========================================="
echo ""

# Test 1: Get Categories
echo "1. GET All Categories"
curl -s -X GET $BASE_URL/categories | jq
echo ""

# Test 2: Create Category
echo "2. POST Create Category"
curl -s -X POST $BASE_URL/categories \
  -H "Content-Type: application/json" \
  -d '{"name":"Test Category","description":"For testing"}' | jq
echo ""

# Test 3: Create Item
echo "3. POST Create Item"
curl -s -X POST $BASE_URL/items \
  -H "Content-Type: application/json" \
  -d '{
    "name":"Test Laptop",
    "asset_code":"TEST-001",
    "category_id":1,
    "quantity":5,
    "minimum_stock":2,
    "condition":"good",
    "location":"Test Lab",
    "description":"Testing item"
  }' | jq
echo ""

# Test 4: Get All Items
echo "4. GET All Items"
curl -s -X GET "$BASE_URL/items?expand=category" | jq
echo ""

# Test 5: Update Item
echo "5. PATCH Update Item"
curl -s -X PATCH $BASE_URL/items/1 \
  -H "Content-Type: application/json" \
  -d '{"quantity":10}' | jq
echo ""

# Test 6: Get Single Item
echo "6. GET Single Item"
curl -s -X GET $BASE_URL/items/1 | jq
echo ""

echo "=========================================="
echo "All tests completed!"
echo "=========================================="
```

Jalankan:
```bash
chmod +x test_api.sh
./test_api.sh
```

---

## Method 4: Testing dengan PHP Script

Buat file `test_api.php`:

```php
<?php

$baseUrl = 'http://localhost:8080/api';

function apiRequest($method, $url, $data = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'code' => $httpCode,
        'data' => json_decode($response, true)
    ];
}

echo "Testing Inventory API\n";
echo str_repeat("=", 50) . "\n\n";

// Test 1: Get Categories
echo "1. GET Categories\n";
$result = apiRequest('GET', "$baseUrl/categories");
echo "Status: {$result['code']}\n";
print_r($result['data']);
echo "\n";

// Test 2: Create Item
echo "2. POST Create Item\n";
$newItem = [
    'name' => 'Test Laptop',
    'asset_code' => 'TEST-' . time(),
    'category_id' => 1,
    'quantity' => 5,
    'minimum_stock' => 2,
    'condition' => 'good',
    'location' => 'Test Lab',
    'description' => 'Testing item'
];
$result = apiRequest('POST', "$baseUrl/items", $newItem);
echo "Status: {$result['code']}\n";
print_r($result['data']);
echo "\n";

// Test 3: Get Items
echo "3. GET Items\n";
$result = apiRequest('GET', "$baseUrl/items?expand=category");
echo "Status: {$result['code']}\n";
echo "Total items: " . count($result['data']) . "\n\n";

echo "All tests completed!\n";
```

Jalankan:
```bash
php test_api.php
```

---

## Checklist Testing

### Basic CRUD Operations
- [ ] GET all categories
- [ ] GET single category
- [ ] POST create category
- [ ] PATCH update category
- [ ] DELETE category
- [ ] GET all items
- [ ] GET single item
- [ ] POST create item
- [ ] PATCH update item
- [ ] PUT update item (full)
- [ ] DELETE item

### Advanced Features
- [ ] Pagination (`?page=1&per-page=5`)
- [ ] Sorting (`?sort=name`, `?sort=-created_at`)
- [ ] Expand relations (`?expand=category`)
- [ ] Combined query parameters

### Error Handling
- [ ] Missing required fields (422)
- [ ] Duplicate asset_code (422)
- [ ] Invalid category_id (422)
- [ ] Non-existent resource (404)
- [ ] Invalid condition value (422)

### Data Integrity
- [ ] Foreign key constraint (can't delete category with items)
- [ ] Unique constraint (asset_code)
- [ ] Timestamp auto-update
- [ ] Default values (quantity, condition)

---

## Tips Testing

1. **Gunakan jq untuk format JSON** (jika pakai curl):
   ```bash
   curl http://localhost:8080/api/categories | jq
   ```

2. **Save response ke variable** (Postman):
   ```javascript
   pm.environment.set("item_id", pm.response.json().id);
   ```

3. **Check response headers**:
   ```bash
   curl -i http://localhost:8080/api/items
   ```

4. **Verbose mode** untuk debugging:
   ```bash
   curl -v http://localhost:8080/api/items
   ```

5. **Test dengan invalid data** untuk memastikan validation bekerja

---

Selamat testing! 🚀
