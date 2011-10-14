<?php
require('../../../mainfile.php');
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
<h2>チャリコインの購入</h2>
1円に対して、チャリコイン1枚と換金します。
<form name="exchange" method="POST" action="<?= XOOPS_URL ?>/modules/charinavi/exchanging.php" onsubmit="return checkForm();">
<input type="text" name="amount" value="0" />枚のチャリコインと換金します。
<input type="submit" name="submit" value="購入" />
</form>

// D.S.G.