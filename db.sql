CREATE TABLE product (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ref INT UNSIGNED,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    description TEXT(650000),
    brand VARCHAR(255) NOT NULL,
    category VARCHAR(255),
    supplier VARCHAR(255),
    quantity INT UNSIGNED,
    a_quantity INT UNSIGNED NOT NULL,
    purchase_price FLOAT UNSIGNED,
    retail_price FLOAT UNSIGNED,
    wholesale_price FLOAT UNSIGNED,
    validity_date VARCHAR(255),
    reg_temp INT UNSIGNED,
    PRIMARY KEY (id)
)

CREATE TABLE category (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE reception (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    product_ref VARCHAR (90) NOT NULL,
    supplier VARCHAR(255),
    purchase_price INT UNSIGNED,
    quantity INT UNSIGNED NOT NULL,
    details VARCHAR(255),
    r_date DATETIME NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE sale (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    destination VARCHAR(255) NOT NULL,
    product_ref VARCHAR (90) NOT NULL,
    retail_price INT UNSIGNED,
    wholesale_price INT UNSIGNED,
    type VARCHAR(255) NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    s_date DATETIME NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE user (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR (255) NOT NULL,
    password VARCHAT (255) NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE admin (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    admin VARCHAR (255) NOT NULL,
    password VARCHAR (255) NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE costumer (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR (255) NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE supplier (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    supplier VARCHAR (255) NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE edition (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    property VARCHAR (255) NOT NULL,
    details TEXT (650000) NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE p_history (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ref VARCHAR (255) NOT NULL,
    action VARCHAR (255) NOT NULL,
    changes VARCHAR (255),
    date VARCHAR (255) NOT NULL,
    user VARCHAR (255) NOT NULL,
    PRIMARY KEY (id)
)





