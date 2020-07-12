<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

//InfoModule
$modversion['name'] = _MI_CHATBOT_NAME;
$modversion['version'] = 1.0;
$modversion['description'] = _MI_CHATBOT_DSC;
$modversion['credits'] = "http://www.wolfpackclan.com";
$modversion['author'] = "Solo";
$modversion['license'] = "GPL";
$modversion['image'] = "images/chatbot_slogo.png";
$modversion['dirname'] = "chatbot";


//SQL
$i = 0;
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][$i++] = "chatbot_content";
$modversion['tables'][$i++] = "chatbot_eliza";
$modversion['tables'][$i++] = "chatbot_topics";
$modversion['tables'][$i++] = "chatbot_bot";
$modversion['tables'][$i]   = "chatbot_report";

//Menu
$modversion['hasMain'] = 1;
// Display menu pages list
global $xoopsDB, $xoopsModule, $xoopsUser;
if ( $xoopsModule && $xoopsModule -> getVar( 'dirname' ) == $modversion['dirname'] ) {

$i = 0 ;
$sql    ="SELECT botid, bot_name, bot_description, bot_directory, bot_image, groups
          FROM ".$xoopsDB->prefix( $modversion['dirname'] . "_bot" )."
          WHERE status > 0
          ORDER BY bot_name ASC";
$result = $xoopsDB->queryF($sql, 5, 0 );
$group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
while( list( $botid, $bot_name, $bot_description, $bot_directory, $bot_image, $groups ) = $xoopsDB->fetchRow($result) )
       {
         $groups = explode(" ",$groups);
         if (count(array_intersect($group,$groups)) > 0)
         {
           if($bot_image) { $botimage = '<img src="' . XOOPS_URL . '/' . $bot_directory . $bot_image . '" align="absmiddle" width="20" alt="' . strip_tags($bot_description) . '"/>&nbsp;'; } else { $botimage = ''; }
          $modversion['sub'][$i]['name'] = $botimage.$bot_name ;
          $modversion['sub'][$i++]['url'] = 'bot.php?id=' . $botid . '" title="' . strip_tags($bot_description) . '"' ;
          } // Groups
       } // While
}  // Active module

//Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Templates
$i=1;
$modversion['templates'][$i]['file'] = 'chatbot_header.html';
$modversion['templates'][$i]['description'] = "";
$i++;
$modversion['templates'][$i]['file'] = 'chatbot_index.html';
$modversion['templates'][$i]['description'] = "";
$i++;
$modversion['templates'][$i]['file'] = 'chatbot_bot.html';
$modversion['templates'][$i]['description'] = "";
$i++;
$modversion['templates'][$i]['file'] = 'chatbot_media.html';
$modversion['templates'][$i]['description'] = "";
$i++;
$modversion['templates'][$i]['file'] = 'chatbot_footer.html';
$modversion['templates'][$i]['description'] = "";
$i++;
$modversion['templates'][$i]['file'] = 'blocks/chatbot_menu_block.html';
$modversion['templates'][$i]['description'] = "";
$i++;
$modversion['templates'][$i]['file'] = 'blocks/chatbot_content_block.html';
$modversion['templates'][$i]['description'] = "";

// Blocks
$i=1;
$modversion['blocks'][$i]['file'] = "content.php";
$modversion['blocks'][$i]['name'] = _MI_CHATBOT_NAME_CONTENT;
$modversion['blocks'][$i]['description'] = "";
$modversion['blocks'][$i]['show_func'] = 'a_chatbot_content_show';
$modversion['blocks'][$i]['edit_func'] = 'a_chatbot_content_edit';
$modversion['blocks'][$i]['options'] = '1|18-12|120-120';
$modversion['blocks'][$i]['template'] = 'chatbot_content_block.html';
$i++;
$modversion['blocks'][$i]['file'] = "menu.php";
$modversion['blocks'][$i]['name'] = _MI_CHATBOT_NAME_MENU;
$modversion['blocks'][$i]['description'] = "";
$modversion['blocks'][$i]['show_func'] = 'a_chatbot_menu_show';
$modversion['blocks'][$i]['edit_func'] = 'a_chatbot_menu_edit';
$modversion['blocks'][$i]['options'] = 'pic|120-120|1';
$modversion['blocks'][$i]['template'] = 'chatbot_menu_block.html';

// Options
$i=1;
$modversion['config'][$i]['name'] = 'chatbot_banner';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_INDEX_BANNER';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_INDEXDSC_BANNER';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'images/module_banner.gif';
$i++;
$modversion['config'][$i]['name'] = 'chatbot_text';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_TEXTINDEX';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_TEXTINDEXDSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_CHATBOT_WELCOME;
$i++;
$modversion['config'][$i]['name'] = 'chatbot_list';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_BOT_LIST';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_BOT_LISTDSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'tab';
$modversion['config'][$i]['options'] = array( '_MI_CHATBOT_LIST_NONE' =>      'none',
                                              '_MI_CHATBOT_LIST_SELECT' =>    'select',
                                              '_MI_CHATBOT_LIST_SELECTBOX' => 'box',
                                              '_MI_CHATBOT_LIST_LIST' =>      'list',
                                              '_MI_CHATBOT_LIST_ALIGN' =>     'tab' );
$i++;
$modversion['config'][$i]['name'] = 'chatbot_perpage';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_PERPAGE';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_PERPAGEDSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 6;
$modversion['config'][$i]['options'] = array( '6' => 6,
                                              '10' => 10, 
                                              '16' => 16,
                                              '20' => 20, 
                                              '26' => 26,
                                              '30' => 30, 
                                              '50' => 50 );
$i++;
$modversion['config'][$i]['name'] = 'chatbot_size';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_SIZE';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_SIZEDSC';
$modversion['config'][$i]['formtype'] = 'textbox';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = '800|800|50|4';
$i++;
$modversion['config'][$i]['name'] = 'chatbot_typewriter';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_TYPEWRITER';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_TYPEWRITERDSC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 20;
$modversion['config'][$i]['options'] = array( '_MI_CHATBOT_TPW_INSTANT' => 0,
                                              '_MI_CHATBOT_TPW_FAST' => 20,
                                              '_MI_CHATBOT_TPW_NORMAL' => 50,
                                              '_MI_CHATBOT_TPW_SLOW' => 100 );
$i++;
$modversion['config'][$i]['name'] = 'chatbot_autoclick';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_AUTOCLICK';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_AUTOCLICKDSC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 0;
$i++;
$modversion['config'][$i]['name'] = 'chatbot_talkDumb ';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_DATA_DUMB';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_DATA_DUMBDSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_CHATBOT_DATAS_DUMB;
$i++;
$modversion['config'][$i]['name'] = 'chatbot_talkZero';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_DATA_ZERO';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_DATA_ZERODSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_CHATBOT_DATAS_ZERO;
$i++;
$modversion['config'][$i]['name'] = 'chatbot_beginPhrase';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_DATA_BEGIN';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_DATA_BEGINDSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_CHATBOT_DATAS_BEGIN;
$i++;
$modversion['config'][$i]['name'] = 'chatbot_endPhrase';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_DATA_END';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_DATA_ENDDSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_CHATBOT_DATAS_END;
/*
$i++;
$modversion['config'][$i]['name'] = 'chatbot_site_report';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_SITEREPORT';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_SITEREPORTDSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'chatbot who,chatbot_bot,bot_name,status=1|chabots count,chatbot_bot,count(*),status=1';
*/
$i++;
$modversion['config'][$i]['name'] = 'chatbot_footer';
$modversion['config'][$i]['title'] = '_MI_CHATBOT_FOOTER';
$modversion['config'][$i]['description'] = '_MI_CHATBOT_FOOTERDSC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = _MI_CHATBOT_FOOTERTEXT;
?>