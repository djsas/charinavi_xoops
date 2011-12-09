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
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');

$myts =& MyTextSanitizer::getInstance();



$name = $myts->makeTboxData4Save($_POST["name"]);
$name_yomi = $myts->makeTboxData4Save($_POST["name_yomi"]);
$personality_id = intval($_POST["personality_id"]);
$uname = $myts->makeTboxData4Save($_POST["uname"]);
$password = $myts->makeTboxData4Save($_SESSION["password"]);
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
$logo_id = intval($_POST["logo"]);
$homepage = $myts->makeTboxData4Save($_POST["homepage"]);
$blog = $myts->makeTboxData4Save($_POST["blog"]);
$facebook = $myts->makeTboxData4Save($_POST["facebook"]);
$description = $myts->makeTareaData4Save($_POST["description"]);
$statutory = $myts->makeTareaData4Save($_POST["statutory"]);
$category_id = intval($_POST["category_id"]);
$last_modified = date("Y-m-d H:i:s");

$sql = sprintf("INSERT INTO %s(name, name_yomi, post, prefecture_id, municipality_id, address, logo_id, homepage, blog, facebook, personality_id, open_name, open_phone, open_fax, open_mail, close_name, close_phone, close_fax, close_mail, num_staffs, num_volunteers, description, statutory, category_id, authorized, last_modified) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 0, '%s');",
	$xoopsDB->prefix("charinavi_volunteers"), $name, $name_yomi, $post, $prefecture_id, $municipality_id, $address, $logo_id, $homepage, $blog, $facebook, $personality_id, $open_name, $open_phone, $open_fax, $open_mail, $close_name, $close_phone, $close_fax, $close_mail, $num_staffs, $num_volunteers, $description, $statutory, $category_id, $last_modified);
//$res = $xoopsDB->query($sql);

//== XOOPSアカウントの登録 ==
$time = time();
$actkey = substr(md5(uniqid(mt_rand(),1)),0,8);
$sql = sprintf("INSERT INTO %s(name, uname, email, url, user_avatar, user_regdate, user_icq, user_from, user_sig, user_viewemail, actkey, user_aim, user_yim, user_msnm, pass, posts, attachsig, rank, level, theme, timezone_offset, last_login, umode, uorder, notify_method, notify_mode, user_occ, bio, user_intrest, user_mailok) VALUES('', '%s', '%s', '', 'blank.gif', %s, '', '', '', 0, '%s', '', '', '',  '%s', 0, 0, 0, 0, '', 9.0, 0, 'nest', 0, 1, 0, '', '', '', 0);",
	$xoopsDB->prefix("users"), $uname, $close_mail, $time, $actkey, md5($password));
$res = $xoopsDB->query($sql);

//== ユーザIDの取得 ==
$sql = sprintf("SELECT * FROM %s WHERE uname = '%s' AND email = '%s' AND user_regdate = %s AND actkey = '%s' AND pass = '%s';",
	$xoopsDB->prefix("users"), $uname, $close_mail, $time, $actkey, md5($password));
$res = $xoopsDB->query($sql);
$row = $xoopsDB->fetchArray($res);
$uid = $row["uid"];
//print $row["uid"];
$sql = sprintf("INSERT INTO %s(groupid, uid) VALUES(%s, %s);", $xoopsDB->prefix("groups_users_link"), getVolunteerGroupId(), $uid);
$res = $xoopsDB->query($sql);

//== 承認メールを送る ==
$subject = $uname."さんの認証キーです";
$url = sprintf("http://charity-japan.com/develtest/xoops218/user.php?op=actv&uid=%s&actkey=%s", $uid, $actkey);
$message = sprintf("%sさん、こんにちは\n\nXOOPS Cube Siteにおけるユーザ登録用メールアドレスとしてあなたのメールアドレス（%s）が使用されました。もしXOOPS Cube Siteでのユーザ登録に覚えがない場合はこのメールを破棄してください。\n\nXOOPS Cube Siteでのユーザ登録を完了するには下記のリンクをクリックして登録の承認を行ってください。\n\n%s\n", $uname, $close_mail, $url);

$xoopsMailer =& getMailer();
$xoopsMailer->useMail();
$xoopsMailer->setToEmails($close_mail);
$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
$xoopsMailer->setFromName($xoopsConfig['sitename']);
$xoopsMailer->setSubject($subject);
$xoopsMailer->setBody($message);
$xoopsMailer->send();

redirect_header(XOOPS_URL, 2, "ユーザ登録のための確認メールを送りました。メールを確認して、ユーザ登録を完了させてください。");
// S.D.G.