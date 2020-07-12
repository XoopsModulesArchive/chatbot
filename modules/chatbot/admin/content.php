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
$catid = isset( $_GET['catid'] ) ? intval( $_GET['catid'] ) : 0;

function displayreplies($catid = '')
	{
        global $xoopsDB, $xoopsModuleConfig, $xoopsModule;
        include_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $startart = isset( $_GET['startart'] ) ? intval( $_GET['startart'] ) : 0;
        if ( $startart ) { $page = '&startart='.$startart; } else { $page = ''; }
        $search   = isset( $_GET['search'] )   ? $_GET['search'] : '';
        if ( isset( $_POST['search'] ) )    $search = $_POST['search'];
                        $searchedit = '';
                        $where = ' WHERE a.id > 0 ';
        $catedit = '';
        if( $catid )  { $where .= ' AND a.catid = '.$catid; $catedit = 'catid='.$catid.'&'; }
        if( $search ) { $where .= ' AND (a.pref_or LIKE "%'.$search.'%"
                                    OR a.pref_and LIKE "%'.$search.'%"
                                    OR a.pref_misc LIKE "%'.$search.'%")'; $searchedit = '&search='.$search;}

        $sql = "SELECT count(a.id)
                FROM " . $xoopsDB->prefix( $xoopsModule->dirname() . '_content' ). " a "
                . $where;
        $result = $xoopsDB->queryF( $sql );
        list( $total ) = $xoopsDB -> fetchRow( $result );
        $pagenav = new XoopsPageNav( $total, $xoopsModuleConfig['chatbot_perpage']*2, $startart, $searchedit.$catedit.'startart' );


          $sql = "SELECT a.id, a.catid, a.status, a.pref_or, a.pref_and,
                         a.pref_misc, a.reply, a.question, b.cat_subject
                  FROM      " . $xoopsDB->prefix( $xoopsModule->dirname() . '_content' ).  " a
                  LEFT JOIN " . $xoopsDB->prefix( $xoopsModule->dirname() . '_topics' ). " b
                  ON a.catid = b.catid
                  $where
                  ORDER BY a.catid ASC, a.pref_and ASC";

          $result = $xoopsDB->queryF( $sql, $xoopsModuleConfig['chatbot_perpage']*2,  $startart );


          $search_form = '&nbsp;&nbsp;&nbsp;&nbsp;
                          <form style="margin:0px; vertical-align:middle; text-align:right;" action="?catid='.$catid.'&search='.$search.'&startart='.$startart.'" method="post">
                          <input style="margin:0px; vertical-align:center;" type="text" name="search" size="30" maxlength="30" value="'.$search.'">&nbsp;
                          <button style="font-size:11px;" type="submit">'._MD_CHATBOT_SEARCH.'</button>
                          <button style="font-size:11px;" name="search" type="submit">'._MD_CHATBOT_CANCEL.'</button>
                          </form>
                	';
                	
          $select_form = chatbot_selector($catid, 'chatbot_topics|catid|cat_subject|||', 'content.php?catid', _MD_CHATBOT_EDIT_AKALI);
          $sform = new XoopsThemeForm( "<div style='text-align:right;'>"._MD_CHATBOT_REPLIES.": ".$select_form.$search_form."</div>", "", "" );
          $display = '  <tr><td colspan="2">';
          $display .= ' <table class="outer" width="100%">';
          $display_header = '
                        <tr>
                           <th>'._MD_CHATBOT_STATUS.'</th>
                           <th>'._MD_CHATBOT_TITLE_AND.'</th>
                           <th>'._MD_CHATBOT_TITLE_OR.'</th>
                           <th>'._MD_CHATBOT_TITLE_CONTEXT.'</th>
                           <th>'._MD_CHATBOT_TITLE_REPLY.'</th>
                           <th>'._MD_CHATBOT_TITLE_QUESTION.'</th>
                           <th> '._MD_CHATBOT_ADMIN.'</th>
                        </tr>
                      ';
//          $display .= $display_header;
          $ii = 0;
          $catid_tmp = '';

          while ( list( $id, $catid, $status, $pref_or, $pref_and, 
                        $pref_misc, $reply, $question, $cat_subject) = $xoopsDB -> fetchrow( $result ) )
	{
                 if ($status) { $status_image = '<img src="../images/icon/online.gif" /><br />'; $stat=0;
                       } else { $status_image = '<img src="../images/icon/offline.gif" /><br />'; $stat=1;}
                 $edit =   '<a href="?op=mod&'.$catedit.'id='.$id.$searchedit.$page.'"><img src="../images/icon/edit.gif" /></a>';
                 $delete = '<a href="?op=del&'.$catedit.'id='.$id.$searchedit.$page.'"><img src="../images/icon/delete.gif" /></a>';

                 if($catid_tmp != $catid ) {
                 $display .= '
                        <tr>
                           <th colspan="8"><a href="?'.$searchedit.'catid='.$catid.'">'.$cat_subject.'</a></th>
                        </tr>
                      ';
                  $display .= $display_header;
                  }
                 $catid_tmp = $catid;

                 $ii++;
                 if( $reply )    {$reply_ul = '<ul><li>'; $reply_ul2 = '</li></ul>';} else {$reply_ul='';$reply_ul2='';}
                 if( $question ) {$question_ul = '<ul><li>';  $question_ul2 = '</li></ul>';} else {$question_ul = '';$question_ul2 = '';}
                 $display .= '                   
                           <tr>
                             <td class="odd"><a href="content.php?op=status&status='.$stat.'&id='.$id.'&startart='.$startart.'">'.$status_image.'</a></td>
                             <td class="even">'.$pref_and.'</td>
                             <td class="even">'.$pref_misc.'</td>
                             <td class="even">'.$pref_or.'</td>
                             <td class="even" width="25%">'.$reply_ul.ereg_replace("\|", "</li><li>", $reply ).$reply_ul2.'</td>
                             <td class="even" width="25%">'.$question_ul.ereg_replace("\|", "</li><li>", $question ).$question_ul2.'</td>
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
function editarticle( $id = '' )
	{
	global $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $xoopsModuleConfig, $xoopsModule, $XOOPS_URL;
	$catid = isset( $_GET['catid'] ) ? intval( $_GET['catid'] ) : 0;
        if( !isset($cat_id) )        { $cat_id = $catid; }    else { $cat_id = intval($cat_id); }
        if( !isset($status) )        { $status = 1; }    else { $status = intval($status); }

        if( !isset($pref_or) )       { $pref_or = ''; }   else { $pref_or   = intval($pref_or); }
        if( !isset($pref_and) )      { $pref_and = ''; }  else { $pref_and  = intval($pref_and); }
        if( !isset($pref_misc) )     { $pref_misc = ''; } else { $pref_misc = intval($pref_misc); }
	if( !isset($reply) )         { $reply = ''; }     else { $reply     = intval($reply); }
        if( !isset($question) )      { $question = ''; }  else { $question  = intval($question); }

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
    ' .  _MD_CHATBOT_HOWTO_CONTENT_01.
         _MD_CHATBOT_HOWTO_CONTENT_02.
         _MD_CHATBOT_HOWTO_CONTENT_03 . '
    <div>

    <script type="text/javascript" language="javascript">toggle(getObject("selecthelp_link"), "selecthelp");</script>

</td></tr>
';


	// If there is a parameter, and the id exists, retrieve data: we're editing an chatbot
	if ( $id )
	{
		$result = $xoopsDB -> queryF( "SELECT * 
                                               FROM " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_content" ) . "
                                               WHERE id = $id" );
		
		if ( !$xoopsDB -> getRowsNum( $result ) )
		{
			redirect_header( "content.php", 1, _MD_CHATBOT_NOTHINGTOEDIT );
			exit();
		}

		list( $id, 
                      $cat_id,
                      $status,
                      $pref_or,
                      $pref_and,
                      $pref_misc,
                      $reply,
                      $question ) = $xoopsDB -> fetchrow( $result );

                      $sform = new XoopsThemeForm( _MD_CHATBOT_EDIT.$help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}
    else // there's no parameter, so we're adding an chatbot
	{
		$sform = new XoopsThemeForm( _MD_CHATBOT_CREATE.$help_display_link, "op", xoops_getenv( 'PHP_SELF' ) );
	}


      	$sform -> setExtra( 'enctype="multipart/form-data"' );
      	$sform -> addElement( $help_display );

// ONLINE
	// Code to take article offline, for maintenance purposes
	$status_radio = new XoopsFormRadioYN( _MD_CHATBOT_STATUS,
                                              'status',
                                              $status, 
                                              '&nbsp;<img src="../images/icon/online.gif"  align="absmiddle" alt="'._MD_CHATBOT_ONLINE.'" />&nbsp;'._MD_CHATBOT_ONLINE.'<br />',
                                              '&nbsp;<img src="../images/icon/offline.gif" align="absmiddle" alt="'._MD_CHATBOT_OFFLINE.'" />&nbsp;'._MD_CHATBOT_OFFLINE);
	$sform -> addElement($status_radio);
// Category
	// Code to create the topics selector
        $sql = " SELECT catid, cat_subject
                 FROM ".$xoopsDB->prefix($xoopsModule->dirname() . "_topics" )."
                 ORDER BY cat_subject ASC";
        $result = $xoopsDB->queryF($sql);
        $topics = array();
        while(list( $catid, $cat_subject ) = $xoopsDB->fetchRow($result))
	           {
                     $topics[$catid] = $cat_subject;
                   }  

	$topics_array = $topics;
 	$topics_select = new XoopsFormSelect( '', 'catid', $cat_id );
	$topics_select -> addOptionArray( $topics_array );
	$topics_tray = new XoopsFormElementTray( _MD_CHATBOT_TOPIC, '&nbsp;' );
	$topics_tray -> addElement( $topics_select );
	$sform -> addElement( $topics_tray );

// Prefix
	// This part is common to edit/add
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_AND,   'pref_and', 70, 255, $pref_and ), FALSE );
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_OR,  'pref_misc',70, 255, $pref_misc ), FALSE );
	$sform -> addElement( new XoopsFormText( _MD_CHATBOT_CONTEXT,    'pref_or',  70, 255, $pref_or ), FALSE );

// Content
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_REPLY,    'reply', $reply ), FALSE );
        $sform->addElement(new XoopsFormTextArea(_MD_CHATBOT_QUESTION, 'question', $question ), FALSE );

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
         chatbot_adminmenu(3, _MD_CHATBOT_EDIT);
         displayreplies($catid);
         echo "<p />";
         editarticle($id);
         include_once( 'admin_footer.php' );
         break;

    case "status":
         if ( isset( $_GET['status'] ) )  { $status = $_GET['status']; }
		if ( $xoopsDB -> queryF( "UPDATE " . $xoopsDB -> prefix( $xoopsModule->dirname() . "_content" ) . "
                                      SET status  = '$status'
                                      WHERE id = '$id'" ) )
			{       redirect_header( "content.php?startart=$startart", 1, _MD_CHATBOT_UPDATED );
			} else {
				redirect_header( "content.php?startart=$startart", 1, _MD_CHATBOT_NOTUPDATED);
			}
         exit();
         break;


     case "addart":
     $myts =& MyTextSanitizer::getInstance();

         $id              = isset($_POST['id']) ? intval($_POST['id']) : 0;
         $catid           = isset($_POST['catid']) ? intval( $_POST['catid'] ) : 0;
         $status          = isset($_POST['status']) ? intval($_POST['status']) : 1;

         $pref_or         = strtoupper($_POST['pref_or']);
         $pref_and        = strtoupper($_POST['pref_and']);
         $pref_misc       = strtoupper($_POST['pref_misc']);

         $reply           = $_POST['reply'];
         $question        = $_POST['question'];

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
                            '$status',
                            '$pref_or',
                            '$pref_and',
                            '$pref_misc',
                            '$reply',
                            '$question' )" ) )
			{
				redirect_header( "content.php?catid=".$catid, 1, _MD_CHATBOT_CREATED );
			}
			else
			{
				redirect_header( "content.php?catid=".$catid, 1, _MD_CHATBOT_NOTCREATED );
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
                                redirect_header( "content.php?catid=$catid", 1, _MD_CHATBOT_UPDATED );

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
			$xoopsDB->queryF( "DELETE FROM " . $xoopsDB->prefix($xoopsModule->dirname() . "_content") . "
                                          WHERE id = $id" );
			redirect_header( "content.php", 1, _MD_CHATBOT_DELETED );
			exit();
		}
		else
		{
			$id = ( isset( $_POST['id'] ) ) ? intval($_POST['id']) : intval($id);
                        include_once( "admin_header.php" );
			xoops_confirm( array( 'op' => 'del', 'id' => $id, 'confirm' => 1, 'subject' => '' ), 'content.php', _MD_CHATBOT_DELETETHISDATA, _MD_CHATBOT_DELETE );
                        include_once( 'admin_footer.php' );
		}

		exit();
                break;
        

	case "default":
	default:
		include_once( "admin_header.php" );
                chatbot_adminmenu(3, _MD_CHATBOT_CONTENT);
                displayreplies($catid);
                echo "<p />";
		editarticle();
		include_once( 'admin_footer.php' ); 
		break;
}
?>