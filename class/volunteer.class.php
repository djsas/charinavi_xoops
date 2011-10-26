<?php
/** 
 *  cmd:    php [this]
 *  create: 2011/10/26 10:54:13
 *  import: 
 *  input:  
 *  output: 
 *  description: ボランティアユーザ管理クラス
 */

class Volunteer{
	function __construct(){
	}
	/**
	 * 所属するボランティア団体のIDを取得する。
	 * @return int ボランティア団体ID。
	 */
	function getId(){
		global $xoopsDB;
		$sql = sprintf("SELECT * FROM %s WHERE uid = '%s';", $xoopsDB->prefix("charinavi_volunteers"), $this->uid);
		$res = $xoopsDB->query($sql);
		while($row = $xoopsDB->fetchArray($res)){
			return $row["id"];
		}
		return false;	
	}
	/**
	 * ボランティアユーザか否かを返す
	 * @param int $uid 確認対象のユーザID
	 * @return bool
	 */
	public function isVolunteer($uid){
		global $xoopsDB;
		
		//volunteerグループのグループIDを取得する
		$sql = "SELECT * FROM ".$xoopsDB->prefix("groups")." WHERE name = 'volunteer';";
		$res = $xoopsDB->query($sql);
		$row = $xoopsDB->fetchArray($res);
		$gid = $row["groupid"];
		
		//volunteerグループに所属しているか確認する
		$sql = "SELECT * FROM ".$xoopsDB->prefix("groups_users_link")." WHERE groupid = ".$gid." AND uid = ".$uid.";";
		$res = $xoopsDB->query($sql);
		while($row = $xoopsDB->fetchArray($res)){
			return true;
		}
		return false;
	}
	/**
	 * ボランティアユーザのみ，そのページへのアクセスを許す
	 * @return void
	 */
	public function restrict(){
		global $xoopsUser;
		$flag = false;
		if(is_object($xoopsUser) && $this->isVolunteer($xoopsUser->uid())){
			return true;
		}
		redirect_header(XOOPS_URL, 2, _MD_CHARINAVI_ACCESS_ERROR);
		return false;
	}
	/**
	 * ユーザIDをセットする
	 * @params int $uid ユーザID
	 * @return void
	 */
	public function setUid($uid){
		$this->uid = $uid;
	}
}

// D.S.G.