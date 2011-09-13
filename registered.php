<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	global $xoopsDB, $xoopsUser;
	
	//入力内容をDBに保存
	
	//ボランティア団体のグループに追加
	$uid = $xoopsUser->uid();
	$sql = "SELECT groupid FROM ".$xoopsDB->prefix("groups")." WHERE name = 'volunteer';";
	$res = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($res);
	$gid = $row["groupid"];
	addUserToXoopsGroup($gid, $uid);
	
	print _MD_CHARINAVI_MSG_REGISTERED;
}

include(XOOPS_ROOT_PATH.'/footer.php');

/**
 * add user to xoops group
 *
 * @access public
 * @param int $gid group id
 * @param int $uid user id
 * @return bool false if failure
 */
function addUserToXoopsGroup( $gid, $uid ) {
	$member_handler =& xoops_gethandler('member');
	if ( ! $member_handler->addUserToGroup( $gid, $uid ) ) {
		return false;
	}
	$myuid = $GLOBALS['xoopsUser']->getVar( 'uid', 'n' );
	if ( $myuid == $uid ) {
		// update group cache and session
		$mygroups = $member_handler->getGroupsByUser( $uid );
		$GLOBALS['xoopsUser']->setGroups( $mygroups );
		if ( isset( $_SESSION['xoopsUserGroups'] ) ) {
			$_SESSION['xoopsUserGroups'] = $mygroups;
		}
	}
	return true;
}
