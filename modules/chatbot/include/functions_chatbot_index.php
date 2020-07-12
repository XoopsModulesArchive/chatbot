<?php
/**
* XOOPS - PHP Content Management System
* Copyright (c) 2004 <http://www.xoops.org/>
*
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (www.wolfpackclan.com/wolfactory)
*	    - DuGris (www.dugris.info)
*/
if (!defined("XOOPS_ROOT_PATH")) { die("XOOPS root path not defined"); }

// Get directory file list
function chatbot_geticonlist($path,$ext)
{
        // Get file list
        
        //Using the opendir function
        $dir_handle = @opendir($path) or die("Unable to open $path");
        
        // Create file array
             $files = array();
        
        //running the while loop
        while ($file = readdir($dir_handle))
        {
              if( eregi($ext, $file) ) {
                  $file = str_replace($ext, '', $file);
                  $files[] = $file; }
         }

        //closing the directory
        closedir($dir_handle);
        Return $files;
}


// Generate files
function chatbot_smilies($path="",$ext='.gif') {
        $icon_list = '';
        $pattern_icons = chatbot_geticonlist($path,$ext);
        $i=0;
        $sep='';
        foreach( $pattern_icons as $icons ) {
          if($i>0) { $sep = ' '; }
          $icon_list .= $sep.$icons;
          $i++;
        }

/*
            if ( eregi($pattern_icon, $icon ) ) {
              $icons_list[] = $pattern_icon;
              break;
            } else {
              $icons_list[] = 'smile';
            }
        }
*/
Return  $icon_list;
}

// Data explode function
function chatbot_data_explode( $datas, 
                               $suffix='', 
                               $separator='|' )
{
	$data = explode($separator, addslashes($datas));
	$ret = '';
     foreach ($data as $data_type) {
        $data_type = preg_replace('#\r\n|\n|\r#', '\n', trim($data_type));
	$ret .= ',
        "'.$suffix. $data_type . '"';
	}
 return $ret;
}

// Tag replacement function
function chatbot_data_tag_replace( $datas, 
                                   $tag )
{ 
 $datas = strtr($datas, $tag);
  return $datas;
}

function chatbot_createlink( $link_url='', 
                             $title='', 
                             $target='_self', 
                             $image_url='', 
                             $image_align='center', 
                             $image_max_width='800', 
                             $image_max_height='600', 
                             $alt_title='' )
{
 // Initiate variables
            $image = '';
            $br = '';
            $align = '';
            $align_in = '';
            $align_out= '';
            $link = '';
            $a = ''; 
            $link_target = '';
            
 // Create link

          if ( $link_url ) {
               if ( !eregi('self', $target) AND $target )
                  {
                    if( !substr($target, 0, 1) == '_' ) { $target = '_'.$target; }
                    $link_target = 'target="'.$target.'" ';
                  }

                    $link = '<a href="'.$link_url.'" '.$link_target.'title="'.htmlentities(strip_tags($alt_title)).'">';
                    $a    = '</a>';
               }

 // Create image
 if ( $image_url ) {

           $image_size = @getimagesize( $image_url );

    if ( $image_size ) {

              if ( $image_size[1] > $image_max_height ) {
                   $height = 'height="' . $image_max_height . '" ';
              } else { $height  = ''; }

              if ( $image_size[0] > $image_max_width )  {
                   $width = 'width="' . $image_max_width . '" ';
                   $height= '';
              } else { $width  = ''; }

              if ( $image_align == 'center' ) {
                   $br = '<br />';
                   $align_in = '<div style="text-align:center;">';
                   $align_out= '</div>';
              } else { 
                   $align = 'align="'.$image_align.'" ';
                   $title = '';
                }
                
              $image  = '<img src="'. $image_url .'"
                             alt="'. htmlentities(strip_tags($alt_title)) .'"
                             '.$align.'' . $width . '' . $height . '/>';

    }
}

          $result = $align_in.$link.$image.$br.$title.$a.$align_out;

  return $result;
}

function chatbot_create_jscontent($target, $file_content) {
  
       	$handle = fopen($target, 'w+');
		if ($handle) {
			if ( fwrite($handle, $file_content) ) {
               	return true;
			}
        }
        return false;
    }
    

function chatbot_summary_report() {

        global $xoopsDB, $xoopsModule;

  // Report
         $sql = "SELECT count(*)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_report' ) . "
                WHERE status = 0";
        $result = $xoopsDB->queryF( $sql );
        list( $total_report_on ) = $xoopsDB -> fetchRow( $result );
        return $total_report_on;
}




function chatbot_site_report($datas) {

  global $xoopsDB;
       $data_array= array();
       $data= array();
       $data_array = explode('|', $datas);
       $i = 0;

  foreach( $data_array as $data ) {
       $data = explode(',', $data);

       $sql = "SELECT " . $data[2] ."
               FROM " . $xoopsDB->prefix( $data[1] ) . "
               WHERE " . $data[3];
       $result = $xoopsDB->queryF( $sql );
       $ii= 0;
       $report['module'][$i] = $data[0];
       while(list( $content ) = $xoopsDB -> fetchRow( $result )) {
                   if($content) { $report['content'][$i][$ii++] = $content; $ii++; }
                   }
     $i++; 
  }
          return $report;
}

function chatbot_user_tags() {
    Global $xoopsUser;
  if (is_object($xoopsUser)) {
        $tag['{EMAIL}']        = $xoopsUser->getVar('email');
        $tag['{URL}']          = $xoopsUser->getVar('url');
        $tag['{FROM}']         = $xoopsUser->getVar('user_from');
        $tag['{POSTS}']        = $xoopsUser->getVar('posts');
        $tag['{LAST_LOGIN}']   = $xoopsUser->getVar('last_login');
        $tag['{USER_OCC}']     = $xoopsUser->getVar('user_occ');
        $tag['{USER_INTREST}'] = $xoopsUser->getVar('user_intrest');
            if( $username = XoopsUser::getUnameFromId($xoopsUser->uid(), 1) ) {}
         else { $username = XoopsUser::getUnameFromId($xoopsUser->uid());}
   } else { $username = $GLOBALS['xoopsConfig']['anonymous']; }
        $tag['{USERNAME}']     = $username;
        
        return $tag;
}

/**
 * send mail for new bot or tracker bot
 *
 * @param string	: emailto
 * @param string	: user agent
 * @param string	: url seen
 */
function chatbot_sendmail ( $mail, $bot_name, $bot_url, $user_name, $rec_convo )
{
	global $xoopsConfig;
	include_once( XOOPS_ROOT_PATH . '/modules/chatbot/language/' . $xoopsConfig['language'] . '/main.php' );

	$today = date('r');
	$template_dir = XOOPS_ROOT_PATH . '/modules/chatbot/language/' . $xoopsConfig['language'] . '/mail_template';

	$xoopsMailer =& getMailer();
	$xoopsMailer->useMail();
	$xoopsMailer->setTemplateDir($template_dir);

        $xoopsMailer->setTemplate('trackerbot.tpl');
	$xoopsMailer->setSubject( sprintf( _CHATBOT_MAIL_CONVO_TRACKER, $xoopsConfig['sitename'], $bot_name ) );

	$xoopsMailer->assign('SITENAME', $xoopsConfig['sitename'] . ' - ' . $xoopsConfig['slogan']);
	$xoopsMailer->assign('SITEURL', XOOPS_URL."/");
	$xoopsMailer->assign('BOT', $bot_name);
	$xoopsMailer->assign('BOT_URL', '(' . $bot_url . ')' );
	$xoopsMailer->assign('USER', $user_name);
	$xoopsMailer->assign('BOT_CONVO', $rec_convo);
	$xoopsMailer->assign('BOT_TODAY', $today);
        $xoopsMailer->setToEmails( array($mail) );
	$xoopsMailer->setFromEmail($xoopsConfig['adminmail']);
	$xoopsMailer->setFromName($bot_name.':'. $xoopsConfig['sitename']);
    $xoopsMailer->send();
}

?>