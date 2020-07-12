<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

// General settings
include_once("header.php");
$xoopsOption['template_main'] = 'chatbot_bot.html';
include_once(XOOPS_ROOT_PATH."/header.php");
include_once( 'include/functions_chatbot.php' );
$myts =& MyTextSanitizer::getInstance();
$botid = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ( isset( $_POST['rec_convo'] ) ) { $rec_convo = $_POST['rec_convo']; } else { $rec_convo = ''; }
if ( isset( $_POST['rec_reply'] ) ) { $rec_reply = $_POST['rec_reply']; } else { $rec_reply = ''; }


// Module Banner
$banner = '';
if ( eregi('.swf', $xoopsModuleConfig['chatbot_banner']) ) {
$banner = '<object
				classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
				codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/ swflash.cab#version=6,0,40,0" ;="" 
				height="60"
				width="468">
<param  name="banner"
			  value="' . trim($xoopsModuleConfig['chatbot_banner']) . '">
<param name="quality" value="high">
<embed src="' . trim($xoopsModuleConfig['chatbot_banner']) . '" 
			 quality="high" 
			 pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" ;="" 
			 type="application/x-shockwave-flash" 
			 height="60" 
			 width="468">
</object>';
$banner = '<a href="./">'.$banner.'</a>';
} elseif ( $xoopsModuleConfig['chatbot_banner'] ) {
$banner = '<img src="'.$xoopsModuleConfig['chatbot_banner'].'" alt="' . $xoopsModule -> getVar( 'name' ) . '" />';
$banner = '<a href="./">'.$banner.'</a>';
}

if ( $xoopsModuleConfig['chatbot_list']=='tab') {
  $rows=6;
  $banner .= chatbot_selector( $botid,
                               'chatbot_bot|botid|bot_name||groups|WHERE status=1',
                               'bot.php?id',
                               $xoopsModule -> getVar( 'name' ),
                               $xoopsModuleConfig['chatbot_list'],
                               $rows, 'self' );
                                }
$xoopsTpl->assign("banner",   $banner);

// Language files
$xoopsTpl->assign("display",  _CHATBOT_DISPLAY);
$xoopsTpl->assign("hide",     _CHATBOT_HIDE);
$xoopsTpl->assign("report",   _CHATBOT_REPORT);
$xoopsTpl->assign("notice",          _CHATBOT_NOTICE);
$xoopsTpl->assign("illustrations",   _CHATBOT_ILLUSTRATIONS);
$xoopsTpl->assign("topics",          _CHATBOT_TOPICS);
$xoopsTpl->assign("topic_info",      _CHATBOT_TOPIC_INFO);
$xoopsTpl->assign("historic",        _CHATBOT_HISTORIC);
$xoopsTpl->assign("see_page",        _CHATBOT_SEE_PAGE);
$yes_array = explode( '|',           _CHATBOT_DATAS_YES);

// Bots datas
$sql = "SELECT *
        FROM ".$xoopsDB->prefix( $xoopsModule->dirname() . "_bot")."
        WHERE botid = $botid AND status = 1";
$result = $xoopsDB->queryF( $sql );

list( $botid,               $status,
      $bot_name,            $bot_description,
      $bot_image,           $bot_directory,    $bot_background,
      $text_color,          $topics,
      $begin,               $dumb,           $zero,                $end,
      $groups
                             ) = $xoopsDB -> fetchrow( $result );
                             
                             
if( !$bot_name ) {
    			header ("location: index.php" );
			exit();
                 };

// Group access
$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
$groups = explode(" ",$groups);
if (count(array_intersect($group,$groups)) <= 0)
{
	redirect_header("index.php",1,_NOPERM);
	exit();
}


// Topics datas
   $is_eliza = 0;$ii=0;
      if( strstr($topics,'Eliza') ) { $topics = eregi_replace('Eliza', '', $topics); $is_eliza = 1;}
      $where   = eregi_replace(' ', ' OR catid=', trim($topics));
if($where) {
$sql = "SELECT cat_subject, cat_description
        FROM ".$xoopsDB->prefix( $xoopsModule->dirname() . "_topics")."
        WHERE (catid=$where) AND status > 1
        ORDER BY cat_subject ASC";
        $result = $xoopsDB->queryF( $sql );
        $topic_list='';

$topic_list .= '<ul>';
while( list( $cat_subject, $cat_description ) = $xoopsDB -> fetchrow( $result ) )
      { $ii++;
        $topic_list .= '<li><b>' . $cat_subject . '</b><br />'.$cat_description.'</li>';
      }
        $topic_list .= '</ul>';
}
if(!$ii) {$topic_list= _CHATBOT_NOTOPICS;}

$xoopsTpl->assign("topic_list", $myts->makeTareaData4Show($topic_list));

//Affiche le nom du module et le texte d'introduction
 if ( !$dumb ) { $dumb = $xoopsModuleConfig['chatbot_talkDumb']; }
 if ( !$zero ) { $zero = $xoopsModuleConfig['chatbot_talkZero']; }
 if ( !$end ) { $end = $xoopsModuleConfig['chatbot_endPhrase']; }
if($bot_description) { $xoopsTpl->assign("textindex", $myts->makeTareaData4Show($bot_description));
                     }else {
                       $xoopsTpl->assign("textindex", $myts->makeTareaData4Show($xoopsModuleConfig['chatbot_text']));
                     }

// Afficher le nom du bot
$tag = chatbot_user_tags(); // Retrieve user datas, for tag use
if( !$bot_name ) { $bot_name = $xoopsModule -> getVar( 'name' ); }
    $xoopsTpl->assign('bot_name', $bot_name);
    $xoopsTpl->assign('username', $tag['{USERNAME}']);
    $xoopsTpl->assign('botid',     $botid);
    $xoopsTpl->assign('lg_topics', _CHATBOT_TOPICS);
    $xoopsTpl->assign('instructions',  sprintf(_CHATBOT_DATA_INFOS, $bot_name, $yes_array[0]));

// Module Background
// Index display options
$default_size = explode('|', $xoopsModuleConfig['chatbot_size']);
$bot_background = explode('|', $bot_background);
// Images
   $index_background = '../../'.$bot_directory.$bot_background[0];
   $text_background = '../../'.$bot_directory.$bot_background[1];
   $background_size = @getimagesize( XOOPS_ROOT_PATH.'/'.$bot_directory.$bot_background[0] );
if ( !isset($background_size[0]) || $background_size[0] < $default_size[0] ) { $background_size[0] = $default_size[0]; }
if ( !isset($background_size[1]) || $background_size[1] < $default_size[1] ) { $background_size[1] = $default_size[1]; }
if( isset($bot_background[4]) ) { $bot_mail=explode(' ',trim($bot_background[4]) ); } else { $bot_mail = ''; }
   $xoopsTpl->assign("background_width", $background_size[0]-20);
   $xoopsTpl->assign("background_height", $background_size[1]-20);
   $xoopsTpl->assign("text_width",  $default_size[2]);
   $xoopsTpl->assign("text_height", $default_size[3]);
   $xoopsTpl->assign("index_background", $index_background);
   $xoopsTpl->assign("text_background", $text_background);

// Media
   $index_sound_background='';$text_sound_background='';$is_type='no';
   if ( $bot_background[2] ) { $index_sound_background = '../../'.$bot_directory.$bot_background[2]; $is_type='yes';}
   if ( $bot_background[3] ) { $text_sound_background = '../../'.$bot_directory.$bot_background[3]; }
   $xoopsTpl->assign("index_sound_background", $index_sound_background);
   $xoopsTpl->assign("text_sound_background", $text_sound_background);
   $bot_temp_directory = '../../'.$bot_directory;

if($bot_image) { 
   $botavatar = '../../'.$bot_directory.$bot_image;
   $ext = '.'.pathinfo($bot_image, PATHINFO_EXTENSION);
} else {
   $botavatar = 'images/blank.gif';
   $ext = '.jpg';
  }
   $bot_image = str_replace($ext,'',$bot_image);
   $boticons = chatbot_smilies(XOOPS_ROOT_PATH.'/'.$bot_directory,$ext);
// } else { $botimage = ''; $ext = ''; $boticons='';}
$xoopsTpl->assign("botimage", $botavatar);
$xoopsTpl->assign("ext", $ext);

if ( !$text_color ) { $text_color = $xoopsModuleConfig['chatbot_back_color']; }
$back_color = explode('|', $text_color);
$xoopsTpl->assign("text_color",     $back_color[0]);  // Page text color
$xoopsTpl->assign("back_color",     $back_color[1]);  // Background color
$xoopsTpl->assign("bot_text_color", $back_color[2]);  // Textarea text color
$xoopsTpl->assign("bot_back_color", $back_color[3]);  // Textarea Background color
$xoopsTpl->assign("border_size",    $back_color[4]);  // Border size
$typewriter = $xoopsModuleConfig['chatbot_typewriter'];
$autoclick  = $xoopsModuleConfig['chatbot_autoclick'];
$where_module = '';
/* ####################################################################### */
/*                 Generate Eliza chat datas for chatbot                   */
/* ####################################################################### */
          include_once("include/eliza_content.php");
          $path = '/'.$bot_directory.'eliza_' . $botid . '.js';
          if( function_exists('fopen') ) {
              chatbot_create_jscontent( XOOPS_ROOT_PATH.$path, $chat_datas);
              $eliza = '<script language="JavaScript" type="text/javascript" src="../..'.$path.'"></script>';
          } else {
              $eliza = '<script language="JavaScript" type="text/javascript">'.$chat_datas.'</script>';
          }
          $xoopsTpl->assign('eliza',     $eliza);

       
/* ####################################################################### */
/*                            Generate datas for akali chatbot             */
/* ####################################################################### */
          include_once("include/akali_content.php");
          $path = '/'.$bot_directory.'akali_' . $botid . '.js';

          if( function_exists('fopen') ) {
              chatbot_create_jscontent( XOOPS_ROOT_PATH.$path, $file_content);
              $akali = '<script language="JavaScript" type="text/javascript" src="../..'.$path.'"></script>';
          } else {
              $akali = '<script language="JavaScript" type="text/javascript">'.$file_content.'</script>';
          }
          
          $xoopsTpl->assign('akali',  $akali );


 /////////////////
 // Back up into database, the current conversation
 ////////////////
 if ( substr_count($rec_convo,$bot_name) >= 3 ) {
    if($bot_mail) { chatbot_sendmail ( $bot_mail, $bot_name, $bot_url, $tag['{USERNAME}'], $rec_convo ); }
   $rec_reply = $myts -> AddSlashes($rec_reply);
   $rec_convo = $myts -> AddSlashes($rec_convo);
   $date = time();
   $bot_url = XOOPS_URL.'/modules/chatbot/bot.php?id='.$botid;

		if ( $xoopsDB -> queryF( "INSERT INTO " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_report" ) .
                  " ( id,
                      botid,
                      status,
                      rec_reply,
                      rec_convo,
                      date
                       )
                        VALUES (
                            '',
                            '$botid',
                            '0',
                            '$rec_reply',
                            '$rec_convo',
                            '$date')" ) )
			{
				$begin = _CHATBOT_THANKS_REPORT;
			}
			else
			{
				$begin = _CHATBOT_THANKS_NOREPORT;
			}
 } elseif ( !$begin ) { $begin = $xoopsModuleConfig['chatbot_beginPhrase']; }


   $begins = explode('|', $begin);
   $begin = array_rand($begins,1);
   $begin = $begins[$begin];
   if( is_object($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid()) ) { $report_total = chatbot_summary_report();}
   if($report_total) { $begin = sprintf(_CHATBOT_REPORT_TXT, $report_total); }
 $xoopsTpl->assign("beginPhrase",  chatbot_data_tag_replace($begin, $tag) );
 

/* ####################################################################### */
/*                            Create footer                                */
/* ####################################################################### */
 $footer = '';

if ( $xoopsModuleConfig['chatbot_list']!='none' && $xoopsModuleConfig['chatbot_list']!='tab') {
  if($xoopsModuleConfig['chatbot_list']=='box') { $rows=5;} else { $rows=1;}
  $footer .= chatbot_selector( $botid,
                               'chatbot_bot|botid|bot_name||groups|WHERE status=1',
                               'bot.php?id',
                               $xoopsModule -> getVar( 'name' ),
                               $xoopsModuleConfig['chatbot_list'],
                               $rows, 'self' );
                                }


if ($xoopsModuleConfig['chatbot_footer']) { $footer .= $xoopsModuleConfig['chatbot_footer']; }
$xoopsTpl->assign("footer", $footer);



/* ####################################################################### */
/*                            Create admin links                           */
/* ####################################################################### */
   if ( $xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid()) ) {

        $adminlink = '<nobr>'.
        chatbot_selector($botid, 'chatbot_bot|botid|bot_name|||',       'admin/bots.php?op=mod&botid',   _CHATBOT_EDIT_BOT).
        chatbot_selector('', 'chatbot_topics|catid|cat_subject|||',     'admin/topics.php?op=mod&catid', _CHATBOT_EDIT_TOPIC).
        chatbot_selector('', 'chatbot_topics|catid|cat_subject|||',     'admin/content.php?catid',       _CHATBOT_EDIT_AKALI).
        chatbot_selector('', 'chatbot_eliza|type|type|||GROUP BY type', 'admin/eliza.php?type',          _CHATBOT_EDIT_ELIZA).
        chatbot_selector('', 'chatbot_report|id|date|||GROUP BY date',  'admin/reports.php?op=mod&id',   _CHATBOT_EDIT_REPORT).
         '</nobr><br />';
	$adminlink .= '     <a href="admin/bots.php?op=mod&botid='.$botid.'">
                              <img src="images/icon/edit.gif" alt="'._CHATBOT_ADMIN.'" />
                            </a> |
                            <a href="admin/utilities.php">
                              <img src="images/icon/utilities.gif" alt="'._CHATBOT_UTILITIES.'" />
                            </a> |
                            <a href="../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid'). '">
                              <img src="images/icon/settings.gif" alt="'._CHATBOT_SETTINGS.'" />
                            </a>';
   }else{

	$adminlink = '';
   }



   $xoopsTpl->assign("adminlink", $adminlink);

include_once(XOOPS_ROOT_PATH."/footer.php");
?>

