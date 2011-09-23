#
# ChariNavi DB
#

CREATE TABLE charinavi_activity (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	vid INT( 10 ) NOT NULL ,
	name TEXT NOT NULL ,
	description TEXT NOT NULL ,
	category_id INT( 10 ) ,
	tags TEXT ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_category (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	name TEXT NOT NULL ,
	picture_id INT( 10 ) ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_log (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	uid INT( 10 ) NOT NULL ,
	eventtype VARCHAR( 20 ) NOT NULL ,
	amount INT( 10 ) ,
	to_id INT( 10 ) ,
	time TIMESTAMP NOT NULL ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_personal (
	uid INT( 10 ) NOT NULL ,
	picture_id INT( 10 ) ,	
	amount INT( 10 ) ,
	PRIMARY KEY ( uid )
) TYPE = MYISAM ;

CREATE TABLE charinavi_pictures (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	image MEDIUMBLOB ,
	imagetype VARCHAR( 10 ) ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_tags (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	name TEXT NOT NULL ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_volunteer (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	uid INT( 10 ) NOT NULL ,
	name TEXT NOT NULL ,
	post VARCHAR( 10 ) NOT NULL ,
	address TEXT NOT NULL ,
	phone VARCHAR( 15 ) NOT NULL ,
	fax VARCHAR( 15 ) NOT NULL ,
	description TEXT NOT NULL ,	
	PRIMARY KEY ( id )
) TYPE = MYISAM ;
