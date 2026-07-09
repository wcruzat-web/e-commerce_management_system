# Changelog

All changes are timestamped and grouped by version/session.

---

## 2026-07-08

### 10:00 AM — Project Setup & Customer Pages
- Created Laravel project and configured Tailwind CSS with Vite
- Built customer-facing pages under `pages/customer/`:
  - **Cart** — `pages/customer/cart/cart.blade.php` with cart-items-list, order-summary, voucher-card, checkout-stepper, cart-scripts
  - **Checkout** — `pages/customer/checkout/checkout.blade.php` with checkout-details, order-summary, checkout-scripts
  - **Payment** — `pages/customer/payment/payment.blade.php` with payment-details, order-summary, payment-scripts
  - **Success** — `pages/customer/success/success.blade.php` with order-confirmed, order-summary, success-scripts
  - **Order Tracking** — `pages/customer/order-tracking/tracking.blade.php` with order-status-banner, timeline, shipment-items, shipment-meta, track-another-order, support-shortcuts, chat-button, tracking-scripts
- Created shared `checkout-stepper` component (used across cart, checkout, payment, success)
- Created `layouts/app.blade.php` (customer layout with header)

### 2:00 PM — Header Component
- Built `components/header/header.blade.php` with announcement bar, mega menu, search, cart icon, account icon
- Built `components/header/announcement-bar.blade.php` with promo message and Admin Portal link
- Built `components/header/search-card.blade.php` with search suggestions

### 4:00 PM — Admin Dashboard (Initial)
- Created `layouts/admin.blade.php` (admin layout, no customer header)
- Built initial dashboard with sidebar, topbar, stat cards, revenue chart, recent orders, low stocks
- Registered admin routes under `/admin/*` prefix
- Set up route names for all customer pages (cart, checkout, payment, success, tracking)
- Fixed breadcrumbs across checkout, payment, success pages
- Wired button navigation: Cart → Checkout → Payment → Success → Tracking

## 2026-07-09

### 11:00 AM — Admin Dashboard Refactoring
- Extracted dashboard into 8 reusable components under `pages/admin/dashboard/components/`
- Dashboard page reduced from 504 to 63 lines
- Components: sidebar, topbar, export-toast, stat-cards, revenue-section, recent-orders, low-stocks, dashboard-scripts

### 11:15 AM — Orders Page Created
- Created `pages/admin/orders/` with full orders list
- Extracted components: orders-table, orders-toolbar, orders-pagination, order-details-modal, orders-scripts
- Added client-side filtering (search by name, filter by status, filter by date range)
- Added print button with print CSS (hides sidebar/topbar, prints only table)
- Added order details slide-over modal (click any row to view)
- Clicking row opens modal with customer info, order items, totals

### 11:30 AM — Sidebar Enhanced
- Made collapsible via toggle button on desktop (persists in localStorage)
- Made responsive — off-canvas overlay on mobile with hamburger toggle
- Moved from `pages/admin/dashboard/components/` to `components/admin/sidebar/`
- Nav links: Dashboard, Product, Inventory (Orders removed — only via "View all >")
- Added `signOut()` function directly in sidebar component (self-contained)

### 11:45 AM — Topbar & Notifications
- Notification bell shows only new/unread notifications in dropdown
- "View all notifications" opens a full slide-over panel with New + Earlier sections
- Notification data reflects dashboard info (low stock, new orders, sync status, revenue milestones)
- Notification toggle JS moved into topbar itself (self-contained)
- Created notification-icon component for reusable SVG icons
- Created notifications-panel component for the "View all" slide-over
- 10 sample notifications (3 new, 7 earlier)

### 12:00 PM — Responsive Fixes
- Sidebar: off-canvas overlay on mobile, collapsible on desktop (`lg+`)
- Tables: wrapped in `overflow-x-auto` for horizontal scroll
- Order details modal: full width on mobile (`max-lg:max-w-full`)
- Grid breakpoints adjusted (`lg` → `xl` for 3-column layouts)
- Content padding: `p-4` mobile, `p-6` desktop
- Stat cards: `lg:grid-cols-4` → `xl:grid-cols-4`
- Topbar: reduced gap on mobile

### 12:15 PM — Dummy Pages Created
Placeholder pages so navigation works end-to-end:

| Route | Name | View Path | Purpose |
|---|---|---|---|
| `/shop` | `products.index` | `pages/customer/shop/index` | "Continue Shopping" button |
| `/account` | `account` | `pages/customer/account/index` | Header account icon |
| `/admin/products` | `admin.products` | `pages/admin/products/index` | Sidebar "Product" link |
| `/admin/inventory` | `admin.inventory` | `pages/admin/inventory/index` | Sidebar "Inventory" link |

### 12:20 PM — Route Changes
- Added `orders.track` alias for `/track` (reuses tracking page)
- Removed duplicate root route — `/` now redirects to `/tracking`
- All hardcoded JS redirects (`/checkout`, `/payment`, `/success`) replaced with `{{ route('...') }}`

---

## TODO (Backend)
- Replace static `$stats`, `$recentOrders`, `$lowStock`, `$revenueSeries` etc. with controller data
- Replace `$newNotifications` / `$allNotifications` with DB data
- Wire search/filter/pagination to Eloquent queries
- Wire `signOut()` to POST /logout
- Wire `exportReport()` to GET /admin/reports/export
- Wire `viewSyncLogs()` to GET /admin/erp/sync-logs
- Wire order details modal to real order data
