-- Step 1: Create the Database
CREATE DATABASE IF NOT EXISTS `cy-play`;
USE `cy-play`;

-- Step 2: Create the `user` Table
CREATE TABLE IF NOT EXISTS `user` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `prenoun` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `passcode` VARCHAR(255) NOT NULL
);

-- Step 3: Create the `product` Table
CREATE TABLE IF NOT EXISTS `product` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `imagelink` VARCHAR(255),
    `stock` INT NOT NULL,
    `review` DECIMAL(3,2),
    `price` DECIMAL(10,2) NOT NULL,
    `nbofachat` INT NOT NULL,
    `categorie` VARCHAR(255) NOT NULL
);

-- Step 4: Create the `fournisseur` Table
CREATE TABLE IF NOT EXISTS `fournisseur` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `commande` (
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `order_date` DATETIME NOT NULL,
    `quantity` INT NOT NULL,
    `status` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`user_id`, `product_id`, `order_date`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `product`(`id`)
);

INSERT INTO `user` (`name`, `prenoun`, `email`, `passcode`) VALUES
('John Doe', 'John', 'john.doe@example.com', 'password123'),
('Jane Smith', 'Jane', 'jane.smith@example.com', 'password456');

INSERT INTO `product` (`name`, `description`, `imagelink`, `stock`, `review`, `price`, `nbofachat`, `categorie`) VALUES
('Laptop', 'High-performance gaming laptop', 'https://example.com/laptop.jpg', 10, 4.5, 1200.00, 5, 'Electronics'),
('Smartphone', 'Latest model smartphone with high-resolution camera', 'https://example.com/smartphone.jpg', 15, 4.7, 800.00, 3, 'Electronics');

INSERT INTO `fournisseur` (`name`) VALUES
('Tech Gadgets Inc.'),
('Smart Electronics Ltd.');
