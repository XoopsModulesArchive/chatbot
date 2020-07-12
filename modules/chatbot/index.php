<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

// General settings
include_once("header.php");
$xoopsOption['template_main'] = 'chatbot_index.html';
include_once XOOPS_ROOT_PATH . '/header.php';

$myts =& MyTextSanitizer::getInstance();
$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
// Redirection

// Language files
$xoopsTpl->assign("lang_image",        _CHATBOT_IMAGE);
$xoopsTpl->assign("lang_name",         _CHATBOT_NAME);
$xoopsTpl->assign("lang_topics",       _CHATBOT_TOPICS);
$xoopsTpl->assign("lang_description",  _CHATBOT_DESCRIPTION);

$xoopsTpl->assign("display",  _CHATBOT_DISPLAY);
$xoopsTpl->assign("hide",     _CHATBOT_HIDE);
$xoopsTpl->assign("report",   _CHATBOT_REPORT);
$xoopsTpl->assign("topics",   _CHATBOT_TOPICS);
$xoopsTpl->assign("historic", _CHATBOT_HISTORIC);
$xoopsTpl->assign("module_name", $xoopsModule -> getVar( 'name' ));







/* ####################################################################### */
/*                            Bots                                         */
/* ####################################################################### */
// Count available bots
       $sql = "SELECT count(botid)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_bot' );
        list( $total ) = $xoopsDB -> fetchRow( $xoopsDB->queryF( $sql ) );
        
        include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;
        $pagenav = new XoopsPageNav( $total, $xoopsModuleConfig['chatbot_perpage'], $startart, 'startart' );
        $xoopsTpl->assign("pagenav", $pagenav -> renderNav());


// Bots datas
          $sql = "SELECT botid, bot_name, bot_description, bot_directory, bot_image, topics, groups
                  FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_bot' )."
                  WHERE status = 1
                  ORDER BY bot_name ASC";
                  

          $result = $xoopsDB->queryF( $sql, $xoopsModuleConfig['chatbot_perpage'], $startart  );

        $ii = $startart+1;
while ( list( $botid , $bot_name, $bot_description, $bot_directory, $bot_image, $topics, $groups ) = $xoopsDB -> fetchrow( $result ) ) {
         $groups = explode(" ",$groups);
         if (count(array_intersect($group,$groups)) > 0)
         {

// Cat datas
$topics   = eregi_replace('Eliza ', '', $topics);
$where   = substr(eregi_replace(' ', ' OR catid = ', $topics), 4);
$redirect_id = $botid;
$topic_list = '';
if($where) {
$topic_sql = "SELECT cat_subject
        FROM ".$xoopsDB->prefix( $xoopsModule->dirname() . "_topics")."
        WHERE ($where) AND status > 1
        ORDER BY cat_subject ASC";

        $topic_result = $xoopsDB->queryF( $topic_sql );
// $total_topics = count( $topic_result );
$total_topics = 8; $i=1; $active_topic_count=0;
$topic_list .= '<table cellpading="0" cellspacing="0"><tr><td><ul>';

while( list( $cat_subject ) = $xoopsDB -> fetchrow( $topic_result ) )
      { $i++; $active_topic_count++;
        $topic_list .= '<li>' . $cat_subject . '</li>';
        if($i > $total_topics/2) { $topic_list .= '</ul></td><td><ul>'; $i = 1;}
      }
        $topic_list .= '</ul></td></tr></table>';
}

if(!$active_topic_count) {  $topic_list = ''; }
  /*
    $link_url='',
                             $title='', 
                             $target='_self', 
                             $image_url='', 
                             $image_align='center', 
                             $image_max_width='800', 
                             $image_max_height='600', 
                             $alt_title=''
  */
       $image              = XOOPS_URL . '/' . $bot_directory . $bot_image;
       $bot['count']       = $ii++;
       $bot['topics']      = $topic_list;
       $bot['name']        = chatbot_createlink('bot.php?id='.$botid, $bot_name, '', $image, 'center', '160', '160', $bot_description );
       $bot['description'] = $bot_description;
       $bot['botid']       = $botid;
        
        $xoopsTpl->append('bots', $bot);
        unset($bot);
                  }// Groups
} // While


// Redirect if there is only one bot
if( $total == 1 OR $ii == 2 ) { header ("location: bot.php?id=".$redirect_id ); exit(); }







/* ####################################################################### */
/*                            Banner                                       */
/* ####################################################################### */
if ( eregi('.swf', $xoopsModuleConfig['chatbot_banner']) ) {
$banner = '<object
				classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
				codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/ swflash.cab#version=6,0,40,0" ;="" 
				height="60"
				width="468">
<param  name="movie"
			  value="' . trim($xoopsModuleConfig['chatbot_banner']) . '">
<param name="quality" value="high">
<embed src="' . trim($xoopsModuleConfig['chatbot_banner']) . '" 
			 quality="high" 
			 pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" ;="" 
			 type="application/x-shockwave-flash" 
			 height="60" 
			 width="468">
</object>';
} elseif ( $xoopsModuleConfig['chatbot_banner'] ) {
$banner = '<img src="'.$xoopsModuleConfig['chatbot_banner'].'" alt="' . $xoopsModule -> getVar( 'name' ) . '" />';
} else {
$banner = '';}
$xoopsTpl->assign("banner",   $banner);

//Affiche le texte d'introduction
      $xoopsTpl->assign("textindex", $myts->makeTareaData4Show($xoopsModuleConfig['chatbot_text']));


/* ####################################################################### */
/*                            Footer                                       */
/* ####################################################################### */
if ($xoopsModuleConfig['chatbot_footer']) {
 $footer = $xoopsModuleConfig['chatbot_footer'];
 } else {
 $footer = '';}
$xoopsTpl->assign("footer", $footer);


/* ####################################################################### */
/*                            Create admin links                           */
/* ####################################################################### */
   if ( $xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid()) ) {
     include_once( 'include/functions_chatbot.php' );
        $adminlink = '<nobr>'.
        chatbot_selector('', 'chatbot_bot|botid|bot_name|||',           'admin/bots.php?op=mod&botid',   _CHATBOT_EDIT_BOT).
        chatbot_selector('', 'chatbot_topics|catid|cat_subject|||',     'admin/topics.php?op=mod&catid', _CHATBOT_EDIT_TOPIC).
        chatbot_selector('', 'chatbot_topics|catid|cat_subject|||',     'admin/content.php?catid',       _CHATBOT_EDIT_AKALI).
        chatbot_selector('', 'chatbot_eliza|type|type|||GROUP BY type', 'admin/eliza.php?type',          _CHATBOT_EDIT_ELIZA).
        chatbot_selector('', 'chatbot_report|id|date|||GROUP BY date',  'admin/reports.php?op=mod&id',   _CHATBOT_EDIT_REPORT).
        '</nobr><br />';
	$adminlink .= "        <a href='admin/index.php'>
                              <img src='images/icon/edit.gif' alt='"._CHATBOT_ADMIN."' /></a> |
                              <a href='admin/utilities.php'>
                              <img src='images/icon/utilities.gif' alt='"._CHATBOT_UTILITIES."' /></a> |
                              <a href='../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=" . $xoopsModule->getVar('mid'). "'>
                              <img src='images/icon/settings.gif' alt='"._CHATBOT_SETTINGS."' /></a>";
   }else{

	$adminlink = '';
   }
   $xoopsTpl->assign("adminlink", $adminlink);

include_once(XOOPS_ROOT_PATH."/footer.php");
?>

