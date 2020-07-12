<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

	 include_once( '../../../mainfile.php');
	 include_once( '../../../include/cp_header.php');

$op = '';

if ( isset( $_GET['op'] ) )  $op = $_GET['op'];
if ( isset( $_POST['op'] ) ) $op = $_POST['op'];

if ( isset( $_GET['id'] ) )  $id = $_GET['id'];
if ( isset( $_POST['id'] ) ) $id = $_POST['id'];


function chatbot_data_tag_replace( $datas, $tag )
{ 
 $datas = strtr($datas, $tag);
  return $datas;
}

function displayreports($id = '')
	{
        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;
        include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;
        if ( $startart ) { $page = '&startart='.$startart; } else { $page = ''; }
        if ( $id ) { $where = 'WHERE id = '.$id; $where2 = 'WHERE a.id = '.$id; } else { $where = ''; $where2 = ''; }
        $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_report'
                . $where );
        $result = $xoopsDB->queryF( $sql );
        list( $total ) = $xoopsDB -> fetchRow( $result );
        $pagenav = new XoopsPageNav( $total, $xoopsModuleConfig['chatbot_perpage'], $startart, 'startart' );
        
          $sql = "SELECT a.id, a.botid, a.status, a.rec_reply, a.rec_convo, a.date, b.bot_name
                  FROM      " . $xoopsDB->prefix( $xoopsModule->dirname() . '_report' )." a
                  LEFT JOIN " . $xoopsDB->prefix( $xoopsModule->dirname() . '_bot' )."    b
                  ON a.botid = b.botid
                  ".$where2."
                  ORDER BY a.status DESC, a.botid DESC, a.rec_reply ASC ";

          $result = $xoopsDB->queryF( $sql, $xoopsModuleConfig['chatbot_perpage'],  $startart );
          $sform = new XoopsThemeForm( _MD_CHATBOT_REPORTS.'<a href="?op=del&id=0"><img src="../images/icon/delete.gif" align="absmiddle" /></a>', '', '' );
          $sform -> setExtra( 'enctype="multipart/form-data"' );
          $display = '     <tr><td colspan="2"><table class="outer" width="100%">';
          $display .= '
                           <tr>
                           <th>'._MD_CHATBOT_STATUS.'</th>
                           <th>'._MD_CHATBOT_TITLE_REPLY.'</th>
                           <th>'._MD_CHATBOT_TITLE_CONVO.'</th>
                           <th>'._MD_CHATBOT_TITLE_INFOS.'</th>
                           <th> '._MD_CHATBOT_ADMIN.'</th>
                           </tr>
                      ';
          $current_id = $id;

          while ( list( $id, $botid, $status, $rec_reply, $rec_convo, $date, $botname  ) = $xoopsDB -> fetchrow( $result ) )
	{
                 if ( $status ) { $status_image = '<img src="../images/icon/online.gif" /><br />';
                       } else { $status_image = '<img src="../images/icon/offline.gif" /><br />'; }
                 $edit = '<a href="?op=mod&id='.$id.$page.'"><img src="../images/icon/edit.gif" /></a>';
                 $delete = '<a href="?op=del&id='.$id.$page.'"><img src="../images/icon/delete.gif" /></a>';

                 $tag['['] = '</li><li><b>';
                 $tag[' >'] = ' ></b>';
                 $rec_convo_display = chatbot_data_tag_replace(substr(trim($rec_convo), 1), $tag);
                 $rec_reply_display = chatbot_data_tag_replace(substr(trim($rec_reply), 1), $tag);
                 $infos             = formatTimestamp($date,'m')." ". $botname;
                 if (!$current_id) { $rec_convo_display = chatbot_short_title($rec_convo_display,256); }
                 $display .= '
                           <tr>
                           <td class="odd">'.$status_image.'</td>
                           <td class="even"><ul><li><b>'.$rec_reply_display.'</li></ul></td>
                           <td class="odd"> <ul><li><b>'.$rec_convo_display.'</li></ul></td>
                           <td class="even">'.$infos.'</td>
                           <td class="even"><nobr>'.$edit.'|'.$delete.'</nobr></td>
                           </tr>
                           ';

        }
         $display .= '</table>
                      <div style="text-align:right;">' . $pagenav -> renderNav() . '</div>
         </td></tr>';
                $sform -> addElement( $display );
        	$sform -> display();
       	return $rec_reply;
 }

// -- Edit function -- //
// -- Edit function -- //
function editarticle( $id = '' )
	{
	global $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $xoopsModuleConfig, $xoopsModule, $XOOPS_URL;
 // Retrive reply
        $sql = "SELECT rec_reply
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_report' )."
                WHERE id = ".$id;
        $result = $xoopsDB->queryF( $sql );
        list($rec_reply)  = $xoopsDB -> fetchrow( $result );
        $rec_reply = explode('>',  trim($rec_reply));
        $rec_reply = explode('[', $rec_reply[1]);
        $rec_reply = explode(' ', $rec_reply[0]);
        $pref_and = '';
        $pref_or  = '';
        $pref_misc = '';
        foreach( $rec_reply as $term )
        {
          $term = eregi_replace("[[:punct:]]"," ", $term);
          if(strlen($term) >= 4 )                      { $pref_and  .= $term . ' '; }
          if(strlen($term) > 2 AND strlen($term) < 4) {  $pref_misc .= $term . ' '; }
        }
         $pref_and = trim($pref_and);
         $pref_misc = trim($pref_misc);

        if( !isset($cat_id) )        { $cat_id = 0; }    else { $cat_id = intval($cat_id); }
        if( !isset($status) )        { $status = 1; }    else { $status = intval($status); }
	if( !isset($reply) )         { $reply = ''; }    else { $reply     = $reply; }
        if( !isset($question) )      { $question = ''; } else { $question  = intval($question); }

	$sform = new XoopsThemeForm( _MD_CHATBOT_CONTENT, "op", xoops_getenv( 'PHP_SELF' ) );

        $sform -> setExtra( 'enctype="multipart/form-data"' );

// ONLINE
	// Code to take article offline, for maintenance purposes
/*	$status_radio = new XoopsFormRadioYN( _MD_CHATBOT_STATUS,
                                              'status',
                                              $status,
                                              '&nbsp;<img src="../images/icon/online.gif"  align="absmiddle" alt="'._MD_CHATBOT_ONLINE.'" />&nbsp;'._MD_CHATBOT_ONLINE.'<br />',
                                              '&nbsp;<img src="../images/icon/offline.gif" align="absmiddle" alt="'._MD_CHATBOT_OFFLINE.'" />&nbsp;'._MD_CHATBOT_OFFLINE);
	$sform -> addElement($status_radio);
*/
// topics
	// Code to create the topics selector
	
        $sql = " SELECT catid, cat_subject
                 FROM ".$xoopsDB->prefix($xoopsModule->dirname() . "_topics" )."
                 ORDER BY cat_subject ASC";
        $result = $xoopsDB->queryF($sql);
        $topics = array();
//        $topics[0] = ' ';
        while(list( $catid, $cat_subject ) = $xoopsDB->fetchRow($result))
	           {
                     $topics[$catid] = $cat_subject;
                   }  
                   

	$topics_array = $topics;
 	$topics_select = new XoopsFormSelect( '', 'catid', $cat_id );
	$topics_select -> addOptionArray( $topics_array );
	$topics_tray = new XoopsFormElementTray( _MD_CHATBOT_TOPICS, '&nbsp;' );
	$topics_tray -> addElement( $topics_select );
	$sform -> addElement( $topics_tray );

// Prefix
	// This part is common to edit/add
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_AND,   'pref_and', 70, 255, $pref_and ), FALSE );
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_OR,    'pref_misc',70, 255, $pref_misc ), FALSE );
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_CONTEXT,    'pref_or',  70, 255, $pref_or ), FALSE );

// Content
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_REPLY,    'reply', $reply ), FALSE );
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_QUESTION, 'question', $question ), FALSE );

	$sform -> addElement( new XoopsFormHidden( 'id', $id ) );
	$button_tray = new XoopsFormElementTray( '', '' );
	$hidden = new XoopsFormHidden( 'op', 'addart' );
	$button_tray -> addElement( $hidden );


		$butt_create = new XoopsFormButton( '', '', _MD_CHATBOT_SUBMIT, 'submit' );
		$butt_create->setExtra('onclick="this.form.elements.op.value=\'addart\'"');
		$button_tray->addElement( $butt_create );

		$butt_clear = new XoopsFormButton( '', '', _MD_CHATBOT_CLEAR, 'reset' );
		$button_tray->addElement( $butt_clear );

		$butt_cancel = new XoopsFormButton( '', '', _MD_CHATBOT_CANCEL, 'button' );
		$butt_cancel->setExtra('onclick="history.go(-1)"');
		$button_tray->addElement( $butt_cancel );
		

	$sform -> addElement( $button_tray );
	$sform -> display();
	unset( $hidden );
}


/* -- Available operations -- */
switch ( $op )
{	  
    case "mod":
    	 include_once( "admin_header.php" );
         chatbot_adminmenu(5, _MD_CHATBOT_REPORTS);
         displayreports($id);
         echo '<p />';
        if($id) { editarticle($id); }
         include_once( 'admin_footer.php' );
         break;


     case "addart":
     $myts =& MyTextSanitizer::getInstance();

         $id              = isset($_POST['id']) ? intval($_POST['id']) : 0;
         $catid           = isset($_POST['catid']) ? intval( $_POST['catid'] ) : 0;
         $status          = isset($_POST['status']) ? intval($_POST['status']) : 1;

         $pref_or         = strtoupper($_POST['pref_or']);
         $pref_and        = strtoupper($_POST['pref_and']);
         $pref_misc       = strtoupper($_POST['pref_misc']);


         $reply           = $myts -> htmlSpecialChars($_POST['reply']);
         $question        = $myts -> htmlSpecialChars($_POST['question']);

// Save to database

		if ( !$id )
		{
		if ( $xoopsDB -> queryF( "INSERT INTO " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_content" ) .
                  " ( id,
                      catid,
                      status,
                      pref_or,
                      pref_and,
                      pref_misc,
                      reply,
                      question
                              ) 
                        VALUES (
                            '$id',
                            '$catid',
                            '1',
                            '$pref_or',
                            '$pref_and',
                            '$pref_misc',
                            '$reply',
                            '$question' )" ) )
			{
				redirect_header( "content.php", 1, _MD_CHATBOT_CREATED );
			}
			else
			{
				redirect_header( "content.php", 1, _MD_CHATBOT_NOTCREATED );
			}
		}
		else  // That is, $id exists, thus we're editing an article
		{

		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_content" ) . "
                                      SET id        =     '$id',
                                      catid         =     '$catid',
                                      status        =     '$status',
                                      pref_or       =     '$pref_or',
                                      pref_and      =     '$pref_and',
                                      pref_misc     =     '$pref_misc',
                                      reply         =     '$reply',
                                      question      =     '$question'
                                      WHERE id = '$id'" ) )
			{
                          
                          $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_report" ) . "
                                      SET status    =     '$status'
                                      WHERE id = '$id'" );

                          redirect_header( "reports.php", 1, _MD_CHATBOT_UPDATED );

			}
			else
			{
				redirect_header( "content.php", 1, _MD_CHATBOT_NOTUPDATED);
			}
		}
		exit();
		break;

	case "del":

		$confirm = (isset($_POST['confirm'])) ? 1 : 0;

		if ($confirm)
		{
			if ($id == 0 ) {
			$xoopsDB->queryF( "DELETE FROM " . $xoopsDB->prefix($xoopsModule->dirname() . "_report") . "
                                          WHERE id >= 0" );
                        } else {
  			$xoopsDB->queryF( "DELETE FROM " . $xoopsDB->prefix($xoopsModule->dirname() . "_report") . "
                                          WHERE id = $id" );
                        }
			redirect_header( "reports.php", 1, _MD_CHATBOT_DELETED );
			exit();
		} else {
			$id = ( isset( $_POST['id'] ) ) ? intval($_POST['id']) : intval($id);

                        include_once( "admin_header.php" );
			xoops_confirm( array( 'op' => 'del', 'id' => $id, 'confirm' => 1, 'subject' => '' ), 'reports.php', _MD_CHATBOT_DELETETHISDATA, _MD_CHATBOT_DELETE );
                        include_once( 'admin_footer.php' );
		}

		exit();
                break;
        

	case "default":
	default:
		include_once( "admin_header.php" );
                chatbot_adminmenu(5, _MD_CHATBOT_REPORTS_TITLE);
                displayreports();
		include_once( 'admin_footer.php' );
		break;
}

?>