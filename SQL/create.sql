########################################
# MySQL Crash Course
# http://www.forta.com/books/0672327120/
# Example table creation scripts
########################################

#CREATE DATABASE IF NOT EXISTS sampledata;

#USE sampledata;


########################
# Create customer table
########################
CREATE TABLE `contacts`
(
  id      int       NOT NULL AUTO_INCREMENT,
  fname char(200) NULL,
  lname    char(200)  NULL ,
  address    char(200)  NULL ,
  city    char(200)  NULL ,
  state    char(200)  NULL ,
  phone    char(200)  NULL ,
  email    char(200)  NULL ,
  dob    char(200)  NULL ,
  contacts    char(200)  NULL ,
  age    char(200)  NULL ,
  
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE `admins`
(
  id      int       NOT NULL AUTO_INCREMENT,
  name char(200) NULL,
  email    char(200)  NULL ,
  password    char(200)  NULL ,
  status    char(200)  NULL ,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (name, email, password, status) VALUES ('Kaleb Tomanovich Admin', 'admin@gmail.com', "admin123", 'admin'),('Kaleb Tomanovich staff', 'staff@gmail.com', "staff123", 'staff');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

