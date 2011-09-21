<?php
require('../../../mainfile.php');
require(XOOPS_ROOT_PATH.'/modules/charinavi/class/imageeditor.class.php');

$editor = new ImageEditor();
$x = $y = 150;

if(isset($_GET["id"])){
	$id = intval($_GET["id"]);
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_category"), $id);
	$res = $xoopsDB->query($sql);
	$myts =& MyTextSanitizer::getInstance();
	while($row = $xoopsDB->fetchArray($res)){
		$type = $myts->makeTboxData4Show($row["imagetype"]);
		$editor->import($row["image"], $type);
	}
}
$editor->rotate(25, "ffffff");
$editor->resize($x, $y);
$editor->show();




// D.S.G.