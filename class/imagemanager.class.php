<?php
require('../../../mainfile.php');

/**
 * 画像編集クラス
 */
class ImageManager{
	public function getUrl($id=null, $x=100, $y=100, $r=0){
		$url = XOOPS_URL."/modules/charinavi/images/loadPicture.php?";
		if($id){ $url .= "id=".$id; }
		$url .= "x=".$x."&y=".$y;
		if($r != 0){ $url .= "&r=".$r; }
		return $url;
	}
}


// D.S.G.