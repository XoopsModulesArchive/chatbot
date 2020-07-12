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
$botid= '';

if ( isset( $_GET['op'] ) )  $op = $_GET['op'];
if ( isset( $_POST['op'] ) ) $op = $_POST['op'];

if ( isset( $_GET['botid'] ) )  $botid = $_GET['botid'];
if ( isset( $_POST['botid'] ) ) $botid = $_POST['botid'];

$startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;

function displaytopics()
	{
        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;
        include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;
        if ( $startart ) { $page = '&startart='.$startart; } else { $page = ''; }
        $botid = isset( $_GET['botid'] ) ? intval( $_GET['botid'] ) : '';

        $sql = "SELECT count(botid)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_bot' );
        $result = $xoopsDB->queryF( $sql );
        list( $total ) = $xoopsDB -> fetchRow( $result );
        $pagenav = new XoopsPageNav( $total, $xoopsModuleConfig['chatbot_perpage'], $startart, 'startart' );
        

          $sql = "SELECT botid , status, bot_name, bot_description, bot_image, bot_directory
                  FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_bot' )."
                  ORDER BY bot_name ASC";
          $selector = chatbot_selector($botid, 'chatbot_bot|botid|bot_name|||', 'bots.php?op=mod&botid', _MD_CHATBOT_EDIT_BOT);
          $result = $xoopsDB->queryF( $sql, $xoopsModuleConfig['chatbot_perpage'],  $startart );
          $sform = new XoopsThemeForm( _MD_CHATBOT_BOTS ." : ".$selector, "", "" );
          $sform -> setExtra( 'enctype="multipart/form-data"' );
          $display = '<tr><td colspan="2"><table class="outer" width="100%">';
          $display .= '
                           <tr>
                           <th>'._MD_CHATBOT_STATUS.'</th>
                           <th>'._MD_CHATBOT_BOTS.'</th>
                           <th>'._MD_CHATBOT_DESCRIPTION.'</th>
                           <th> '._MD_CHATBOT_ADMIN.'</th>
                           </tr>
                      ';
          while ( list( $botid , $status, $bot_name, $bot_description, $bot_image, $bot_directory) = $xoopsDB -> fetchrow( $result ) )
	{
                 if ($bot_image) { $image = '<img src="'.XOOPS_URL.'/'.$bot_directory.$bot_image.'" width="80" /><br />'; } else { $image = ''; }
                 if ($status) { $status_image = '<img src="../images/icon/online.gif" />'; $stat=0; 
                       } else { $status_image = '<img src="../images/icon/offline.gif" /><br />'; $stat=1; }
                 $edit = '<a href="?op=mod&botid='.$botid.$page.'"><img src="../images/icon/edit.gif" /></a>';
                 $delete = '<a href="?op=del&botid='.$botid.'"><img src="../images/icon/delete.gif" /></a>';

                  $display .= '
                           <tr>
                           <td class="odd"><a href="bots.php?op=status&status='.$stat.'&botid='.$botid.'">'.$status_image.'</a></td>
                           <td class="even"><a href="../bot.php?id='.$botid.'">'.$image.$bot_name.'</a></td>
                           <td class="odd"> '.$bot_description.'</td>
                           <td class="even"><nobr>'.$edit.'|'.$delete.'</nobr></td>
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
function editarticle( $botid = '', $op = '' )
	{
	global $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $xoopsModuleConfig, $xoopsModule, $XOOPS_URL;
	$myts =& MyTextSanitizer::getInstance();
        if( !isset($status) )              { $status = 1; }         else { $status = intval($status); }

	if( !isset($bot_name) )          { $bot_name = '{BOTNAME}'; }    else { $bot_name = intval($bot_name); }
        if( !isset($bot_description) )      { $bot_description = ''; }   else { $bot_description = intval($bot_description); }
        if( !isset($bot_image) )      { $bot_image = '{BOT}.jpg'; }   else { $bot_image = intval($bot_image); }
        if( !isset($bot_directory) )      { $bot_directory = 'uploads/chatbot/{BOT}'; }   else { $bot_directory = intval($bot_directory); }
        if( !isset($bot_background) )      { $bot_background = '{BKG}.png|{SCREEN}.png|||'; }   else { $bot_background = intval($bot_background); }
        if( !isset($text_color) )      { $text_color = 'black|white no-repeat top right|black|white|1px'; }   else { $text_color = intval($text_color); }
        if( !isset($topics) )      { $topics = 'Eliza'; }   else { $topics = intval($topics); }
        if( !isset($start) )      { $start = ''; }   else { $start = intval($start); }
        if( !isset($dumb) )      { $dumb = ''; }   else { $dumb = intval($dumb); }
        if( !isset($zero) )      { $zero = ''; }   else { $zero = intval($zero); }
        if( !isset($groups) )      { $groups = '1 2 3'; }   else { $groups = intval($groups); }
        if( !isset($end) )      { $end = ''; }   else { $end = intval($end); }

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
    ' .  _MD_CHATBOT_HOWTO_BOTS . '
    <div>
    <script type="text/javascript" language="javascript">toggle(getObject("selecthelp_link"), "selecthelp");</script>
</th></tr>
';

	// If there is a parameter, and the id exists, retrieve data: we're editing an chatbot
	if ( $botid )
	{
		$result = $xoopsDB -> queryF( "SELECT * 
                                               FROM " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_bot" ) . "
                                               WHERE botid = $botid" );
		
		if ( !$xoopsDB -> getRowsNum( $result ) )
		{
			redirect_header( "bots.php", 1, _MD_CHATBOT_NOTHINGTOEDIT );
			exit();
		}

		list( $botid,
                      $status,
                      $bot_name,
                      $bot_description,
                      $bot_image,
                      $bot_directory,
                      $bot_background,
                      $text_color,
                      $topics,
                      $start,
                      $dumb,
                      $zero,
                      $end,
                      $groups ) = $xoopsDB -> fetchrow( $result );

                      $sform = new XoopsThemeForm( _MD_CHATBOT_EDIT . " ". $bot_name. $help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}
    else // there's no parameter, so we're adding an chatbot
	{
		$sform = new XoopsThemeForm( _MD_CHATBOT_CREATE. $help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}


      	$sform -> setExtra( 'enctype="multipart/form-data"' );
        $sform -> addElement( $help_display );
// ONLINE
	// Code to take article offline, for maintenance purposes
	$status_radio = new XoopsFormRadioYN( _MD_CHATBOT_STATUS,
                                              'status',
                                              $status, 
                                              '&nbsp;<img src="../images/icon/online.gif"  align="absmiddle" alt="'._MD_CHATBOT_ACTIVE.'" />&nbsp;'._MD_CHATBOT_ACTIVE.'<br />',
                                              '&nbsp;<img src="../images/icon/offline.gif" align="absmiddle" alt="'._MD_CHATBOT_INACTIVE.'" />&nbsp;'._MD_CHATBOT_INACTIVE);
	$sform -> addElement($status_radio);

// Bot
	// This part is common to edit/add
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_NAME,    'bot_name', 70, 255, $myts->htmlSpecialChars($bot_name) ), TRUE );


// Content
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_DESCRIPTION, 'bot_description',           $bot_description ),  FALSE );
        $sform->addElement(new XoopsFormText(_MD_CHATBOT_IMAGE,           'bot_image',        70, 255, $bot_image ),        FALSE );
        $sform->addElement(new XoopsFormText(_MD_CHATBOT_SMILIES,         'bot_directory',    70, 255, $bot_directory  ),   TRUE );
        $sform->addElement(new XoopsFormText(_MD_CHATBOT_BACKGROUND,      'bot_background',   70, 255, $bot_background ),   FALSE );
        $sform->addElement(new XoopsFormText(_MD_CHATBOT_COLOR,           'text_color',       70, 255, $text_color ),       FALSE );
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_INTRO,       'start',                     $start ),            FALSE );
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_DUMB,        'dumb',                      $dumb ),             FALSE );
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_ZERO,        'zero',                      $zero ),             FALSE );
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_END,         'end',                       $end ),              FALSE );
// Topics
	// Code to create the topic selector
        $sql = " SELECT catid, cat_subject, status
                 FROM ".$xoopsDB->prefix($xoopsModule->dirname() . "_topics" )."
                 ORDER BY status DESC, cat_subject ASC";
        $result = $xoopsDB->queryF($sql);
        $topic = array();
        $topic['Eliza'] = '[ELIZA] Eliza Chat';
        while(list( $catid, $cat_subject, $status ) = $xoopsDB->fetchRow($result))
	           {
                      if($status == 0) {$status_name = _MD_CHATBOT_INACTIVE;}
                      if($status == 1) {$status_name = _MD_CHATBOT_HIDDEN;}
                      if($status == 2) {$status_name = _MD_CHATBOT_ACTIVE;}
                      if($status == 3) {$status_name = _MD_CHATBOT_CONTEXTUAL;}
                   $topic[$catid] = '['.$status_name.'] '.$cat_subject;
                   }

                if( $topics ) {
                            $cat_array = explode(' ', $topics);
                        foreach ($cat_array as $cat_ids) {
	                       $catid[]= $cat_ids;
	                       }
                    }

	$topic_array = $topic;
 	$topic_select = new XoopsFormSelect( '', 'catid', $catid, 10, TRUE );
	$topic_select -> addOptionArray( $topic_array );
	$topic_tray = new XoopsFormElementTray( _MD_CHATBOT_TOPICS, '&nbsp;' );
	$topic_tray -> addElement( $topic_select );
	$sform -> addElement( $topic_tray );

	$sform -> addElement( new XoopsFormHidden( 'botid', $botid ) );
	$button_tray = new XoopsFormElementTray( '', '' );
	$hidden = new XoopsFormHidden( 'op', 'addart' );
	$button_tray -> addElement( $hidden );
	
 // GROUPS
        $groups = explode(" ", $groups);
	$sform -> addElement(new XoopsFormSelectGroup(_MD_CHATBOT_GROUPS, "groups", true, $groups, 5, true));

	if ( !$botid ) // there's no id? Then it's a new data
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

	$sform -> addElement($button_tray );
	$sform -> display();
	unset( $hidden );
}


/* -- Available operations -- */
switch ( $op )
{	  
    case "mod":
    	 include_once( "admin_header.php" );
         chatbot_adminmenu(1, _MD_CHATBOT_BOT);
         displaytopics();
         echo '<p />';
         editarticle($botid); 
         include_once( 'admin_footer.php' );
         break;
         
    case "status":
         if ( isset( $_GET['status'] ) )  { $status = $_GET['status']; }
		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_bot" ) . "
                                      SET status  = '$status'
                                      WHERE botid = '$botid'" ) )
			{       redirect_header( "bots.php?startart=$startart", 0, _MD_CHATBOT_UPDATED );
			} else {
				redirect_header( "bots.php?startart=$startart", 0, _MD_CHATBOT_NOTUPDATED);
			}
         exit();
         break;


     case "addart":
     $myts =& MyTextSanitizer::getInstance();
     include_once( XOOPS_ROOT_PATH .'/modules/'.$xoopsModule->getVar('dirname').'/include/functions_chatbot.php' );
         $botid              = isset($_POST['botid']) ? intval($_POST['botid']) : '';
         $status             = isset($_POST['status']) ? intval($_POST['status']) : 1;

         $bot_name           = trim(addslashes($_POST['bot_name']));
         $bot_description    = $_POST['bot_description'];
         $bot_image          = chatbot_clean_url($_POST['bot_image'], 0);
         $bot_directory      = chatbot_clean_url($_POST['bot_directory'],1);
         $bot_background     = chatbot_clean_url($_POST['bot_background'],0,4);
//         $text_color         = trim($_POST['text_color']);
         $text_color         = chatbot_clean_url($_POST['text_color'],0,4);
              $ret = '';
              foreach ($_POST['catid'] as $cat_ids) {
	              $ret .= ' '.$cat_ids;
	           }

         $topics             = $ret;
         $start              = $_POST['start'];
         $dumb               = $_POST['dumb'];
         $zero               = $_POST['zero'];
         $end                = $_POST['end'];
         $groups             = $_POST['groups'];
         $groups             = (is_array($groups)) ? implode(" ", $groups) : '';

// Check if directory exists
chatbot_create_dir($bot_directory);

// Save to database
		if ( !$botid )
		{
		if ( $xoopsDB -> queryF( "INSERT INTO " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_bot" ) .
                  " ( botid,
                      status,
                      bot_name,
                      bot_description,
                      bot_image,
                      bot_directory,
                      bot_background,
                      text_color,
                      topics,
                      start,
                      dumb,
                      zero,
                      end,
                      groups )
                        VALUES (
                            '$botid',
                            '$status',
                            '$bot_name',
                            '$bot_description',
                            '$bot_image',
                            '$bot_directory',
                            '$bot_background',
                            '$text_color',
                            '$topics',
                            '$start',
                            '$dumb',
                            '$zero',
                            '$end',
                            '$groups' )" ) )
			{
				redirect_header( "bots.php", 1, _MD_CHATBOT_CREATED );
			}
			else
			{
				redirect_header( "bots.php", 1, _MD_CHATBOT_NOTCREATED );
			}
		}
		else  // That is, $botid exists, thus we're editing an article
		{

		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_bot" ) . "
                                      SET status       =     '$status',
                                      bot_name         =     '$bot_name',
                                      bot_description  =     '$bot_description',
                                      bot_image        =     '$bot_image',
                                      bot_directory    =     '$bot_directory',
                                      bot_background   =     '$bot_background',
                                      text_color       =     '$text_color',
                                      topics           =     '$topics',
                                      start            =     '$start',
                                      dumb             =     '$dumb',
                                      zero             =     '$zero',
                                      end              =     '$end',
                                      groups           =     '$groups'
                                      WHERE botid = '$botid'" ) )
			{
               if( !$status ) {redirect_header( "bots.php", 1, _MD_CHATBOT_UPDATED );
                      } else { redirect_header( "../bot.php?id=".$botid, 1, _MD_CHATBOT_UPDATED ); };

			}
			else
			{
				redirect_header( "bots.php", 1, _MD_CHATBOT_NOTUPDATED);
			}
		}
		exit();
		break;

	case "del":

		$confirm = (isset($_POST['confirm'])) ? 1 : 0;

		if ($confirm)
		{
			$xoopsDB->queryF( "DELETE FROM " . $xoopsDB->prefix($xoopsModule->dirname() . "_bot") . "
                                          WHERE botid = $botid" );
			redirect_header( "bots.php", 1, _MD_CHATBOT_DELETED );
			exit();
		}
		else
		{
			$botid = ( isset( $_POST['botid'] ) ) ? intval($_POST['botid']) : intval($botid);
                        include_once( "admin_header.php" );
			xoops_confirm( array( 'op' => 'del', 'botid' => $botid, 'confirm' => 1, 'subject' => '' ), 'bots.php', _MD_CHATBOT_DELETETHISDATA, _MD_CHATBOT_DELETE );
                        include_once( 'admin_footer.php' );
		}
		exit();
                break;
        

	case "default":
	default:
		include_once( "admin_header.php" );
                chatbot_adminmenu(1, _MD_CHATBOT_BOT);
                displaytopics();
                echo '<p />';
		editarticle();
		include_once( 'admin_footer.php' ); 
		break;
}

?>