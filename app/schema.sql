CREATE TABLE products(
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 price DECIMAL(10,2),
 category VARCHAR(50),
 status VARCHAR(20),
 image_path VARCHAR(255)
);