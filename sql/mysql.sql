#
# ChariNavi DB
#

CREATE TABLE charinavi_log (
	id INT( 10 ) NOT NULL AUTO_INCREMENT ,
	uid INT( 10 ) NOT NULL ,
	eventtype VARCHAR( 20 ) NOT NULL ,
	amount INT( 10 ) ,
	to_uid INT( 10 ) ,
	time TIMESTAMP NOT NULL ,
	PRIMARY KEY ( id )
) TYPE = MYISAM ;

CREATE TABLE charinavi_personal (
	uid INT( 10 ) NOT NULL ,
	amount INT( 10 ) ,
	PRIMARY KEY ( uid )
) TYPE = MYISAM ;

