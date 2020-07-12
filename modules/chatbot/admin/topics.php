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
$catid= '';
if ( isset( $_GET['op'] ) ) $op = $_GET['op'];
if ( isset( $_POST['op'] ) ) $op = $_POST['op'];

if ( isset( $_GET['catid'] ) )  $catid = $_GET['catid'];
if ( isset( $_POST['catid'] ) ) $catid = $_POST['catid'];

$startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;

function displaytopics()
	{
        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;
        include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;
        if($startart) {$page='&startart='.$startart;} else {$page='';}
        $catid = isset( $_GET['catid'] ) ? intval( $_GET['catid'] ) : 0;
        $sql = "SELECT count(catid)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_topics' );
        $result = $xoopsDB->queryF( $sql );
        list( $total ) = $xoopsDB -> fetchRow( $result );
        $pagenav = new XoopsPageNav( $total, $xoopsModuleConfig['chatbot_perpage'], $startart, 'startart' );


        $sql = "SELECT catid , status, page_link, cat_subject, cat_description
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_topics' )."
                ORDER BY cat_subject ASC";
        $result = $xoopsDB->queryF( $sql, $xoopsModuleConfig['chatbot_perpage'], $startart );
        $select_form = chatbot_selector($catid, 'chatbot_topics|catid|cat_subject|||', 'topics.php?op=mod&catid', _MD_CHATBOT_EDIT_TOPIC);
          $sform = new XoopsThemeForm( _MD_CHATBOT_TOPIC.": ".$select_form, "", "" );
          $sform -> setExtra( 'enctype="multipart/form-data"' );
          $display = '<tr><td colspan="2"><table class="outer" width="100%">';
          $display .= '
                           <tr>
                           <th>'._MD_CHATBOT_STATUS.'</th>
                           <th>'._MD_CHATBOT_TOPIC.'</th>
                           <th>'._MD_CHATBOT_PAGELINK.'</th>
                           <th>'._MD_CHATBOT_DESCRIPTION.'</th>
                           <th> '._MD_CHATBOT_ADMIN.'</th>
                           </tr>
                      ';
          while ( list( $catid , $status, $page_link, $cat_subject, $cat_description) = $xoopsDB -> fetchrow( $result ) )
	{
                 if( $status == 2 ) {       $status_image = '<img src="../images/icon/online.gif" alt="'._MD_CHATBOT_ONLINE.'" /><br />';$stat=1;
                 } elseif( $status == 1 ) { $status_image = '<img src="../images/icon/hidden.gif" alt="'._MD_CHATBOT_HIDDEN.'" /><br />';$stat=3;
                 } elseif( $status == 0 ) { $status_image = '<img src="../images/icon/offline.gif" alt="'._MD_CHATBOT_OFFLINE.'" /><br />';$stat=2;
                 } // elseif( $status == 3 ) { $status_image = '<img src="../images/icon/relatif.gif" alt="'._MD_CHATBOT_CONTEXTUAL.'" />'; $stat=0;}

                 $edit = '<a href="?op=mod&catid='.$catid.$page.'"><img src="../images/icon/edit.gif" /></a>';
                 $delete = '<a href="?op=del&catid='.$catid.'"><img src="../images/icon/delete.gif" /></a>';

                  $display .= '
                           <tr>
                           <td class="odd"><a href="topics.php?op=status&status='.$stat.'&catid='.$catid.$page.'">'.$status_image.'</a></td>
                           <td class="even"><a href="content.php?catid='.$catid.'">'.$cat_subject.'</a></td>
                           <td class="even" style="text-align:left;"> '.$page_link.'</td>
                           <td class="odd" style="text-align:left;"> '.$cat_description.'</td>
                           <td class="odd"><nobr>'.$edit.'|'.$delete.'</nobr></td>
                           </tr>
                           ';

        }
         $display .= '</table>
                      <div style="text-align:right;">' . $pagenav -> renderNav() . '</div>
         </td></tr>';
                $sform -> addElement( $display );
        	$sform -> display();
 }

// -- Edit function -- //
function editarticle( $catid = '', $op = '' )
	{
	global $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $xoopsModuleConfig, $xoopsModule, $XOOPS_URL;
	
        if( !isset($status) )              { $status = 2; }         else { $status = intval($status); }
        if( !isset($cat_subject) )          { $cat_subject = ''; }    else { $cat_subject = intval($cat_subject); }
	if( !isset($page_link) )          { $page_link = ''; }    else { $page_link = intval($page_link); }
        if( !isset($cat_description) )      { $cat_description = ''; }   else { $cat_description = intval($cat_description); }

$help_display_link = '
 <div align="left">
 <a title="show/hide"
    id="selecthelp_link"
    href="javascript: void(0);"
    onclick="toggle(this, \'selecthelp\');">[-]</a>['._MD_CHATBOT_HOWTO.']
 </div>';
$help_display = '<!-- flooble Expandable Content box start -->
<tr><td colspan="2" style="background-color:AntiqueWhite;">
<script language="JavaScript" type="text/javascript" src="../script/expandable.js"></script>
    <div style="text-align:left;" id="selecthelp">
    ' .  _MD_CHATBOT_HOWTO_TOPICS . '
    <div>
    <script type="text/javascript" language="javascript">toggle(getObject("selecthelp_link"), "selecthelp");</script>
</th></tr>
';


	// If there is a parameter, and the catid exists, retrieve data: we're editing an chatbot
	if ( $catid )
	{
		$result = $xoopsDB -> queryF( "SELECT * 
                                               FROM " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_topics" ) . "
                                               WHERE catid = $catid" );
		
		if ( !$xoopsDB -> getRowsNum( $result ) )
		{
			redirect_header( "topics.php", 1, _MD_CHATBOT_NOTHINGTOEDIT );
			exit();
		}

		list( $catid,
                      $status,
                      $page_link,
                      $cat_subject,
                      $cat_description ) = $xoopsDB -> fetchrow( $result );

                      $sform = new XoopsThemeForm( _MD_CHATBOT_EDIT . ": ". $cat_subject . $help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}
    else // there's no parameter, so we're adding an chatbot
	{
		$sform = new XoopsThemeForm( _MD_CHATBOT_CREATE . $help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}


      	$sform -> setExtra( 'enctype="multipart/form-data"' );
        $sform -> addElement( $help_display );
// ONLINE
	// Code to take topics status
	$status_radio = new XoopsFormRadio(_MD_CHATBOT_STATUS, 'status', $status);
	$status_radio->addOption("2", '&nbsp;<img src="../images/icon/online.gif"  align="absmiddle" alt="'._MD_CHATBOT_ACTIVE.'" />&nbsp;'._MD_CHATBOT_ACTIVE.'<br />');
	$status_radio->addOption("1", '&nbsp;<img src="../images/icon/hidden.gif"  align="absmiddle" alt="'._MD_CHATBOT_HIDDEN.'" />&nbsp;'._MD_CHATBOT_HIDDEN.'<br />');
//	$status_radio->addOption("3", '&nbsp;<img src="../images/icon/relatif.gif" align="absmiddle" alt="'._MD_CHATBOT_CONTEXTUAL.'" />&nbsp;'._MD_CHATBOT_CONTEXTUAL.'<br />');
	$status_radio->addOption("0", '&nbsp;<img src="../images/icon/offline.gif" align="absmiddle" alt="'._MD_CHATBOT_INACTIVE.'" />&nbsp;'._MD_CHATBOT_INACTIVE);
	$sform -> addElement( $status_radio );

// Topic
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_TOPIC,    'cat_subject',   70, 255, $cat_subject ), TRUE );

// Link
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_PAGELINK._MD_CHATBOT_PAGELINKDSC,    'page_link',   70, 255, $page_link ), TRUE );


// Description
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_DESCRIPTION, 'cat_description', $cat_description ), FALSE );

	$sform -> addElement( new XoopsFormHidden( 'catid', $catid ) );
	$button_tray = new XoopsFormElementTray( '', '' );
	$hidden = new XoopsFormHidden( 'op', 'addart' );
	$button_tray -> addElement( $hidden );

	if ( !$catid ) // there's no id? Then it's a new data
		{
		$butt_create = new XoopsFormButton( '', '', _MD_CHATBOT_SUBMIT, 'submit' );
		$butt_create->setExtra('onclick="this.form.elements.op.value=\'addart\'"');
		$button_tray->addElement( $butt_create );

		$butt_clear = new XoopsFormButton( '', '', _MD_CHATBOT_CLEAR, 'reset' );
		$button_tray->addElement( $butt_clear );

		$butt_cancel = new XoopsFormButton( '', '', _MD_CHATBOT_CANCEL, 'button' );
		$butt_cancel->setExtra('onclick="history.go(-1)"');
		$button_tray->addElement( $butt_cancel );
		
		}
	else // else, we're editing an existing article
		{
		$butt_create = new XoopsFormButton( '', '', _MD_CHATBOT_MODIFY, 'submit' );
		$butt_create->setExtra('onclick="this.form.elements.op.value=\'addart\'"');
		$button_tray->addElement( $butt_create );

		$butt_cancel = new XoopsFormButton( '', '', _MD_CHATBOT_CANCEL, 'button' );
		$butt_cancel->setExtra('onclick="history.go(-1)"');
		$button_tray->addElement( $butt_cancel );
		}

	$sform -> addElement( $button_tray );
	$sform -> display();
	unset( $hidden );
}


/* -- Available operations -- */
switch ( $op )
{	  
    case "mod":
    	 include_once( "admin_header.php" );
         chatbot_adminmenu(2, _MD_CHATBOT_EDIT);
         displaytopics();
         echo '<p />';
         editarticle($catid);
         include_once( 'admin_footer.php' );
         break;

    case "status":
         if ( isset( $_GET['status'] ) )  { $status = $_GET['status']; }
		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_topics" ) . "
                                      SET status  = '$status'
                                      WHERE catid = '$catid'" ) )
			{       redirect_header( "topics.php?startart=$startart", 1, _MD_CHATBOT_UPDATED );
			} else {
				redirect_header( "topics.php?startart=$startart", 1, _MD_CHATBOT_NOTUPDATED);
			}
         exit();
         break;

     case "addart":
     $myts =& MyTextSanitizer::getInstance();
         $catid              = isset($_POST['catid']) ? intval($_POST['catid']) : 0;
         $status             = isset($_POST['status']) ? intval($_POST['status']) : 1;
         $page_link          = $_POST['page_link'];
         $cat_subject        = $myts -> htmlSpecialChars($_POST['cat_subject']);
         $cat_description    = $myts -> htmlSpecialChars($_POST['cat_description']);

// Save to database

		if ( !$catid )
		{
		if ( $xoopsDB -> queryF( "INSERT INTO " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_topics" ) .
                  " ( catid,
                      status,
                      page_link,
                      cat_subject,
                      cat_description )
                        VALUES (
                            '$catid',
                            '$status',
                            '$page_link',
                            '$cat_subject',
                            '$cat_description' )" ) )
			{
				redirect_header( "topics.php", 1, _MD_CHATBOT_CREATED );
			}
			else
			{
				redirect_header( "index.php", 1, _MD_CHATBOT_NOTCREATED );
			}
		}
		else  // That is, $catid exists, thus we're editing an article
		{

		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_topics" ) . "
                                      SET catid        =     '$catid',
                                      status           =     '$status',
                                      page_link        =     '$page_link',
                                      cat_subject      =     '$cat_subject',
                                      cat_description  =     '$cat_description'
                                      WHERE catid = '$catid'" ) )
			{
                                redirect_header( "topics.php", 1, _MD_CHATBOT_UPDATED );


			}
			else
			{
				redirect_header( "index.php", 1, _MD_CHATBOT_NOTUPDATED);
			}
		}
		exit();
		break;

	case "del":

   		$confirm = (isset($_POST['confirm'])) ? 1 : 0;
		if ($confirm)
		{
			$xoopsDB->queryF( "DELETE FROM " . $xoopsDB->prefix($xoopsModule->dirname() . "_topics") . "
                                          WHERE catid = $catid" );
			redirect_header( "topics.php", 1, _MD_CHATBOT_DELETED );
			exit();
		} else {
			$catid = ( isset( $_POST['catid'] ) ) ? intval($_POST['catid']) : intval($catid);
                        include_once( "admin_header.php" );
			xoops_confirm( array( 'op' => 'del', 'catid' => $catid, 'confirm' => 1, 'subject' => '' ), 'topics.php', _MD_CHATBOT_DELETETHISDATA, _MD_CHATBOT_DELETE );
                        include_once( 'admin_footer.php' );
		}
		exit();
                break;
        

	case "default":
	default:
		include_once( "admin_header.php" );
                chatbot_adminmenu(2, _MD_CHATBOT_TOPIC_TITLE);
                displaytopics();
                echo '<p />';
		editarticle();
		include_once( 'admin_footer.php' ); 
		break;
}

?>