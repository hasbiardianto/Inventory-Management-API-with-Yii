# Inventory Management API Documentation

## Overview
API RESTful sederhana untuk management inventory menggunakan Yii2 Framework.

## Base URL
```
http://localhost:8080/api
```

## Authentication
Saat ini API tidak memerlukan authentication (dapat ditambahkan dengan Bearer Token jika diperlukan).

---

## Categories API

### 1. Get All Categories
Mendapatkan daftar semua kategori.

**Endpoint:**
```
GET /api/categories
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Electronics",
    "description": "Electronic devices and computers",
    "created_at": 1697385600,
    "updated_at": 1697385600,
    "item_count": 5
  },
  {
    "id": 2,
    "name": "Hardware",
    "description": "Hardware components and tools",
    "created_at": 1697385600,
    "updated_at": 1697385600,
    "item_count": 3
  }
]
```

### 2. Get Category by ID
Mendapatkan detail kategori berdasarkan ID.

**Endpoint:**
```
GET /api/categories/{id}
```

**Example:**
```
GET /api/categories/1
```

**Response:**
```json
{
  "id": 1,
  "name": "Electronics",
  "description": "Electronic devices and computers",
  "created_at": 1697385600,
  "updated_at": 1697385600,
  "item_count": 5
}
```

### 3. Create Category
Membuat kategori baru.

**Endpoint:**
```
POST /api/categories
```

**Request Body:**
```json
{
  "name": "Office Furniture",
  "description": "Desks, chairs, and office furniture"
}
```

**Response:**
```json
{
  "id": 4,
  "name": "Office Furniture",
  "description": "Desks, chairs, and office furniture",
  "created_at": 1697472000,
  "updated_at": 1697472000,
  "item_count": 0
}
```

### 4. Update Category
Mengupdate kategori yang sudah ada.

**Endpoint:**
```
PUT /api/categories/{id}
PATCH /api/categories/{id}
```

**Request Body:**
```json
{
  "name": "Office Furniture",
  "description": "Desks, chairs, and office furniture"
}
```

**Response:**
```json
{
  "id": 4,
  "name": "Office Furniture",
  "description": "Desks, chairs, and office furniture",
  "created_at": 1697472000,
  "updated_at": 1697558400,
  "item_count": 0
}
```

### 5. Delete Category
Menghapus kategori.

**Endpoint:**
```
DELETE /api/categories/{id}
```

**Response:**
```
HTTP 204 No Content
```

---

## Items API

### 1. Get All Items
Mendapatkan daftar semua item inventory.

**Endpoint:**
```
GET /api/items
```

**Query Parameters:**
- `expand=category` - Include detail kategori
- `page` - Nomor halaman (default: 1)
- `per-page` - Jumlah item per halaman (default: 20)

**Example:**
```
GET /api/items?expand=category&per-page=10
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Dell XPS 13 Laptop",
    "asset_code": "LPT-001",
    "category_id": 1,
    "category": "Electronics",
    "quantity": 5,
    "minimum_stock": 2,
    "condition": "good",
    "location": "Storage Room A",
    "description": "High-performance laptop for general use",
    "created_at": 1697385600,
    "updated_at": 1697385600
  },
  {
    "id": 2,
    "name": "Raspberry Pi 4",
    "asset_code": "RPI-001",
    "category_id": 2,
    "category": "Hardware",
    "quantity": 10,
    "minimum_stock": 3,
    "condition": "good",
    "location": "Tech Lab",
    "description": "Single-board computer for IoT projects",
    "created_at": 1697385600,
    "updated_at": 1697385600
  }
]
```

### 2. Get Item by ID
Mendapatkan detail item berdasarkan ID.

**Endpoint:**
```
GET /api/items/{id}
```

**Example:**
```
GET /api/items/1?expand=category
```

**Response:**
```json
{
  "id": 1,
  "name": "Dell XPS 13 Laptop",
  "asset_code": "LPT-001",
  "category_id": 1,
  "category": "Electronics",
  "quantity": 5,
  "minimum_stock": 2,
  "condition": "good",
  "location": "Storage Room A",
  "description": "High-performance laptop for general use",
  "created_at": 1697385600,
  "updated_at": 1697385600
}
```

### 3. Create Item
Membuat item baru.

**Endpoint:**
```
POST /api/items
```

**Request Body:**
```json
{
  "name": "MacBook Pro 14",
  "asset_code": "MBP-001",
  "category_id": 1,
  "quantity": 3,
  "minimum_stock": 1,
  "condition": "good",
  "location": "Storage Room B",
  "description": "MacBook Pro for advanced users"
}
```

**Response:**
```json
{
  "id": 3,
  "name": "MacBook Pro 14",
  "asset_code": "MBP-001",
  "category_id": 1,
  "category": "Electronics",
  "quantity": 3,
  "minimum_stock": 1,
  "condition": "good",
  "location": "Storage Room B",
  "description": "MacBook Pro for advanced users",
  "created_at": 1697472000,
  "updated_at": 1697472000
}
```

### 4. Update Item
Mengupdate item yang sudah ada.

**Endpoint:**
```
PUT /api/items/{id}
PATCH /api/items/{id}
```

**Request Body (PUT - semua field required):**
```json
{
  "name": "MacBook Pro 14 (Updated)",
  "asset_code": "MBP-001",
  "category_id": 1,
  "quantity": 5,
  "minimum_stock": 2,
  "condition": "good",
  "location": "Storage Room B",
  "description": "MacBook Pro for advanced users - Updated"
}
```

**Request Body (PATCH - partial update):**
```json
{
  "quantity": 5,
  "minimum_stock": 2
}
```

**Response:**
```json
{
  "id": 3,
  "name": "MacBook Pro 14 (Updated)",
  "asset_code": "MBP-001",
  "category_id": 1,
  "category": "Electronics",
  "quantity": 5,
  "minimum_stock": 2,
  "condition": "good",
  "location": "Storage Room B",
  "description": "MacBook Pro for advanced users - Updated",
  "created_at": 1697472000,
  "updated_at": 1697558400
}
```

### 5. Delete Item
Menghapus item.

**Endpoint:**
```
DELETE /api/items/{id}
```

**Response:**
```
HTTP 204 No Content
```

---

## Field Descriptions

### Category Fields
- `id` (integer): ID unik kategori
- `name` (string, max 100): Nama kategori (required, unique)
- `description` (text): Deskripsi kategori
- `created_at` (integer): Unix timestamp saat dibuat
- `updated_at` (integer): Unix timestamp saat terakhir diupdate
- `item_count` (integer): Jumlah item dalam kategori

### Item Fields
- `id` (integer): ID unik item
- `name` (string, max 150): Nama item (required)
- `asset_code` (string, max 150): Kode aset (required, unique)
- `category_id` (integer): ID kategori (required)
- `category` (string): Nama kategori (expanded field)
- `quantity` (integer): Jumlah stok (default: 0)
- `minimum_stock` (integer): Stok minimum (default: 0)
- `condition` (enum): Kondisi item - "good", "needs_service", "damaged" (default: "good")
- `location` (string, max 150): Lokasi penyimpanan
- `description` (text): Deskripsi detail item
- `created_at` (integer): Unix timestamp saat dibuat
- `updated_at` (integer): Unix timestamp saat terakhir diupdate

---

## Error Responses

### Validation Error (422)
```json
{
  "name": "Unprocessable Entity",
  "message": "Data Validation Failed.",
  "code": 0,
  "status": 422,
  "type": "yii\\web\\UnprocessableEntityHttpException",
  "errors": {
    "name": ["Name cannot be blank."],
    "asset_code": ["Asset Code cannot be blank."]
  }
}
```

### Not Found (404)
```json
{
  "name": "Not Found",
  "message": "Object not found: 999",
  "code": 0,
  "status": 404,
  "type": "yii\\web\\NotFoundHttpException"
}
```

### Server Error (500)
```json
{
  "name": "Internal Server Error",
  "message": "An internal server error occurred.",
  "code": 0,
  "status": 500,
  "type": "yii\\web\\HttpException"
}
```

---

## Setup Instructions

### 1. Database Migration

Pastikan MySQL sudah berjalan dan buat database:

```sql
CREATE DATABASE inventory_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'inventory_user'@'localhost' IDENTIFIED BY 'inventory123';
GRANT ALL PRIVILEGES ON inventory_db.* TO 'inventory_user'@'localhost';
FLUSH PRIVILEGES;
```

Jalankan migration untuk membuat tabel:
```bash
./yii migrate
```

### 2. Start Development Server
```bash
php yii serve
```
atau
```bash
php -S localhost:8080 -t web
```

### 3. Test API
Gunakan curl, Postman, atau tools API testing lainnya:

**Example with curl:**
```bash
# Get all categories
curl http://localhost:8080/api/categories

# Create new item
curl -X POST http://localhost:8080/api/items \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Arduino Uno",
    "asset_code": "ARD-001",
    "category_id": 2,
    "quantity": 15,
    "minimum_stock": 5,
    "condition": "good",
    "location": "Lab Electronics",
    "description": "Microcontroller untuk belajar embedded systems"
  }'

# Update item quantity
curl -X PATCH http://localhost:8080/api/items/1 \
  -H "Content-Type: application/json" \
  -d '{"quantity": 10}'

# Delete item
curl -X DELETE http://localhost:8080/api/items/1
```

---

## Additional Features

### Pagination
API menggunakan pagination otomatis untuk endpoint GET all:
- Header `X-Pagination-Total-Count`: Total jumlah records
- Header `X-Pagination-Page-Count`: Total jumlah halaman
- Header `X-Pagination-Current-Page`: Halaman saat ini
- Header `X-Pagination-Per-Page`: Jumlah items per halaman
- Links header untuk navigasi (first, prev, next, last)

### Filtering & Sorting
Tambahkan custom filters jika diperlukan:
```
GET /api/items?filter[condition]=good
GET /api/items?sort=-created_at
```

### CORS
CORS sudah di-enable untuk memudahkan integrasi dengan frontend.

---

## Testing API

Setelah database berjalan, Anda dapat test API dengan:

1. **Postman Collection** - Import dan test semua endpoints
2. **curl commands** - Lihat examples di atas
3. **Frontend Application** - Integrasikan dengan React, Vue, atau Angular

---

## Notes

- Semua timestamps menggunakan Unix timestamp (integer)
- API menggunakan format JSON
- RESTful conventions (GET, POST, PUT, PATCH, DELETE)
- Automatic validation dari Yii2 models
- Foreign key constraints untuk data integrity
