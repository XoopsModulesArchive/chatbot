<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

include_once( "admin_header.php" );
$myts =& MyTextSanitizer::getInstance();

chatbot_adminmenu(-1, _MD_CHATBOT_HELP);
OpenTable();
$helpfile = XOOPS_ROOT_PATH . '/modules/chatbot/language/' . $xoopsConfig['language'] . '/help.html';
if ( file_exists($helpfile) ) {
	include_once ( $helpfile );
} else {
	include_once ( XOOPS_ROOT_PATH . '/modules/chatbot/language/english/help.html' );
}

CloseTable();
include_once( 'admin_footer.php' );
?>