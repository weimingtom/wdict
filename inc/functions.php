<?php
/*------------------------------------------------------------------------
	WDict, another web-based dictionary

	@author  NGUYEN-DAI Quy <vnpenguin@vnoss.org>
	@license http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
	@date    Sun Jan  8 17:40:22 CET 2006
	@url     http://vnoss.org http://forum.vnoss.org 
--------------------------------------------------------------------------*/
function _Addslashes( $str ){
   $str = str_replace('\\', '\\\\', $str);
   $str = str_replace('\'', '\'\'', $str);
   return $str;
}

function nearbyWords($id){
	global $db, $d, $tblprefix;
	#$alinks = array(); 
	#$url = $_SERVER['PHP_SELF'].'?d='.$d.'&id=';
	
	if ( DICT_LIST_TYPE == 1 ){
		$min = $id ;
	} elseif( DICT_LIST_TYPE == 2 ) {
		$min = $id - intvat(DICT_LIST_NUM/2); 
	}
	$min = ($min<0) ? 0 : $min;
	
	$sql = 'SELECT id,word FROM '.$tblprefix.$d.' WHERE id>='.$min.' LIMIT '.DICT_LIST_NUM;
	$res = mysql_query($sql,$db);
	$alinks = Array();
	if($res){
		while($row  = mysql_fetch_assoc($res)){
			$id = $row['id'];
			$alinks[] = '<a href="#" onClick="showWord('.$id.')">'.$row['word'].'</a>';
		}
	}
	$links = '<ul><li>'.implode('</li><li>',$alinks).'</li></ul>';
	return $links;
}
//------------------------------------------------------
// Build word list 
//
function makeWordList($param){
	global $db, $d, $tblprefix;
	
	if ( is_int($param) ){
		$id = $param;
		if ( DICT_LIST_TYPE == 1 ){
			$min = $id ;
		} elseif( DICT_LIST_TYPE == 2 ) {
			$min = $id - intvat(DICT_LIST_NUM/2); 
		}
		$min = ($min<0) ? 0 : $min;
	
		$sql = 'SELECT id,word FROM '.$tblprefix.$d.' WHERE id>='.$min.' LIMIT '.DICT_LIST_NUM;
		$res = mysql_query($sql,$db);
	} else if (is_resource($param)) {
		$res = $param;
	} else {
		echo "Error: Invalid param function!";
		exit;
	}
	$list = '<select id="wordList" name="wl" size="30">';
	$i = 1;
	if($res){
		while($row  = mysql_fetch_assoc($res) AND ($i<= DICT_LIST_NUM)){
			$id = $row['id'];
			$list .= '<option value="'.$id.'">&bull;&nbsp;'.$row['word'].'</option>';
			$i++;
		}
	}
	$list .= '</select>';
	return $list;
}


//-------------------------------------
// HTML output (default)
//-------------------------------------
function fmtHTML($row) {
	global $d;
	
	$is_admin = (1 > 2); // Admin functions not available for this moment !
	$url = 'admin.php?d='.$d.'&action=';
	
	$word = $row['word'];
	$meanings = $row['meanings'];
	$phonetic = $row['phonetic'];
	
	if($word == '')
		return '';
	
	$out  = "\n".'<!-- Begin output for the word -->'."\n";
	$out .= '<div class="word_meanings">';
	$out .= '<div class="word"><span class="thisword">'.$word.'</span>';
	if($phonetic)
		$out .= '<span class="phonetic">/'.$phonetic.'/</span>';
	if(make_audio_link($word, $d))
		$out .= '<span class="audio">'.make_audio_link($word, $d).'</span>';
	$out .= '</div>'."\n";
	$out .= '<div class="meanings">'."\n";
	$myarr = preg_split("/\r?\n/", $meanings);
	foreach ($myarr as $line){
		$is_kind = false;
		if(preg_match("/\* (.+)\s*$/", $line, $matches)){
			$line = '<br><p class="kind">&loz; '.$matches[1].'</p>'."\n";
			$is_kind = true;
		} elseif (preg_match("/\- (.+)\s*$/", $line, $matches))
			$line = '&nbsp;&nbsp;&bull; <span class="mean1">'.$matches[1]."</span>\n";
		elseif (preg_match("/!(.+)\s*$/", $line, $matches))
			$line = '&nbsp;&nbsp;&spades; <span class="mean2">'.$matches[1]."</span>\n";
		elseif(preg_match("/^=(.+)\+\s*(.+)\s*$/", $line, $matches)){
			$line = '&nbsp;&nbsp;&nbsp;&nbsp;&sdot; <span class="lang1">'.$matches[1].
			'</span> &rArr; <span class="lang2">'.$matches[2]."</span>\n";
		}
		$out .= $is_kind ? $line : $line ."<br />\n";
	}
	$out .= "<br /></div></div>\n";
	$out .= '<!-- End output for the word -->'."\n";
	return $out;
}

//-------------------------------
// Output plain text
//-------------------------------
function fmtTXT($row){
	$out  = $row['word'].' ';
	if($row['phonetic'])
		$out .= '/'.$row['d_phonetic'].'/';
	$out .= "\n".$row['meanings']."\n";
	return $out;
}

function makeSelectDict($d='en_vi'){
	global $DICT;
	$out = '<select id="selDict" name="d" size="1">';
	foreach ($DICT as $k => $v){
		$sel = ($d==$k)?' selected':'';
		$out .= '<option value="'.$k.'"'.$sel.'>'.$v.'</option>'."\n";
	}
	$out .= '</select>'."\n";
	return $out;
}

function makeSelectFmt($fmt='html'){
	$fmts = array(
		"html" => "HTML",
		"txt" => "TXT",
		"xml" => "XML",
		"context" => "ConTeXt",
		"latex" => "LaTeX"
	);
	$out = '<select id="selFmt" name="f" size="1">';
	foreach ($fmts as $k => $v){
		$sel = ($fmt==$k)?' selected':'';
		$out .= '<option value="'.$k.'"'.$sel.'>'.$v.'</option>'."\n";
	}
	$out .= '</select>'."\n";
	return $out;
}

// Make HTML HEAD from user's array
function makeHtmlHead($a) {
	$a_out = Array();
	foreach( $a as $key => $str ){
		if($key == 'title' && !preg_match("/<title>/i",$str)){
			$a_out[] = '<title>'.$str.'</title>';
		} elseif (preg_match("/css/",$key) && !preg_match("/<link /",$str)){
			$a_out[] = '<link rel="stylesheet" type="text/css" href="'.$str.'" />';
		} elseif (preg_match("/js/",$key) && !preg_match("/<script /",$str)){
			$a_out[] = '<script type="text/JavaScript" src="'.$str.'"></script>';
		} else {
			$a_out[] = $str;
		}
	}
	return implode("\n",$a_out);
}

// Check for a valid dictname
function isValidDictName($d){
	global $DICT;
	$res = false;
	if ( in_array( $d, array_keys( $DICT ) ) )
		$res = true;
	return $res;
}

//---------------------------------------------------
// Workaround for Vietnamese UTF8 Collation of MySQL
// Thanks to Long Dinh Le (skz0) <longld AT gmail DOT com> for this nice idea :-)
//---------------------------------------------------
function fetchRow($res, $q) {
	while ( $row = mysql_fetch_assoc( $res ) ){
		if ( $q === $row['word'] )
			return $row;
	}
}
//----------------------------------------------------------
// Audio support with http://musicplayer.sourceforge.net/
//----------------------------------------------------------
function make_audio_link($word, $dict) {
	$audio_file = 'media/'.substr($dict,0,2).'/'.substr($word,0,1).'/'.$word.'.mp3';
	if( ! is_file($audio_file) )
		return '';
	$data = 'media/musicplayer.swf?&song_url='.$audio_file.'&'; 
	return '<object type="application/x-shockwave-flash" data="'.$data.'" '.
		'width="17" height="17"><param name="movie" value="'.$data.'" />'.
		'<img src="img/noflash.gif" width="17" height="17" alt="" />'.
		'</object>';
}
?>