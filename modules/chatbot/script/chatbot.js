//Do not remove these lines:
//Alkali Chatbot
//http://www.alkalisoftware.ca/
//http://www.wolfpackclan.com/
//Version 4

// The chatbot var.
var alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZÉÈÊËÖÜÎÔÛÙÇÀéèêëöüîôûùçà0123456789 ";
var sayUser = "";
var letexte = "0";
var numSpaces = 0;
var prevWords = "";
var stopResponding = false;

var thinkText = "";
var length = "";

// Typewriter var
var montimer;
var cmpt = 0;
var count = 0;
var j = 0;
var i = 0;
var courant = '';
var courant, affiche;
var timer_tilt='';
var click=0;
var image_url='';


/////////////////////////////////////////////
// 1 Let's start with the chat script
function doAI() {
   gotoLink(document.AI.User.value, 0);
   sayUserOrig = document.AI.User.value;
   sayUser = parseStr(sayUserOrig);
   tiltbar(2);
   document.AI.User.value = '';
   document.botLink.src = XOOPS_URL+'/modules/chatbot/images/icon/blank.gif';
   document.AI.rec_convo.value = document.AI.rec_convo.value +
                                 "\n["+userName+" >" + sayUserOrig;

   if ( Eliza==1 ) { eliza_texte=doEliza(sayUserOrig); } else { eliza_texte=''; }
   if (numSpaces==0) {
     typewriter(noPost(), 0);
   } else if ( eliza_texte ) {
     letexte=" "+eliza_texte;
     typewriter('letexte', 0);
   } else {
     typewriter(bot_reply(), 0);
   }
 return false;
}

// 1.a Test Eliza script first
	function doEliza(){
		var Input = sayUserOrig;
		return listen(Input);
	}

// 1.b If there is a link in the text, activat it
function gotoLink(sayUserOrig, click) {
  // Redirection java managed (target = "_blank")
  x=document.AI.Bot.value.indexOf("{",0);
  y=document.AI.Bot.value.indexOf("}",0);
if( x > 0 && y > 0 ) {
    sayYes = parseStr(sayUserOrig.charAt(0)+sayUserOrig.charAt(1)+sayUserOrig.charAt(2));
    if ( sayYes == parseStr(yes1) || sayYes == parseStr(yes2) || sayYes == parseStr(yes3) || click==1 )  {
   if ( document.AI.Bot.value.indexOf("www",0) > 0  ) {
      href = 'http://' + document.AI.Bot.value.substring(x+1,y);
    } else if ( document.AI.Bot.value.indexOf("https://",0) > 0 || document.AI.Bot.value.indexOf("http://",0) > 0 || document.AI.Bot.value.indexOf("ftp://",0) > 0  ) {
      href = document.AI.Bot.value.substring(x+1,y);
    } else {
      href = XOOPS_URL + '/' + document.AI.Bot.value.substring(x+1,y);
   }

   window.open(this.href, 'wclose', 
                          'width=600,height=478,dependent=yes,toolbar=yes,scrollbars=yes,status=no,resizable=yes,titlebar=no,left=200,top=60',
                          'false');
   return false;
   }
  }
}


// 1.c Display bot picture and emoticons
function displayImage() {
       pic = botimage;
       sayAI=document.AI.Bot.value.toLowerCase();
       boticons=boticons.toLowerCase();
       boticon_array=boticons.split(' ');

for (i=0;i<boticon_array.length;i++) {

        if ( sayAI.indexOf(boticon_array[i],0)   > 0 ||                         // Words
           ( boticon_array[i]=='question'  && sayAI.indexOf('?',0)   > 0 )||    // Punctuation
           ( boticon_array[i]=='surprised' && sayAI.indexOf('!',0)   > 0 )||
           ( boticon_array[i]=='angry'     && sayAI.indexOf('!?',0)  > 0 )||
           ( boticon_array[i]=='sad'       && sayAI.indexOf(':-(',0) > 0 )||    // Smilies start
           ( boticon_array[i]=='happy'     && sayAI.indexOf(':-D',0) > 0 )||
           ( boticon_array[i]=='smile'     && sayAI.indexOf(':-)',0) > 0 )||
           ( boticon_array[i]=='wink'      && sayAI.indexOf(';-)',0) > 0 )||
           ( boticon_array[i]=='wow'       && sayAI.indexOf(':-o',0) > 0 )||
           ( boticon_array[i]=='cheek'     && sayAI.indexOf(':-P',0) > 0 )||
           ( boticon_array[i]=='cool'      && sayAI.indexOf('8-)',0) > 0 ) )    // Smilies end
           { pic = boticon_array[i]; }

}

   if (document.all){
      document.images.botSmily.style.filter="blendTrans(duration=0.5)";
      document.images.botSmily.filters.blendTrans.Apply();
   }
      link = botsmilies+pic+ext;
      document.botSmily.src = link;
/*
      window.open(this.link, 'wclose',
                          'width=600,height=478,dependent=yes,toolbar=yes,scrollbars=yes,status=no,resizable=yes,titlebar=no,left=200,top=60',
                          'false');
*/
//      link = '{'+link+'}';
//      gotoImage(link);
   if (document.all){
      document.images.botSmily.filters.blendTrans.Play();
   }
return true;
}

// 1.d If there is a link in the text, activat it
function gotoImage() {
   src_image = document.botSmily.src;
   window.open(this.src_image, 'wclose',
                               'width=800,height=600,dependent=yes,toolbar=no,scrollbars=yes,status=no,resizable=yes,titlebar=no,left=100,top=60',
                               'false');
   return false;
   }




// 1.c Autochat
/*
function autoChat(i) {
  while( i >= 3 ) { break;   }
  i++;
  typewriter(noPost(), 0);
  wait = setTimeout("autoChat('i')", (Math.random()*100)+100);
  clearTimeout(wait);

//return true;
}
*/


/////////////////////////////////////////////
// 2. Eliza bot : check Patterns and render result
function doPatterns() {
    result = '';
    input = sayUserOrig.toLowerCase();
  for (i=0; i < patterns.length; i++) {
    pattern = new RegExp (patterns[i][0], "ig");

    // check if there is a match
    resultVec = pattern.exec(input);
              if (resultVec) {
                // get a random index for the REST of the subarray
                len = patterns[i].length - 1;
                index = Math.ceil( len * Math.random());
                // replace the patterns
                replyPattern = patterns[i][index];
                result = " "+input.replace(pattern, replyPattern);
              }
  }
  return result;
}



// 3.a. Format input datas
function parseStr(pass) {
   var newString = "";
   var token = "";
   var apostrophe = false;
   pass = noaccent(pass);
   pass = pass.replace(/[']/gi," ");
//   pass = nopunctuation(pass);
   numSpaces = 0;
   for (i=0;i<pass.length;i++) {
      token = pass.charAt(i).toUpperCase();
      if (token=="'") {
         apostrophe = true;
      } else if (token==" ") {
         numSpaces++;
         apostrophe = false;
      }
      if (apostrophe==false && alphabet.indexOf(token)!=-1) newString += token;
   }
   if (newString.length > 0) numSpaces++;
   return " " + newString + " ";
}

function noaccent(chaine) {
  temp = chaine.replace(/[àâä]/gi,"a")
  temp = temp.replace(/[éèêë]/gi,"e")
  temp = temp.replace(/[îï]/gi,"i")
  temp = temp.replace(/[ôö]/gi,"o")
  temp = temp.replace(/[ùûü]/gi,"u")
  temp = temp.replace(/[\".,;!#$/:?()[]_-\\]/gi," ")
  return temp
}

/*
function nopunctuation(chaine) {
  temp = chaine.replace(/[\".,;!#$/:?'()[]_-\\]/gi," ")
  return temp
}
*/



// 3.b. Just in case user submit form is empty
function noPost() {
        letexte = " "+talkZero[Math.floor(Math.random() * talkZero.length)];
      return letexte;
}


// 4.c1 Render response
function bot_reply() {
   var main_score = 0, cur_main = 0;
   var small_score = 0, cur_small = 0;
   var context_score = 0, cur_context = 0;
   var cur_k = 0;
   var i;
   var chkWord;

   // Find out which response to use
   // Calcul Tokens values
   for (i=0;i<wordList.length;i++) {
      token = wordList[i].charAt(0);
      if (token=="^" || token=="#") {
         main_score = 0;
         small_score = 0;
         context_score = 0;
      } else if (token==">" || token=="!") {
         if (main_score!=0 || context_score!=0 || token==">") small_score += Math.random(); else small_score = 0;
         if (main_score>cur_main || (main_score==cur_main && (context_score>cur_context || (context_score==cur_context && small_score>cur_small)))) {
            cur_main = main_score;
            cur_context = context_score;
            cur_small = small_score;
            cur_k = i;
         }
         main_score = 0;
         small_score = 0;
         context_score = 0;
      } else if (token!="*") {
         if (token=="&") chkWord = wordList[i].substring(1, wordList[i].length); else if (token=="") chkWord = wordList[i];
         if (sayUser.indexOf(" " + chkWord + " ")!=-1) {
            if (token=="&") main_score++; else small_score++;
         } else if (token=="&") {
            if (prevWords.indexOf(" " + chkWord + " ")!=-1) context_score++;
         }
      }
   }
   
   // Calcul previous sentence values
   assocPrev(cur_k);

   // Compare results
   if (cur_main==0 && cur_context==0) {
      if (cur_small==0) {
         letexte = " "+endPhrase;
         resetArray();
         return letexte;
      } else {
         if (document.AI.User.value.indexOf("?")!=-1) { chkWord = "Hmm... "; } 
         else { chkWord = talkDumb[Math.floor(Math.random() * talkDumb.length)] + "  "; }
      }
   } else {
      chkWord = "";
   }

     letexte = " "+chkWord + wordList[cur_k].substring(1, wordList[cur_k].length);

   if (cur_k<wordList.length-1) {
      token = wordList[cur_k + 1];
      if (token.charAt(0)=="^") eval(token.substring(1, token.length));
   }
   wordList[cur_k] = "#" + wordList[cur_k];
   return letexte;
}

// 4.c2 Compare with previous replies
function assocPrev(startPos) {
   prevWords = " ";
   for (i=startPos-1;i>=0;i--) {
      token = wordList[i].charAt(0);
      if (token=="!" || token=="#" || token==">" || token=="^") {
         break;
      } else if (token=="&" || token=="*") {
         prevWords += wordList[i].substring(1, wordList[i].length) + " ";
      }
   }
}

// 4.c2 Reset Keywords array
function resetArray() {
   for (i=0;i<wordList.length;i++) {
      if (wordList[i].charAt(0)=="#") wordList[i] = wordList[i].substring(1, wordList[i].length);
   }
}


/* Useless render result
function doQuestion() {
   sayUser = parseStr(document.AI.User.value);
   document.USER.Question.value = "";
   return True;
}
*/


/////////////////////////////////////////////
// 4.a Render results with a typewriter style
function typewriter(letexte, count) {
cmpt = count;
rand = 1;
      if(cmpt < letexte.length && cmpt > 0) {
	      courant = courant+letexte.charAt(cmpt);
	      clearTimeout(timer);
	      	if (delay==0) { document.AI.Bot.value = letexte; }
		if (letexte.charAt(cmpt)=="{") { j=1; rand = 1; }
		if (letexte.charAt(cmpt)=="}") { j=0; document.botLink.src = XOOPS_URL+'/modules/chatbot/images/icon/link.gif'; }
		if (j==0 && delay!=0) {
                            innerHTML = courant;
                            innerHTML = courant+"|";
                            if(is_type=='yes') { playSound('type_sound'); }
                            document.AI.Bot.value = innerHTML;
		            courant = innerHTML.substring(0, innerHTML.length -1);
		            rand = (Math.random()*(delay*5))+delay;
			    }
      } else {
        courant_safe=courant;
        courant="";
        }
      if(cmpt >= letexte.length) { render_result();  tiltbar(0); }
      cmpt++;
      if(cmpt <= letexte.length) { timer = setTimeout("typewriter(letexte, cmpt)", rand); }
   }

function playSound(soundname) {
var sound = eval("document." + soundname);
     try { sound.Stop();
           sound.Rewind(); } catch (e) {}
     try { sound.DoPlay(); } catch (e) { sound.Play(); }
}


// This function displays a blinking bar
 function tiltbar(val)
{
  if( val==2 ) { clearTimeout(timer_tilt); } else {
        var msg = courant_safe;
	var speed = 500;
	var pos = val;
	var msg1  = msg+" ";
	var msg2  = msg+"|";

	if(pos == 0){
		masg = msg1;
		pos = 1;
	}
	else if(pos == 1){
		masg = msg2;
		pos = 0;
	}

	document.AI.Bot.value = masg;
	timer_tilt = window.setTimeout("tiltbar("+pos+")",speed);
 }
}

// 4.b Create historic output
function render_result() {
  botspeech = document.AI.Bot.value;
  if(autoClick) { gotoLink('',1); }
  if(boticons!='') { displayImage(); }
  document.AI.rec_convo.value = document.AI.rec_convo.value  +
                                "\n["+botName+" >" + botspeech.substring(0, botspeech.length -1);
  document.AI.rec_reply.value = "\n["+userName+" >" + sayUserOrig +
                                "\n["+botName+" >" +  botspeech;
                                
// 4.c. Backup conversation when quitting
/*
function backup() {
                   alert('Voulez-vous quitter cette page ?');
                   submit();
}
*/
//   repost = setTimeout("autoChat('0')", (Math.random()*100)+100);
//   clearTimeout(repost);
}


//  Use only if you want to simulate bot reflexion
/*
function thinking() {
        document.AI.Bot.value = thinkText;
        length = 12 + (Math.random()*12);
        for (i=0;i<length;i++) {
        dot = '.'
        setTimeout('document.AI.Bot.value = document.AI.Bot.value + dot',500+Math.random()*delay);
        }
}


function reset() {
        document.AI.Bot.value = thinkText;
        length = 2 + (Math.random()*8);
        for (i=0;i<length;i++) {
        dot = '.'
        setTimeout('document.AI.Bot.value = document.AI.Bot.value + dot',delay);
        }
}
*/