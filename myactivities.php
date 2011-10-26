<?php
/** 
 *  cmd:    php [this]
 *  create: 2011/10/26 10:35:48
 *  import: 
 *  input:  
 *  output: 
 *  description: 
 */

require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/include/functions.php');
include_once(XOOPS_ROOT_PATH.'/modules/charinavi/class/volunteer.class.php');

$vol = new Volunteer();
$vol->restrict();
$vol->setUid($xoopsUser->uid());
?>

<table class="tablecloth">
<tr>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIVITY; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_REPORT; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_VISIT; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_DONATION; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_UPBEAT; ?></th>
<th><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ACTIONS; ?></th>
</tr>
<?php
$sql = sprintf("SELECT * FROM %s WHERE vid = %s;", $xoopsDB->prefix("charinavi_activities"), $vol->getId());
$res = $xoopsDB->query($sql);
$myts =& MyTextSanitizer::getInstance();
while($row = $xoopsDB->fetchArray($res)){
	print "<tr>"
		."<td>".$myts->makeTboxData4Show($row["name"])."</td>"
		."<td><a href=''>"._MD_CHARINAVI_MYACTIVITIES_LABEL_SHOWREPORT."</a></td>"
		."<td>0</td>"
		."<td>0</td>"
		."<td>0</td>"
		."<td><input type='button' value='"._MD_CHARINAVI_MYACTIVITIES_LABEL_EDIT."' /><input type='button' value='"._MD_CHARINAVI_MYACTIVITIES_LABEL_DELETE."' /></td>"
		."</tr>\n";
}
?>
</table>
<a href="javascript:openAddActivity();"><?= _MD_CHARINAVI_MYACTIVITIES_LABEL_ADD; ?>&gt;&gt;</a>

<div id="pwc_addactivity" style="display:none;">
<?php
$body = new xoopsTpl();
$body->assign("addactivity_title", _MD_CHARINAVI_ADDACTIVITY_TITLE);
$body->assign("name_title", _MD_CHARINAVI_ADDACTIVITY_NAME_TITLE);
$body->assign("description_title", _MD_CHARINAVI_ADDACTIVITY_DESCRIPTION_TITLE);
$body->assign("tags_title", _MD_CHARINAVI_ADDACTIVITY_TAGS_TITLE);
echo $body->fetch( "db:charinavi_addactivity.html" );
?></div>  <!-- end id=pwc_addactivity //-->
<script type="text/javascript">
function openAddActivity(){
	Dialog.confirm($('pwc_addactivity').innerHTML, 
		{top: 10, width:400, height:300, className: "alphacube", okLabel: "<?= _MD_CHARINAVI_ADDACTIVITY_SUBMIT; ?>", cancelLabel:"Cancel",
		onOk: function(win){
			var res = checkForm();
			if(res){
				//$("exchangeform").action = "<{$xoops_url}>/modules/charinavi/svr/exchange.php";
				//$("exchangeform").submit();
			}else{
				Windows.focusedWindow.updateHeight();
				new Effect.Shake(Windows.focusedWindow.getId());
				return false;
			}
		}});
}
</script>


<?php
include(XOOPS_ROOT_PATH.'/footer.php');


// D.S.G.