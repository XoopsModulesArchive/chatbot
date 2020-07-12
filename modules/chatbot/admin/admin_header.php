<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

include_once( '../../../mainfile.php');
include_once( '../../../include/cp_header.php');
include_once( '../../../include/functions.php');
include_once( XOOPS_ROOT_PATH . '/class/xoopsmodule.php');
include_once( XOOPS_ROOT_PATH . '/class/xoopsformloader.php' );
// include_once( XOOPS_ROOT_PATH . '/class/module.errorhandler.php');
// $eh = new ErrorHandler;
include_once( XOOPS_ROOT_PATH .'/modules/'.$xoopsModule->getVar('dirname').'/include/functions_chatbot.php' );

// if ( !ereg( "detail", basename($_SERVER['PHP_SELF']) ) ) {
	xoops_cp_header();
	echo '<style type="text/css">';
	echo 'th a:link {text-decoration: none; color: #ffff00; font-weight: bold; background-color: transparent;}';
	echo 'th a:active {text-decoration: none; color: #ffffff; font-weight: bold; background-color: transparent;}';
	echo 'th a:visited {text-decoration: none; color: #ffff00; font-weight: bold; background-color: transparent;}';
	echo 'th a:hover {text-decoration: none; color: #ff0000; font-weight: bold; background-color: transparent;}';
	echo 'ul {text-align: left; color: #ff0000; }';
	echo 'li {text-align: left; color: #000000; list-style-type: decimal; }';
//	echo 'th {text-decoration: none; color: #000000; font-weight: bold; background-color: #333333;}';
	echo '</style>';
//}

?>