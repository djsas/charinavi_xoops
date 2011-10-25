<?php
require('../../../mainfile.php');
include_once(XOOPS_ROOT_PATH."/modules/charinavi/include/functions.php");
include_once(XOOPS_ROOT_PATH."/modules/charinavi/class/imagemanager.class.php");

if(isset($_POST["name"]) && isset($_POST["idname"]) && isset($_POST["rank"])){
	//必要なクラスの定義
	$im = new ImageManager();
	$myts =& MyTextSanitizer::getInstance();
	
	if(!empty($_POST["id"])){
		$id = intval($_POST["id"]);
		$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_categories"), $id);
		$res = $xoopsDB->query($sql);
		if($res){
			$row = $xoopsDB->fetchArray($res);
			$category_id = intval($row["id"]);
			$already_picture_id = intval($row["picture_id"]);
		}else{
			$category_id = false;
			$already_picture_id = false;
		}
	}
	
	//画像ファイルがアップロードされていればpictureテーブルに登録する
	if(is_uploaded_file($_FILES["picture"]["tmp_name"]) && $im->isImageType($_FILES["picture"]["type"])){
		$img = file_get_contents($_FILES["picture"]["tmp_name"]);
		$imgtype = $myts->makeTboxData4Save($_FILES["picture"]["type"]);
		if($already_picture_id){
			$im->update($already_picture_id, $img, $imgtype);
			$picture_id = $already_picture_id;
		}else{
			$picture_id = $im->insert($img, $imgtype);
		}
	}else{
		$picture_id = false;
	}
	
	$name = $myts->makeTboxData4Save($_POST["name"]);
	$idname = $myts->makeTboxData4Save($_POST["idname"]);
	$order = intval($_POST["rank"]);
	if(!empty($category_id)){
		if($picture_id){
			$sql = sprintf("UPDATE %s SET name = '%s', idname = '%s', picture_id = %s, rank = %s WHERE id = %s;",
				$xoopsDB->prefix("charinavi_categories"), $name, $idname, $picture_id, $order, $category_id);
		}else{
			$sql = sprintf("UPDATE %s SET name = '%s', idname = '%s', rank = %s WHERE id = %s;",
				$xoopsDB->prefix("charinavi_categories"), $name, $idname, $order, $category_id);
		}
	}else{
		if($picture_id){
			$sql = sprintf("INSERT INTO %s(name, idname, picture_id, rank) VALUES('%s', '%s', '%s', %s);",
				$xoopsDB->prefix("charinavi_categories"), $name, $idname, $picture_id, $order);
		}else{
			$sql = sprintf("INSERT INTO %s(name, idname, rank) VALUES('%s', '%s', %s);",
				$xoopsDB->prefix("charinavi_categories"), $name, $idname, $order);
		}
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