<?php
require('../../../mainfile.php');

/**
 * 画像編集クラス
 */
class ImageEditor{
	private $image, $type;
	
	function __construct(){
		$this->image = imagecreatefromjpeg(XOOPS_ROOT_PATH."/modules/charinavi/images/noimage.jpg");
		$this->type = "image/jpeg";
	}
	public function import($str, $type){
		$this->image = imagecreatefromstring($str);
		$this->type = $type;
	}
	public function resize($x, $y){
		$src_w = imagesx($this->image);
		$src_h = imagesy($this->image);
		$dst_w = $x;
		$dst_h = $y;
		if($src_w > $src_h){  // 横長画像の場合
			$dst_h = $src_h * ($dst_w / $src_w);
		}else{  // 縦長画像の場合
			$dst_w = $src_w * ($dst_h / $src_h);
		}
		$dst_image = imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresampled($dst_image,$this->image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
		$this->image = $dst_image;
	}
	public function rotate($angle, $bgcolor){
		$this->image = ImageRotate($this->image, $angle, hexdec($bgcolor));
	}
	public function sanitize($v){
		return intval($v) > 0 ? intval($v) : 100;
	}
	public function show(){
		header('Content-Type: '.$this->type);
		if($this->type == "image/jpeg"){
			imagejpeg($this->image, "", 100);
		}else if($this->type == "image/png"){
			imagepng($this->image, "", 100);
		}

	}
}


// D.S.G.