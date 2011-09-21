<?php
require('../../mainfile.php');
include(XOOPS_ROOT_PATH.'/header.php');
?>
<style type="text/css">
.button{ cursor: pointer; }
.editor{ display: none; }
</style>

<script type="text/javascript">
function showEditor(id){
	var el = document.getElementById("editor_" + id);
	el.style.display = el.style.display == "none" ? "block" : "none";
}
</script>

<img src="images/personalphoto.php" /><img src="images/pencil24.png" class="button" onclick="showEditor(1);" />
<div id="editor_1" class="editor"><input type="file" name="photo" /></div>

<?php
include(XOOPS_ROOT_PATH.'/footer.php');
