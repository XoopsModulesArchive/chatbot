<?php
/**
* XOOPS - PHP Content Management System
* Copyright (c) 2004 <http://www.xoops.org/>
*
* Module: chatbot 1.0
* Licence : GPL
* Authors :         
*           - solo (http://www.wolfpackclan.com/wolfactory)
*			- DuGris (http://www.dugris.info)
*/


include_once( '../../../mainfile.php');
include_once( '../../../include/cp_header.php');

$op = '';
foreach ( $HTTP_POST_VARS as $k => $v ) { ${$k} = $v; }
foreach ( $HTTP_GET_VARS as $k => $v ) { ${$k} = $v; }
if ( isset( $_GET['op'] ) ) $op = $_GET['op'];
if ( isset( $_POST['op'] ) ) $op = $_POST['op'];
if ( isset($_GET['botid'])) { $botid = $_GET['botid']; } else { $botid = ''; }
// if ( isset( $_GET['bot_directory'] ) ) $bot_directory = $_GET['bot_directory'];

function utilities( $bot_id ) {
	global $xoopsConfig, $modify, $xoopsModuleConfig, $xoopsModule, $XOOPS_URL, $xoopsDB;
//        if ( !isset($bot_id)) { $bot_id = 0; }
        $select_form = chatbot_selector($bot_id, 'chatbot_bot|botid|bot_name|||', 'uploader.php?botid');

        $sform = new XoopsThemeForm( _MD_CHATBOT_UPLOAD.' : '.$select_form, "op", xoops_getenv( 'PHP_SELF' ) );
        $sform -> setExtra( 'enctype="multipart/form-data"' );
        
// Bots
	// Code to create the bot selector
        $sql = " SELECT botid, bot_name, bot_directory
                 FROM ".$xoopsDB->prefix("chatbot_bot" )."
                 ORDER BY bot_name ASC";
        $result = $xoopsDB->queryF($sql);
        $bot = array();
        $bot['']=''; $current=''; $current_dir='uploads/chatbot/';
        while(list( $botid, $bot_name, $bot_directory ) = $xoopsDB->fetchRow($result))
	           {
                    $bot_values = $botid.' '.$bot_directory;
                    if($botid==$bot_id) { $current=$botid.' '.$bot_directory; 
                                          $current_dir = $bot_directory;}
                    $bot[$bot_values] = $bot_name;
                   }

	$botdir_array = $bot;
 	$botdir_select = new XoopsFormSelect( '', 'bot_directory', $current );
	$botdir_select -> addOptionArray( $botdir_array );
	$botdir_tray = new XoopsFormElementTray( _MD_CHATBOT_BOTS, '&nbsp;' );
	$botdir_tray -> addElement( $botdir_select );
//	$sform -> addElement( $botdir_tray );
	$sform -> addElement( new XoopsFormHidden( 'bot_directory', $current ) );


// File selector
	$sform -> addElement( new XoopsFormFile( _MD_CHATBOT_UPLOADMEDIA, 'cmedia', '' ), TRUE );





//        $sform -> addElement( new XoopsFormHidden( 'bot_directory', $bot_directory ) );

	$button_tray = new XoopsFormElementTray( '', '' );
	$hidden = new XoopsFormHidden( 'op', 'uploadmedia' );
	$button_tray -> addElement( $hidden );
	$butt_create = new XoopsFormButton( '', '', _MD_CHATBOT_SUBMIT, 'submit' );
	$butt_create->setExtra('onclick="this.form.elements.op.value=\'uploadmedia\'"');
	$button_tray->addElement( $butt_create );
	$butt_clear = new XoopsFormButton( '', '', _MD_CHATBOT_CLEAR, 'reset' );
	$button_tray->addElement( $butt_clear );
	$butt_cancel = new XoopsFormButton( '', '', _MD_CHATBOT_CANCEL, 'button' );
	$butt_cancel->setExtra('onclick="history.go(-1)"');
	$button_tray->addElement( $butt_cancel );

	$sform -> addElement( $button_tray );
	
	//	Code to create the media selector
	$graph_array = & XoopsLists :: getImgListAsArray( XOOPS_ROOT_PATH . '/'.$current_dir );
	$image_select = new XoopsFormSelect( '', 'image', '' );
	$image_select -> addOptionArray( $graph_array );
	$image_select -> setExtra( 'onchange=\'showImgSelected("image5", "image", "' . $current_dir . '", "", "' . XOOPS_URL . '")\'' );
	$image_tray = new XoopsFormElementTray( _MD_CHATBOT_MEDIA, '&nbsp;' );
	$image_tray -> addElement( $image_select );
 	$image_tray -> addElement( new XoopsFormLabel( '', '<p /><img src="' . XOOPS_URL . '/modules/chatbot/images/blank.gif" name="image5" id="image5" alt="" />' ) );
	$sform -> addElement( $image_tray );


	$sform -> display();
	unset( $hidden );
}


function chatbot_uploading( $file_name='',
                            $allowed_mimetypes='',
                            $dir='uploads/chatbot/',
                            $redirecturl = 'uploader.php',
                            $file_options='1024|748|1024000)',
                            $num=0, $redirect=1 )
{
    global $HTTP_POST_VARS;
    include_once XOOPS_ROOT_PATH . "/class/uploader.php";

    $media_options  = explode('|', $file_options);
    $maxfilewidth   = $media_options[0];
    $maxfileheight  = $media_options[1];
    $maxfilesize    = $media_options[2];
    $uploaddir      = XOOPS_ROOT_PATH . "/" . $dir;
    $file           = $uploaddir . $file_name;
    if( is_file($file) ) { unlink($file); $comment=_MD_CHATBOT_UPDATED;} else {$comment=_MD_CHATBOT_UPLOADED;}
    
    $uploader = new XoopsMediaUploader( $uploaddir, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight );

    if ( $uploader -> fetchMedia( $HTTP_POST_VARS['xoops_upload_file'][$num] ) )
    {
                    if ( !$uploader -> upload() ) {
                        $errors = $uploader -> getErrors();
                        redirect_header( $redirecturl, 3, _MD_CHATBOT_UPLOAD_ERROR . $errors );
                    } else {
                        if ( $redirect ) { redirect_header( $redirecturl, $redirect, $comment ); }
                    }
    } else {
        $errors = $uploader -> getErrors();
        redirect_header( $redirecturl, 3, _MD_CHATBOT_UPLOAD . $errors );
    }

}


/* -- Available operations -- */
switch ( $op ) {
	case "uploadmedia":
	$allowed_mimetypes = array( 'image/gif', 
                                    'image/jpeg', 
                                    'image/pjpeg', 
                                    'image/x-png', 
                                    'image/png' );
        $file_name = $HTTP_POST_FILES['cmedia']['name'];
        if(!isset($bot)) {$bot[0]='';$bot[1]='uploads/chatbot/';}
        chatbot_uploading( $file_name,
                           $allowed_mimetypes, 
                           $bot[1],
                           'uploader.php?botid='.$bot[0] );
        break;


    case "utilities":
    default:
    	include_once( "admin_header.php" );
        chatbot_adminmenu(6, _MD_CHATBOT_UTILITIES);
        chatbot_statmenu(0, '');
        utilities( $botid );
        include_once( 'admin_footer.php' );
	break;
}
?>