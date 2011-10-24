<?php
require('../../../mainfile.php');
include_once(XOOPS_ROOT_PATH."/modules/charinavi/include/functions.php");
include_once(XOOPS_ROOT_PATH."/modules/charinavi/class/imagemanager.class.php");

if(isset($_POST["name"]) && isset($_POST["idname"]) && isset($_POST["order"])){
	//必要なクラスの定義
	$im = new ImageManager();
	$myts =& MyTextSanitizer::getInstance();
	
	//画像ファイルがアップロードされていればpictureテーブルに登録する
	if(is_uploaded_file($_FILES["picture"]["tmp_name"]) && $im->isImageType($_FILES["picture"]["type"])){
		$img = file_get_contents($_FILES["picture"]["tmp_name"]);
		$imgtype = $myts->makeTboxData4Save($_FILES["picture"]["type"]);
		$picture_id = $im->insert($img, $imgtype);
	}else{
		$picture_id = false;
	}
	
	$name = $myts->makeTboxData4Save($_POST["name"]);
	$idname = $myts->makeTboxData4Save($_POST["idname"]);
	$order = intval($_POST["order"]);
	if($picture_id){
		$sql = sprintf("INSERT INTO %s(name, idname, picture_id, rank) VALUES('%s', '%s', '%s', %s);",
			$xoopsDB->prefix("charinavi_categories"), $name, $idname, $picture_id, $order);
	}else{
		$sql = sprintf("INSERT INTO %s(name, idname, rank) VALUES('%s', '%s', %s);",
			$xoopsDB->prefix("charinavi_categories"), $name, $idname, $order);
	}
	$res = $xoopsDB->queryF($sql);
	if($res){
		redirect_header(XOOPS_URL."/modules/charinavi/admin/category.php", 2, _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_COMPLETED);
	}else{
		occurError(111, _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_INCOMPLETED);
	}
}else{
	occurError(110, _MD_CHARINAVI_ADMIN_CATEGORIES_MSG_INCOMPLETED);
}


// D.S.G.