<?php
// $Id: xoops_version.php,v 1.4 2003/09/21 07:40:10 kousuke Exp $

// change 
$modversion['name'] = _MI_CHARINAVI_NAME;
$modversion['dirname'] = "charinavi";



$modversion['description'] = $modversion['name'];
$modversion['version'] = "0.1";
$modversion['credits'] = "";
$modversion['author'] = 'djsas';
$modversion['help'] = "help.html";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "logo.gif";

//Admin things
$modversion['hasAdmin'] = 0;
$modversion['hasMain'] = 1;

$modversion['onInstall'] = 'include/oninstall.inc.php'; 
//$modversion['onUpdate'] = 'include/onupdate.inc.php';
//$modversion['onUninstall'] = 'include/onuninstall.inc.php'; 

/// Templates
$modversion['templates'][1]['file'] = 'charinavi_register.html';
$modversion['templates'][1]['description'] = 'ボランティア団体登録ページ。';
$modversion['templates'][2]['file'] = 'charinavi_exchange.html';
$modversion['templates'][2]['description'] = 'チャリコインの換金ページ。';

// Blocks
$modversion['blocks'][1]['file'] = 'charinavi_menu.php';
$modversion['blocks'][1]['name'] = _MI_NIMGSEARCH_BLOCK1_TITLE;
$modversion['blocks'][1]['description'] = _MI_NIMGSEARCH_BLOCK1_DESCRIPTION;
$modversion['blocks'][1]['show_func'] = "b_charinavi_menu_show";
$modversion['blocks'][1]['template'] =  'charinavi_block_menu.html';

?>