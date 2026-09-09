# RatpacCheck WordPress Theme — Delivery & Setup Guide

This package contains the complete, production-ready WordPress Theme converted from the Next.js frontend website.

---

## 📦 What is Included in Delivery

| Path / File | Description |
| :--- | :--- |
| **`ratpaccheck-theme.zip`** | **Ready-to-upload WordPress Theme ZIP file**. Hand this directly to the client or upload via WP Admin. |
| **`wordpress-theme/ratpaccheck/`** | The uncompressed theme source directory (for developers, FTP, or cPanel uploads). |

---

## 🚀 Step 1: Install & Activate the Theme in WordPress

### Method A: Upload via WordPress Admin Dashboard (Easiest)
1. Log in to your WordPress Admin dashboard (`https://yourdomain.com/wp-admin`).
2. Go to **Appearance** &rarr; **Themes**.
3. Click **Add New Theme** at the top, then click **Upload Theme**.
4. Choose `ratpaccheck-theme.zip` from your computer and click **Install Now**.
5. Once uploaded, click **Activate**.

### Method B: Upload via cPanel / FTP
1. Upload the `ratpaccheck` folder to `/wp-content/themes/` on your server.
2. Go to **Appearance** &rarr; **Themes** in WP Admin and click **Activate**.

---

## 📄 Step 2: Set Up the Pages

Go to **Pages** &rarr; **Add New** in WordPress and create each of the following pages:

| Page Title | Permalinks / Slug | Page Attributes &rarr; Template |
| :--- | :--- | :--- |
| **Home** | `/` | *(Default template or Front Page)* |
| **Products** | `/products/` | **Products Catalog** |
| **Collections** | `/collections/` | **Collections** |
| **About Us** | `/about/` | **About Us** |
| **Customer Help** | `/customer-help/` | **Customer Help & FAQs** |
| **Track Order** | `/track-order/` | **Track Order** |
| **Product Detail** | `/product-detail/` | **Product Detail Page** |

### Set Home as Front Page
1. Go to **Settings** &rarr; **Reading**.
2. Under **Your homepage displays**, select **A static page**.
3. Set **Homepage** to **Home**.
4. Click **Save Changes**.

---

## 🧭 Step 3: Configure Navigation Menus

1. Go to **Appearance** &rarr; **Menus**.
2. Click **create a new menu**, name it **Main Header Menu**.
3. Add the following links:
   - **Shop** &rarr; `/products/`
   - **Skin Care** &rarr; `/products/?concern=Skin`
   - **Hair Care** &rarr; `/products/?concern=Hair`
   - **Collections** &rarr; `/collections/`
   - **About Us** &rarr; `/about/`
   - **Customer Help** &rarr; `/customer-help/`
   - **Track Order** &rarr; `/track-order/`
4. Under **Menu Settings** at the bottom, check **Primary Header Navigation**.
5. Click **Save Menu**.

---

## ⚡ Features & Interactivity Included

- **Persistent Shopping Cart Drawer**: LocalStorage-backed cart drawer with item count badges, quantity +/- controls, free shipping milestone indicator (₹499 target), and checkout CTA.
- **Product Gallery & Active Ingredients**: Instant image thumbnail switching, rating stars, active ingredient breakdowns, and routine steps.
- **Instant Search Modal**: Live keyword filtering across all products, concerns, and categories without page reloads.
- **Interactive FAQ Accordions**: Smooth toggle on customer support page with chevron rotation.
- **Order Tracking Simulation**: Lookup form with timeline milestones (Confirmed &rarr; Shipped &rarr; Out for Delivery &rarr; Delivered).
- **Responsive Architecture**: Fully mobile-friendly drawer menu and responsive grid cards matching the design system.

---

## 🛠️ Developer Notes

- **Tailwind CSS Compilation**: Main styles are bundled in `assets/css/main.css`. If you edit templates in the future, recompile anytime using:
  ```bash
  npx tailwindcss -i ./src/app/globals.css -o ./wordpress-theme/ratpaccheck/assets/css/main.css --content "./wordpress-theme/ratpaccheck/**/*.{php,html,js}" --minify
  ```
- **Product Catalog Data**: Master product data is centrally managed in `inc/products-data.php`.
