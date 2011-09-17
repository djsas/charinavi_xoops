<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	global $xoopsDB, $xoopsUser;
	
	$uid = $xoopsUser->uid();
	$myts =& MyTextSanitizer::getInstance();

	//入力内容をDBに保存	
	$name = $myts->makeTareaData4Save($_POST["name"]);
	$post = $myts->makeTboxData4Save($_POST["post"]);
	$address = $myts->makeTareaData4Save($_POST["address"]);
	$phone = $myts->makeTboxData4Save($_POST["phone"]);
	$fax = $myts->makeTboxData4Save($_POST["fax"]);
	$description = $myts->makeTareaData4Save($_POST["description"]);
	$sql = sprintf("INSERT INTO %s(uid, name, post, address, phone, fax, description) VALUES(%s, '%s', '%s', '%s', '%s', '%s', '%s');",
		$xoopsDB->prefix("charinavi_volunteer"), $uid, $name, $post, $address, $phone, $fax, $description);
	$res = $xoopsDB->query($sql);
	if($res){
		//ボランティア団体のグループに追加
		$sql = "SELECT groupid FROM ".$xoopsDB->prefix("groups")." WHERE name = 'volunteer';";
		$res = $xoopsDB->query($sql);
		$row = $xoopsDB->fetchArray($res);
		$gid = $row["groupid"];
		addUserToXoopsGroup($gid, $uid);
		print _MD_CHARINAVI_MSG_REGISTERED;
	}else{
		print _MD_CHARINAVI_REGISTERED_ERROR;
	}	
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
