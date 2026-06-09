# 🛒 Grocery Store Website

A complete Grocery Store E-Commerce Website built using PHP, MySQL, Bootstrap 5, Razorpay Payment Gateway, and DomPDF Invoice Generator.

This project allows customers to browse grocery products, add items to cart, place orders, make online payments, and download invoices. It also includes a powerful Admin Panel for managing products, categories, users, and orders.

---

# 🚀 Features

## Customer Features

* User Registration & Login
* Secure Authentication
* Product Catalog
* Category Wise Products
* Product Details Page
* Shopping Cart
* Update Cart Quantity
* Remove Cart Items
* Checkout System
* Cash On Delivery
* Razorpay Online Payment
* Order History
* Order Details
* PDF Invoice Download
* Responsive Design

---

## Admin Features

* Admin Login
* Dashboard Statistics
* Product CRUD
* Category CRUD
* Order Management
* User Management
* Sales Reports
* Product Image Upload
* Order Status Updates

---

# 🛠 Technologies Used

* PHP 8+
* MySQL
* Bootstrap 5
* HTML5
* CSS3
* JavaScript
* jQuery
* Razorpay Payment Gateway
* DomPDF
* Font Awesome

---

# 📂 Project Structure

```text
grocery-store/
│
├── admin/
│   ├── auth.php
│   ├── dashboard.php
│   ├── sidebar.php
│   ├── products.php
│   ├── edit-product.php
│   ├── categories.php
│   ├── edit-category.php
│   ├── orders.php
│   ├── users.php
│   └── sales-report.php
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── config/
│   ├── db.php
│   └── razorpay.php
│
├── includes/
│   ├── auth.php
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
├── index.php
├── products.php
├── product-details.php
├── cart.php
├── checkout.php
├── payment-success.php
├── orders.php
├── order-details.php
├── invoice.php
├── login.php
├── register.php
├── logout.php
│
├── database.sql
├── vendor/
└── README.md
```

---

# ⚙ Installation

## 1. Clone Project

```bash
git clone https://github.com/yogeshkumarsaini/grocery-store.git
```

---

## 2. Move Project

Copy project to:

```text
xampp/htdocs/
```

or

```text
wamp/www/
```

---

## 3. Create Database

Create database:

```sql
CREATE DATABASE grocery_store;
```

Import:

```text
database.sql
```

---

## 4. Configure Database

File:

```php
config/db.php
```

```php
<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "grocery_store"
);
?>
```

---

## 5. Install Composer Packages

```bash
composer install
```

Install DomPDF:

```bash
composer require dompdf/dompdf
```

---

## 6. Configure Razorpay

Create file:

```php
config/razorpay.php
```

```php
<?php

$keyId = "rzp_test_xxxxxxxxxxxx";
$keySecret = "xxxxxxxxxxxxxxxx";
```

Update checkout.php:

```php
include 'config/razorpay.php';
```

```javascript
"key":"<?php echo $keyId; ?>"
```

---

## 7. Run Project

```text
http://localhost/grocery-store
```

---

# 👨‍💼 Admin Login

```text
Email    : admin@grocery.com
Password : password
```

---

# 🗄 Database Tables

## users

* id
* name
* email
* password
* role
* created_at

## categories

* id
* category_name

## products

* id
* category_id
* product_name
* description
* price
* stock
* image

## orders

* id
* user_id
* total_amount
* status
* payment_id
* payment_status
* created_at

## order_items

* id
* order_id
* product_id
* quantity
* price

---

# 💳 Payment Flow

```text
Cart
 ↓
Checkout
 ↓
Razorpay Payment
 ↓
Payment Success
 ↓
Order Created
 ↓
Stock Updated
 ↓
Invoice Generated
```

---

# 📄 Invoice Generation

Invoice is generated using DomPDF.

URL Example:

```text
invoice.php?id=1
```

---

# 📈 Future Improvements

* Wishlist
* Coupons & Discounts
* Product Reviews
* Email Notifications
* WhatsApp Notifications
* REST API
* Laravel Version
* Multi Vendor Support
* GST Invoice
* Analytics Dashboard

---

# 🔒 Security Features

* Session Authentication
* Password Hashing
* Protected Admin Routes
* User Order Validation
* XSS Protection using htmlspecialchars()
