<?php
/**
 * 個人情報管理クラス
 */
class PersonalManager{
	private $amount;  //ポイント残高
	private $picture_id;  //画像ID
	private $table;
	private $uid;  //管理対象となるユーザID
	/**
	 * コンストラクタ
	 */
	function __construct(){
		global $xoopsDB, $xoopsUser;
		$this->table = $xoopsDB->prefix("charinavi_personal");
		if(is_object($xoopsUser)){
			$this->uid = $xoopsUser->uid();
			$this->getPersonal();  //uidの定義が先になることに注意
		}else{
			$this->picture_id = false;
			$this->uid = false;
		}
	}
	/**
	 * 個人情報をDBから取得します．
	 * @return void
	 */
	private function getPersonal(){
		global $xoopsDB;
		$sql = sprintf("SELECT * FROM %s WHERE uid = %s;", $this->table, $this->uid);
		$res = $xoopsDB->query($sql);
		while($row = $xoopsDB->fetchArray($res)){
			$this->amount = intval($row["amount"]);
			$this->picture_id = intval($row["picture_id"]);
		}
	}
	/**
	 * 画像IDを返します．
	 * @return id 画像ID
	 */
	public function getPictureId(){
		return $this->picture_id;
	}
	/**
	 * ログインしているか否かを返します．
	 * @return bool ログインしていればtrue，していなければfalseを返します．
	 */
	public function isLogin(){
		return $this->uid === false ? false : true ;
	}
}


// D.S.G.