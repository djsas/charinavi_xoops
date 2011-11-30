<?php
// 
// create: 2011/11/26 13:59:59
// usage: php [this]
// Copyright (C)
//   2011 dj_satoru
// License: GPL v2 or (at your option) any later version
//
// ボランティア団体の情報表示ページ

require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

function getPersonality($id){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_personalities"), $id);
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return $row["personality"];
	}
	return "";
}
function getPrefecture($id){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_prefectures"), $id);
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return $row["prefecture"];
	}
	return "";
}
function getMunicipality($id){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_municipalities"), $id);
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return $row["municipality"];
	}
	return "";
}
function getCategory($id){
	global $xoopsDB;
	$sql = sprintf("SELECT * FROM %s WHERE id = %s;", $xoopsDB->prefix("charinavi_categories"), $id);
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		return $row["name"];
	}
	return "";
}


if($_GET["id"]){
	$sql = sprintf("SELECT * FROM %s WHERE id = %s", $xoopsDB->prefix("charinavi_volunteers"), intval($_GET["id"]));
	$res = $xoopsDB->query($sql);
	$myts =& MyTextSanitizer::getInstance();
	while($row = $xoopsDB->fetchArray($res)){ 
		if($row["authorized"] == 0){
			print "このボランティア団体は審査中です。";
		}
	?>

<table class="tablecloth">
<tr><th>ボランティア団体名</th><td><?= $myts->makeTboxData4Show($row["name"]); ?></td></tr>
<tr><th>ボランティア団体名(ふりがな)</th><td><?= $myts->makeTboxData4Show($row["name_yomi"]); ?></td></tr>
<tr><th>法人種類</th><td><?= getPersonality($row["personality_id"]); ?></td></tr>
<tr><th>郵便番号</th><td><?= $myts->makeTboxData4Show($row["post"]); ?></td></tr>
<tr><th>都道府県</th><td><?= getPrefecture($row["prefecture_id"]); ?></td></tr>
<tr><th>市区町村</th><td><?= getMunicipality($row["municipality_id"]); ?></td></tr>
<tr><th>市区町村以降の住所</th><td><?= $myts->makeTboxData4Show($row["address"]); ?></td></tr>
<tr><th>代表者氏名</th><td><?= $myts->makeTboxData4Show($row["open_name"]); ?></td></tr>
<tr><th>連絡先の電話番号</th><td><?= $myts->makeTboxData4Show($row["open_phone"]); ?></td></tr>
<tr><th>連絡先のFAX番号</th><td><?= $myts->makeTboxData4Show($row["open_fax"]); ?></td></tr>
<tr><th>連絡先のメールアドレス</th><td><?= $myts->makeTboxData4Show($row["open_mail"]); ?></td></tr>
<tr><th>スタッフ人数</th><td><?= intval($row["num_staffs"]); ?></td></tr>
<tr><th>ボランティア人数</th><td><?= intval($row["num_volunteers"]); ?></td></tr>
<tr><th>団体のロゴ画像</th><td></td></tr>
<tr><th>団体の公式サイトURL</th><td><?= $myts->makeTboxData4Show($row["homepage"]); ?></td></tr>
<tr><th>団体のブログURL</th><td><?= $myts->makeTboxData4Show($row["blog"]); ?></td></tr>
<tr><th>団体のFacebookURL</th><td><?= $myts->makeTboxData4Show($row["facebook"]); ?></td></tr>
<tr><th>過去の活動実績</th><td><?= $myts->makeTareaData4Show($row["description"]); ?></td></tr>
<tr><th>定款・会則の情報</th><td><?= $myts->makeTboxData4Show($row["statutory"]); ?></td></tr>
<tr><th>カテゴリ</th><td><?= getCategory($row["category_id"]); ?></td></tr>
</table>
<?php	}
}

include(XOOPS_ROOT_PATH.'/footer.php');

// S.D.G.