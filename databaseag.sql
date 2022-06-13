CREATE DATABASE IF NOT EXISTS api_rest_laravel_ag;
USE api_rest_laravel_ag;

CREATE TABLE users(
    id  int(255) auto_increment not null,
    name    varchar(200) NOT NULL,  
    surname varchar(200) NOT NULL,
    email   varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    created_at  datetime DEFAULT NULL,  
    update_at   datetime DEFAULT NULL,
    remember_token  varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE categories(
    id  int(255) auto_increment NOT NULL,
    name varchar(255) NOT NULL,
    CONSTRAINT pk_categories PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE  typefeatures(
    id int(255) auto_increment NOT NULL,
    name varchar(100) NOT NULL,

    CONSTRAINT pk_typeFeatures PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE features(
    id int(255) auto_increment NOT NULL,
    typeFeature_id int(255),
    name varchar(255) NOT NULL,
    description text,
    CONSTRAINT pk_features PRIMARY KEY(id),
    CONSTRAINT fk_feature_typeFeature FOREIGN KEY(typeFeature_id) REFERENCES typeFeatures(id)
)ENGINE=InnoDb;

CREATE TABLE sizes(
    id int(255) auto_increment NOT NULL,
    size varchar(100) NOT NULL,
    CONSTRAINT pk_sizes PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE admins(
    id int(255) auto_increment NOT NULL,
    name varchar(255)   NOT NULL,
    mail varchar(255)   NOT NULL,
    password    varchar(255) NOT NULL,

    CONSTRAINT pk_admin PRIMARY KEY(id)

)ENGINE=InnoDb;

CREATE TABLE products(
    id  int(255) auto_increment NOT NULL,
    name    varchar(250) NOT NULL,
    price   varchar(250) NOT NULL,
    image varchar(255),
    category_id  int(255),
    admin_id int(255),
    created_at  datetime DEFAULT NULL,
    update_at   datetime DEFAULT NULL,
    remember_token  varchar(255),

    CONSTRAINT pk_products PRIMARY KEY(id),
    CONSTRAINT fk_product_category_id FOREIGN KEY(category_id) references categories(id),
    CONSTRAINT fk_product_admin_id FOREIGN KEY(admin_id) references admin(id)

)ENGINE=InnoDb;

CREATE TABLE stocks(
    id int(255) auto_increment NOT NULL,
    product_id  int(255) NOT NULL,
    size_id     int(255) NOT NULL,
    quantity    int(255),

    CONSTRAINT pk_stocks PRIMARY KEY(id),
    CONSTRAINT fk_stock_producto_id FOREIGN KEY(product_id) references products(id),
    CONSTRAINT fk_stock_size_id FOREIGN KEY(size_id) references sizes(id)
)ENGINE=InnoDb;

CREATE TABLE ccs(
    id int(255) auto_increment NOT NULL,
    product_id int(255) NOT NULL,
    typeFeature_id int(255) NOT NULL,
    feature_id int(255) NOT NULL,

    CONSTRAINT pk_ccs PRIMARY KEY(id),
    CONSTRAINT fk_cc_product_id FOREIGN KEY (product_id) references products(id),
    CONSTRAINT fk_cc_typeFeature_id FOREIGN KEY(typeFeature_id) references typeFeatures(id),
    CONSTRAINT fk_cc_feature_id FOREIGN KEY(feature_id) references features(id)

)ENGINE=InnoDb;
