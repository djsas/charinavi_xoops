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
$modversion['image'] = "logo.png";

$modversion['hasMain'] = 1;

//Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php"; // 管理用スクリプトの場所
$modversion['adminmenu'] = "admin/menu.php";

$modversion['onInstall'] = 'include/oninstall.inc.php'; 
//$modversion['onUpdate'] = 'include/onupdate.inc.php';
//$modversion['onUninstall'] = 'include/onuninstall.inc.php'; 

/// Templates
$modversion['templates'][1]['file'] = 'charinavi_register.html';
$modversion['templates'][1]['description'] = 'ボランティア団体登録ページ。';
$modversion['templates'][2]['file'] = 'charinavi_exchange.html';
$modversion['templates'][2]['description'] = 'チャリコインの換金ページ。';
$modversion['templates'][3]['file'] = 'charinavi_addactivity.html';
$modversion['templates'][3]['description'] = '寄付を募る活動の登録ページ。';
$modversion['templates'][4]['file'] = 'charinavi_activity.html';
$modversion['templates'][4]['description'] = 'ボランティア活動の紹介と寄付をするページ。';

/// Blocks
$modversion['blocks'][1]['file'] = 'charinavi_menu.php';
$modversion['blocks'][1]['name'] = _MI_CHARINAVI_BLOCK1_TITLE;
$modversion['blocks'][1]['description'] = _MI_CHARINAVI_BLOCK1_DESCRIPTION;
$modversion['blocks'][1]['show_func'] = "b_charinavi_menu_show";
$modversion['blocks'][1]['template'] =  'charinavi_block_menu.html';
$modversion['blocks'][2]['file'] = 'charinavi_vmenu.php';
$modversion['blocks'][2]['name'] = _MI_CHARINAVI_BLOCK2_TITLE;
$modversion['blocks'][2]['description'] = _MI_CHARINAVI_BLOCK2_DESCRIPTION;
$modversion['blocks'][2]['show_func'] = "b_charinavi_vmenu_show";
$modversion['blocks'][2]['template'] =  'charinavi_block_vmenu.html';
$modversion['blocks'][3]['file'] = 'charinavi_new.php';
$modversion['blocks'][3]['name'] = _MI_CHARINAVI_BLOCK3_TITLE;
$modversion['blocks'][3]['description'] = _MI_CHARINAVI_BLOCK3_DESCRIPTION;
$modversion['blocks'][3]['show_func'] = "b_charinavi_new_show";
$modversion['blocks'][3]['template'] =  'charinavi_block_avatar.html';
$modversion['blocks'][4]['file'] = 'charinavi_avatar.php';
$modversion['blocks'][4]['name'] = _MI_CHARINAVI_BLOCK_AVATAR_TITLE;
$modversion['blocks'][4]['description'] = _MI_CHARINAVI_BLOCK_AVATAR_DESCRIPTION;
$modversion['blocks'][4]['show_func'] = "b_charinavi_avatar_show";
$modversion['blocks'][4]['template'] =  'charinavi_block_avatar.html';


// Sql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// Tables
$modversion['tables'][0] = "charinavi_log";
$modversion['tables'][1] = "charinavi_personal";
$modversion['tables'][2] = "charinavi_addactivities";
$modversion['tables'][3] = "charinavi_tags";
$modversion['tables'][4] = "charinavi_volunteers";
$modversion['tables'][5] = "charinavi_categories";
$modversion['tables'][6] = "charinavi_transcheck";
$modversion['tables'][7] = "charinavi_error";



// D.S.G.