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
CREATE TABLE notes
(
  id      int       NOT NULL AUTO_INCREMENT,
  timestamp       int NULL ,
  note    char(200)  NULL ,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

