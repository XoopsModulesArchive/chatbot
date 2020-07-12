<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/


function a_chatbot_menu_show($options) {

      global $xoopsDB, $xoopsUser;
	$myts 	=& MyTextSanitizer::getInstance();
	$module = "chatbot";
	include_once (XOOPS_ROOT_PATH. "/modules/".$module."/include/functions_block.php");
        include_once (XOOPS_ROOT_PATH. "/modules/".$module."/include/functions_chatbot_index.php");
        $group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS);
/* ####################################################################### */
/*                            Query settings                               */
/* ####################################################################### */
// Check wether there is a bot

          $sql = "SELECT botid, bot_name, bot_description, bot_directory, bot_image, topics, groups
                  FROM " . $xoopsDB->prefix( $module . '_bot' )."
                  WHERE status = 1
                  ORDER BY bot_name ASC";
   // Count available bots

  $numrows = $xoopsDB->getRowsNum($xoopsDB->query($sql));

   	if( !$numrows )
	{
		return '';
		exit();
	}

/* ####################################################################### */
/*                            Variables settings                           */
/* ####################################################################### */
	$perpage     = chatbot_getmoduleoption('chatbot_perpage');
	$image_size = explode('-', $options[1]);
	$ii = 1;

  $block = array();
  	$block['display_mode']     = $options[0];
  	if($numrows<$options[2])  $options[2] = $numrows;
        $block['width']            = round(100/$options[2],1);
        $block['columns']          = $options[2];
	$block['lang_num']         = _MB_CHATBOT_NUM;
	$block['lang_name']        = _MB_CHATBOT_NAME;
        $block['lang_topics']      = _MB_CHATBOT_TOPICS;
        $block['lang_description'] = _MB_CHATBOT_DESCRIPTION;

/* ############################ Readmore link ########################## */
if ( $numrows > $perpage ) {
  $block['readmore'] = '   <div style="text-align:right; padding:6px;">
                           <a href="'.XOOPS_URL.'/modules/'.$module.'/">
                           '._MB_CHATBOT_SEEMORE.'
                           </a>
                           </div>';
                           }

/* ####################################################################### */
/*                            Create each and every bot                    */
/* ####################################################################### */

$result = $xoopsDB->queryF($sql, $perpage, 0);
while( list( $botid, $bot_name, $bot_description, $bot_directory, $bot_image, $topics, $groups ) = $xoopsDB->fetchRow($result)  )
{
  
           $groups = explode(" ",$groups);
         if (count(array_intersect($group,$groups)) > 0)
         {
/* ############################ Categories display ###################### */
if( $options[0] == 'ext' ){
    $where   = substr(eregi_replace(' ', ' OR catid = ', $topics), 4);
    $topic_sql = "SELECT cat_subject
                  FROM ".$xoopsDB->prefix( $module . "_topics")."
                  WHERE ($where) AND status > 1
                  ORDER BY cat_subject ASC";

    $topic_result = $xoopsDB->queryF( $topic_sql );
    $topic_list = '<table cellpading="0" cellspacing="0"><tr><td><ul>';
    $i = 1;
    while( list( $cat_subject ) = $xoopsDB -> fetchrow( $topic_result ) )
          { $i++;
            $topic_list .= '<li>' . $cat_subject . '</li>';
            if($i > $perpage) { $topic_list .= '</ul></td><td></ul>'; $i = 1;}
          }
            $topic_list .= '</ul></td></tr></table>';
            $data['topics']                = $topic_list;
}
/* ############################ Image and link display ###################### */
                 $link = '';
                 $link_url = XOOPS_URL.'/modules/'.$module.'/bot.php?id='.$botid;
                 $alt_description = $myts -> AddSlashes(strip_tags($bot_description));

            if ( $bot_image ) {
                 $logo_url =  XOOPS_URL . '/'. $bot_directory . $bot_image;
            } else {
                 $logo_url =  '';
            }

            if ( $options[0] == 'pic' || $options[0] == 'ext'  ) {
                 $image_link = chatbot_createlink($link_url, $bot_name, '', $logo_url, 'center', trim($image_size[0]), trim($image_size[1]), $alt_description);
            } else {
                 $image_link = chatbot_createlink($link_url, '', '', $logo_url, 'center', trim($image_size[0]), trim($image_size[1]), $alt_description);
                 $link       = chatbot_createlink($link_url, $bot_name, '', '', '', '', '', $alt_description);
            }

/* ############################ Send to template ########################## */
                  $data['link']                  = $link;
                  $data['image_link']            = $image_link;
                  $data['bot_name']              = $bot_name;
                  $data['alt_description']       = $alt_description;
                  $data['link_url']              = $link_url;
                  $data['description']           = $bot_description;
                  $data['count']                 = $ii++;
                  //Render results
	          $block['bots'][]               = $data;
 } // Groups
}// While
      return $block;
      unset ($block);
}


function a_chatbot_menu_edit($options) {
  $i = 0;
//        $form = '<table class="outer"><tr class="odd"><td>';
  /* ########################## Display mode ################### */
        $form = _MB_CHATBOT_FORMAT.'&nbsp;<select name="options[]">';
        
        $form.= '<option value="menu"';
        if ($options[$i] == "menu") {
                $form .= ' selected="selected"';
        }
        $form.= '>'._MB_CHATBOT_MENU.'</option>';

        $form.= '<option value="list"';
        if ($options[$i] == "list") {
                $form .= ' selected="selected"';
        }
        $form.= '>'._MB_CHATBOT_LIST.'</option>';

        $form.= '<option value="pic"';
        if ($options[$i] == "pic") {
                $form .= ' selected="selected"';
        }
        $form.= '>'._MB_CHATBOT_PIC.'</option>';

                $form.= '<option value="ext"';
        if ($options[$i] == "ext") {
                $form .= ' selected="selected"';
        }
        $form.= '>'._MB_CHATBOT_EXT.'</option>';

        $form.= '</select><p />';

/* ########################## Pic Def size ################### */
//        $form .= '</td><td>';
    $i++;
        $form.= _MB_CHATBOT_PICSIZE . '<input type="text" size="10" name="options['.$i.']" value="' . $options[$i] . '" /><p />';

/* ########################## Columns ################### */
//        $form .= '</td></tr><tr class="even"><td>';
    $i++;
        $form.= _MB_CHATBOT_COLUMNS.'&nbsp;<select name="options['.$i.']">';

        $form.= '<option value="1"';
        if ($options[$i] == "1") {
                $form .= ' selected="selected"';
        }
        $form.= '>1</option>';

        $form.= '<option value="2"';
        if ($options[$i] == "2") {
                $form .= ' selected="selected"';
        }
        $form.= '>2</option>';

        $form.= '<option value="3"';
        if ($options[$i] == "3") {
                $form .= 'selected="selected"';
        }
        $form.= '>3</option>';

        $form.= '<option value="4"';
        if ($options[$i] == "4") {
                $form .= 'selected="selected"';
        }
        $form.= '>4</option>';
        $form.= '</select>';
        
//        $form.= '</select>';
//        $form .= '</td></tr></table>';

	return $form;
}
?>