<?php
/**
* Module: Chatbot
* Licence : GPL
* Authors :
*           - solo (http://www.wolfpackclan.com)
*/

if (file_exists("../language/".$xoopsConfig['language']."/help.php")) {
   include "../language/".$xoopsConfig['language']."/help.php";
} elseif (file_exists("../language/english/help.php")) {
   include "../language/english/help.php";
}

// Admin Navigation
define("_MD_CHATBOT_INDEX",	        "Index");
define("_MD_CHATBOT_HELP",	        "Help");
define("_MD_CHATBOT_ADMIN",	        "Admin");
define("_MD_CHATBOT_EDIT_BOT",	    "- Bot -");
define("_MD_CHATBOT_EDIT_TOPIC",	"- Topics -");
define("_MD_CHATBOT_EDIT_AKALI",	"- Add Q/R : Akali -");
define("_MD_CHATBOT_EDIT_ELIZA",	"- Add Q/R : Eliza -");
define("_MD_CHATBOT_EDIT_REPORT",	"- Discussion report -");
define("_MD_CHATBOT_EDIT_CHAT",	    "Chat with...");
define("CHATBOT_ELIZA_TYPE_1",	    "Conversion");
define("CHATBOT_ELIZA_TYPE_2",	    "Corection");
define("CHATBOT_ELIZA_TYPE_3",	    "Datas");


// utilities.php
define("_MD_CHATBOT_UTILITIES",		"Utilities");
define("_MD_CHATBOT_CLONE",		"Module duplication");
define("_MD_CHATBOT_CLONENAME",	        "Clone name<br /><i>
                                         <ul>
                                             <li>Don't use more than caracters</li>
                                             <li>Don't use special caracters</li>
                                             <li>Don't use already existing module names</li>
                                             <li>Capital letters and blank spaces accepted</li>
                                         </ul></i>
                                         Sample : 'My Module 01'. ");
define("_MD_CHATBOT_DB_DATAS",		"SQL datas");
define("_MD_CHATBOT_DB_IMPORT",		"Importation into database");
define("_MD_CHATBOT_DB_EXPORT",		"Exportation from database");
define("_MD_CHATBOT_EXPORT",		"Export");
define("_MD_CHATBOT_INSERT",		"Insert");
define("_MD_CHATBOT_UPDATE",		"Update");
define("_MD_CHATBOT_TOPIC_INFOS",	"<ul><li><i>Select a topic<br />
for datas from<br />
'<font color='red'>chatbot_content</font> table'</i></li>");

// common
define("_MD_CHATBOT_STATUS",	         "Status");
define("_MD_CHATBOT_ONLINE",	         "Use");
define("_MD_CHATBOT_OFFLINE",	         "Ignore");
define("_MD_CHATBOT_DESCRIPTION",       "Description");

define("_MD_CHATBOT_CREDIT",	        "ChatBot 1.0 is an original creation of Solo (Solo71)<br />
                                        <img src='../images/chatbot_tag.png' alt='myHome' align='absmiddle' />
                                        <a href='http://wolfactory.wolfpackclan.com/' target='_blank'>
                                        <img src='../images/wolfactory_tag.gif' alt='wolFactory' align='absmiddle' />
                                        </a>(c) Augustus-September 2006
                                        ");

define("_MD_CHATBOT_SUBMIT",	"Submit");
define("_MD_CHATBOT_CLEAR",	"Clear");
define("_MD_CHATBOT_CANCEL",	"Cancel");
define("_MD_CHATBOT_MODIFY",	"Modify");
define("_MD_CHATBOT_EDIT",      "Edit");
define("_MD_CHATBOT_HIDDEN",    "Hidden");
define("_MD_CHATBOT_SEARCH",    "Search expression");

//index.php
define("_MD_CHATBOT_STATS",	"Stats");
define("_MD_CHATBOT_SUMMARY",	"Summary");
define("_MD_CHATBOT_ADMIN_TEXT","<h1 align='center'>ChatBot 1.0</h1>
Welcome to ChatBot, the automated Xoops chatterbot.");
define("_MD_CHATBOT_TITLE_REPLIES",	"Q/R");
define("_MD_CHATBOT_TITLE_CHAT",	"Q/R (Eliza)");

// content.php
define("_MD_CHATBOT_CONTENT",	"Manage questions/replies");
define("_MD_CHATBOT_REPLIES",	"Question/Replies");

// topics.php
define("_MD_CHATBOT_TOPICS",	        "Topics<br />
<i>Select bot's conversation topics.
<ul>
<li>[ELIZA] : Activate the 'Eliza Bot' conversation mode</li>
<li>Other topics : Activate the 'Akali Bot' topics</li>
</ul></i>");
define("_MD_CHATBOT_TOPIC",	        "Topic");
define("_MD_CHATBOT_PAGELINK",          "Linked page/module");
define("_MD_CHATBOT_PAGELINKDSC",          "<br />
Indicate the linked page<br />
or module's url.");
define("_MD_CHATBOT_TOPIC_TITLE",	"Manage topics");

// content.php
define("_MD_CHATBOT_TITLE_AND",	    "Mandatory");
define("_MD_CHATBOT_TITLE_OR",	    "Facultative");
define("_MD_CHATBOT_TITLE_CONTEXT", "Contextual");
define("_MD_CHATBOT_TITLE_REPLY",   "Reply");
define("_MD_CHATBOT_TITLE_QUESTION","Question");

define("_MD_CHATBOT_AND",	"Mandatory<br />
- Mandatory terms");
define("_MD_CHATBOT_CONTEXT",	"Contextual<br />
- Contextual terms<br />
following previous discussions");
define("_MD_CHATBOT_OR",	"Facultative<br />
- Secondaires terms");
define("_MD_CHATBOT_REPLY",	"Replys<br />
- Used to reply to<br />
a specific question.");
define("_MD_CHATBOT_QUESTION",	"Discussion<br />
- Used to start again<br />or change topic.");

// Bots
define("_MD_CHATBOT_BOTS",      "ChatBots");
define("_MD_CHATBOT_BOT",       "Manage ChatBots");
define("_MD_CHATBOT_NAME",      "Bot's Name *");
define("_MD_CHATBOT_SMILIES",   "Bot directory *<br /><i>
<ul><li>Bot images</li>
<li>Smilies</li>
<li>.js files</li></ul>
The directory must be writable (check CHMOD)!</i>");
define("_MD_CHATBOT_ACTIVE",    "Active");
define("_MD_CHATBOT_INACTIVE",  "Inactive");
define("_MD_CHATBOT_IMAGE",     "Avatar");

define("_MD_CHATBOT_BACKGROUND","Illustrations<br /><i>
<font color='red'>Background picture</font>|
<font color='blue'>Textbox background picture</font>|<br />
<font color='red'>Background sound</font>|
<font color='blue'>'Typewriter mode' sound</font>|<br />
<font color='green'>Mail adresses</font></i>");

define("_MD_CHATBOT_COLOR",     "Colors<br />
<font color='red'>Page texte</font>|
<font color='blue'>Page Background</font><br />
<font color='red'>Textbox text</font>|
<font color='blue'>Textbox background</font>|
<font color='green'>Textbox border width</font>");

define("_MD_CHATBOT_INTRO",     "Welcome sentence<br /><i>
- Separate sentences by: |<br />
- Support tags: {USERNAME}, etc.<br />
Ex: Hello {USERNAME}.|Hi!<i>");

define("_MD_CHATBOT_DUMB",      "Custom sentences<br /><i>
- Separate sentences by: |<br />
- Support tags: {USERNAME}, etc.<br />
Ex: He he {USERNAME}.|Hm...</i>");

define("_MD_CHATBOT_ZERO",      "Dumb sentences<br /><i>
Expressions used when the bot changes topics.
- Separate sentences by: |<br />
- Support tags: {USERNAME}, etc.<br />
Ex: Sorry {USERNAME}?|Ah yes!</i>");

define("_MD_CHATBOT_END",       "Conclusion sentences<br /><i>
- Separate sentences by: |<br />
- Support tags: {USERNAME}, etc<br />
Ex: Good bye {USERNAME}.|See you soon!</i>");

define("_MD_CHATBOT_GROUPS",      "Groupes");

// Datas redirection
define("_MD_CHATBOT_CREATE",            "Add a new entry");
define("_MD_CHATBOT_CREATED",	        "Data successfully added.");
define("_MD_CHATBOT_NOTCREATED",        "Data creation failed!");
define("_MD_CHATBOT_UPDATED",	        "Data successfully updated.");
define("_MD_CHATBOT_NOTUPDATED",        "Data update failed!");
define("_MD_CHATBOT_DELETETHISDATA",    "Are you sure you want to delete this entry?");
define("_MD_CHATBOT_DELETED",	        "Data successfully deleted!");
define("_MD_CHATBOT_DELETE",            "Delete");

// Eliza
define("_MD_CHATBOT_CHAT",	        "Question/Reply 'Eliza'");
define("_MD_CHATBOT_TYPE",	        "Type");
define("_MD_CHATBOT_KEYWORD",	        "Keywords");
define("_MD_CHATBOT_REPLACEMENT",	"Replacement");
define("_MD_CHATBOT_REPLIES_",	        "Replies");

define("_MD_CHATBOT_SENTENCE",	        "User questions<br /><i>
- Separate sentences by: |<br />
Ex: I would like you to|You have to</i>");

define("_MD_CHATBOT_REPLY_",	        "Bot replies<br /><i>
- Separate sentences by: |<br />
- Use '(*)+ponctuation' for content replacement.<br />
- Available punctuation : (. ! ? ...)<br />
Ex: Why do you me to(*)?|Sure, I will!</i>");

define("_MD_CHATBOT_FROM",	        "From...");
define("_MD_CHATBOT_TO",	        "To...");
define("_MD_CHATBOT_CONVERSIONS",	"Conversion (before mask application)");
define("_MD_CHATBOT_CORRECTIONS",	"Correction (after mask application)");
define("_MD_CHATBOT_DATAS",	        "Datas (Mask and random replies)");

define("_MD_CHATBOT_CONVERSION",	"Conversion");
define("_MD_CHATBOT_CORRECTION",	"Correction");
define("_MD_CHATBOT_DATA",	        "Datas");

// Reports
define("_MD_CHATBOT_REPORTS",	        "Discussion reports");
define("_MD_CHATBOT_REPORTS_TITLE",	"Manage discussion reports");
define("_MD_CHATBOT_TITLE_CONVO",	"Conversation");
define("_MD_CHATBOT_TITLE_INFOS",	"Infos");

// Utilities
define("_MD_CHATBOT_CLONED",	        "Module successfully cloned.");
define("_MD_CHATBOT_MODULEXISTS",	"This module already exist!");
define("_MD_CHATBOT_NOTCLONED",	        "Cloning settings are incorrect!");
define("_MD_CHATBOT_CLONE_TROUBLE",	"Your host settings do not allow you to clone this module online.
					 Please try again on a server which authorise writing permission on server.
                                         (Exemple: local server)");

define("_MD_CHATBOT_MEDIA",	        "Medias");
define("_MD_CHATBOT_UPLOADMEDIA",	"File to upload");
define("_MD_CHATBOT_UPLOAD",	        "Upload a media");
define("_MD_CHATBOT_UPLOAD_ERROR",	"Error while uploading!");
define("_MD_CHATBOT_UPLOADED",	        "File successfully uploaded.");


// Blocs et Groupes
define("_MD_CHATBOT_BLOCKS",	        "Blocks and groups access management");
?>