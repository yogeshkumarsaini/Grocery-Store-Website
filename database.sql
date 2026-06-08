CREATE DATABASE grocery_store;
USE grocery_store;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','customer') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);

-- Products Table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    product_name VARCHAR(150) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    image VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Orders Table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10,2),
    status ENUM('Pending','Completed','Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Order Items Table
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10,2),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Default Admin
INSERT INTO users(name,email,password,role)
VALUES(
'Administrator',
'admin@grocery.com',
'$2y$10$6c8XK1Lv4Y4T9Y5YjM6T9uC7C4X1w6h2N8xS9xgqR0M5zY3lD7K6W',
'admin'
);

INSERT INTO categories(category_name) VALUES
('Fruits'),
('Vegetables'),
('Dairy'),
('Bakery'),
('Rice & Grains'),
('Cooking Oil');

INSERT INTO products
(category_id,product_name,price,stock,image,description)
VALUES

(1,'Fresh Apple',120,50,'apple.jpg',
'Fresh and juicy apples'),

(1,'Banana',60,100,'banana.jpg',
'Healthy bananas'),

(2,'Potato',30,200,'potato.jpg',
'Farm fresh potatoes'),

(2,'Tomato',40,150,'tomato.jpg',
'Organic tomatoes'),

(3,'Milk 1L',65,100,'milk.jpg',
'Fresh dairy milk'),

(4,'Brown Bread',45,80,'bread.jpg',
'Healthy brown bread'),

(5,'Basmati Rice',120,60,'rice.jpg',
'Premium quality rice'),

(6,'Sunflower Oil',180,40,'oil.jpg',
'Refined sunflower oil');

ALTER TABLE orders
ADD payment_id VARCHAR(255);

ALTER TABLE orders
ADD payment_status VARCHAR(50);

