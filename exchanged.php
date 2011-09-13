<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');

if(isset($_POST["submit"]) && $_POST["submit"]){
	print $_POST["amount"]."枚のチャリコインと換金しました。";
}

include(XOOPS_ROOT_PATH.'/footer.php');

// D.S.G.