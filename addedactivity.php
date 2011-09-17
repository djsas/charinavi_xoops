<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	print_r($_POST);
	//空でないか確認
	if(empty($_POST["name"]) || empty($_POST["description"])){
		print _MD_CHARINAVI_FORMINPUT_ERROR;
	}else{
		$myts =& MyTextSanitizer::getInstance();
		$name = $myts->makeTareaData4Save($_POST["name"]);
		$description = 
	}
}

include(XOOPS_ROOT_PATH.'/footer.php');

// D.S.G.