<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/


	 include_once( '../../../mainfile.php');
	 include_once( '../../../include/cp_header.php');


function chatbot_summary() {

        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;
        
// Status pictures
$status_online  = '<img src="../images/icon/online.gif" alt="'._MD_CHATBOT_ONLINE.'"      width="10" align="absmiddle" />&nbsp;';
$status_hidden  = '<img src="../images/icon/hidden.gif" alt="'._MD_CHATBOT_HIDDEN.'"      width="10" align="absmiddle" />&nbsp;';
$status_offline = '<img src="../images/icon/offline.gif" alt="'._MD_CHATBOT_OFFLINE.'"    width="10" align="absmiddle" />&nbsp;';

        
 // Topics
         $sql = "SELECT count(catid)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_topics' );
        $result = $xoopsDB->queryF( $sql );
        list( $total_topic ) = $xoopsDB -> fetchRow( $result );
        
  // Topics
         $sql = "SELECT a.cat_subject, a.status, count(b.id) as count, a.catid
                FROM "      . $xoopsDB->prefix( $xoopsModule->dirname() . '_topics' ) . " a
                LEFT JOIN " . $xoopsDB->prefix( $xoopsModule->dirname() . '_content' )  . " b
                ON a.catid = b.catid
                GROUP BY a.cat_subject
                ORDER BY a.status ASC, count DESC" ;
        $result = $xoopsDB->queryF( $sql );
                $topic_count   = '<ol>';
                $content_count = '<ol>';
        While (list( $cat_subject, $status, $total_topic_content, $catid ) = $xoopsDB -> fetchRow( $result ))
              {

                       if( $status == 2 ) { $status_image = $status_online;
                 } elseif( $status == 1 ) { $status_image = $status_hidden;
                 } elseif( $status == 0 ) { $status_image = $status_offline;
                 } elseif( $status == 4 ) { $status_image = $status_context; }

                $topic_count .= '<li><a href="topics.php?op=mod&catid='.$catid.'">' . $status_image . $cat_subject . '</a>
                                     <a href="content.php?catid='.$catid.'">[' . $total_topic_content . ']</a>
                                 </li>';
                $content_count .= '<li><a href="content.php?catid='.$catid.'">[' . $total_topic_content . ']</a></li>'; }
                $topic_count .= '</ol>';
                $content_count .= '</ol>';

 // Bots
         $sql = "SELECT count(botid)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_bot' );
        $result = $xoopsDB->queryF( $sql );
        list( $total_bot ) = $xoopsDB -> fetchRow( $result );

         $sql = "SELECT bot_name, status, botid
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_bot' );
        $result = $xoopsDB->queryF( $sql );
        $bot_list = '<ol>';
        While (list( $bot_name, $status, $botid ) = $xoopsDB -> fetchRow( $result ))
              { 
                       if( $status == 1 ) { $status_image = $status_online;
                 } elseif( $status == 0 ) { $status_image = $status_offline; }

                 $bot_list .= '<li><a href="../bot.php?id='.$botid.'">' . $status_image . $bot_name.'</a></li>';}
                $bot_list .= '</ol>';

  // Content
         $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_content' );
        $result = $xoopsDB->queryF( $sql );
        list( $total_content ) = $xoopsDB -> fetchRow( $result );
        
  // Eliza
         $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_eliza' ) . "
                WHERE type=1";
        $result = $xoopsDB->queryF( $sql );
        list( $total_eliza_01 ) = $xoopsDB -> fetchRow( $result );
        $eliza_count = '<ol><li><a href="eliza.php?op=mod&type=1">'.CHATBOT_ELIZA_TYPE_1.'</a> ['.$total_eliza_01.']</li>';

        $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_eliza' ) . "
                WHERE type=2";
        $result = $xoopsDB->queryF( $sql );
        list( $total_eliza_02 ) = $xoopsDB -> fetchRow( $result );
        $eliza_count .= '<li><a href="eliza.php?op=mod&type=2">'.CHATBOT_ELIZA_TYPE_2.'</a> ['.$total_eliza_02.']</li>';

        $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_eliza' ) . "
                WHERE type=3";
        $result = $xoopsDB->queryF( $sql );
        list( $total_eliza_03 ) = $xoopsDB -> fetchRow( $result );
        $eliza_count .= '<li><a href="eliza.php?op=mod&type=3">'.CHATBOT_ELIZA_TYPE_3.'</a> ['.$total_eliza_03.']</li></ol>';
        $total_eliza = $total_eliza_01+$total_eliza_02+$total_eliza_03;

  // Report
         $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_report' ) . "
                WHERE status = 1";
        $result = $xoopsDB->queryF( $sql );
        list( $total_report_on ) = $xoopsDB -> fetchRow( $result );

        $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_report' ) . "
                WHERE status = 0";
        $result = $xoopsDB->queryF( $sql );
        list( $total_report_off ) = $xoopsDB -> fetchRow( $result );
  
         $total_report = $total_report_on + $total_report_off;

          $sform = new XoopsThemeForm( _MD_CHATBOT_SUMMARY, "", "" );
          $display = '<tr><td colspan="2"><table class="outer" width="100%">';
          $display .= '
                           <tr>
                           <th><a href="bots.php"><nobr>' . _MD_CHATBOT_BOTS .    '</a><br />[' . $total_bot . ']</nobr></th>
                           <th><a href="topics.php"><nobr>' . _MD_CHATBOT_TOPIC .  '</a> [' . $total_topic . ']</nobr><br />
                               <a href="content.php"><nobr>' . _MD_CHATBOT_TITLE_REPLIES . '</a> [' . $total_content . ']</nobr></th>
                           <th><a href="eliza.php"><nobr>' . _MD_CHATBOT_TITLE_CHAT . '</a><br />[' . $total_eliza . ']</nobr></th>
                           <th><a href="reports.php"><nobr>' . _MD_CHATBOT_REPORTS . '</a><br />[' . $total_report . ']</nobr></th>
                           </tr>
                      ';
          $display .= '
                           <tr>
                           <td class="odd"  style="vertical-align:top;"><nobr>' . $bot_list . '</nobr></td>
                           <td class="even" style="vertical-align:top;"><nobr>' . $topic_count . '</nobr></td>
                           <td class="even" style="vertical-align:top;"><nobr>' . $eliza_count . '</nobr></td>
                           <td class="odd"  style="vertical-align:top;"><ol><li>' . $status_online . $total_report_on . '</li>
                                                                            <li>' . $status_offline . $total_report_off . '</li></ol></td>
                           </tr>
                      ';
          $display .= '</table>
         </td></tr>';
                $sform -> addElement( $display );
        	$sform -> display();
  
}

$op = '';

/* -- Available operations -- */
switch ( $op )
{
  case "index":
  	default:
  	include_once( "admin_header.php" );
        chatbot_adminmenu(0, _MD_CHATBOT_STATS);

        OpenTable();
        echo _MD_CHATBOT_ADMIN_TEXT    . '<p />';
        chatbot_summary();
        CloseTable();
        include_once( 'admin_footer.php' );
    break;

}

?>