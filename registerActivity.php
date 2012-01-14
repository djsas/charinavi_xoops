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
#fname, #fname_yomi, #funame, #fpassword1, #fpassword2, #faddress, #fopen_name, #fopen_mail, #fclose_name, #fclose_mail, #fhomepage, #fblog, #ffacebook{ width: 400px; }
#fpost1, #fopen_phone1, #fopen_fax1, #fclose_phone1, #fclose_fax1, #num_staffs, #num_volunteers{ width: 50px; }
#fpost2, #fopen_phone2, #fopen_phone3, #fopen_fax2, #fopen_fax3, #fclose_phone2, #fclose_phone3, #fclose_fax2, #fclose_fax3{ width: 60px; }
#fdescription, #fstatutory{ height:200px; width:400px; }
</style>

<form enctype="multipart/form-data" method="POST" action="confirmRegisterActivity.php">
<table class="tablecloth">
<tr><th colspan="2">活動場所の住所</th></tr>
<tr><th>郵便番号</th><td><input type="text" id="fpost1" name="post1" value="" /> - <input type="text" id="fpost2" name="post2" value="" /></td></tr>
<tr><th>都道府県</th><td><select id="fprefecture" name="prefecture" onchange="showMunicipalities(this[this.selectedIndex].value);"><?php printListPrefecture(); ?></select></td></tr>
<tr><th>市区町村</th><td><select id="fmunicipality" name="municipality"></select></td></tr>
<tr><th>市区町村以降の住所</th><td><input type="text" id="faddress" name="address" value="" /></td></tr>
<tr><th colspan="2">活動内容</th></tr>
<tr><th>活動風景の写真</th><td><input type="file" id="fpicture" name="picture" /></td></tr>
<tr><th>活動風景の動画(YouTubeなどのURL)</th><td><input type="text" id="fvideo" name="video" value="" /></td></tr>
<tr><th>活動の紹介文章</th><td><textarea id="fdescription" name="description"></textarea></td></tr>
<tr><th>活動時期</th><td><input type="text" id="fterm" name="term" value="" /></td></tr>
<tr><th>活動頻度</th><td><input type="text" id="ffrequency" name="frequency" value="" /></td></tr>
<tr><th>カテゴリ</th><td><select id="fcategory" name="category"><?php printListCategory(); ?></select></td></tr>
<tr><th colspan="2">公開用の連絡先</th></tr>
<tr><th>メールアドレス</th><td><input type="text" id="fopen_mail" name="open_mail" value="" /></td></tr>
<tr><th>活動担当者の氏名</th><td><input type="text" id="fopen_name" name="open_name" value="" /></td></tr>
<tr><th>活動担当者の部署</th><td><input type="text" id="fopen_name" name="open_name" value="" /></td></tr>
<tr><th colspan="2">スタッフ募集</th></tr>
<tr><th>スタッフ募集の有無</th><td></td></tr>
<tr><th>目標募集人数</th><td></td></tr>
<tr><th>スタッフの活動内容</th><td></td></tr>
<tr><th>備考</th><td></td></tr>
<tr><th colspan="2">寄付について</th></tr>
<tr><th>目標寄付金額</th><td></td></tr>
<tr><th>いつまでに集めたいか</th><td></td></tr>
<tr><th>寄付の用途</th><td></td></tr>
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