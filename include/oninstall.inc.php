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
