# Inventory Management API - Quick Start Guide

## Setup Cepat

### 1. Persiapan Database

Pastikan MySQL sudah berjalan dan buat database:

```sql
CREATE DATABASE inventory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'inventory_user'@'localhost' IDENTIFIED BY 'inventory123';
GRANT ALL PRIVILEGES ON inventory_db.* TO 'inventory_user'@'localhost';
FLUSH PRIVILEGES;
```

### 2. Jalankan Migration

```bash
cd /path/to/your/project
./yii migrate
```

Migration akan membuat:
- Tabel `categories` dengan 3 kategori default (Laptop, Perangkat Coding, Aksesori)
- Tabel `items` untuk menyimpan inventory items

### 3. Start Server

```bash
# Opsi 1: Menggunakan Yii built-in server
./yii serve

# Opsi 2: Menggunakan PHP built-in server
php -S localhost:8080 -t web

# Opsi 3: Menggunakan Apache/Nginx
# Configure virtual host sesuai dokumentasi Yii2
```

## Test API Endpoints

### Test Categories API

```bash
# 1. Get all categories
curl http://localhost:8080/api/categories

# 2. Get category by ID
curl http://localhost:8080/api/categories/1

# 3. Create new category
curl -X POST http://localhost:8080/api/categories \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Furniture",
    "description": "Meja, kursi, dan furniture lainnya"
  }'

# 4. Update category
curl -X PATCH http://localhost:8080/api/categories/4 \
  -H "Content-Type: application/json" \
  -d '{
    "description": "Furniture untuk lab dan kantor"
  }'

# 5. Delete category
curl -X DELETE http://localhost:8080/api/categories/4
```

### Test Items API

```bash
# 1. Get all items
curl http://localhost:8080/api/items

# 2. Get all items with category details
curl http://localhost:8080/api/items?expand=category

# 3. Create new item
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

# 4. Update item quantity
curl -X PATCH http://localhost:8080/api/items/1 \
  -H "Content-Type: application/json" \
  -d '{
    "quantity": 10
  }'

# 5. Update item condition
curl -X PATCH http://localhost:8080/api/items/1 \
  -H "Content-Type: application/json" \
  -d '{
    "condition": "needs_service"
  }'

# 6. Get item by ID with category
curl http://localhost:8080/api/items/1?expand=category

# 7. Delete item
curl -X DELETE http://localhost:8080/api/items/1
```

## Sample Data untuk Testing

### Create Multiple Items

```bash
# Item 1: Laptop
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Dell XPS 13 Laptop",
    "asset_code": "LPT-002",
    "category_id": 1,
    "quantity": 3,
    "minimum_stock": 1,
    "condition": "good",
    "location": "Storage Room A",
    "description": "High-performance laptop for general use"
  }'

# Item 2: Raspberry Pi
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

# Item 3: Arduino
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

# Item 4: Mouse
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

# Item 5: Keyboard
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Keychron K2 Mechanical",
    "asset_code": "KBD-001",
    "category_id": 3,
    "quantity": 15,
    "minimum_stock": 5,
    "condition": "good",
    "location": "Accessories Storage",
    "description": "Mechanical keyboard for productivity"
  }'
```

## Common API Patterns

### Pagination

```bash
# Get items with pagination
curl "http://localhost:8080/api/items?page=1&per-page=5"

# Response headers will include:
# X-Pagination-Total-Count: 20
# X-Pagination-Page-Count: 4
# X-Pagination-Current-Page: 1
# X-Pagination-Per-Page: 5
```

### Sorting

```bash
# Sort by name ascending
curl "http://localhost:8080/api/items?sort=name"

# Sort by created_at descending
curl "http://localhost:8080/api/items?sort=-created_at"

# Multiple sort
curl "http://localhost:8080/api/items?sort=category_id,-quantity"
```

### Expanding Relations

```bash
# Get items with category details
curl "http://localhost:8080/api/items?expand=category"

# Get category with all items
curl "http://localhost:8080/api/categories/1?expand=items"
```

## Error Handling

### Validation Error Example

```bash
# Try to create item without required fields
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "quantity": 5
  }'

# Response:
# {
#   "name": "Unprocessable Entity",
#   "message": "Data Validation Failed.",
#   "code": 0,
#   "status": 422,
#   "errors": {
#     "name": ["Name cannot be blank."],
#     "asset_code": ["Asset Code cannot be blank."],
#     "category_id": ["Category ID cannot be blank."]
#   }
# }
```

### Duplicate Asset Code

```bash
# Try to create item with existing asset_code
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Test Item",
    "asset_code": "LPT-001",
    "category_id": 1
  }'

# Response:
# {
#   "name": "Unprocessable Entity",
#   "message": "Data Validation Failed.",
#   "code": 0,
#   "status": 422,
#   "errors": {
#     "asset_code": ["Asset Code has already been taken."]
#   }
# }
```

## Using with Postman

1. Import API collection:
   - Create new collection "Inventory API"
   - Set base URL variable: `{{base_url}}` = `http://localhost:8080/api`

2. Create requests:
   - GET `{{base_url}}/categories`
   - GET `{{base_url}}/items?expand=category`
   - POST `{{base_url}}/items`
   - PATCH `{{base_url}}/items/1`
   - DELETE `{{base_url}}/items/1`

3. Set Content-Type header:
   - `Content-Type: application/json`

## Next Steps

1. **Add Authentication**: Implement Bearer token authentication
2. **Add Search**: Add search functionality untuk nama dan kode aset
3. **Add Statistics**: Endpoint untuk statistik inventory
4. **Add History**: Track perubahan quantity (transaction log)
5. **Add Reports**: Generate laporan inventory

Lihat `API_DOCUMENTATION.md` untuk dokumentasi lengkap.
