<?php
if ( ! defined( 'XOOPS_ROOT_PATH' ) ) {
  exit();
}

/**
 * charinavi install function
 *
 * @param object $xoopsMod module instance
 * @return bool false if failure
 */
function xoops_module_install_charinavi( $xoopsMod ) {
	// create and join volunteer group
	$mgid = createGroup( 'volunteer', "a volunteer organization" );
	if ( $mgid === false ) {
		return false;
	}
	
	insertDatas();
	
	return true;  //complete the installation
}

/**
 * create xoops group
 *
 * @access public
 * @param string $name group name
 * @param string $description group description
 * @return int created group id
 */
function createGroup( $name, $description ) {
	$member_handler =& xoops_gethandler( 'member' );
	$group =& $member_handler->createGroup();
	$group->setVar( 'name', $name, true ); // not gpc
	$group->setVar( 'description', $description, true ); // not gpc
	$ret = $member_handler->insertGroup( $group );
	if ( $ret == false ) {
		return false;
	}
	$gid = $group->getVar( 'groupid', 'n' );
	return $gid;
}

/**
 * insert datas into tables
 */
function insertDatas(){
	global $xoopsDB;
	$table = $xoopsDB->prefix("charinavi_credit_types");
	$sql = "INSERT INTO $table('credit_type') VALUES ('ÉáÄÌ')";
	$res = $xoopsDB->query($sql);
	$sql = "INSERT INTO $table('credit_type') VALUES ('ÅöºÂ')";
	$res = $xoopsDB->query($sql);
	
	$table = $xoopsDB->prefix("charinavi_prefectures");
	include(XOOPS_ROOT_PATH."/modules/charinavi/include/prefectures.php");
	$prefecture_ids = array();
	foreach($prefectures as $p){
		$sql = sprintf("INSERT INTO %s(prefecture, lat, lng) VALUES('%s', %s, %s);", $table, $p[0], $p[1], $p[2]);
		$res = $xoopsDB->queryF($sql);
		$prefecture_ids[$p[0]] = $xoopsDB->getInsertId();
	}

	$table = $xoopsDB->prefix("charinavi_municipalities");
	include(XOOPS_ROOT_PATH."/modules/charinavi/include/municipalities.php");
	foreach($municipalities as $m){
		$sql = sprintf("INSERT INTO %s(municipality, prefecture_id) VALUES('%s', %s);", $table, $m[1], $prefecture_ids[$m[0]]);
		$res = $xoopsDB->queryF($sql);
	}
}