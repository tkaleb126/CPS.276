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
CREATE TABLE user
(
  id      int       NOT NULL AUTO_INCREMENT,
  firstname char(200) NULL,
  lastname    char(200)  NULL ,
  email    char(200)  NULL ,
  password    char(200)  NULL ,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

<label for="password2">Confirm Password</label>
    <input type="text" class="form-control" id="password2" name="password2" value="Pass$or1">