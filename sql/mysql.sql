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

CREATE TABLE charinavi_credit_types (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	credit_type VARCHAR( 255 ) NOT NULL ,
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

CREATE TABLE charinavi_municipalities (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	municipality VARCHAR( 255 ) NOT NULL ,
	prefecture_id INT( 10 ) NOT NULL ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_personal (
	uid INT( 10 ) NOT NULL ,
	picture_id INT( 10 ) ,	
	amount INT( 10 ) ,
	PRIMARY KEY ( uid )
) TYPE = MYISAM ;

CREATE TABLE charinavi_personalities (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	personality VARCHAR( 255 ) NOT NULL ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_pictures (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	image MEDIUMBLOB ,
	imagetype VARCHAR( 10 ) ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_prefectures (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	prefecture VARCHAR( 255 ) NOT NULL ,
	lat FLOAT NOT NULL ,
	lng FLOAT NOT NULL ,
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
	name_yomi TEXT NOT NULL ,
	post VARCHAR( 10 ) NOT NULL ,
	prefecture_id INT( 10 ) NOT NULL ,
	municipality_id INT( 10 ) NOT NULL ,
	address TEXT NOT NULL ,
	logo_id INT( 10 ) NOT NULL ,
	homepage TEXT ,
	blog TEXT ,
	facebook TEXT ,
	personality_id INT( 10 ) NOT NULL ,
	open_name TEXT ,
	open_phone VARCHAR( 15 ) NOT NULL ,
	open_fax VARCHAR( 15 ) NOT NULL ,
	open_mail VARCHAR( 255 ) NOT NULL ,
	close_name TEXT ,
	close_phone VARCHAR( 15 ) NOT NULL ,
	close_fax VARCHAR( 15 ) NOT NULL ,
	close_mail VARCHAR( 255 ) NOT NULL ,
	num_staffs INT( 10 ) NOT NULL ,
	num_volunteers INT( 10 ) NOT NULL ,
	description TEXT NOT NULL ,	
	statutory TEXT NOT NULL ,
	category_id INT( 10 ) NOT NULL ,
	authorized TINYINT( 1 ) DEFAULT '0' NOT NULL ,
	last_modified TIMESTAMP NOT NULL ,
	accountant_name TEXT ,
	accountant_phone VARCHAR( 15 ) NOT NULL ,
	accountant_fax VARCHAR( 15 ) NOT NULL ,
	accountant_mail VARCHAR( 255 ) NOT NULL ,
	credit_bank VARCHAR( 255 ) ,
	credit_branch VARCHAR( 255 ) ,
	credit_type_id INT( 10 ) ,
	credit_number VARCHAR( 20 ) ,
	credit_name VARCHAR( 255 ) ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;
