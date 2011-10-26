#
# ChariNavi DB
#

CREATE TABLE charinavi_activities (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	vid INT( 10 ) NOT NULL ,
	name TEXT NOT NULL ,
	description TEXT NOT NULL ,
	category_id INT( 10 ) ,
	tags TEXT ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_activity_review (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	activity_id INT( 10 ) NOT NULL ,
	uid INT( 10 ) NOT NULL ,
	title TEXT ,
	review TEXT NOT NULL ,
	star TINYINT( 1 ) DEFAULT '0' NOT NULL ,
	created_date TIMESTAMP NOT NULL ,
	modified_date TIMESTAMP NOT NULL ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_categories (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	name TEXT NOT NULL ,
	idname VARCHAR( 50 ) NOT NULL ,
 	picture_id INT( 10 ) ,
	rank INT( 10 ) DEFAULT '0' NOT NULL ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_error (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	uid INT( 10 ) NOT NULL ,
	code INT( 10 ) NOT NULL ,
	url TEXT NOT NULL ,
	datetime TIMESTAMP ,
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

CREATE TABLE charinavi_transcheck (
	transid TEXT,
	posted TIMESTAMP
);

CREATE TABLE charinavi_volunteers (
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
