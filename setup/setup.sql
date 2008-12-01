DROP DATABASE IF EXISTS rpinventory;
CREATE DATABASE rpinventory;
USE rpinventory;

CREATE TABLE inventory (
       inventory_id int(5) NOT NULL auto_increment,
       description varchar(250) NOT NULL,
       location_id int(5) NOT NULL,
       current_condition varchar(100) NOT NULL,
       current_value decimal(6,2) NOT NULL,
       PRIMARY KEY (inventory_id)
) type = MyISAM;


CREATE TABLE locations (
       location_id int(5) NOT NULL auto_increment,
       location varchar(30) NOT NULL,
       description varchar(250),
       PRIMARY KEY (location_id)
) type = MyISAM;

CREATE TABLE purchases (
       purchase_id int(5) NOT NULL auto_increment,
       business_id int(5) NOT NULL,
       purchase_date date NOT NULL,
       total_price decimal(7,2) NOT NULL,
       PRIMARY KEY (purchase_id)
) type = MyISAM;

CREATE TABLE purchase_items (
       purchase_id int(5) NOT NULL,
       inventory_id int(5) NOT NULL,
       cost decimal(6,2) NOT NULL,
       PRIMARY KEY  (purchase_id, inventory_id)
) type = MyISAM;

CREATE TABLE repairs (
       repair_id int(5) NOT NULL auto_increment,
       inventory_id int(5) NOT NULL,
       business_id int(5) NOT NULL,
       repair_date date NOT NULL,
       repair_cost decimal(6,2) NOT NULL,
       description varchar(250),
       PRIMARY KEY (repair_id)
) type = MyISAM;

CREATE TABLE businesses (
       business_id int(5) NOT NULL auto_increment,
       address_id int(5) NOT NULL,
       company_name varchar(50) NOT NULL,
       fax varchar(20),
       email varchar(100),
       website varchar(200),
       PRIMARY KEY (business_id)
) type = MyISAM;

CREATE TABLE loans (
       loan_id int(5) NOT NULL auto_increment,
       inventory_id int(5) NOT NULL,
       borrower_id int(5) NOT NULL,
       issue_date date NOT NULL,
       return_date date,
       starting_condition varchar(100),
       PRIMARY KEY (loan_id)
) type = MyISAM;

CREATE TABLE borrower_addresses (
       user_id int(5) NOT NULL,
       address_id int(5) NOT NULL,
       PRIMARY KEY (user_id, address_id)
) type = MyISAM;

CREATE TABLE addresses (
       address_id int(5) NOT NULL auto_increment,
       address varchar(100),
       address2 varchar(200),
       city varchar(50),
       state varchar(20),
       zipcode varchar(10),
       phone varchar(20),
       PRIMARY KEY (address_id)
) type = MyISAM;

CREATE TABLE logins (
       id int(5) NOT NULL auto_increment,
       username varchar(50) NOT NULL,
       password varchar(32) NOT NULL,
       access_level int(1) NOT NULL,
       rin char(9) NOT NULL,
       email varchar(100) NOT NULL,
       name varchar(100) NOT NULL,
       PRIMARY KEY (id)
) type = MyISAM;
