# Project Notes — ECommerce Module

## Overview
These notes document every file, function, class, and decision related to the ECommerce module for defense/review purposes. Organized by layer: **Migrations → Models → Architecture (DTOs, Repositories, Services) → Controllers → Views → Routes → Flows**

---

## Migrations

### `2026_07_09_115225_create_customers_table.php`
Creates the `customers` table. This is one of the first tables — customers exist before cart/checkout since every cart needs an owner. Originally designed for guest flow (auto-created customer records), later expanded for authenticated users.

| Column | Type | Notes |
|---|---|---|
| customer_id | bigint | PK (not default `id`) |
| name | string | Original single-name field (later split into first_name/last_name) |
| email | string | Unique |
| phone | string(20) | Nullable |
| address | text | Nullable (later removed — address lives in customer_addresses) |
| timestamps | | created_at, updated_at |

### `2026_07_09_115226_create_carts_table.php`
One cart per customer. The cart is the container for cart items before checkout.

| Column | Type | Notes |
|---|---|---|
| cart_id | bigint | PK |
| customer_id | bigint | FK → customers (cascade delete) |
| timestamps | | |

### `2026_07_09_115227_create_cart_items_table.php`
Each row is one product line in a cart. Stores a snapshot of the unit price at add time so price changes in the Product table don't affect existing cart items.

| Column | Type | Notes |
|---|---|---|
| cart_item_id | bigint | PK |
| cart_id | bigint | FK → carts (cascade) |
| product_id | bigint | FK → products (cascade) |
| quantity | integer | |
| unit_price | decimal(10,2) | Price snapshot at add time |
| subtotal | decimal(10,2) | quantity × unit_price |
| timestamps | | |

### `2026_07_09_112153_create_categories_table.php` (Other module)
### `2026_07_09_112154_create_products_table.php` (Other module)
### `2026_07_09_112155_create_product_images_table.php` (Other module)
### `2026_07_09_112156_create_product_specifications_table.php` (Other module)
These belong to Procurement/Product Master (OTHER MODULE) — we only read from them. Products, categories, images, and specifications are managed upstream.

### `2026_07_10_132723_create_orders_table.php`
Created when user completes checkout. Stores the full order with a snapshot of shipping info.

| Column | Type | Notes |
|---|---|---|
| order_id | bigint | PK |
| customer_id | bigint | FK → customers |
| order_number | string | Unique (OID-####-#### format) |
| status | string | Default "pending" |
| subtotal | decimal(10,2) | Sum of order_items subtotals |
| tax | decimal(10,2) | 8% of subtotal |
| grand_total | decimal(10,2) | subtotal + tax |
| shipping_name | string | Snapshot of customer name at checkout |
| shipping_email | string | Snapshot of email |
| shipping_phone | string(20) | Nullable |
| shipping_address | text | Full address string (street, barangay, city, etc.) |
| notes | text | Nullable — order notes |
| timestamps | | |

### `2026_07_10_132724_create_order_items_table.php`
Copies of cart items frozen at order time. Even if products/prices change later, the order preserves what was purchased.

| Column | Type | Notes |
|---|---|---|
| order_item_id | bigint | PK |
| order_id | bigint | FK → orders (cascade) |
| product_id | bigint | FK → products (cascade) |
| quantity | integer | |
| unit_price | decimal(10,2) | Price snapshot at order time |
| subtotal | decimal(10,2) | quantity × unit_price |
| timestamps | | |

### `2026_07_10_134110_create_customer_addresses_table.php`
Saved address cards shown on checkout. A customer can have multiple addresses (Home, Work, Other). Only one can be marked `is_default`. Originally had `recipient_name` and `phone_number` columns, but those were dropped later since contact info is entered in the checkout form, making them redundant here.

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

**Removed columns (migration `2026_07_11_080433`):** `recipient_name` (string 100), `phone_number` (string 20) — both dropped because contact info is captured in the checkout form (first_name, last_name, shipping_phone) not in the address record.

### `2026_07_11_064617_modify_customers_table.php`
Transformed the `customers` table from guest-only to full auth support:

**Changes:**
- Dropped: `name`, `phone`, `address` (old guest schema)
- Added: `first_name` (string 100), `last_name` (string 100), `password` (hashed), `phone_number` (string 20, nullable), `profile_picture` (string 255, nullable), `status` (string 20, default 'Active'), `email_verified_at` (nullable timestamp), `last_login` (nullable timestamp)

### `2026_07_11_065100_create_sessions_table.php`
Standard Laravel sessions table. Required because we switched session driver to `database` so sessions persist even without file-based storage.

---

## Models

### `App\Models\Customer`
- **Primary key:** `customer_id` (not the default `id`)
- **Implements:** `Authenticatable` (Laravel's auth contract) — enables `Auth::user()`, `Auth::login()`, etc.
- **Hidden:** `password` (never exposed in JSON)
- **Casts:** `password` → `hashed` (auto-hashes on set)
- **Fillable:** `first_name`, `last_name`, `email`, `phone_number`, `password`, `profile_picture`, `status`
- **Relationships:**
  - `hasMany(Cart)` — one customer can have multiple carts (though we only use one active cart)
  - `hasMany(Order)` — one customer can have many orders
  - `hasMany(CustomerAddress)` — one customer can have many saved addresses

### `App\Models\Cart`
- **Primary key:** `cart_id`
- **Fillable:** `customer_id`
- **Relationships:**
  - `belongsTo(Customer)` — each cart belongs to one customer
  - `hasMany(CartItem)` — a cart holds multiple items

### `App\Models\CartItem`
- **Primary key:** `cart_item_id`
- **Route key name:** `cart_item_id` (route-model binding uses `cart_item_id` instead of default `id`)
- **Fillable:** `cart_id`, `product_id`, `quantity`, `unit_price`, `subtotal`
- **Relationships:**
  - `belongsTo(Cart)` — each item belongs to one cart
  - `belongsTo(Product)` — each item references one product from Procurement module

### `App\Models\Order`
- **Primary key:** `order_id`
- **Fillable:** all order columns
- **Relationships:**
  - `belongsTo(Customer)` — each order belongs to one customer
  - `hasMany(OrderItem)` — an order has multiple line items

### `App\Models\OrderItem`
- **Primary key:** `order_item_id`
- **Fillable:** all order_item columns
- **Relationships:**
  - `belongsTo(Order)` — each item belongs to one order
  - `belongsTo(Product)` — references the product snapshot

### `App\Models\CustomerAddress`
- **Primary key:** `address_id`
- **Fillable:** `customer_id`, `address_type`, `street`, `barangay`, `city`, `province`, `postal_code`, `country`, `is_default`
- **Relationships:**
  - `belongsTo(Customer)` — each address belongs to one customer

---

## Architecture (OOP — Single Responsibility)

Each layer has one job. The flow: **Controller → Service → Repository → Model**

DTOs sit between Controller and Service — typed immutable objects replacing loose arrays.

### DTOs

#### `App\DTOs\CartSummaryDTO`
A Data Transfer Object — a plain PHP class with typed `readonly` properties. Replaces the old associative array so you always know exactly what type each value is.

| Property | Type | Description |
|---|---|---|
| `itemsCount` | int | Total quantity of all items |
| `subtotal` | float | Sum of all item subtotals |
| `tax` | float | 8% of subtotal |
| `grandTotal` | float | subtotal + tax |

Usage: `$summary->subtotal` instead of `$summary['subtotal']`.

#### `App\DTOs\CheckoutDataDTO`
Typed DTO holding validated checkout form data. Created in the controller after validation, passed to CheckoutService.

| Property | Type | Description |
|---|---|---|
| `shippingName` | string | first_name + last_name combined |
| `shippingEmail` | string | Customer email for this order |
| `shippingPhone` | string | Phone number, defaults to empty string |
| `shippingAddress` | string | Full address as single string |
| `notes` | string | Order notes, defaults to empty |

### Repositories

Repositories only talk to the database. No business logic, no calculations.

#### `App\Repositories\CartRepository`
| Method | What it does |
|---|---|
| `findOrCreateByCustomer(customerId)` | Gets existing cart or creates a new one for this customer |
| `loadItems(cart)` | Eager-loads all cart items with their product data (prevents N+1 queries) |
| `findExistingItem(cartId, productId)` | Checks if a product is already in the cart |
| `addItem(cartId, productId, qty, price)` | Inserts a new row into cart_items |
| `updateItem(cartItemId, qty, subtotal)` | Updates quantity and subtotal on an existing cart item |
| `deleteItem(cartItemId)` | Removes a cart item row |

#### `App\Repositories\CustomerRepository`
| Method | What it does |
|---|---|
| `find(id)` | Finds a customer by ID |
| `findByEmail(email)` | Finds a customer by email (used in auth) |
| `createRegistered(data)` | Creates a new registered customer with name, email, hashed password |
| `updateLastLogin(customer)` | Sets `last_login` to now and saves |

#### `App\Repositories\OrderRepository`
| Method | What it does |
|---|---|
| `create(data)` | Inserts a new order row |
| `addItem(orderId, data)` | Inserts an order_items row linked to an order |
| `loadItems(order)` | Eager-loads items with product data |

### Services

Services contain business logic. They never call Eloquent directly — all DB work goes through repositories.

#### `App\Services\CustomerService`
| Method | What it does |
|---|---|
| `authenticate(credentials)` | Calls `Auth::attempt()` with email + password |
| `register(data)` | Calls `CustomerRepository::createRegistered()` then logs the user in |
| `logout()` | Calls `Auth::logout()` and invalidates session |

**Guest methods removed (2026-07-11):** `getGuestCustomer()` and `createGuest()` were deleted. All cart/checkout users must now be authenticated.

#### `App\Services\CartService`
Business logic only. Uses `CartRepository` for DB and returns `CartSummaryDTO` instead of a loose array.

| Method | What it does |
|---|---|
| `getOrCreateCart(customerId)` | Uses CartRepository to find or create a cart, then load its items |
| `addItem(cart, productId, qty)` | Gets product price, checks if item already in cart via repository — if yes increments qty; if no creates new item |
| `updateQuantity(cartItem, qty)` | Ensures min quantity of 1, delegates update to repository |
| `removeItem(cartItem)` | Delegates delete to repository |
| `getSummary(cart)` | Loops items, calculates counts + totals, returns a CartSummaryDTO |

#### `App\Services\CheckoutService`
| Method | What it does |
|---|---|
| `createOrder(cart, dto)` | Creates the Order row via OrderRepository → copies each cart item into order_items via addItem → clears all cart items (deleteItems) → returns the order with items loaded |

### Controllers

The HTTP layer. Only job is receiving requests and returning responses. Services are injected via constructor.

#### `App\Http\Controllers\CartController`
| Method | Route | What it does |
|---|---|---|
| `index` | `GET /cart` | Gets authenticated customer → gets cart → gets summary DTO → renders view. If customer has no cart, it creates one (empty cart view) |
| `add` | `POST /cart/add` | Validates product_id + quantity → delegates to service → redirects back |
| `updateQuantity` | `PATCH /cart/{cartItem}` | Validates quantity → delegates to service → redirects to cart |
| `remove` | `DELETE /cart/{cartItem}` | Delegates to service → redirects to cart |

#### `App\Http\Controllers\CheckoutController`
| Method | Route | What it does |
|---|---|---|
| `index` | `GET /checkout` | Gets customer → gets cart + summary → loads saved addresses → renders checkout form. Redirects to cart if cart is empty |
| `store` | `POST /checkout` | Validates form (first/last name, email, phone, full address, notes) → creates CheckoutDataDTO → calls CheckoutService::createOrder → saves address to customer_addresses (with duplicate check; first becomes default) → redirects to /payment with order_id |
| `saveAddress` | `POST /checkout/address` | JSON-only endpoint. If `address_id` provided → updates existing address. If exact match exists → returns existing. Otherwise → creates new address. Returns `{ address: {...} }`. First saved address becomes default |

**Note:** `saveAddress` returns JSON (AJAX). `store` returns a redirect (standard form POST). Full REST API for checkout will be converted per-page later.

#### `App\Http\Controllers\Auth\LoginController`
| Method | Route | What it does |
|---|---|---|
| `showLoginForm` | `GET /login` | If already authenticated → redirects to /cart. Otherwise renders login page with `guest` layout |
| `login` | `POST /login` | Validates email + password → calls `Auth::attempt()` → if fails, back with error. If succeeds, regenerates session + redirects to intended page (default /cart) |
| `logout` | `POST /logout` | Calls `Auth::logout()`, invalidates session, redirects to /login |

#### `App\Http\Controllers\Auth\RegisterController`
| Method | Route | What it does |
|---|---|---|
| `showRegistrationForm` | `GET /register` | If already authenticated → redirects to /cart. Otherwise renders register page |
| `register` | `POST /register` | Validates first_name, last_name, email, password (confirmed) → calls CustomerService::register (creates + logs in) → redirects to /cart |

---

## Views

### Layouts

`layouts/app.blade.php` — Main customer layout. Extends a base shell. Includes the header (with mega menu, search, cart icon, account icon), a `toastContainer` div for toast notifications, and a `@yield('content')` section. Used by cart, checkout, payment, success, tracking pages.

`layouts/guest.blade.php` — Minimal layout for auth pages (login, register, forgot-password). Has ShopEase branding header + footer. No navigation, no mega menu.

`layouts/admin.blade.php` — Admin layout with sidebar, topbar, and content area.

### Auth Pages

#### `login.blade.php` (pages/customer/auth/)
Uses `guest` layout. Includes `login-card` component. Standard form (`method="POST"` with `@csrf`) — no JS fetch. Uses `@error` directives for per-field validation errors. Has link to register page and forgot-password.

**Included components:**
- `components/cards/login-card.blade.php` — The actual form card: email input, password input, remember me checkbox, submit button, links to register + forgot password
- `components/shared/auth-branding.blade.php` — ShopEase logo and tagline
- `components/shared/field-error.blade.php` — Reusable `@error` wrapper with red border + error text
- `components/shared/social-divider.blade.php` — "OR" divider for social logins
- `components/shared/google-icon.blade.php` — SVG Google icon (placeholder)

#### `register.blade.php` (pages/customer/auth/)
Same structure as login. Includes `register-card` component with: first_name, last_name, email, password, password_confirmation fields.

#### `forgot-password.blade.php` (pages/customer/auth/)
Static forgot-password form. POST route exists but returns a "not implemented" message.

### Cart Pages

#### `cart.blade.php` (pages/customer/cart/)
Main cart page. Extends `layouts.app`. Two-column layout: left has checkout stepper + cart items list, right has voucher card + order summary.

**Included components:**
- `components/checkout-stepper.blade.php` — 4-step progress bar: Cart (active/green) → Checkout → Payment → Success. Each step is "done" (green check), "active" (blue), or "upcoming" (gray) based on `$activeStep`
- `components/cart-items-list.blade.php` — Loops `$cart->items` and renders each row: product image, brand/category tags, name, SKU, stock status badge (`In Stock` = green, `Low Stock` = yellow, `Out of Stock` = red), quantity stepper with +/- buttons and hidden input, remove button (submits DELETE form), line total. Has empty state with "Continue Shopping" button
- `components/order-summary.blade.php` — Sidebar card: items count, subtotal, shipping (FREE), 8% tax, grand total. "Proceed to Checkout" button links to route('checkout'). Hidden when cart is empty
- `components/voucher-card.blade.php` — Input + Apply button for coupon codes. Placeholder only — not wired to backend
- `components/cart-scripts.blade.php` — JS for quantity stepper. On +/- click: updates hidden input + display, debounces 600ms, submits PATCH form via HTMX-style form submit. Also `applyVoucher()` stub

### Checkout Pages

#### `checkout.blade.php` (pages/customer/checkout/)
Extends `layouts.app`. Two-column layout: left has checkout stepper (step 2 active) + checkout details form, right has order summary.

**Included components:**
- `components/checkout-details.blade.php` — The main form. Contains:
  - **Contact fields:** first_name, last_name, email, shipping_phone
  - **Address section:** Saved address cards (if any) → hidden address fields container → "Use Another Address" button
  - **Address modal overlay:** Fixed backdrop modal with address form (address_type dropdown, street, barangay, city, province, postal_code, country) → "Use This Address" button
  - **Notes textarea**
  - **Continue to Payment button**
  - **JavaScript:** All modal/card logic inline (see JS section below)
- `components/order-summary.blade.php` — Same as cart sidebar but for checkout
- `components/checkout-scripts.blade.php` — Additional checkout JS if needed

### Payment Page
`payment.blade.php` (pages/customer/payment/) — Static view only. Shows checkout stepper (step 3 active), payment form placeholders, order summary. No payment processing backend yet.

### Success Page
`success.blade.php` (pages/customer/success/) — Static confirmation page showing order confirmed message, order summary. Stepper shows all 4 steps done.

### Order Tracking Page
`tracking.blade.php` (pages/customer/order-tracking/) — Static tracking view with order status banner, timeline, shipment items, shipment meta, support shortcuts, chat button, track-another-order form.

### Dummy Pages
- `shop/index.blade.php` — Product grid: brand, name, rating, price, sale price, badge overlay. Fetches from DB.
- `shop/show.blade.php` — Product detail: image, brand, name, rating, price, spec cards, quantity selector, Add to Cart (POST /cart/add), specs tabs. "Add to Cart" redirects back to product page.
- `account.blade.php` — Placeholder account page.
- `address-preview.blade.php` — Preview of saved address cards for testing.

---

## JavaScript (checkout-details.blade.php)

All JS is inline in `checkout-details.blade.php`. No separate JS file.

### Functions

#### `fillAddressFields(street, barangay, city, province, postal, country, type)`
Sets the hidden form field values from address card data or modal response. Also sets the `address_type` select value.

**Note:** `phone_number` and `recipient_name` parameters were removed — those are captured by the checkout form (shipping_phone, first_name+last_name), not the address.

#### `openAddressModal(clear, addr)`
Three modes:
1. `clear=true, addr=object`: Pre-fills modal with address data for editing (from Edit button click)
2. `clear=true, addr=undefined/empty`: Clears all modal fields for new address entry
3. `clear=false`: Copies current hidden form field values into modal (used if user clicks "Use Another Address" after already selecting one)

#### `closeAddressModal()`
Hides modal, restores body scroll.

#### `esc(str)`
Escapes HTML entities in strings used in dynamic card creation (prevents XSS in `addAddressCard` innerHTML).

#### `updateAddressCard(card, addr)`
Called after successful AJAX save when editing an existing address. Updates the card's data attributes and visible text in-place so changes appear without a page refresh. Steps:
1. Updates all `data-*` attributes on the `<label>` element
2. Sets the radio input value to the server-returned `address_id`
3. Updates the visible type badge text
4. Updates street/barangay and city/province/postal text lines

#### `useAddressFromModal()`
Main function called when user clicks "Use This Address" in the modal. Steps:
1. Validates street + barangay are not empty (shows toast error if missing)
2. Builds payload object with: `address_id` (null for new, existing ID for edit), `address_type`, `street`, `barangay`, `city`, `province`, `postal_code`, `country`
3. Sends `POST /checkout/address` with JSON body
4. On success: calls `fillAddressFields()` to populate hidden form → closes modal → if card with matching `address_id` exists, calls `updateAddressCard()` + `.click()`; otherwise calls `addAddressCard()` with the new address
5. Shows success/error toast

#### `addAddressCard(addr)`
Creates a new address card `<label>` element dynamically and prepends it to `#savedAddressCards`. Sets all data attributes, radio input, innerHTML with escaped values. Attaches click + edit listeners. Automatically clicks the new card to select it.

### Event Listeners (setup on page load)

**Address card click:** Selects the card (visual highlight), fills hidden fields via `fillAddressFields()`, shows the address fields container.

**Edit button click (`.edit-address-btn`):** Stops propagation (so card click doesn't fire), opens modal pre-filled with that card's data.

**Modal backdrop click:** Closes modal if user clicks outside the modal card.

**DOMContentLoaded:** If a default address card exists, auto-selects it. If no cards exist at all, opens the modal for the user to add one.

### Toast Notifications

`toastNotify(type, message)` — Creates a colored toast div in `#toastContainer` (fixed to bottom-right in app layout). Types: `success` (green), `error` (red), `info` (blue). Auto-fades after 3 seconds.

---

## Routes (web.php)

### Middleware Groups

| Middleware | Routes | Purpose |
|---|---|---|
| `auth` | cart, checkout, payment, success, tracking, dummy/addresses | All customer pages require login |
| None (guest) | login, register, forgot-password | Auth pages accessible without login |
| None | dummy/shop, dummy/account, dummy/shop/{slug} | Public product browsing |
| None | admin/* | Admin dashboard routes |

### Route Table

| Method | URI | Controller / View | Name |
|---|---|---|---|
| GET | `/` | Redirect → `/dummy/shop` | — |
| GET | `/cart` | `CartController@index` | `cart` |
| POST | `/cart/add` | `CartController@add` | `cart.add` |
| PATCH | `/cart/{cartItem}` | `CartController@updateQuantity` | `cart.update` |
| DELETE | `/cart/{cartItem}` | `CartController@remove` | `cart.remove` |
| GET | `/checkout` | `CheckoutController@index` | `checkout` |
| POST | `/checkout` | `CheckoutController@store` | `checkout.store` |
| POST | `/checkout/address` | `CheckoutController@saveAddress` | `checkout.address.save` |
| GET | `/payment` | `pages.customer.payment.payment` | `payment` |
| GET | `/success` | `pages.customer.success.success` | `success` |
| GET | `/tracking` | `pages.customer.order-tracking.tracking` | `tracking` |
| GET | `/track` | `pages.customer.order-tracking.tracking` | `orders.track` |
| GET | `/login` | `LoginController@showLoginForm` | `login` |
| POST | `/login` | `LoginController@login` | — |
| GET | `/register` | `RegisterController@showRegistrationForm` | `register` |
| POST | `/register` | `RegisterController@register` | — |
| POST | `/logout` | `LoginController@logout` | `logout` |
| GET | `/forgot-password` | `pages.customer.auth.forgot-password` | `forgot.password` |
| POST | `/forgot-password` | Closure (not implemented) | — |
| GET | `/dummy/shop` | Closure (fetches categories + products) | `products.index` |
| GET | `/dummy/shop/{slug}` | Closure (loads product with relations) | `products.show` |
| GET | `/dummy/account` | `pages.dummy.account` | `account` |
| GET | `/dummy/addresses` | Closure (previews saved addresses) | `dummy.addresses` |

---

## Flows

### Cart Flow

1. User visits `/dummy/shop` → clicks a product → lands on product detail page
2. User selects quantity, clicks **Add to Cart** → submits `POST /cart/add`
3. `CartController@add` runs:
   - `Auth::user()` gets the authenticated customer
   - `CartService::getOrCreateCart()` finds or creates Cart for that customer
   - `CartService::addItem()` adds the product or increments qty if already in cart
   - Redirects back to product page with success message
4. User visits `/cart`:
   - `CartController@index` loads cart + summary, renders the page
   - User can change quantity (debounced PATCH submit via quantity stepper) or remove items (DELETE form submit)
   - "Proceed to Checkout" links to route('checkout')
   - If cart is empty: shows empty state with "Continue Shopping" button, order summary hidden

### Checkout Flow

1. User has items in cart → visits `/checkout`
2. `CheckoutController@index` checks cart is not empty → loads saved addresses from `$customer->addresses`
3. If saved addresses exist: cards shown with radio selection. Click a card → fills hidden form fields. Default address auto-selected on page load
4. **Edit a card:** Click the pencil icon on any card → modal opens pre-filled with that address → edit fields → "Use This Address" → AJAX save → card DOM updates instantly → card stays selected
5. **Add new address:** Click "Use Another Address" (dashed button) → modal opens empty → fill in → "Use This Address" → AJAX save → new card created + auto-selected
6. User fills contact fields (first_name, last_name, email, phone) if not already filled
7. User clicks "Continue to Payment" → `POST /checkout`
8. `CheckoutController@store`:
   - Validates all fields (name, email, phone, address, notes)
   - Creates `CheckoutDataDTO`
   - Calls `CheckoutService::createOrder()` → creates Order + OrderItems → clears cart
   - Auto-saves address to `customer_addresses` (skips if duplicate; first becomes default)
   - Redirects to `/payment` with `order_id` in session flash

### Address Save Flow (useAddressFromModal)

1. User fills modal → clicks "Use This Address"
2. JS validates street + barangay required
3. `POST /checkout/address` with JSON payload: `{ address_id, address_type, street, barangay, city, province, postal_code, country }`
4. `CheckoutController@saveAddress`:
   - If `address_id` present: Find existing by customer+id → update columns → return `{ address }`
   - If no `address_id` but exact match exists (street+barangay+city+province+postal+country): Return existing address unchanged
   - Otherwise: Create new address (first one = `is_default: true`) → return `{ address }`
5. JS: `fillAddressFields()` → close modal → if card with matching `address_id` exists: `updateAddressCard()` + click; else: `addAddressCard()` + click
6. Success toast shown

### Auth Flow

1. User visits a protected page (e.g., `/cart`) → not logged in → redirected to `/login`
2. User fills email + password → `POST /login`
3. `LoginController@login`: Validates → `Auth::attempt()` → if fails, return with `@error` → if succeeds, regenerate session → redirect to intended URL (default `/cart`)
4. **Register:** `/register` → fill first_name, last_name, email, password, confirm password → `POST /register`
5. `RegisterController@register`: Validates → `CustomerService::register()` (creates customer with hashed password + logs in) → redirect to `/cart`
6. **Logout:** `POST /logout` → `Auth::logout()` + session invalidate → redirect to `/login`

---

## Pending / Not Yet Built

| Feature | Status |
|---|---|
| Payment processing | Static view only |
| Order tracking backend | Static view only |
| Admin order management | Static table |
| Admin product management | Static list |
| Account/profile settings | Placeholder page |
| Order history for customers | No route or view |
| Coupon/voucher system | Placeholder input only |
| Password reset | Returns "not implemented" |
| Google OAuth | Placeholder buttons only |
| REST API for checkout | Only `saveAddress` is JSON; `store` is form POST |
