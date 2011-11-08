<?php
/** 
 *  cmd:    php [this]
 *  create: 2011/11/08 17:36:46
 *  import: 
 *  input:  
 *  output: 
 *  description: 
 */

require('../../mainfile.php');
?>
<html>
<head>

<style type="text/css">
body{ background-color: #e44268; }
</style>

</head>
<body>
<div><img src="<?= XOOPS_URL; ?>/modules/charinavi/images/topbackground.png" /></div>
<div style="width:850px; margin-left:auto; margin-right:auto; padding-top:25px; padding-bottom:25px;">
<form>
<input type="text" value="ユーザID" /> <input type="text" value="パスワード" /> <input type="submit" value="ログイン" />
</form>
<div style="color:white; margin-top:10px;"><span>&gt;&gt;新規登録</span>
<span style="margin-left:15px;">&gt;&gt;ログインしないで使う</span></div>
</div>
</body>
</html>