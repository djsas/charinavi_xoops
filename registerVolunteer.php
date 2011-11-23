<?php
// 
// create: 2011/11/23 11:50:43
// usage: php [this]
// Copyright (C)
//   2011 dj_satoru
// License: GPL v2 or (at your option) any later version
//
// 

require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

function printListPersonality(){
	global $xoopsDB;
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_personalities");
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		printf("<option value='%s'>%s</option>", $row["id"], $row["personality"]);
	}
}
function printListPrefecture(){
	global $xoopsDB;
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_prefectures");
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		printf("<option value='%s'>%s</option>", $row["id"], $row["prefecture"]);
	}
}
function printListMunicipality(){
	global $xoopsDB;
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_municipalities");
	$res = $xoopsDB->query($sql);
	$htmls = array();
	while($row = $xoopsDB->fetchArray($res)){
		if(!array_key_exists($row["prefecture_id"], $htmls)){
			$htmls[$row["prefecture_id"]] = array();
		}
		array_push($htmls[$row["prefecture_id"]], $row["id"], $row["municipality"]);
	}
	foreach($htmls as $k => $v){
		printf("municipalities[%s] = ['%s'];\n", $k, implode("','", $v));
	}
}
function printListCategory(){
	global $xoopsDB;
	$sql = "SELECT * FROM ".$xoopsDB->prefix("charinavi_categories");
	$res = $xoopsDB->query($sql);
	while($row = $xoopsDB->fetchArray($res)){
		printf("<option value='%s'>%s</option>", $row["id"], $row["name"]);
	}	
}

?>
<style type="text/css">
#fname, #fname_yomi, #faddress, #fopen_name, #fopen_mail, #fclose_name, #fclose_mail, #fhomepage, #fblog, #ffacebook{ width: 400px; }
#fpost1, #fopen_phone1, #fopen_fax1, #fclose_phone1, #fclose_fax1, #num_staffs, #num_volunteers{ width: 50px; }
#fpost2, #fopen_phone2, #fopen_phone3, #fopen_fax2, #fopen_fax3, #fclose_phone2, #fclose_phone3, #fclose_fax2, #fclose_fax3{ width: 60px; }
#fdescription, #fstatutory{ height:200px; width:400px; }
</style>

<form method="POST" action="confirmRegisterVolunteer.php">
<table class="tablecloth">
<tr><th>ボランティア団体名</th><td><input type="text" id="fname" name="name" value="" /></td></tr>
<tr><th>ボランティア団体名(ふりがな)</th><td><input type="text" id="fname_yomi" name="name_yomi" value="" /></td></tr>
<tr><th>法人種類</th><td><select id="fpersonality" name="personality"><?php printListPersonality(); ?></select></td></tr>
<tr><th>郵便番号</th><td><input type="text" id="fpost1" name="post1" value="" /> - <input type="text" id="fpost2" name="post2" value="" /></td></tr>
<tr><th>都道府県</th><td><select id="fprefecture" name="prefecture" onchange="showMunicipalities(this[this.selectedIndex].value);"><?php printListPrefecture(); ?></select></td></tr>
<tr><th>市区町村</th><td><select id="fmunicipality" name="municipality"></select></td></tr>
<tr><th>市区町村以降の住所</th><td><input type="text" id="faddress" name="address" value="" /></td></tr>
<tr><th>代表者氏名</th><td><input type="text" id="fopen_name" name="open_name" value="" /></td></tr>
<tr><th>公開用連絡先の電話番号</th><td><input type="text" id="fopen_phone1" name="open_phone1" value="" /> - <input type="text" id="fopen_phone2" name="open_phone2" value="" /> - <input type="text" id="fopen_phone3" name="open_phone3" value="" /></td></tr>
<tr><th>公開用連絡先のFAX番号</th><td><input type="text" id="fopen_fax1" name="open_fax1" value="" /> - <input type="text" id="fopen_fax2" name="open_fax2" value="" /> - <input type="text" id="fopen_fax3" name="open_fax3" value="" /></td></tr>
<tr><th>公開用連絡先のメールアドレス</th><td><input type="text" id="fopen_mail" name="open_mail" value="" /></td></tr>
<tr><th>Charity Japanとの連絡対応者氏名 (非公開)</th><td><input type="text" id="fclose_name" name="close_name" value="" /></td></tr>
<tr><th>Charity Japanとの連絡対応者電話番号</th><td><input type="text" id="fclose_phone1" name="close_phone1" value="" /> - <input type="text" id="fclose_phone2" name="close_phone2" value="" /> - <input type="text" id="fclose_phone3" name="close_phone3" value="" /></td></tr>
<tr><th>Charity Japanとの連絡対応者FAX番号</th><td><input type="text" id="fclose_fax1" name="close_fax1" value="" /> - <input type="text" id="fclose_fax2" name="close_fax2" value="" /> - <input type="text" id="fclose_fax3" name="close_fax3" value="" /></td></tr>
<tr><th>Charity Japanとの連絡対応者メールアドレス</th><td><input type="text" id="fclose_mail" name="close_mail" value="" /></td></tr>
<tr><th>スタッフ人数</th><td><input type="text" id="fnum_staffs" name="num_staffs" value="" /></td></tr>
<tr><th>ボランティア人数</th><td><input type="text" id="fnum_volunteers" name="num_volunteers" value="" /></td></tr>
<tr><th>団体のロゴ画像</th><td><input type="file" id="flogo" name="logo" /></td></tr>
<tr><th>団体の公式サイトURL</th><td><input type="text" id="fhomepage" name="homepage" value="" /></td></tr>
<tr><th>団体のブログURL</th><td><input type="text" id="fblog" name="blog" value="" /></td></tr>
<tr><th>団体のFacebookURL</th><td><input type="text" id="ffacebook" name="facebook" value="" /></td></tr>
<tr><th>過去の活動実績</th><td><textarea id="fdescription" name="description"></textarea></td></tr>
<tr><th>定款・会則の情報</th><td><textarea id="fstatutory" name="statutory"></textarea></td></tr>
<tr><th>カテゴリ</th><td><select id="fcategory" name="category"><?php printListCategory(); ?></select></td></tr>
</table>
<input type="submit" name="submit" value="確認ページへ" />
</form>

<script type="text/javascript">
var municipalities = [];
<?php printListMunicipality(); ?>
function showMunicipalities(id){
	var html = "";
	for(var i=0; i<municipalities[id].length; i+=2){
		html += "<option value='" + municipalities[id][i] + "'>" + municipalities[id][i+1] + "</option>";
	}
	document.getElementById("fmunicipality").innerHTML = html;
}
showMunicipalities(1);
</script>

<?php
include(XOOPS_ROOT_PATH.'/footer.php');


// S.D.G.