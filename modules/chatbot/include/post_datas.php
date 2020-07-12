<?php
/**
* Module: chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/
   $current_file = pathinfo($_SERVER['SCRIPT_NAME'],PATHINFO_BASENAME);

// Common
    $op       = isset( $_POST['op'] )          ? intval( $_POST['op'] )          : '';
    $id       = isset( $_POST['id'] )         ? intval( $_POST['id'] )          : '';
    $startart = isset( $_POST['startart'] )   ? intval( $_POST['startart'] )    : 0;
    $status   = isset( $_POST['status'] )     ? intval( $_POST['status'] )      : '2';

// Topics & content & Eliza
if($current_file=='topics.php' || $current_file=='content.php' || $current_file=='topics.php') {    
    $catid           = isset( $_POST['catid'] )          ? intval( $_POST['catid'] )            : '';
    $cat_subject     = isset( $_POST['cat_subject'] )     ? intval( $_POST['cat_subject'] )     : '';
    $cat_description = isset( $_POST['cat_description'] ) ? intval( $_POST['cat_description'] ) : '';
}

// Bots
if($current_file=='bots.php') {
    $botid             = isset( $_POST['botid'] )           ? intval( $_POST['botid'] )              : '';
    $bot_name          = isset( $_POST['bot_name'] )        ? intval( $_POST['bot_name'] )           : '';
    $bot_description   = isset( $_POST['bot_description'] ) ? intval( $_POST['bot_description'] )    : '';
    $bot_image         = isset( $_POST['bot_image'] )       ? intval( $_POST['bot_image'] )          : '';
    $bot_directory     = isset( $_POST['bot_directory'] )   ? intval( $_POST['bot_directory'] )      : '';
    $bot_background    = isset( $_POST['bot_background'] )  ? intval( $_POST['bot_background'] )     : '';
    $text_color        = isset( $_POST['text_color'] )      ? intval( $_POST['text_color'] )         : '';
    $topics            = isset( $_POST['topics'] )          ? intval( $_POST['topics'] )             : '';
    $start             = isset( $_POST['start'] )           ? intval( $_POST['start'] )              : '';
    $dumb              = isset( $_POST['dumb'] )            ? intval( $_POST['dumb'] )               : '';
    $zero              = isset( $_POST['zero'] )            ? intval( $_POST['zero'] )               : '';
    $groups            = isset( $_POST['groups'] )          ? intval( $_POST['botid'] )              : '';
    $end               = isset( $_POST['end'] )             ? intval( $_POST['end'] )                : '';
}

// Content
if($current_file=='content.php') {
    $search            = isset( $_POST['search'] )          ? $_POST['search']    : '';
    $pref_or           = isset( $_POST['pref_or'] )         ? $_POST['pref_or']   : '';
    $pref_and          = isset( $_POST['pref_and'] )        ? $_POST['pref_and']  : '';
    $pref_misc         = isset( $_POST['pref_misc'] )       ? $_POST['pref_misc'] : '';
    $reply             = isset( $_POST['reply'] )           ? $_POST['reply']     : '';
    $question          = isset( $_POST['question'] )        ? $_POST['question']  : '';
}

// Eliza
if($current_file=='eliza.php') {
    $type              = isset( $_POST['type'] )            ? intval( $_POST['type'] )     : 'all';
    $keyword           = isset( $_POST['keyword'] )         ? intval( $_POST['keyword'] )  : '';
    $response          = isset( $_POST['response'] )        ? intval( $_POST['response'] ) : '';
}

?>