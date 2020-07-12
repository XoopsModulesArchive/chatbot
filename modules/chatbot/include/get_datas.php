<?php
/**
* Module: chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*           - DuGris (http://www.dugris.info)
*/
    $current_file = pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME);

// Common
    $op       = isset( $_GET['op'] )          ? intval( $_GET['op'] )          : '';
    $id       = isset( $_GET['id'] )         ? intval( $_GET['id'] )          : '';
    $startart = isset( $_GET['startart'] )   ? intval( $_GET['startart'] )    : 0;
    $status   = isset( $_GET['status'] )     ? intval( $_GET['status'] )      : '2';


// Topics & content & Eliza
if($current_file=='topics.php' || $current_file=='content.php' || $current_file=='topics.php') {    
    $catid           = isset( $_GET['catid'] )          ? intval( $_GET['catid'] )            : '';
    $cat_subject     = isset( $_GET['cat_subject'] )     ? intval( $_GET['cat_subject'] )     : '';
    $cat_description = isset( $_GET['cat_description'] ) ? intval( $_GET['cat_description'] ) : '';
}

// Bots
if($current_file=='bots.php') {
    $botid             = isset( $_GET['botid'] )           ? intval( $_GET['botid'] )              : '';
    $bot_name          = isset( $_GET['bot_name'] )        ? intval( $_GET['bot_name'] )           : '';
    $bot_description   = isset( $_GET['bot_description'] ) ? intval( $_GET['bot_description'] )    : '';
    $bot_image         = isset( $_GET['bot_image'] )       ? intval( $_GET['bot_image'] )          : '';
    $bot_directory     = isset( $_GET['bot_directory'] )   ? intval( $_GET['bot_directory'] )      : '';
    $bot_background    = isset( $_GET['bot_background'] )  ? intval( $_GET['bot_background'] )     : '';
    $text_color        = isset( $_GET['text_color'] )      ? intval( $_GET['text_color'] )         : '';
    $topics            = isset( $_GET['topics'] )          ? intval( $_GET['topics'] )             : '';
    $start             = isset( $_GET['start'] )           ? intval( $_GET['start'] )              : '';
    $dumb              = isset( $_GET['dumb'] )            ? intval( $_GET['dumb'] )               : '';
    $zero              = isset( $_GET['zero'] )            ? intval( $_GET['zero'] )               : '';
    $groups            = isset( $_GET['groups'] )          ? intval( $_GET['botid'] )              : '';
    $end               = isset( $_GET['end'] )             ? intval( $_GET['end'] )                : '';
}

// Content
if($current_file=='content.php') {
    $search            = isset( $_GET['search'] )          ? $_GET['search']    : '';
    $pref_or           = isset( $_GET['pref_or'] )         ? $_GET['pref_or']   : '';
    $pref_and          = isset( $_GET['pref_and'] )        ? $_GET['pref_and']  : '';
    $pref_misc         = isset( $_GET['pref_misc'] )       ? $_GET['pref_misc'] : '';
    $reply             = isset( $_GET['reply'] )           ? $_GET['reply']     : '';
    $question          = isset( $_GET['question'] )        ? $_GET['question']  : '';
}

// Eliza
if($current_file=='eliza.php') {
    $type              = isset( $_GET['type'] )            ? intval( $_GET['type'] )     : 'all';
    $keyword           = isset( $_GET['keyword'] )         ? intval( $_GET['keyword'] )  : '';
    $response          = isset( $_GET['response'] )        ? intval( $_GET['response'] ) : '';
}

?>