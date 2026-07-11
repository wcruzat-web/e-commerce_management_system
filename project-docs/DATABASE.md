# Database Planning — ECommerce Module

## Notes
- This file tracks all database planning, table schemas, and decisions made during development.
- Tables prefixed with `[OTHER MODULE]` are placeholders — not our responsibility to build.

---

## 2026-07-09 — Products Module

### Tables Created

#### categories — [OTHER MODULE] Procurement/Product Master | Migration: `database/migrations/2026_07_09_112153_create_categories_table.php`
| Column | Type | Notes |
|---|---|---|
| id | bigint | PK |
| name | string | |
| slug | string | Unique |
| description | text | Nullable |
| timestamps | | created_at, updated_at |

#### products — [OTHER MODULE] Procurement/Product Master | Migration: `database/migrations/2026_07_09_112154_create_products_table.php`
| Column | Type | Notes |
|---|---|---|
| id | bigint | PK |
| brand | string | |
| name | string | |
| slug | string | Unique |
| description | text | Nullable |
| price | decimal(10,2) | |
| sale_price | decimal(10,2) | Nullable |
| category_id | bigint | FK → categories |
| featured_image | string | Nullable |
| stock | integer | Default 0 |
| sku | string | Unique |
| badge | string | Nullable ("Only 4 Left", "New Arrival", "Best Seller") |
| rating | decimal(3,2) | Default 0 |
| review_count | integer | Default 0 |
| is_active | boolean | Default true |
| timestamps | | |

#### product_images — [OTHER MODULE] Procurement/Product Master | Migration: `database/migrations/2026_07_09_112155_create_product_images_table.php`
| Column | Type | Notes |
|---|---|---|
| id | bigint | PK |
| product_id | bigint | FK → products |
| url | string | Image path |
| sort_order | integer | Default 0 |
| timestamps | | |

#### product_specifications — [OTHER MODULE] Procurement/Product Master | Migration: `database/migrations/2026_07_09_112156_create_product_specifications_table.php`
| Column | Type | Notes |
|---|---|---|
| id | bigint | PK |
| product_id | bigint | FK → products |
| group_name | string | "GPU Architecture", "Memory", etc. |
| label | string | "CUDA Cores" |
| value | string | "16,384" |
| is_highlight | boolean | For "At a Glance" cards |
| sort_order | integer | Default 0 |
| timestamps | | |

### Notes
- `migrate:fresh` was run; dropped pre-existing `carts`, `cart_items`, `wishlists` tables (no migration files). Recreate when Cart page is tackled.
- All product tables have proper foreign keys with cascade delete.
- For shop page UI reference, see `reference_ui.png` and layout description in changelog.

---

## 2026-07-09 — Cart Module

### Tables Created

#### customers — ECommerce Cart | Migration: `database/migrations/2026_07_09_115225_create_customers_table.php`
| Column | Type | Notes |
|---|---|---|
| customer_id | bigint | PK |
| name | string | |
| email | string | Unique |
| phone | string(20) | Nullable |
| address | text | Nullable |
| timestamps | | |

#### carts — ECommerce Cart | Migration: `database/migrations/2026_07_09_115226_create_carts_table.php`
| Column | Type | Notes |
|---|---|---|
| cart_id | bigint | PK |
| customer_id | bigint | FK → customers |
| timestamps | | |

#### cart_items — ECommerce Cart | Migration: `database/migrations/2026_07_09_115227_create_cart_items_table.php`
| Column | Type | Notes |
|---|---|---|
| cart_item_id | bigint | PK |
| cart_id | bigint | FK → carts (cascade) |
| product_id | bigint | FK → products (cascade) |
| quantity | integer | |
| unit_price | decimal(10,2) | Price snapshot at add time |
| subtotal | decimal(10,2) | quantity × unit_price |
| timestamps | | |

### Models
- `App\Models\Customer` — hasMany(Cart)
- `App\Models\Cart` — belongsTo(Customer), hasMany(CartItem)
- `App\Models\CartItem` — belongsTo(Cart), belongsTo(Product)

### Architecture
- `App\Services\CartService` — OOP service class handling cart logic (getOrCreate, addItem, updateQuantity, removeItem, getSummary)
- `App\Http\Controllers\CartController` — HTTP layer using dependency-injected CartService
- Guest users get an auto-created Customer record stored in session (`guest_customer_id`)
- Routes: GET /cart, PATCH /cart/{cartItem}, DELETE /cart/{cartItem}
- ToDo: POST /cart/voucher when coupon system is built

---

## 2026-07-10 — Checkout Module

### Tables Created

#### orders — ECommerce Checkout | Migration: `database/migrations/2026_07_10_132723_create_orders_table.php`
| Column | Type | Notes |
|---|---|---|
| order_id | bigint | PK |
| customer_id | bigint | FK → customers |
| order_number | string | Unique (ORD-XXXXX) |
| status | string | Default "pending" |
| subtotal | decimal(10,2) | |
| tax | decimal(10,2) | |
| grand_total | decimal(10,2) | |
| shipping_name | string | |
| shipping_email | string | |
| shipping_phone | string(20) | Nullable |
| shipping_address | text | |
| notes | text | Nullable |
| timestamps | | |

#### order_items — ECommerce Checkout | Migration: `database/migrations/2026_07_10_132724_create_order_items_table.php`
| Column | Type | Notes |
|---|---|---|
| order_item_id | bigint | PK |
| order_id | bigint | FK → orders (cascade) |
| product_id | bigint | FK → products (cascade) |
| quantity | integer | |
| unit_price | decimal(10,2) | |
| subtotal | decimal(10,2) | |
| timestamps | | |

### Models
- `App\Models\Order` — belongsTo(Customer), hasMany(OrderItem)
- `App\Models\OrderItem` — belongsTo(Order), belongsTo(Product)

### CustomerAddresses
`customer_addresses` — ECommerce Checkout | Migration: `database/migrations/2026_07_10_134110_create_customer_addresses_table.php`

| Column | Type | Notes |
|---|---|---|
| address_id | bigint | PK |
| customer_id | bigint | FK → customers (cascade) |
| address_type | string(20) | "Home", "Work", "Other" |
| street | string(150) | |
| barangay | string(100) | |
| city | string(100) | |
| province | string(100) | |
| postal_code | string(10) | |
| country | string(100) | |
| is_default | boolean | Only one default per customer |
| timestamps | | |

**Model:** `App\Models\CustomerAddress` — `belongsTo(Customer)`
**Seeder:** `CustomerAddressSeeder` — 3 sample addresses (Home, Work, Other)

### Architecture
- `App\DTOs\CheckoutDataDTO` — typed DTO for checkout form data (shippingName, shippingEmail, ...)
- `App\Repositories\OrderRepository` — DB queries: create order, add item, load items
- `App\Services\CheckoutService` — creates order from cart, clears cart items
- `App\Services\CustomerService` — manages guest customer session (find or create)
- `App\Http\Controllers\CheckoutController` — GET /checkout (form with address selection), POST /checkout (creates order + saves address)

## Removed Tables
- `users`, `password_reset_tokens`, `cache`, `cache_locks`, `jobs`, `job_batches`, `failed_jobs` — non-ecommerce Laravel scaffolding deleted from migrations

### Seeders
- **CategorySeeder** — 4 categories: Graphics Cards, Processors, Motherboards, Memory
- **ProductSeeder** — 4 products: RTX 4090, i9-14900K, ROG Maximus Z790 Hero, Trident Z5 RGB
- **CustomerAddressSeeder** — 3 addresses (Home/Work/Other) for first customer
- 52 product specifications created across all products

Seeder files:
- `database/seeders/CategorySeeder.php`
- `database/seeders/ProductSeeder.php`
- `database/seeders/CustomerAddressSeeder.php`

## Pending Decisions

