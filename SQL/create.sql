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
CREATE TABLE file
(
  id      int       NOT NULL AUTO_INCREMENT,
  filename        char(50) NULL ,
  filelocation    char(50)  NULL ,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

