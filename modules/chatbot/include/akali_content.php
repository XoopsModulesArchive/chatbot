<?php
$convo_datas = '';

if($where OR $where_module) {
  if(!$where) { $where = 0; }
$sql = "SELECT pref_or, pref_and, pref_misc, reply, question
        FROM ".$xoopsDB->prefix( "chatbot_content")."
        WHERE (catid=$where $where_module AND status>0)
        ORDER BY catid ASC";
$result = $xoopsDB->queryF($sql);

while(list( $pref_or,
            $pref_and,
            $pref_misc,
            $reply,
            $question ) = $xoopsDB->fetchRow($result))
{
                                 $convo_data = '';
          if ( $pref_or ) {      $convo_data .= chatbot_data_explode($pref_or,   '*', ' '); }
          if ( $pref_and ) {     $convo_data .= chatbot_data_explode($pref_and,  '&', ' '); }
          if ( $pref_misc ) {    $convo_data .= chatbot_data_explode($pref_misc, '',  ' '); }
          if ( $reply )    {
                                  $replies = explode('|', $reply);
                                  foreach($replies as $reply) {
                                  $reply = preg_replace('#\r\n|\n|\r#', '\n', trim($reply));//gestion des retours à la ligne
                                  $convo_datas .= $convo_data;
                                  $convo_datas .= ',
               "!' . $reply . '"'; }

          } // if

          if ( $question ) {
                                  $questions = explode('|', $question);
                                  foreach($questions as $question) {
                                  $question = preg_replace('#\r\n|\n|\r#', '\n', trim($question));//gestion des retours à la ligne
                                  $convo_datas .= ',
   ">' . trim($question) . '"'; }
          }// if
 }
          }
 
// Retrieve datas from the site
/*
if(isset($xoopsModuleConfig['chatbot_site_report']) && $xoopsModuleConfig['chatbot_site_report']) {
$datas = $xoopsModuleConfig['chatbot_site_report'];
          $reports = chatbot_site_report($datas);
          $i  = 0;

          foreach( $reports['module'] as $fake ) {
                    $convo_datas .= chatbot_data_explode(strtoupper($reports['module'][$i]),   '&', ' ');
                    $report_list = '';
            $howmany = '';
          if( isset($reports['content'][$i]) ) {
            $howmany = count($reports['content'][$i]);
            foreach( $reports['content'][$i] as $reporting) { 
              if($reporting) { $report_list .=  ', ' . $reporting; }
              }
          }
          $report_list = substr($report_list,1);

if($howmany == 1 ) { $texte = _CHATBOT_DATA; } elseif($howmany > 1 && is_numeric($report_list)) { $texte = _CHATBOT_DATAS; } else { $texte = _CHATBOT_DATA; $report_list = _CHATBOT_NODATA; }
$report_list = sprintf($texte, $report_list, substr($reports['module'][$i],0,strpos($reports['module'][$i],' ')));
            $i++;
            $convo_datas .= '
 "!' . $report_list . '",
 ';
          }
          }
 */
 $datas =  "wordList = new Array(".chatbot_data_tag_replace(substr($convo_datas, 1), $tag).");
 ";
// $xoopsTpl->assign("datas", $datas );

 $talkDumb = "talkDumb = new Array(".chatbot_data_tag_replace(substr(chatbot_data_explode($dumb), 1), $tag).");
 ";
 $talkZero = "talkZero = new Array(".chatbot_data_tag_replace(substr(chatbot_data_explode($zero), 1), $tag).");
 ";
 $ends = explode('|', $end);
 $end = array_rand($ends, 1);
 $endPhrase = 'endPhrase = "'.chatbot_data_tag_replace(trim($ends[$end]), $tag).'";';


 /////////////////
 // Create JS file for akali datas
 ////////////////

 $file_content  = $datas.$talkDumb.$talkZero.$endPhrase;
 $bot_name  = addslashes($bot_name);
 $user_name = addslashes($tag['{USERNAME}']);
 $file_content .= "

var userName  = '".$user_name."';
var botName   = '".$bot_name."';
var XOOPS_URL = '".XOOPS_URL."';
var yes1 = '".$yes_array[0]."';
var yes2 = '".$yes_array[1]."';
var yes3 = '".$yes_array[2]."';
var botsmilies = '".$bot_temp_directory."';
var boticons = '".$boticons."';
var botimage = '".$bot_image."';
var delay = ".$typewriter.";
var Eliza = ".$is_eliza.";
var ext = '".$ext."';
var is_type = '".$is_type."';
var autoClick = ".$autoclick.";
  ";

?>