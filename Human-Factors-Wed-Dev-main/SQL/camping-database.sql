SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS campingDB;
CREATE DATABASE campingDB;

USE campingDB;

CREATE TABLE customer(
    user_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fName varchar(30) NOT NULL,
    lName varchar(30),
    bDay DATE DEFAULT NULL,
    email VARCHAR(100) UNIQUE KEY NOT NULL,
    password VARCHAR(1000) NOT NULL
) AUTO_INCREMENT = 001;


CREATE TABLE products_category (
    cat_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cat_name varchar(100) NOT NULL,
    cat_desc varchar(1000)
) AUTO_INCREMENT = 001;


CREATE TABLE products (
    product_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cat_id int,
    product_keywords varchar(1000),
    productName varchar(1000),
    productDesc varchar(1000),
    images VARCHAR(1000),
    price float,
    quantity int,
    user_id int DEFAULT NULL,
    FOREIGN Key (cat_id) references products_category(cat_id),
    FOREIGN Key (user_id) references customer(user_id)
) AUTO_INCREMENT = 001;

CREATE TABLE payment_details (
    payment_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,

    amount float,
    card_name varchar(1000),
    card_number varchar(100),
    expiry varchar(100),
    csv int(3) 
) AUTO_INCREMENT = 001;

CREATE TABLE order_details (
    order_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id int,
    payment_id int,
    FOREIGN Key (user_id) references customer(user_id),
    FOREIGN Key (payment_id) references payment_details(payment_id)
) AUTO_INCREMENT = 001;

CREATE TABLE order_items (
    order_id int NOT NULL,
    product_id int,
    quantity int,
    FOREIGN Key (order_id) references order_details(order_id),
    FOREIGN Key (product_id) references products(product_id)
);

CREATE TABLE cart (
    session_id VARCHAR(300) NOT NULL,
    product_id int NOT NULL,
    quantity int,
    PRIMARY KEY (session_id, product_id),
    FOREIGN Key (product_id) references products(product_id)

);

CREATE TABLE user_address (
    user_id int NOT NULL,
    address varchar(100),
    country varchar(100),
    city varchar(100),
    postcode int(4),
    FOREIGN Key (user_id) references customer(user_id)
);

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON campingDB.* TO dbadmin@localhost;

INSERT INTO products_category(cat_id,cat_name,cat_desc) VALUES(012,'Camping and Hiking', 'This category contains items like tents');
INSERT INTO products_category(cat_id,cat_name,cat_desc) VALUES(345,'Skate and boards', 'This category contains items like skii boards');
INSERT INTO products_category(cat_id,cat_name,cat_desc) VALUES(678,'Individual and Necessity', 'This category contains items like sleeping bags');
INSERT INTO products_category(cat_id,cat_name,cat_desc) VALUES(910,'Backpacks', 'This category contains items like Backpacks');

-- Users 
INSERT INTO customer(user_id,fName,lName,bDay,email,password) VALUES(0123, 'Zara', 'Ali', '1995-11-28', 'zaraali95@gmail.com', '$2y$10$NCiRcLABMzyd8EkswRda5.AwqAOOOqdrkLXIVwKAvc.G26vS2eiHi'); -- password 5192
INSERT INTO customer(user_id,fName,lName,bDay,email,password) VALUES(3456, 'Jafar', 'Hilfiger', '1993-10-02', 'jafar93@gmail.com', '$2y$10$j5y9pYGqpijTHtXqSCNv5uN0xEY1THKZXmD8RppnQHN8CDvT6hmnC');-- password 65477
INSERT INTO customer(user_id,fName,lName,bDay,email,password) VALUES(6789, 'Sara', 'Jones', '1998-09-10', 'SJones98@gmail.com', '$2y$10$zEcz83Dr5.9djxBCR49beuYFR0rEtYeSfRWpZQhG.j0iMdE86IzqG');-- password 88975
INSERT INTO customer(user_id,fName,lName,bDay,email,password) VALUES(1010, 'William', 'Green', '1988-06-26', 'WilliamGreen@gmail.com', '$2y$10$9WHglm3YD4lFzcuHWApzP.4WuiTTIsrWDyrNa3CARyvvGB5cBRwVq');-- password 65743

-- non market items
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(012,'Tent 1','Tents, tents','Waterproof Automatic Quick Open Camping Outdoor Tent','Images/tent1.jpeg',88.9,2);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(012,'Tent 2','Tents, tents','Instant Up Camping Tent Pop up Tents Family Hiking Dome 4-8','Images/tent2.jpeg',53.0,4);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(012,'Tent 3','Tents, tents','Family Camping Tent 4 Person Hiking Beach Tents Canvas','Images/tent3.jpeg',25.6,1);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(012,'Tent 4','Tents, tents','200CM Instant Camping Tent 3-5 Person Pop up Tents Family','Images/tent4.jpeg',33.50,5);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(012,'Tent 5','Tents, tents','6-7 Persons Pop Up Tent Waterproof For Hiking Beach Family Camping Tent Portable','Images/tent5.jpeg',88.7,5);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(012,'Tent 6','Tents, tents','Kids tent for hiking/playing Pop Up Tent Waterproof For Hiking Beach Family Camping Tent Portable','Images/tent6.jpeg',69.7,3);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(345,'Ski board','Ski, ski','Matrix Snow Skis Gyro Flat Sidewall 175cm with Binding Package','Images/ski.jpeg',59.3,10);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(678,'Sleeping bag 1','Sleeping bags, sleeping','Camping Traveller 60L 20L sleeping bag | Size ONE | perfect for camping','Images/sleeping.jpeg',53.4,2);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(678,'Sleeping bag 2','Sleeping bags, sleeping','Traveling sleeping bag 50L 20L | Size One | perfect for camping','Images/sleeping2.png',43.65,5);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity) VALUES(910,'Backpack','Backpacks, backpack','Travel backpack for sleeping | hiking | camping | Waterproof','Images/backpack.png',25.7,2);

-- market palce items
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(012,'Tent 1 -Market Item','Tents, tents','Waterproof Automatic Quick Open Camping Outdoor Tent','Images/tent1.jpeg',88.9,1,0123);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(012,'Tent 2 -Market Item','Tents, tents','Instant Up Camping Tent Pop up Tents Family Hiking Dome 4-8','Images/tent2.jpeg',53.0,1,3456);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(012,'Tent 3 -Market Item','Tents, tents','Family Camping Tent 4 Person Hiking Beach Tents Canvas','Images/tent3.jpeg',25.61,1,6789);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(012,'Tent 4 -Market Item','Tents, tents','200CM Instant Camping Tent 3-5 Person Pop up Tents Family','Images/tent4.jpeg',33.50,2,3456);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(012,'Tent 5 -Market Item','Tents, tents','6-7 Persons Pop Up Tent Waterproof For Hiking Beach Family Camping Tent Portable','Images/tent5.jpeg',88.71,3,6789);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(012,'Tent 6 -Market Item','Tents, tents','Kids tent for hiking/playing Pop Up Tent Waterproof For Hiking Beach Family Camping Tent Portable','Images/tent6.jpeg',69.7,1,0123);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(345,'Ski board-Market Item','Ski, ski','Matrix Snow Skis Gyro Flat Sidewall 175cm with Binding Package','Images/ski.jpeg',59.3,1,0123);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(678,'Sleeping bag 1 -Market Item','sleeping bags, sleeping','Camping Traveller 60L 20L sleeping bag | Size ONE | perfect for camping','Images/sleeping.jpeg',53.4,1,1010);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(678,'Sleeping bag 2 -Market Item ','sleeping bags, sleeping','Traveling sleeping bag 50L 20L | Size One | perfect for camping','Images/sleeping2.png',43.65,1,1010);
INSERT INTO products(cat_id,productName,product_keywords,productDesc,images,price,quantity,user_id) VALUES(910,'Backpacks -Market Item','Backpacks, backpack','Travel backpack for sleeping | hiking | camping | Waterproof','Images/backpack.png',25.7,1,1010);

-- payment_details do atleat one just for id
INSERT INTO payment_details(payment_id,amount,card_name,card_number,expiry,csv) VALUES(905465,158.4,'Zara Ali', '$2y$10$NCiRcLABMzyd8EkswRda5.AwqAOOOqdrkLXIVwKAvc.G26vS2eiHi',"2024-02",145);
INSERT INTO payment_details(payment_id,amount,card_name,card_number,expiry,csv) VALUES(897543,194.41,'Jafar Hilfiger', '$2y$10$NCiRcLABMzyd8EkswRda5.AwqAOOOqdrkLXIVwKAvc.G26vS2eiHi',"2023-05",646);

-- order_details
INSERT INTO order_details(order_id,user_id,payment_id) VALUES(653,0123,905465);
INSERT INTO order_details(order_id,user_id,payment_id) VALUES(544,3456,897543);

-- order_items items that are in order  history 
INSERT INTO order_items(order_id,product_id,quantity) VALUES(653,5,1);
INSERT INTO order_items(order_id,product_id,quantity) VALUES(653,6,2);
INSERT INTO order_items(order_id,product_id,quantity) VALUES(544,15,1);
INSERT INTO order_items(order_id,product_id,quantity) VALUES(544,20,1);
INSERT INTO order_items(order_id,product_id,quantity) VALUES(544,2,4);

-- user_address 
INSERT INTO user_address(user_id,address,country,city,postcode) VALUES(0123,'12 Butter Rd','Australia','Morphett Vale',5162);
INSERT INTO user_address(user_id,address,country,city,postcode) VALUES(3456,'19 Home Ave','Australia','Salisbury',5108);
INSERT INTO user_address(user_id,address,country,city,postcode) VALUES(6789,'24 Bakers Rd','Australia','Kangarilla',5157);
INSERT INTO user_address(user_id,address,country,city,postcode) VALUES(1010,'32a Pub St','Australia','Adelaide',5000);


-- update images

