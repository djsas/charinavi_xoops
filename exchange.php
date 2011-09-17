<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
?>
<script type="text/javascript">
function checkForm(){
	var a = document.exchange.amount.value;
	if(a.match(/^[0-9]+$/)){
		a = parseInt(a);
		if(a > 0){
			return true;
		}else{
			document.getElementById("log").innerHTML = "0以上の数字を入力してください。";
			return false;
		}
	}else{
		document.getElementById("log").innerHTML = "数字を入力してください。";
		return false;
	}
}
</script>
<div id="log"></div>
<?php
$body = new xoopsTpl();
$body->assign("exchange_title", _MD_CHARINAVI_EXCHANGE_TITLE);
$body->assign("exchange_description", _MD_CHARINAVI_EXCHANGE_DESCRIPTION);
$body->assign("exchange_msg_form", _MD_CHARINAVI_EXCHANGE_MSG_FORM);
$body->assign("exchange_submit", _MD_CHARINAVI_EXCHANGE_SUBMIT);
echo $body->fetch("db:charinavi_exchange.html");

include(XOOPS_ROOT_PATH.'/footer.php');

// D.S.G.