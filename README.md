# Timedoor Inventory REST API (Yii2 Basic)

Starter files for an existing Yii2 Basic project.

## Setup
1. Copy `controllers`, `models`, and `migrations` into your Yii2 project root. Merge folders; do not replace your entire `config/web.php`.
2. In `config/web.php`, merge these entries into the existing `components` array:

```php
'request' => [
    'cookieValidationKey' => 'PASTE_YOUR_OWN_RANDOM_SECRET',
    'parsers' => ['application/json' => 'yii\\web\\JsonParser'],
],
'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => false,
    'rules' => [
        ['class' => 'yii\\rest\\UrlRule', 'controller' => ['api/items', 'api/categories']],
    ],
],
```

Generate a secret with:
`php -r 'echo bin2hex(random_bytes(32)), PHP_EOL;'`

If `request` or `urlManager` already exists, merge settings into it; do not duplicate the keys.

3. Create a database and configure `config/db.php`:
```sql
CREATE DATABASE timedoor_inventory CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
4. Run `php yii migrate`
5. Run `php yii serve --port=8080`

## Endpoints
Items: `GET /api/items`, `GET /api/items/1`, `POST /api/items`, `PUT /api/items/1`, `PATCH /api/items/1`, `DELETE /api/items/1`
Categories: `GET /api/categories`, `GET /api/categories/1`, `POST /api/categories`, `PUT /api/categories/1`, `PATCH /api/categories/1`, `DELETE /api/categories/1`

Example:
```bash
curl -i -X POST http://localhost:8080/api/items \\
  -H 'Content-Type: application/json' \\
  -d '{"name":"Laptop Lenovo","asset_code":"TDA-SMG-LAP-001","category_id":1,"quantity":5,"minimum_stock":1,"condition":"good","location":"Semarang"}'
```

This is a development starter. Authentication/authorization and production hardening are not included yet.
