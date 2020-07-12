<?php
/**
* Module: chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*           - DuGris (http://www.dugris.info)
*/

if (!defined("XOOPS_ROOT_PATH")) { die("XOOPS root path not defined"); }

function chatbot_adminmenu($currentoption = 0, $breadcrumb = '') {

	echo "
    	<style type='text/css'>
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . "/modules/chatbot/images/bg.gif') repeat-x left bottom; font-size: 10px; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:0px 5px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url('" . XOOPS_URL . "/modules/chatbot/images/left_both.gif') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; white-space: nowrap}
		#buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . "/modules/chatbot/images/right_both.gif') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; white-space: nowrap}
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#buttonbar a span {float:none;}
		/* End IE5-Mac hack */
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";
	// global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig;
	global $xoopsModule, $xoopsConfig;
	$myts = &MyTextSanitizer::getInstance();

	$tblColors = Array_Fill(0,8,'');
	$tblColors[$currentoption] = 'current';

	if (file_exists(XOOPS_ROOT_PATH . '/modules/'.$xoopsModule->dirname().'/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
		include_once XOOPS_ROOT_PATH . '/modules/'.$xoopsModule->dirname().'/language/' . $xoopsConfig['language'] . '/modinfo.php';
	} else {
		include_once XOOPS_ROOT_PATH . '/modules/'.$xoopsModule->dirname().'/language/french/modinfo.php';
	}

	include 'menu.php';

	echo '<div id="buttontop">';
	echo '<table style="width: 100%; padding: 0;" cellspacing="0"><tr>';
	echo '<td style="font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;">';
	for( $i=0; $i<count($headermenu); $i++ ){
		echo '<a class="nobutton" href="' . $headermenu[$i]['link'] .'">' . $headermenu[$i]['title'] . '</a> ';
		if ($i < count($headermenu)-1) {
			echo "| ";
		}
	}
	echo "| " . chatbot_selector('', 'chatbot_bot|botid|bot_name|||', '../bot.php?id', _MD_CHATBOT_EDIT_BOT, 'select', 1);
	echo '</td>';
	echo '<td style="font-size: 12px; text-align: right; color: #CC0000; padding: 0 6px; line-height: 18px; font-weight: bold;">' . $breadcrumb . '</td>';
	echo '</tr></table>';
	echo '</div>';

	echo '<div id="buttonbar">';
	echo "<ul>";

	for( $i=0; $i<count($adminmenu); $i++ ){
		echo '<li id="' . $tblColors[$i] . '"><a href="' . XOOPS_URL . '/modules/'.$xoopsModule->dirname().'/' . $adminmenu[$i]['link'] . '"><span>' . $adminmenu[$i]['title'] . '</span></a></li>';
	}
	echo '</ul></div>';
        echo '<div style="float: left; width: 100%; text-align: center; margin: 0px; padding: 0px">';
        // Generate select boxes
        echo '<nobr>';
        echo chatbot_selector('', 'chatbot_bot|botid|bot_name|||', 'bots.php?op=mod&botid', _MD_CHATBOT_EDIT_BOT, 'box', 4);
        echo chatbot_selector('', 'chatbot_topics|catid|cat_subject|||', 'topics.php?op=mod&catid', _MD_CHATBOT_EDIT_TOPIC, 'box', 4);
        echo chatbot_selector('', 'chatbot_topics|catid|cat_subject|||', 'content.php?op=mod&catid', _MD_CHATBOT_EDIT_AKALI, 'box', 4);
        echo chatbot_selector('', 'chatbot_eliza|type|type|||GROUP BY type', 'eliza.php?op=mod&type', _MD_CHATBOT_EDIT_ELIZA, 'box', 4);
        echo chatbot_selector('', 'chatbot_report|id|date|||GROUP BY date', 'reports.php?op=mod&id', _MD_CHATBOT_EDIT_REPORT, 'box', 4);
        echo '</nobr><br /><br />';
}

function chatbot_statmenu($currentoption = 0, $breadcrumb = '') {
	echo "
    	<style type='text/css'>
    	#statbar { float:right; font-size: 10px; line-height:normal; margin-bottom: 0px;}
    	#statbar ul { margin:0px; margin-top: 0px; padding:0px 0px; list-style:none; }
		#statbar li { display:inline; margin:0; padding:0px;}
		#statbar a  { float:left; background-color: #DDE; margin:0px; padding: 5px; text-align: center; text-decoration:none;
                              border: 1px outset #008; border-bottom: 0px; white-space: nowrap}
		#statbar a span { display:block; white-space: nowrap; color:#888;}
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#statbar a span {float:none;}
		/* End IE5-Mac hack */
		#statbar a:hover span { color:#008; }
		#statbar #current a { background-color: #EEE; border: 1px inset #008; border-bottom: 0px;}
		#statbar #current a span { background-color: #EEE; color:#800; }
		#statbar a:hover { background-position:0% -150px; background-color: #FEE; 
                                   border: 1px inset #008; border-bottom: 0px;}
		#statbar a:hover span { background-position:100% -150px; background-color: #FEE; }
		</style>
    ";
	// global $xoopsDB, $xoopsModule, $xoopsConfig, $xoopsModuleConfig;
	global $xoopsModule, $xoopsConfig;
	$myts = &MyTextSanitizer::getInstance();

	$tblColors = Array_Fill(0,4,'');
	$tblColors[$currentoption] = 'current';


	if (file_exists(XOOPS_ROOT_PATH . '/modules/chatbot/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
		include_once XOOPS_ROOT_PATH . '/modules/chatbot/language/' . $xoopsConfig['language'] . '/modinfo.php';
	} else {
		include_once XOOPS_ROOT_PATH . '/modules/chatbot/language/english/modinfo.php';
	}

	include 'menu.php';
/*
echo '<div id="adminmenu" style="visibility:hidden;position:absolute;z-index:100;top:-100"></div>';
echo '<script language="JavaScript1.2" src="../script/popmenu.js" type="text/javascript"></script>';
echo'
     <script language="JavaScript1.2"  type="text/javascript">
     ';

	for( $i=0; $i<count($statmenu); $i++ ){
echo '
      Text['.$i.']=["'.$statmenu[$i]['title'].'","'.$statmenu[$i]['help'].'"]
';
 }
*/
 /* The Style array parameters come in the following order
Style[...]=[titleColor,TitleBgColor,TitleBgImag,TitleTextAlign,TitleFontFace,TitleFontSize,
            TextColor,TextBgColor,TextBgImag,TextTextAlign,TextFontFace,TextFontSize,
            Width,Height,BorderSize,BorderColor,
            Textpadding,transition number,Transition duration,
            Transparency level,shadow type,shadow color,Appearance behavior,TipPositionType,Xpos,Ypos]
*/
/*
echo '
      Style[0]=["white","#2F5376","","","","","black","white","","center","",,300,,1,"#2F5376",2,,,96,2,"black",,,,]
';
echo '
     var TipId="adminmenu"
     var FiltersEnabled = 1
     mig_clay()
     </script>
     ';
*/
	echo '<br /><div id="statbar">';
	echo "<ul>";

	for( $i=0; $i<count($statmenu); $i++ ){
		echo '<li id="' . $tblColors[$i] . '">
                      <a onMouseOver="stm(Text['.$i.'],Style[0])" onMouseOut="htm()"
                         href="' . XOOPS_URL . '/modules/chatbot/' . $statmenu[$i]['link'] . '">
                      <span>' . $statmenu[$i]['title'] . '</span></a></li>';
	}
	echo '</ul></div>';
    echo '<div style="float: left; width: 100%; text-align: center; margin: 0px; padding: 0px">';
}

function chatbot_adminfooter() {
	echo '<p/>';
	OpenTable();
	echo '<div style="text-align: center; vertical-align: center">';
        echo _MD_CHATBOT_CREDIT;
        echo '</div>';
	CloseTable();
	echo '<p/>';
}

function chatbot_create_dir( $directory='' )
{
//	$thePath = XOOPS_ROOT_PATH . "/modules/'.$xoopsModule->dirname().'/" . $directory . "/";
$thePath = XOOPS_ROOT_PATH .'/'.$directory;

	if(@is_writable($thePath)){
		chatbot_admin_chmod($thePath, $mode = 0777);
        return $thePath;
	} elseif(!@is_dir($thePath)) {

    	        chatbot_admin_mkdir($thePath);
        return $thePath;
	}
    return 0;
}

function chatbot_admin_mkdir($target)
{
	// http://www.php.net/manual/en/function.mkdir.php
	// saint at corenova.com
	// bart at cdasites dot com
	$final_target = $target;
	if (is_dir($target) || empty($target)) {
		return true; // best case check first
	}

	if (file_exists($target) && !is_dir($target)) {
		return false;
	}

	if (chatbot_admin_mkdir(substr($target,0,strrpos($target,'/')))) {
		if (!file_exists($target)) {
			$res = mkdir($target, 0777); // crawl back up & create dir tree
			chatbot_admin_chmod($target);
			Global $xoopsModule;
		  $logo_file = XOOPS_ROOT_PATH . '/modules/'.$xoopsModule->dirname().'/images/index.html';
		  copy($logo_file, $final_target.'/index.html');
	  	return $res;
	  }
	}
    $res = is_dir($target);

	return $res;
}

function chatbot_admin_chmod($target, $mode = 0777)
{
	return @chmod($target, $mode);
}

function chatbot_select_eliza($sel=0, $op='')
{
          Global $xoopsDB, $xoopsUser;
          $sql = "SELECT catid, cat_subject
                FROM " . $xoopsDB->prefix( 'chatbot_topics' )."
                ORDER BY cat_subject ASC";
        $result = $xoopsDB->queryF( $sql);
        $operator='';
        $selected[0] = '';
        $selected[$sel] = 'selected';
        if($op) {$operator = 'op='.$op.'&';}
        $select = '<select size="1" name="select"
                             onchange="location=\'?'.$operator.'catid=\'+this.options[this.selectedIndex].value">
                     <option value="all"'.$selected[0].'></option>';
while ( list( $catid, $cat_subject) = $xoopsDB -> fetchrow( $result ) )
	{ 
          if( !isset($selected[$catid]) ) { $selected[$catid] = ''; }
          $select .= '<option value="'.$catid.'"'.$selected[$catid].'>'.$cat_subject.'</option>
          ';}
          $select .= '</select>
          ';
return $select;
}


// selected, table|id|name|image|groups|where,
// destination, caption, display, size, options
function chatbot_selector( $sel=0,
                           $sql='|||||',
                           $destination='', 
                           $caption='',
                           $display='select',
                           $size=1,
                           $target='self')
{
          Global $xoopsDB,$xoopsUser;
          $db = explode('|',$sql); // table|id|name|image|groups|where
          $db_table   = $db[0];
          $db_id      = $db[1];
          $db_name    = $db[2];
          if($db[3])  { $db_image =$db[3]; } else { $db_image=$db[1];}
          if($db[4])  { $db_groups=$db[4]; } else {$db_groups=$db[2];}
          $db_where   = $db[5];
          if($db_groups) { $group = is_object($xoopsUser) ? $xoopsUser->getGroups() : array(XOOPS_GROUP_ANONYMOUS); }
          $sql = "SELECT ".$db_id.", ".$db_name.", ".$db_image.", ".$db_groups."
                FROM " . $xoopsDB->prefix( $db_table )."
                ".$db_where."
                ORDER BY ".$db[2]." ASC ";
          $result = $xoopsDB->queryF( $sql);
          $operator='';
          if($target!='self') { $target=' target="_'.$target.'" '; } else { $taget=''; }

// Drop down list
if($display=='select' || $display=='box') {
        $selected[0] = '';
        $selected[$sel] = 'selected';
        $select = '<select size="'.$size.'" name="select'.$db_table.'"
                           onchange="location=\''.$destination.'=\'+this.options[this.selectedIndex].value">
                     <option value=""'.$selected[0].'>'.$caption.'</option>';

while ( list( $id, $name, $image, $groups ) = $xoopsDB -> fetchrow( $result ) )
	{ $select_tmp = $select;
          if( !isset($selected[$id]) ) { $selected[$id] = ''; }
          if( is_numeric($name) && $name < 10000 ) { $name = constant( strtoupper($db_table.'_'.$db_name.'_'.$name)); }
          if( is_numeric($name) && $name >= 10000 ) { $name = formatTimestamp($name,'m'); }
          $select .= '<option value="'.$id.'"'.$selected[$id].'>'.chatbot_short_title($name, 24).'</option>
          ';}
          $select .= '</select> 
          ';
        if($groups!=$name) {
            $groups = explode(" ",$groups);
            if (count(array_intersect($group,$groups))==0) { $select = $select_tmp; }
	}
 }
 
 

// Unordered list
if($display=='list' ) {
        $select = '<ul>';
while ( list( $id, $name, $image, $groups ) = $xoopsDB -> fetchrow( $result ) )
	{ $select_tmp = $select;
          if( is_numeric($name) && $name < 10000 ) { $name = constant( strtoupper($key[0].'_'.$key[2].'_'.$name)); }
          if( is_numeric($name) && $name >= 10000 ) { $name = formatTimestamp($name,'m'); }
          if( !is_numeric($image) ) { $image = '<img src="'.$image.'" />'; } else { $image = ''; }
          $select .= '<li><a href="'.$destination.'='.$id.'"'.$target.'>'.$image.chatbot_short_title($name, 42).'</li>
          ';}
          $select .= '</ul>
          ';
          
           if($groups!=$name) {
            $groups = explode(" ",$groups);
            if (count(array_intersect($group,$groups))==0) { $select = $select_tmp; }
           }
 }




 // Align
if($display=='tab' ) {
        $colors_a='#888';
        $colors_txt='#008';
        $colors_bck='#DDD';
        $colors_bck_current='#FFF';
        $colors_bck_hover='#EEE';
        $select = "
    	<style type='text/css'>
    	#chatbot_tabs { float:left; font-size: 10px; line-height:normal; margin-bottom: 0px;}
    	#chatbot_tabs ul { margin:0px; margin-top: -11px; padding:0px 0px; list-style:none; }
		#chatbot_tabs li { display:inline; margin:0; padding:0px;}
		#chatbot_tabs a  { float:left; background-color: ".$colors_bck."; margin:0px; padding: 5px; text-align: center; text-decoration:none;
                              border: 1px outset ".$colors_txt."; border-bottom: 0px; white-space: nowrap}
		#chatbot_tabs a span { display:block; white-space: nowrap; color:".$colors_a.";}
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#chatbot_tabs a span {float:none;}
		/* End IE5-Mac hack */
		#chatbot_tabs a:hover span { color:".$colors_txt."; }
		#chatbot_tabs #current a { background-color: ".$colors_bck_current."; border: 1px inset ".$colors_txt."; border-bottom: 0px;}
		#chatbot_tabs #current a span { background-color: ".$colors_bck_current."; color:".$colors_txt."; }
		#chatbot_tabs a:hover { background-position:0% -150px; background-color: ".$colors_bck_hover."; 
                                   border: 1px inset ".$colors_txt."; border-bottom: 0px;}
		#chatbot_tabs a:hover span { background-position:100% -150px; background-color: ".$colors_bck_hover."; }
		</style>
    ";
        $select .= '<div id="chatbot_tabs"><ul>
        ';
        $selected[$sel] = 'current';
while ( list( $id, $name, $image, $groups ) = $xoopsDB -> fetchrow( $result ) )
	{ $select_tmp = $select;
          if( !isset($selected[$id]) ) { $selected[$id] = ''; }
          if( is_numeric($name) && $name < 10000 ) { $name = constant( strtoupper($key[0].'_'.$key[2].'_'.$name)); }
          if( is_numeric($name) && $name >= 10000 ) { $name = formatTimestamp($name,'m'); }
          if( !is_numeric($image) ) { $image = '<img src="../uploads/chatbot/'.$name.'/'.$image.'" />'; } else { $image = ''; }
          $select .= '<li id="' . $selected[$id] . '">
                      <a href="'.$destination.'='.$id.'"'.$target.'>
                      <span>'.$image.chatbot_short_title($name, 42).'</span>
                      </a>
                      </li>
          ';
          if($groups!=$name) {
            $groups = explode(" ",$groups);
            if (count(array_intersect($group,$groups))==0) { $select = $select_tmp; }
	}


          }
          $select .= '</ul></div>
          ';
 }


return $select;
}

function chatbot_short_title( $title='', $length=24, $tiddle='[...]' )
{
     $tiddle_length=round(strlen($tiddle)/4,1);
     $length=round($length-$tiddle_length,1);
     $part2=round($length/4,1);
     $part1=$part2*3;
     $length=round($length);
 if( strlen($title) > $length )
   { $title_01 = substr($title,0,$part1).$tiddle;
     $title_02 = substr($title,-$part2);
     $title=$title_01.$title_02;
   }
//   echo $part1.'+'.$tiddle_length.'+'.$part2.'='.$part1+$tiddle_length+$part2.'/'.$length.'<br />';
   return $title;
}

function chatbot_clean_url( $url='', $dir=1, $total=0 )
{
  $urls = array();
  $urls = explode('|', $url);
  $i=0;$ii=0;
  foreach($urls as $url) {   
   // Supprimer les espace superflus
         $url = trim($url);
   // Nettoyer l'url des erreures d'encodage
        $strip = '\\';               $replace[$strip]        = '/';
        $xoops_url = XOOPS_URL.'/';  $replace[$xoops_url]   = '';
        $url = strtr($url, $replace);
  //      echo $url.' | ';
  // Vérifier si l'url redirige vers un répertoire ou un fichier
        $pathinfo = pathinfo($url);
        if($dir && isset($pathinfo['extension'])) { $url = $pathinfo['dirname']; }
   //     echo $url.' | ';
  // Vérifier que l'url est conforme à l'utilisation
         if(substr($url, -1, 1) != '/' && $dir) {$url = $url.'/';} //   echo $url.' | ';
         if(substr($url, -1, 1) == '/' && !$dir) {$url = substr($url, 0, -1);} //   echo $url.' | ';
         if(substr($url, 0, 1) == '/') {$url = substr($url, 1);}    //   echo $url.' | ';
  // Compiler les réulstats
         $urls[$i++] = $url;
}
    // Vérifier le nombre d'occurences
         $count=count($urls); 
         $dif=$total-$count;
         for($ii;$ii<=$dif;$ii++) {
           $urls[$i++]='';
         }
         $url = implode('|', $urls);
   return $url;
}
?>