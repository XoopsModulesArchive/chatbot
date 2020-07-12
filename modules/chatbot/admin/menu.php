<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

$i = 0;
if (!isset($xoopsModule)) {
$adminmenu[$i]['title']     = _MI_CHATBOT_INDEX;
$adminmenu[$i++]['link']    = "index.php";
}
$adminmenu[$i]['title']     = _MI_CHATBOT_MENU;
$adminmenu[$i++]['link']    = "admin/index.php";

$adminmenu[$i]['title']     = _MI_CHATBOT_BOTS;
$adminmenu[$i++]['link']    = "admin/bots.php";

$adminmenu[$i]['title']     = _MI_CHATBOT_TOPICS;
$adminmenu[$i++]['link']    = "admin/topics.php";

$adminmenu[$i]['title']     = _MI_CHATBOT_CONTENT;
$adminmenu[$i++]['link']    = "admin/content.php";

$adminmenu[$i]['title']     = _MI_CHATBOT_CHAT;
$adminmenu[$i++]['link']    = "admin/eliza.php";

$adminmenu[$i]['title']     = _MI_CHATBOT_REPORTS;
$adminmenu[$i++]['link']    = "admin/reports.php";

$adminmenu[$i]['title']     = _MI_CHATBOT_UTILITIES;
$adminmenu[$i++]['link']    = "admin/uploader.php";

$adminmenu[$i]['title']     = _MI_CHATBOT_BLOCKS;
$adminmenu[$i++]['link']    = "admin/myblocksadmin.php";

/*
$adminmenu[$i]['title'] = _MI_CHATBOT_BLOCKS_GROUPS;
$adminmenu[$i++]['link'] = "admin/myblocksadmin.php";
*/

if (isset($xoopsModule)) {
  $i = 0;
	$headermenu[$i]['title'] = _PREFERENCES;
	$headermenu[$i++]['link'] = '../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid');

	$headermenu[$i]['title'] = _MI_CHATBOT_GOTO_INDEX;
	$headermenu[$i++]['link'] = XOOPS_URL . '/modules/'.$xoopsModule->getVar('dirname').'/';

	$headermenu[$i]['title'] = _MI_CHATBOT_HELP;
	$headermenu[$i++]['link'] = "help.php";
}
  $i = 0;
$statmenu[$i]['title'] = _MI_CHATBOT_UPLOAD;
$statmenu[$i++]['link'] = "admin/uploader.php";
$statmenu[$i]['title'] = _MI_CHATBOT_CLONE;
$statmenu[$i++]['link'] = "admin/clone.php";
$statmenu[$i]['title'] = _MI_CHATBOT_EXPORT;
$statmenu[$i++]['link'] = "admin/export.php";
$statmenu[$i]['title'] = _MI_CHATBOT_IMPORT;
$statmenu[$i++]['link'] = "admin/import.php";
?>