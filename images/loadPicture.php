<?php
require('../../../mainfile.php');
require(XOOPS_ROOT_PATH.'/modules/charinavi/class/imageeditor.class.php');

$x = isset($_GET["x"]) && intval($_GET["x"]) > 0 ? intval($_GET["x"]) : 100 ;
$y = isset($_GET["y"]) && intval($_GET["y"]) > 0 ? intval($_GET["y"]) : 100 ;
$r = isset($_GET["r"]) ? floatval($_GET["r"]) : 0 ;

$editor = new ImageEditor();

if(isset($_GET["id"])){
	$id = intval($_GET["id"]);
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_pictures"), $id);
	$res = $xoopsDB->query($sql);
	$myts =& MyTextSanitizer::getInstance();
	while($row = $xoopsDB->fetchArray($res)){
		$type = $myts->makeTboxData4Show($row["imagetype"]);
		$editor->import($row["image"], $type);
	}
}

//先にリサイズ。回転を先にすると縦横サイズが崩れてエラーとなる
$editor->resize($x, $y);
if($r != 0){
	$editor->rotate($r, "ffffff");
}
$editor->show();




// D.S.G.