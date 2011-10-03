<?php
require('../../../mainfile.php');

/**
 * 画像編集クラス
 */
class ImageManager{
	/**
	 * 指定したIDの画像情報を削除する
	 * @param int $id 画像のID
	 * @return void
	 */
	public function delete($id){
		global $xoopsDB;
		$sql = sprintf("DELETE FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_pictures"), $id);
		$xoopsDB->query($sql);
	}
	/**
	 * 指定した画像を取得するためのURLを得る
	 * @param int $id 画像のID
	 * @param int $x 画像の横幅サイズ
	 * @param int $y 画像の縦幅サイズ
	 * @param int $r 回転の度合い
	 * @return string 画像取得のURL
	 */
	public function getUrl($id=null, $x=100, $y=100, $r=0){
		$url = XOOPS_URL."/modules/charinavi/images/loadPicture.php?";
		if($id){ $url .= "id=".$id; }
		$url .= "x=".$x."&y=".$y;
		if($r != 0){ $url .= "&r=".$r; }
		return $url;
	}
	/**
	 * 新規IDを発行する形で画像情報を追加する
	 * @param int binary $img 画像のバイナリデータ
	 * @param string $type 画像のファイルタイプ
	 * @return int 新規発行された画像ID
	 */
	public function insert($img, $type){
		global $xoopsDB;
		$myts =& MyTextSanitizer::getInstance();
		$img = mysql_real_escape_string($img);
		$type = $myts->makeTboxData4Save($type);
		$sql = sprintf("INSERT INTO %s(image, imagetype) VALUES(BINARY '%s', '%s');", $xoopsDB->prefix("charinavi_pictures"), $img, $type);
		$res = $xoopsDB->query($sql) or die(getErrorMsg(_MD_CHARINAVI_ERROR_401, 401));
		return $res;
	}
	/**
	 * 指定したIDの画像情報を更新する
	 * @param int $id 更新したい画像のID
	 * @param binary $img 画像のバイナリデータ
	 * @param string $type 画像のファイルタイプ
	 * @return void
	 */
	public function update($id, $img, $type){
		global $xoopsDB;
		$myts =& MyTextSanitizer::getInstance();
		$img = mysql_real_escape_string($img);
		$type = $myts->makeTboxData4Save($type);
		$sql = sprintf("UPDATE %s SET image = BINARY '%s', imagetype = '%s' WHERE id = %s;", $xoopsDB->prefix("charinavi_pictures"), $img, $type, $id);
		$xoopsDB->query($sql);
	}
}


// D.S.G.