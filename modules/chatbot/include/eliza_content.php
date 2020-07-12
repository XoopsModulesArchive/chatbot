<?php
/* ####################################################################### */
/*                 Generate Eliza chat datas for chatbot                   */
/* ####################################################################### */

$sql = "SELECT type, keyword, response
        FROM ".$xoopsDB->prefix( "chatbot_eliza")."
        WHERE status = 1
        ORDER BY type ASC";
$result = $xoopsDB->queryF($sql);

        $conj1_datas = 'conj1[0]  = "";          conj2[0]  = "";
';
        $conj3_datas = 'conj3[0]  = "";          conj4[0]  = "";
';
        $keyword_datas = '';
        $response_datas = '';

        $i = 1;  $ii = 1; $iii = 0; $count_responses = 0;
        while(list( $type, $keyword, $response ) = $xoopsDB->fetchRow($result))
        {

        // 1) Create correspondance
        if($type==1) { $conj1_datas .= 'conj1['.$i.']  = "'.$keyword.'";          conj2['.$i++.']  = "'.$response.'";
'; }
        
        // 2) Create pronouns
        if($type==2) { $conj3_datas .= 'conj3['.$ii.']  = "'.$keyword.'";          conj4['.$ii++.']  = "'.$response.'";
'; }
        
        // 3) Create keywords and responses
        if($type==3) {
        // Responses
           $count_responses_start = $count_responses;
           $responses_array = explode('|',$response);
           foreach( $responses_array as $response ) {
                    $response = preg_replace('#\r\n|\n|\r#', '\n', trim($response));//gestion des retours à la ligne
                    $response_datas .= 'response['.$count_responses++.']="'.$response.'";
';
           } // foreach
           $count_responses_end = $count_responses;
           $count_responses_end--;
        // Keywords
		$keyword = preg_replace('#\r\n|\n|\r#', '\n', $keyword);//gestion des retours à la ligne
                    $keyword_array = explode('|',$keyword);
                    foreach( $keyword_array as $keyword ) {
                    $keyword_datas .= 'keyword['.$iii++.']=new key( "'.trim(strtoupper($keyword)).'",  '.$count_responses_start.',  '.$count_responses_end.');
';
                    } // foreach
        }// While

}
                    $keyword_datas .= 'keyword['.$iii++.']=new key("NO KEY FOUND", 	1, 1);
';
                    $keyword_datas .= 'keyword['.$iii++.']=new key("repeat input", 	1, 1);
';
// Count results
	$maxKey = $iii;
        $maxrespnses = $count_responses_end;
	$maxConj = $i;
	$max2ndConj = $ii;

 /////////////////
 // Create JS file for Eliza datas
 ////////////////
 $maxConj        = $maxConj;
 $max2ndConj     = $max2ndConj;
 $maxKey        =  $maxKey-1;
 $maxrespnses    = $maxrespnses;

$chat_datas = '
maxConj = '.$maxConj.';
max2ndConj = '.$max2ndConj.';
maxKey = '.$maxKey.';
maxrespnses = '.$maxrespnses.';

  response = new Array(maxrespnses);
  var conj1 = new Array(maxConj);
  var conj2 = new Array(maxConj);
  var conj3 = new Array(max2ndConj);
  var conj4 = new Array(max2ndConj);
  
     keyword = new Array(maxKey);
     
        keyNotFound = maxKey-1;

	function key(key,idx,end){
   	this.key = key;               			// phrase to match
    	this.idx = idx;              			// first response to use
   	this.end = end;          			// last response to use
   	this.last = end;				// response used last time
 	}
 	
// Funtion to replaces all occurances of substring substr1 with substr2 within strng
// if type == 0 straight string replacement
// if type == 1 assumes padded strings and replaces whole words only
// if type == 2 non case sensitive assumes padded strings to compare whole word only
// if type == 3 non case sensitive straight string replacement

	var RPstrg = "";

	function replaceStr( strng, substr1, substr2, type){
		var pntr = -1; aString = strng;
		if( type == 0 ){ 
			if( strng.indexOf( substr1 ) >= 0 ){ pntr = strng.indexOf( substr1 );	}
		} else if( type == 2 ){ 
			if( strng.indexOf( " "+ substr1 +" " ) >= 0 ){ pntr = strng.indexOf( " " + substr1 + " " ) + 1; }	
		} else if( type == 1 ){ 
			bstrng = strng.toUpperCase();
			bsubstr1 = substr1.toUpperCase();
			if( bstrng.indexOf( " "+ bsubstr1 +" " )>= 0 ){ pntr = bstrng.indexOf( " " + bsubstr1 + " " ) + 1; }	
		} else {
			bstrng = strng.toUpperCase();
			bsubstr1 = substr1.toUpperCase();
			if( bstrng.indexOf( bsubstr1 ) >= 0 ){ pntr = bstrng.indexOf( bsubstr1 ); }
		}
		if( pntr >= 0 ){
			RPstrg += strng.substring( 0, pntr ) + substr2;
			aString = strng.substring(pntr + substr1.length, strng.length );
			if( aString.length > 0 ){ replaceStr( aString, substr1, substr2, type ); }
		}
		aString = RPstrg + aString;
		RPstrg = "";
		return aString;
	}	


// Function to pad a string.. head, tail & punctuation

	punct = new Array(".", ",", "!", "?", ":", ";", "&", "@", "#", "(", ")" )

	function padString(strng){
		aString = " " + strng + " ";
		for( i=0; i < punct.length; i++ ){
			aString = replaceStr( aString, punct[i], " " + punct[i] + " ", 0 );
		}
		return aString
	}

// Function to strip padding

	function unpadString(strng){
		aString = strng;
		aString = replaceStr( aString, "  ", " ", 0 ); 		// compress spaces
		if( strng.charAt( 0 ) == " " ){ aString = aString.substring(1, aString.length ); }
		if( strng.charAt( aString.length - 1 ) == " " ){ aString = aString.substring(0, aString.length - 1 ); }
		for( i=0; i < punct.length; i++ ){
			aString = replaceStr( aString, " " + punct[i], punct[i], 0 );
		}
		return aString
	}



// Dress Input formatting i.e leading & trailing spaces and tail punctuation
	
	var ht = 0;										// head tail stearing
	
	function strTrim(strng){
		if(ht == 0){ loc = 0; }								// head clip
		else { loc = strng.length - 1; }						// tail clip  ht = 1 
		if( strng.charAt( loc ) == " "){
			aString = strng.substring( - ( ht - 1 ), strng.length - ht);
			aString = strTrim(aString);
		} else { 
			var flg = false;
			for(i=0; i<=5; i++ ){ flg = flg || ( strng.charAt( loc ) == punct[i]); }
			if(flg){	
				aString = strng.substring( - ( ht - 1 ), strng.length - ht );
			} else { aString = strng; }
			if(aString != strng ){ strTrim(aString); }
		}
		if( ht ==0 ){ ht = 1; strTrim(aString); } 
		else { ht = 0; }		
		return aString;
	}

// adjust pronouns and verbs & such

	function conjugate( sStrg ){       	// rephrases sString
		var sString = sStrg;
		for( i = 0; i < maxConj; i++ ){			// decompose
			sString = replaceStr( sString, conj1[i], "#@&" + i, 2 );
		}
		for( i = 0; i < maxConj; i++ ){			// recompose
			sString = replaceStr( sString, "#@&" + i, conj2[i], 2 );
		}
		// post process the resulting string
		for( i = 0; i < max2ndConj; i++ ){			// decompose
			sString = replaceStr( sString, conj3[i], "#@&" + i, 2 );
		}
		for( i = 0; i < max2ndConj; i++ ){			// recompose
			sString = replaceStr( sString, "#@&" + i, conj4[i], 2 );
		}
		return sString;
	}

// Build our response string
// get a random choice of response based on the key
// Then structure the response

	var pass = 0;
	var thisstr = "";
		
	function phrase( sString, keyidx ){
		idxmin = keyword[keyidx].idx;
		idrange = keyword[keyidx].end - idxmin + 1;
		choice = keyword[keyidx].idx + Math.floor( Math.random() * idrange );
		if( choice == keyword[keyidx].last && pass < 5 ){ 
			pass++; phrase(sString, keyidx ); 
		}
		keyword[keyidx].last = choice;
		var rTemp = response[choice];
		var tempt = rTemp.charAt( rTemp.length - 1 );
		if(( tempt == "." ) || ( tempt == "!" ) || ( tempt == "?" ) || ( tempt == "..." )){
			var sTemp = padString(sString);
			var wTemp = sTemp.toUpperCase();
			var strpstr = wTemp.indexOf( " " + keyword[keyidx].key + " " );
   		strpstr += keyword[ keyidx ].key.length + 1;
			thisstr = conjugate( sTemp.substring( strpstr, sTemp.length ) );
			thisstr = strTrim( unpadString(thisstr) )
			       if( tempt == "?" )   { sTemp = replaceStr( rTemp, "(*)?", " " + thisstr + " ?", 0 );
			} else if( tempt == "." )   { sTemp = replaceStr( rTemp, "(*).", " " + thisstr + ".", 0 );
			} else if( tempt == "!" )   { sTemp = replaceStr( rTemp, "(*)!", " " + thisstr + " !", 0 );
			} else if( tempt == "..." ) { sTemp = replaceStr( rTemp, "(*)...", " " + thisstr + "...", 0 );
			}
		} else sTemp = rTemp;
		return sTemp;
	}
	
// returns array index of first key found

		var keyid = 0;

	function testkey(wString){
		if( keyid < keyNotFound
			&& !( wString.indexOf( " " + keyword[keyid].key + " ") >= 0 )){ 
			keyid++; testkey(wString); 
		}
	}
	function findkey(wString){ 
		keyid = 0;
		found = false;
		testkey(wString);
		if( keyid >= keyNotFound ){ keyid = keyNotFound; }
  		return keyid;  		
	}

// This is the entry point and the I/O of this code

	var wTopic = "";							// Last worthy responce
	var sTopic = "";						        // Last worthy responce
	var wPrevious = "";        		    				// so we can check for repeats
	var started = false;	

	function listen(User){
  		sInput = User;

   	sInput = strTrim(sInput);						// dress input formating
		if( sInput != "" ){ 
			wInput = padString(sInput.toUpperCase());	        // Work copy
			var foundkey = maxKey;         		  		// assume its a repeat input
			if (wInput != wPrevious){   				// check if user repeats himself
				foundkey = findkey(wInput);   			// look for a keyword.
			}
			if( foundkey == keyNotFound ){
                                        return "";

			} else {
				if( sInput.length > 12 ){ sTopic = sInput; wTopic = wInput; }
				wPrevious = wInput;  			// save input to check repeats
				return phrase( sInput, foundkey );			// Get our response
			}
		}
	}


'.$conj1_datas.'
'.$conj3_datas.'
'.$keyword_datas.'
'.$response_datas;

?>