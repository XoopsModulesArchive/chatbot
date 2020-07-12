<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

function a_chatbot_content_show($options)
{
	global $xoopsDB, $xoopsUser, $xoopsModule;
	$myts 	=& MyTextSanitizer::getInstance();
	$module = "chatbot";
	include_once (XOOPS_ROOT_PATH. "/modules/".$module."/include/functions_block.php");
        include_once (XOOPS_ROOT_PATH. "/modules/".$module."/include/functions_chatbot_index.php");

  $block = array();
  if (is_object($xoopsUser)) {
        $tag['{EMAIL}']        = $xoopsUser->getVar('email');
        $tag['{URL}']          = $xoopsUser->getVar('url');
        $tag['{FROM}']         = $xoopsUser->getVar('user_from');
        $tag['{POSTS}']        = $xoopsUser->getVar('posts');
        $tag['{LAST_LOGIN}']   = $xoopsUser->getVar('last_login');
        $tag['{USER_OCC}']     = $xoopsUser->getVar('user_occ');
        $tag['{USER_INTREST}'] = $xoopsUser->getVar('user_intrest');
        $username              = XoopsUser::getUnameFromId($xoopsUser->uid(), 1);
        } else { $username = $GLOBALS['xoopsConfig']['anonymous']; }
        $tag['{USERNAME}']     = $username;

// Language files
$yes_array = explode( '|', _MB_CHATBOT_DATAS_YES);
$block['yes1'] = $yes_array[0];
$block['yes2'] = $yes_array[1];
$block['yes3'] = $yes_array[2];
$typewriter    = chatbot_getmoduleoption('chatbot_typewriter');
$ext           = '';
$is_type       = 'no';

// Bots datas
$sql = "SELECT *
        FROM ".$xoopsDB->prefix( $module . "_bot")."
        WHERE botid = $options[0] AND status = 1";
$result = $xoopsDB->queryF( $sql );

list( $botid,               $status,
      $bot_name,            $bot_description,
      $bot_image,           $bot_directory,    $bot_background,
      $text_color,          $topics,
      $begin,               $dumb,           $zero,                $end,
      $groups
                             ) = $xoopsDB -> fetchrow( $result );

if( !$bot_name OR ($xoopsModule AND $xoopsModule -> getVar( 'dirname' ) == 'chatbot') ) {
		return '';
		exit();
                 };

// Generate emoticons
// $bot_temp_directory =   XOOPS_URL.'/'.$bot_directory;
// $boticons           =   chatbot_smilies(XOOPS_ROOT_PATH.'/'.$bot_directory);
$bot_temp_directory = ''; $boticons ='';
$autoclick          =   chatbot_getmoduleoption('chatbot_autoclick');
 if ( !$dumb ) { $dumb = chatbot_getmoduleoption('chatbot_talkDumb'); }
 if ( !$zero ) { $zero = chatbot_getmoduleoption('chatbot_talkZero'); }
 if ( !$end ) { $end = chatbot_getmoduleoption('chatbot_endPhrase'); }
// $block['boticons'] =    chatbot_smilies(XOOPS_ROOT_PATH.'/'.$bot_directory);
// $block['botsmilies'] =    XOOPS_URL.'/'.$bot_directory;

// Topics datas
   $is_eliza = 0;
   if( strstr($topics,'Eliza') ) { $topics = eregi_replace('Eliza', '', $topics); $is_eliza = 1;}
   $where   = eregi_replace(' ', ' OR catid=', trim($topics));
   

// Related module topics
$where_module = '';
$current_url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].(($_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : ''));
$current_page = str_replace(XOOPS_URL.'/', '', $current_url);

$sql = "SELECT catid, page_link
        FROM ".$xoopsDB->prefix( $module . "_topics")."
        WHERE page_link!=''";
//                WHERE page_link LIKE '%".$current_page."%'";
$result = $xoopsDB->queryF( $sql );
while (list($current_module_catid, $page_link) = $xoopsDB -> fetchrow( $result ))
{ if( ereg($page_link,$current_page) ) { $where_module .= 'OR catid='.$current_module_catid; } }


// Afficher le nom du bot
    $block['bot_name'] =    $bot_name;
    $block['botname']  =    substr($bot_name,0,1);
    $block['user_name'] =   $username;
    $block['username'] =    substr($username,0,1);
    $block['historic'] =    _MB_CHATBOT_HISTORIC;

//   $block['lg_topics'] =   _MB_CHATBOT_TOPICS;
//   $block['instructions',  sprintf(_MB_CHATBOT_DATA_INFOS, $bot_name, $yes_array[0]);


   $bot_background = explode('|', $bot_background);
   if ($bot_background[1]) { $text_background = trim(XOOPS_URL.'/'.$bot_directory.'/'.$bot_background[1]); } else { $text_background = ''; }

$block['text_background'] = $text_background;

// Avatar options
$image_size = explode('-', trim($options[2]));
$block['image_width']      = $image_size[0];
$block['image_height']     = $image_size[1];
$logo_url =   XOOPS_URL.'/'.$bot_directory.$bot_image;
$link_url =   XOOPS_URL.'/modules/'.$module.'/bot.php?id='.$botid;
$alt_description = strip_tags($bot_description);
$block['botimage'] = chatbot_createlink($link_url, $bot_name, '', $logo_url, 'center', $image_size[0], $image_size[1], $alt_description);

// Index display options
$text_size = explode('-', $options[1]);
$block['text_width'] =    $text_size[0];
$block['text_height'] =   $text_size[1];

$back_color = explode('|', $text_color);
$block['text_color']       =   $back_color[0];  // Page text color
$block['back_color']       =   $back_color[1];  // Background color
$block['bot_text_color']   =   $back_color[2];  // Textarea text color
$block['bot_back_color']   =   $back_color[3];  // Textarea Background color
$block['border_size']      =   $back_color[4];  // Border size

/* ####################################################################### */
/*                 Generate Eliza chat datas for chatbot                   */
/* ####################################################################### */
          include_once(XOOPS_ROOT_PATH . "/modules/chatbot/include/eliza_content.php");
          $path = '/'.$bot_directory.'block_eliza_' . $botid . '.js';
          if( function_exists('fopen') ) {
              chatbot_create_jscontent( XOOPS_ROOT_PATH.$path, $chat_datas);
              $eliza = '<script language="JavaScript" type="text/javascript" src="'.XOOPS_URL.$path.'"></script>';
          } else {
              $eliza = '<script language="JavaScript" type="text/javascript">'.$chat_datas.'</script>';
          }
          $block['eliza'] = $eliza;

       
/* ####################################################################### */
/*                            Generate datas for akali chatbot             */
/* ####################################################################### */
          include_once(XOOPS_ROOT_PATH . "/modules/chatbot/include/akali_content.php");
          $path = '/'.$bot_directory.'block_akali_' . $botid . '.js';

          if( function_exists('fopen') ) {
              chatbot_create_jscontent( XOOPS_ROOT_PATH.$path, $file_content);
              $akali = '<script language="JavaScript" type="text/javascript" src="'.XOOPS_URL.$path.'"></script>';
          } else {
              $akali = '<script language="JavaScript" type="text/javascript">'.$file_content.'</script>';
          }
          
          $block['akali'] = $akali;


/* ####################################################################### */
/*                 Generate Eliza chat datas for chatbot                   */
/* ####################################################################### */
/*
$sql = "SELECT user, bot
        FROM ".$xoopsDB->prefix( $module . "_chat")."
        WHERE status = 1";
$result = $xoopsDB->queryF($sql);

         $chat_datas = 'var patterns= new Array (';

while(list( $user,
            $bot ) = $xoopsDB->fetchRow($result))
{
         $chitchat = ereg_replace("\|", "\",\"", trim($bot) );

         $chat_datas .= '
new Array ("'. trim($user) . '",
"' . $chitchat .'"),
';

}
          $chat_datas = substr($chat_datas, 0, -3).'
          );';
          $target = XOOPS_ROOT_PATH.'/'.$bot_directory.'/chat_block_' . $botid . '.js';
          chatbot_create_jscontent( $target, $chat_datas);
          $block['eliza'] =      XOOPS_URL.'/'.$bot_directory.'chat_block_' . $botid . '.js';
*/
/* ####################################################################### */
/*                            Generate datas for chatbot                   */
/* ####################################################################### */
/*
$sql = "SELECT pref_or, pref_and, pref_misc, reply, question
        FROM ".$xoopsDB->prefix( $module . "_content")."
        WHERE ($where) AND status = 1
        ORDER BY catid ASC";
$result = $xoopsDB->queryF($sql);

         $convo_datas = '';
         $tics = explode('|', $tic);

while(list( $pref_or,
            $pref_and,
            $pref_misc,
            $reply,
            $question ) = $xoopsDB->fetchRow($result))
{

          if ( $pref_or ) {      $convo_datas .= chatbot_data_explode($pref_or,   '*', ' '); }
          if ( $pref_and ) {     $convo_datas .= chatbot_data_explode($pref_and, '&', ' '); }
          if ( $pref_misc ) {    $convo_datas .= chatbot_data_explode($pref_misc,     '', ' '); }
          if ( $reply )    {
                                 $tic_rand = array_rand($tics,1);
                                 $tic_tag['{TIC}'] = $tics[$tic_rand];
                                 $convo_datas .= '
 "!' . chatbot_data_tag_replace($reply, $tic_tag) . '",
 '; }
          if ( $question ) {     $convo_datas .= '
 ">' . chatbot_data_tag_replace($question, $tic_tag) . '",
 '; }

 }
 $datas =  "wordList = new Array(".chatbot_data_tag_replace(substr($convo_datas, 0, -4), $tag).");
 ";
// $block['datas'] =   $datas ;

 if ( !$dumb ) { $dumb = chatbot_getmoduleoption('chatbot_talkDumb'); }
 $talkDumb = "talkDumb = new Array(".chatbot_data_tag_replace(substr(chatbot_data_explode($dumb), 0, -1), $tag).");
 ";
// $block['talkDumb'] =   $talkDumb;

 if ( !$zero ) { $zero = chatbot_getmoduleoption('chatbot_talkZero'); }
 $talkZero = "talkZero = new Array(".chatbot_data_tag_replace(substr(chatbot_data_explode($zero), 0, -1), $tag).");
 ";
// $block['talkZero'] =   $talkZero;

 $file_content = $datas.$talkDumb.$talkZero;
 $target = XOOPS_ROOT_PATH.'/'.$bot_directory.'/content_block_' . $botid . '.js';

 chatbot_create_jscontent( $target, $file_content);
 $block['akali'] =      XOOPS_URL.'/'.$bot_directory.'content_block_' . $botid . '.js';

*/

 $block['botid'] =       $botid;
 $begins = explode('|', $begin);
 $begin = array_rand($begins,1);
 $block['beginPhrase'] =    chatbot_data_tag_replace($begins[$begin], $tag) ;

/*
 if ( !$end ) { $end = chatbot_getmoduleoption('chatbot_endPhrase'); }
 $ends = explode('|', $end);
 $end = array_rand($ends, 1);
 $end = chatbot_data_tag_replace($ends[$end], $tag) ;
// $block['endPhrase'] =      chatbot_data_tag_replace($ends[$end], $tag) ;
*/

/* ####################################################################### */
/*                            Return data to template                      */
/* ####################################################################### */

   return $block;
   unset($block);
}

function a_chatbot_content_edit($options)
{
	global $xoopsDB;
	$myts =& MyTextSanitizer::getInstance();
	$i = 0;
	$lst='';
	$module = 'chatbot';
	
		$sql = "SELECT botid, bot_name FROM ".$xoopsDB->prefix($module.'_bot')." 
                         WHERE status > 0
                         ORDER BY bot_name ASC";
	$result = $xoopsDB->queryF($sql);
	while( $myrow = $xoopsDB->fetchArray($result) )
	{
		$selected='';
		if($myrow["botid"] == $options[0])
		{
			$selected=" selected ";
		}
		$lst.="<option value='" . $myrow["botid"] . "'" . $selected . ">" . $myrow["bot_name"] . "</option>";
	}

/* ########################## Content selection ################### */
        $form = '<br />'._MB_CHATBOT_SELECT.'&nbsp;<select name="options['.$i.']">';

	$form.= $lst;

        $form.= '</select><p />';
        
/* ########################## Chat box size ################## */
    $i++;
        $form.= _MB_CHATBOT_CHATSIZE . '<input type="text" size="10" name="options['.$i.']" value="' . $options[$i] . '" /><p />';
        
/* ########################## Pic Def size ################### */
    $i++;
        $form.= _MB_CHATBOT_PICSIZE . '<input type="text" size="10" name="options['.$i.']" value="' . $options[$i] . '" /><p />';


/* ########################## Title display ################### */
/*        $i++;
	$form .= _MB_MB_CHATBOT_SHOWTITLE."&nbsp;<input type='radio' id='options[".$i."]' name='options[".$i."]' value='1'";
	if ( $options[$i] == 1 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._YES."&nbsp;<input type='radio' id='options[".$i."]' name='options[".$i."]' value='0'";
	if ( $options[$i] == 0 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._NO."<br />";

/* ########################## Logo display ################### */
/*        $i++;
	$form .= _MB_MB_CHATBOT_SHOWLOGO."&nbsp;<input type='radio' id='options[".$i."]' name='options[".$i."]' value='1'";
	if ( $options[$i] == 1 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._YES."&nbsp;<input type='radio' id='options[".$i."]' name='options[".$i."]' value='0'";
	if ( $options[$i] == 0 ) {
		$form .= " checked='checked'";
	}
	$form .= " />&nbsp;"._NO."";

/* ########################## Media display ################### */
/*        $i++;
        $form.= '<br />'._MB_MB_CHATBOT_MEDIA_DISPLAY.'&nbsp;<select name="options['.$i.']">';

        $form.= '<option value=""';
        if ($options[$i] == "") {
                $form .= ' selected="selected"';
        }
        $form.= '></option>';

        $form.= '<option value="popup"';
        if ($options[$i] == "popup") {
                $form .= ' selected="selected"';
        }
        $form.= '>'._MB_MB_CHATBOT_SELECT_POPUP.'</option>';

        $form.= '<option value="page"';
        if ($options[$i] == "page") {
                $form .= ' selected="selected"';
        }
        $form.= '>'._MB_MB_CHATBOT_SELECT_PAGE.'</option>';

        $form.= '<option value="both"';
        if ($options[$i] == "both") {
                $form .= ' selected="selected"';
        }
        $form.= '>'._MB_MB_CHATBOT_SELECT_BOTH.'</option>';
        $form.= '</select>';
*/
	return $form;
}
?>