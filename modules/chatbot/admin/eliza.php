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
$id= '';
if ( isset( $_GET['op'] ) ) $op = $_GET['op'];
if ( isset( $_POST['op'] ) ) $op = $_POST['op'];

if ( isset( $_GET['id'] ) )  $id = $_GET['id'];
if ( isset( $_POST['id'] ) ) $id = $_POST['id'];

$startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;

function displayreplies()
	{
        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;
        include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;
        if($startart) {$page='&startart='.$startart;} else {$page='';}
        $type = isset( $_GET['type'] ) ? intval( $_GET['type'] ) : 'all';
        if( $type!='all' ) { $where = "WHERE type=" . $type; } else { $where = ''; }
        $sql = "SELECT count(id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_eliza' ) . " " .
                $where;
        $result = $xoopsDB->queryF( $sql );
        list( $total ) = $xoopsDB -> fetchRow( $result );
        $pagenav = new XoopsPageNav( $total, $xoopsModuleConfig['chatbot_perpage']*2, $startart, 'type='.$type.'&startart' );

          $sql = "SELECT *
                  FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_eliza' ) . " " .
                  $where . "
                  ORDER BY type ASC, keyword ASC";

          $result = $xoopsDB->queryF( $sql, $xoopsModuleConfig['chatbot_perpage']*2,  $startart );
          for($i=0; $i<=3; $i++) { $selected[$i] = ''; }
          $selected[$type] = 'selected'; $i=0;
          $select = chatbot_selector($type, 'chatbot_eliza|type|type|||GROUP BY type', 'eliza.php?op=mod&type', _MD_CHATBOT_EDIT_ELIZA);
          $sform = new XoopsThemeForm(_MD_CHATBOT_TYPE.":".$select, "", "" );
          $display = '<tr><td colspan="2"><table class="outer" width="100%">';
          $display_convert = '
                           <tr>
                           <th>'._MD_CHATBOT_STATUS.'</th>
                           <th>'._MD_CHATBOT_FROM.'</th>
                           <th>'._MD_CHATBOT_TO.'</th>
                           <th> '._MD_CHATBOT_ADMIN.'</th>
                           </tr>
                      ';
          $display_datas = '
                           <tr>
                           <th>'._MD_CHATBOT_STATUS.'</th>
                           <th>'._MD_CHATBOT_KEYWORD.'</th>
                           <th>'._MD_CHATBOT_REPLIES_.'</th>
                           <th> '._MD_CHATBOT_ADMIN.'</th>
                           </tr>
                      ';
                      $i = 0; $ii = 0; $iii = 0;
          while ( list( $id, $status, $type, $keyword, $response) = $xoopsDB -> fetchrow( $result ) )
	{
                 if ($status) { $status_image = '<img src="../images/icon/online.gif" /><br />'; $stat=0;
                       } else { $status_image = '<img src="../images/icon/offline.gif" /><br />'; $stat=1; }

                 $edit =   '<a href="?op=mod&id='.$id.'&type='.$type.$page.'"><img src="../images/icon/edit.gif" /></a>';
                 $delete = '<a href="?op=del&id='.$id.'&type='.$type.$page.'"><img src="../images/icon/delete.gif" /></a>';
                 if($type==3 && !$i) { $display .= $display_datas; $i++;}
                 if($type==1 && !$ii) { $display .= $display_convert; $ii++;}
                 if($type==2 && !$iii) { $display .= $display_convert; $iii++;}
                 $display .= '
                           <tr>
                           <td class="odd"><a href="eliza.php?op=status&status='.$stat.'&id='.$id.'&startart='.$startart.'">'.$status_image.'</a></td>
                           <td class="even"><ul><li>' . ereg_replace("\|", "</li><li>", $keyword ) . '</li></ul></td>
                           <td class="even" style="text-align:left;"><ul><li>' . ereg_replace("\|", "</li><li>", $response ) . '</li></ul></td>
                           <td class="even" width="30px"><nobr>'.$edit.'|'.$delete.'</nobr></td>
                           </tr>
                           ';

//                            <td class="even">'.substr($response,0,strpos($response,'|')+strlen('|')-1).'</td>
        }
         $display .= '</table>
                      <div style="text-align:right;">' . $pagenav -> renderNav() . '</div>
         </td></tr>';
                $sform -> addElement( $display );
        	$sform -> display();
 }


// -- Edit function -- //
function editarticle( $id = '' )
	{
	global $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $xoopsModuleConfig, $xoopsModule, $XOOPS_URL;
	$myts =& MyTextSanitizer::getInstance();
	$type = isset( $_GET['type'] ) ? intval( $_GET['type'] ) : 'all';
        if( !isset($cat_id) )        { $cat_id = 0; } //   else { $cat_id = intval($cat_id); }
        if( !isset($status) )        { $status = 1; } //   else { $status = intval($status); }
        if( !isset($type) )          { $type = 3; } //  else { $type   = intval($type); }
        if( !isset($keyword) )       { $keyword = ''; } //  else { $keyword   = intval($keyword); }
        if( !isset($response) )      { $response = ''; } //  else { $response  = intval($response); }

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
    ' .  _MD_CHATBOT_HOWTO_ELIZA_01.
         _MD_CHATBOT_HOWTO_ELIZA_02.
         _MD_CHATBOT_HOWTO_ELIZA_03 . '
    <div>
    <script type="text/javascript" language="javascript">toggle(getObject("selecthelp_link"), "selecthelp");</script>
</th></tr>
';

	// If there is a parameter, and the id exists, retrieve data: we're editing an chatbot
	if ( $id )
	{
		$result = $xoopsDB -> queryF( "SELECT * 
                                               FROM " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_eliza" ) . "
                                               WHERE id = $id" );
		
		if ( !$xoopsDB -> getRowsNum( $result ) )
		{
			redirect_header( "eliza.php", 1, _MD_CHATBOT_NOTHINGTOEDIT );
			exit();
		}

		list( $id,
                      $status,
                      $type,
                      $keyword,
                      $response ) = $xoopsDB -> fetchrow( $result );

                      $sform = new XoopsThemeForm( _MD_CHATBOT_EDIT.$help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}
    else // there's no parameter, so we're adding an chatbot
	{
		$sform = new XoopsThemeForm( _MD_CHATBOT_CREATE.$help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}


      	$sform -> setExtra( 'enctype="multipart/form-data"' );
        $sform -> addElement( $help_display );
// Status
	$status_radio = new XoopsFormRadioYN( _MD_CHATBOT_STATUS,
                                              'status',
                                              $status, 
                                              '&nbsp;<img src="../images/icon/online.gif"  align="absmiddle" alt="'._MD_CHATBOT_ONLINE.'" />&nbsp;'._MD_CHATBOT_ONLINE.'<br />',
                                              '&nbsp;<img src="../images/icon/offline.gif" align="absmiddle" alt="'._MD_CHATBOT_OFFLINE.'" />&nbsp;'._MD_CHATBOT_OFFLINE);
	$sform -> addElement($status_radio);

// Data Type
	$type_radio = new XoopsFormRadio(_MD_CHATBOT_TYPE, 'type', $type);
	$type_radio->addOption("1", _MD_CHATBOT_CONVERSIONS.'<br />');
	$type_radio->addOption("2", _MD_CHATBOT_CORRECTIONS.'<br />');
	$type_radio->addOption("3", _MD_CHATBOT_DATAS.'<br />');
	$sform -> addElement( $type_radio );

// Prefix
// This part is common to edit/add
//	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_KEYWORD,   'keyword', 70, 255, $keyword ), TRUE );
	if($type==3) {
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_SENTENCE, 'keyword', $keyword, 10 ), TRUE );
        } else {
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_KEYWORD, 'keyword', 70, 255, $myts->htmlSpecialChars($keyword) ), TRUE );
        }

// Content
	if($type==3) {
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_REPLY_,    'response', $response, 10 ), TRUE );
        } else {
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_REPLACEMENT,'response', 70, 255, $myts->htmlSpecialChars($response) ), TRUE );
        }

	$sform -> addElement( new XoopsFormHidden( 'id', $id ) );
	$button_tray = new XoopsFormElementTray( '', '' );
	$hidden = new XoopsFormHidden( 'op', 'addart' );
	$button_tray -> addElement( $hidden );

	if ( !$id ) // there's no id? Then it's a new data
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
         chatbot_adminmenu(4, _MD_CHATBOT_EDIT);
         displayreplies();
         echo "<p />";
         editarticle($id);
         include_once( 'admin_footer.php' );
         break;

    case "status":
         if ( isset( $_GET['status'] ) )  { $status = $_GET['status']; }
		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_eliza" ) . "
                                      SET status  = '$status'
                                      WHERE id = '$id'" ) )
			{       redirect_header( "eliza.php?startart=$startart", 1, _MD_CHATBOT_UPDATED );
			} else {
				redirect_header( "eliza.php?startart=$startart", 1, _MD_CHATBOT_NOTUPDATED);
			}
         exit();
         break;

     case "addart":
     $myts =& MyTextSanitizer::getInstance();

         $id              = isset($_POST['id']) ? intval($_POST['id']) : 0;
         $status          = isset($_POST['status']) ? intval($_POST['status']) : 1;
         $type            = isset($_POST['type']) ? intval($_POST['type']) : 3;

         $keyword         = $_POST['keyword'];
         $response        = $_POST['response'];


         $startart        = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;
//         $type            = isset( $_GET['type'] )     ? intval( $_GET['type'] ) : 'all';

// Save to database

		if ( !$id )
		{
		if ( $xoopsDB -> queryF( "INSERT INTO " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_eliza" ) .
                  " ( id,
                      status,
                      type,
                      keyword,
                      response
                              )
                        VALUES (
                            '',
                            '$status',
                            '$type',
                            '$keyword',
                            '$response' )" ) )
			       { redirect_header( "eliza.php?type=$type&startart=$startart", 1, _MD_CHATBOT_CREATED );
			} else { redirect_header( "eliza.php?type=$type&startart=$startart", 1, _MD_CHATBOT_NOTCREATED ); }
		}
		else  // That is, $id exists, thus we're editing an article
		{
		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_eliza" ) . "
                                      SET status        =     '$status',
                                      type              =     '$type',
                                      keyword              =     '$keyword',
                                      response               =     '$response'
                                      WHERE id = '$id'" ) )
			       { redirect_header( "eliza.php?type=$type&startart=$startart", 1, _MD_CHATBOT_UPDATED );
			} else { redirect_header( "eliza.php?type=$type&startart=$startart", 1, _MD_CHATBOT_NOTUPDATED); }
		}
		exit();
		break;

	case "del":

        	$confirm = (isset($_POST['confirm'])) ? 1 : 0;

		if ($confirm)
		{
			$xoopsDB->queryF( "DELETE FROM " . $xoopsDB->prefix($xoopsModule->dirname() . "_eliza") . "
                                          WHERE id = $id" );
			redirect_header( "eliza.php?startart=$startart", 1, _MD_CHATBOT_DELETED );
			exit();
		}
		else
		{
			$id = ( isset( $_POST['id'] ) ) ? intval($_POST['id']) : intval($id);
                        include_once( "admin_header.php" );
			xoops_confirm( array( 'op' => 'del', 'id' => $id, 'confirm' => 1, 'subject' => '' ), 'eliza.php?startart='.$startart, _MD_CHATBOT_DELETETHISDATA, _MD_CHATBOT_DELETE );
                        include_once( 'admin_footer.php' );
		}

		exit();
                break;


	case "default":
	default:
		include_once( "admin_header.php" );
                chatbot_adminmenu(4, _MD_CHATBOT_CONTENT);
                displayreplies();
                echo "<p />";
		editarticle();
		include_once( 'admin_footer.php' ); 
		break;
}
?>