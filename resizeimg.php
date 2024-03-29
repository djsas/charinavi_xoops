<?php
require('../../mainfile.php');
require(XOOPS_ROOT_PATH.'/modules/charinavi/class/imageeditor.class.php');

if(isset($_GET["id"])){
	$id = intval($_GET["id"]);
	$editor = new ImageEditor();
	$x = isset($_GET["x"]) ? $editor->sanitize($_GET["x"]) : 100;
	$y = isset($_GET["y"]) ? $editor->sanitize($_GET["y"]) : 100;

	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_category"), $id);
	$res = $xoopsDB->query($sql);
	$myts =& MyTextSanitizer::getInstance();
	while($row = $xoopsDB->fetchArray($res)){
		$type = $myts->makeTboxData4Show($row["imagetype"]);
		$editor->import($row["image"], $type);
		
		$editor->resize($x, $y);
		$editor->show();
	}
}





// D.S.G.