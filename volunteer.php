<?php
// 
// create: 2011/11/26 13:59:59
// usage: php [this]
// Copyright (C)
//   2011 dj_satoru
// License: GPL v2 or (at your option) any later version
//
// �ܥ��ƥ������Τξ���ɽ���ڡ���

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
			print "���Υܥ��ƥ������ΤϿ�����Ǥ���";
		}
	?>

<table class="tablecloth">
<tr><th>�ܥ��ƥ�������̾</th><td><?= $myts->makeTboxData4Show($row["name"]); ?></td></tr>
<tr><th>�ܥ��ƥ�������̾(�դ꤬��)</th><td><?= $myts->makeTboxData4Show($row["name_yomi"]); ?></td></tr>
<tr><th>ˡ�ͼ���</th><td><?= getPersonality($row["personality_id"]); ?></td></tr>
<tr><th>͹���ֹ�</th><td><?= $myts->makeTboxData4Show($row["post"]); ?></td></tr>
<tr><th>��ƻ�ܸ�</th><td><?= getPrefecture($row["prefecture_id"]); ?></td></tr>
<tr><th>�Զ�Į¼</th><td><?= getMunicipality($row["municipality_id"]); ?></td></tr>
<tr><th>�Զ�Į¼�ʹߤν���</th><td><?= $myts->makeTboxData4Show($row["address"]); ?></td></tr>
<tr><th>��ɽ�Ի�̾</th><td><?= $myts->makeTboxData4Show($row["open_name"]); ?></td></tr>
<tr><th>Ϣ����������ֹ�</th><td><?= $myts->makeTboxData4Show($row["open_phone"]); ?></td></tr>
<tr><th>Ϣ�����FAX�ֹ�</th><td><?= $myts->makeTboxData4Show($row["open_fax"]); ?></td></tr>
<tr><th>Ϣ����Υ᡼�륢�ɥ쥹</th><td><?= $myts->makeTboxData4Show($row["open_mail"]); ?></td></tr>
<tr><th>�����åտͿ�</th><td><?= intval($row["num_staffs"]); ?></td></tr>
<tr><th>�ܥ��ƥ����Ϳ�</th><td><?= intval($row["num_volunteers"]); ?></td></tr>
<tr><th>���ΤΥ�����</th><td></td></tr>
<tr><th>���Τθ���������URL</th><td><?= $myts->makeTboxData4Show($row["homepage"]); ?></td></tr>
<tr><th>���ΤΥ֥�URL</th><td><?= $myts->makeTboxData4Show($row["blog"]); ?></td></tr>
<tr><th>���Τ�FacebookURL</th><td><?= $myts->makeTboxData4Show($row["facebook"]); ?></td></tr>
<tr><th>���γ�ư����</th><td><?= $myts->makeTareaData4Show($row["description"]); ?></td></tr>
<tr><th>�괾����§�ξ���</th><td><?= $myts->makeTboxData4Show($row["statutory"]); ?></td></tr>
<tr><th>���ƥ���</th><td><?= getCategory($row["category_id"]); ?></td></tr>
</table>
<?php	}
}

include(XOOPS_ROOT_PATH.'/footer.php');

// S.D.G.