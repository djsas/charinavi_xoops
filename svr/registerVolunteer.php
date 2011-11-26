<?php
// 
// create: 2011/11/26 09:47:53
// usage: php [this]
// Copyright (C)
//   2011 dj_satoru
// License: GPL v2 or (at your option) any later version
//
// ボランティア団体の情報を登録する

require('../../../mainfile.php');
print_r($_POST);

$myts =& MyTextSanitizer::getInstance();



$name = $myts->makeTboxData4Save($_POST["name"]);
$name_yomi = $myts->makeTboxData4Save($_POST["name_yomi"]);
$personality_id = intval($_POST["personality_id"]);
$uname = $myts->makeTboxData4Save($_POST["uname"]);
$password = = $myts->makeTboxData4Save($_SESSION["password"]);
$post = $myts->makeTboxData4Save($_POST["post"]);
$prefecture_id = intval($_POST["prefecture_id"]);
$municipality_id = intval($_POST["municipality_id"]);
$address = $myts->makeTboxData4Save($_POST["address"]);
$open_name = $myts->makeTboxData4Save($_POST["open_name"]);
$open_phone = $myts->makeTboxData4Save($_POST["open_phone"]);
$open_fax = $myts->makeTboxData4Save($_POST["open_fax"]);
$open_mail = $myts->makeTboxData4Save($_POST["open_mail"]);
$close_name = $myts->makeTboxData4Save($_POST["close_name"]);
$close_phone = $myts->makeTboxData4Save($_POST["close_phone"]);
$close_fax = $myts->makeTboxData4Save($_POST["close_fax"]);
$close_mail = $myts->makeTboxData4Save($_POST["close_mail"]);
$num_staffs = intval($_POST["num_staffs"]);
$num_volunteers = intval($_POST["num_volunteers"]);
//memo: ここでロゴを保存可能にする
$homepage = $myts->makeTboxData4Save($_POST["homepage"]);
$blog = $myts->makeTboxData4Save($_POST["blog"]);
$facebook = $myts->makeTboxData4Save($_POST["facebook"]);
$description = $myts->makeTareaData4Save($_POST["description"]);
$statutory = $myts->makeTareaData4Save($_POST["statutory"]);
$category_id = intval($_POST["category_id"]);
$last_modified = date("Y-m-d H:i:s");

$sql = sprintf("INSERT INTO %s(name, name_yomi, post, prefecture_id, municipality_id, address, homepage, blog, facebook, personality_id, open_name, open_phone, open_fax, open_mail, close_name, close_phone, close_fax, close_mail, num_staffs, num_volunteers, description, statutory, category_id, authorized, last_modified) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 0, '%s');",
	$xoopsDB->prefix("charinavi_volunteers"), $name, $name_yomi, $post, $prefecture_id, $municipality_id, $address, $homepage, $blog, $facebook, $personality_id, $open_name, $open_phone, $open_fax, $open_mail, $close_name, $close_phone, $close_fax, $close_mail, $num_staffs, $num_volunteers, $description, $statutory, $category_id, $last_modified);
//$res = $xoopsDB->query($sql);

//== XOOPSアカウントの登録 ==
$sql = sprintf("INSERT INTO %s(name, uname, email, url, user_avatar, user_regdate, user_icq, user_from, user_sig, user_viewemail, actkey, user_aim, user_yim, user_msnm, pass, posts, attachsig, rank, level, theme, timezone_offset, last_login, umode, uorder, notify_method, notify_mode, user_occ, bio, user_intrest, user_mailok) VALUES('', '%s', '%s', '', 'blank.gif', %s, '', '', '', 0, '', '', '', '',  
	$xoopsDB->prefix("users"), $uname, $close_mail, time(), 
//$sql = sprintf("INSERT INTO %s(groupid, uid)


// S.D.G.