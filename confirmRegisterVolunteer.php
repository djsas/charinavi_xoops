<?php
// 
// create: 2011/11/23 14:56:26
// usage: php [this]
// Copyright (C)
//   2011 dj_satoru
// License: GPL v2 or (at your option) any later version
//
// 

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

$name = htmlspecialchars($_POST["name"]);
$name_yomi = htmlspecialchars($_POST["name_yomi"]);
$uname = htmlspecialchars($_POST["uname"]);
$_SESSION["password"] = $_POST["password1"];
$personality_id = intval($_POST["personality"]);
$post = htmlspecialchars($_POST["post1"]) . "-" . htmlspecialchars($_POST["post2"]);
$prefecture_id = intval($_POST["prefecture"]);
$municipality_id = intval($_POST["municipality"]);
$address = htmlspecialchars($_POST["address"]);
$open_name = htmlspecialchars($_POST["open_name"]);
$open_phone = htmlspecialchars($_POST["open_phone1"]) . "-" . htmlspecialchars($_POST["open_phone2"]) . "-" . htmlspecialchars($_POST["open_phone3"]);
$open_fax = htmlspecialchars($_POST["open_fax1"]) . "-" . htmlspecialchars($_POST["open_fax2"]) . "-" . htmlspecialchars($_POST["open_fax3"]);
$open_mail = htmlspecialchars($_POST["open_mail"]);
$close_name = htmlspecialchars($_POST["close_name"]);
$close_phone = htmlspecialchars($_POST["close_phone1"]) . "-" . htmlspecialchars($_POST["close_phone2"]) . "-" . htmlspecialchars($_POST["close_phone3"]);
$close_fax = htmlspecialchars($_POST["close_fax1"]) . "-" . htmlspecialchars($_POST["close_fax2"]) . "-" . htmlspecialchars($_POST["close_fax3"]);
$close_mail = htmlspecialchars($_POST["close_mail"]);
$num_staffs = intval($_POST["num_staffs"]);
$num_volunteers = intval($_POST["num_volunteers"]);

$homepage = htmlspecialchars($_POST["homepage"]);
$blog = htmlspecialchars($_POST["blog"]);
$facebook = htmlspecialchars($_POST["facebook"]);
$description = htmlspecialchars($_POST["description"]);
$statutory = htmlspecialchars($_POST["statutory"]);
$category_id = intval($_POST["category"]);

?>
<form method="POST" action="svr/registerVolunteer.php">
<table class="tablecloth">
<tr><th>ボランティア団体名</th><td><?= $name; ?><input type="hidden" name="name" value="<?= $name; ?>" /></td></tr>
<tr><th>ボランティア団体名(ふりがな)</th><td><?= $name_yomi; ?><input type="hidden" name="name_yomi" value="<?= $name_yomi; ?>" /></td></tr>
<tr><th>法人種類</th><td><?= getPersonality($personality_id); ?><input type="hidden" name="personality_id" value="<?= $personality_id; ?>" /></td></tr>
<tr><th>ログイン用のアカウント名</th><td><?= $uname; ?><input type="hidden" name="post" value="<?= $uname; ?>" /></td></tr>
<tr><th>パスワード</th><td>******</td></tr>
<tr><th>郵便番号</th><td><?= $post; ?><input type="hidden" name="post" value="<?= $post; ?>" /></td></tr>
<tr><th>都道府県</th><td><?= getPrefecture($prefecture_id); ?><input type="hidden" name="prefecture_id" value="<?= $prefecture_id; ?>" /></td></tr>
<tr><th>市区町村</th><td><?= getMunicipality($municipality_id); ?><input type="hidden" name="municipality_id" value="<?= $municipality_id; ?>" /></td></tr>
<tr><th>市区町村以降の住所</th><td><?= $address; ?><input type="hidden" name="address" value="<?= $address; ?>" /></td></tr>
<tr><th>代表者氏名</th><td><?= $open_name; ?><input type="hidden" name="open_name" value="<?= $open_name; ?>" /></td></tr>
<tr><th>公開用連絡先の電話番号</th><td><?= $open_phone; ?><input type="hidden" name="open_phone" value="<?= $open_phone; ?>" /></td></tr>
<tr><th>公開用連絡先のFAX番号</th><td><?= $open_fax; ?><input type="hidden" name="open_fax" value="<?= $open_fax; ?>" /></td></tr>
<tr><th>公開用連絡先のメールアドレス</th><td><?= $open_mail; ?><input type="hidden" name="open_mail" value="<?= $open_mail; ?>" /></td></tr>
<tr><th>Charity Japanとの連絡対応者氏名 (非公開)</th><td><?= $close_name; ?><input type="hidden" name="close_name" value="<?= $close_name; ?>" /></td></tr>
<tr><th>Charity Japanとの連絡対応者電話番号</th><td><?= $close_phone; ?><input type="hidden" name="close_phone" value="<?= $close_phone; ?>" /></td></tr>
<tr><th>Charity Japanとの連絡対応者FAX番号</th><td><?= $close_fax; ?><input type="hidden" name="close_fax" value="<?= $close_fax; ?>" /></td></tr>
<tr><th>Charity Japanとの連絡対応者メールアドレス</th><td><?= $close_mail; ?><input type="hidden" name="close_mail" value="<?= $close_mail; ?>" /></td></tr>
<tr><th>スタッフ人数</th><td><?= $num_staffs; ?><input type="hidden" name="num_staffs" value="<?= $num_staffs; ?>" /></td></tr>
<tr><th>ボランティア人数</th><td><?= $num_volunteers; ?><input type="hidden" name="num_volunteers" value="<?= $num_volunteers; ?>" /></td></tr>
<tr><th>団体のロゴ画像</th><td><input type="file" id="flogo" name="logo" /></td></tr>
<tr><th>団体の公式サイトURL</th><td><?= $homepage; ?><input type="hidden" name="homepage" value="<?= $homepage; ?>" /></td></tr>
<tr><th>団体のブログURL</th><td><?= $blog; ?><input type="hidden" name="blog" value="<?= $blog; ?>" /></td></tr>
<tr><th>団体のFacebookURL</th><td><?= $facebook; ?><input type="hidden" name="facebook" value="<?= $facebook; ?>" /></td></tr>
<tr><th>過去の活動実績</th><td><?= $description; ?><input type="hidden" name="description" value="<?= $description; ?>" /></td></tr>
<tr><th>定款・会則の情報</th><td><?= $statutory; ?><input type="hidden" name="statutory" value="<?= $statutory; ?>" /></td></tr>
<tr><th>カテゴリ</th><td><?= getCategory($category_id); ?><input type="hidden" name="category_id" value="<?= $category_id; ?>" /></td></tr>
</table>
<input type="submit" name="submit" value="登録" />
</form>
<?php
include(XOOPS_ROOT_PATH.'/footer.php');

// S.D.G.