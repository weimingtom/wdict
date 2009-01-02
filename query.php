<?php
/*------------------------------------------------------------------------
	WDict, yet another web-based dictionary

	@author  NGUYEN-DAI Quy <vnpenguin@vnoss.org>
	@license http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
	@date    Sun Jan  8 17:40:22 CET 2006
	@url     http://vnoss.org http://forum.vnoss.org 
	@usage   query.php?q=QUERYSTRING&d=EN_VI&n=NUM&f=FORMAT
--------------------------------------------------------------------------*/
include('inc/config.php');
include('inc/functions.php');

$db = mysql_connect($dbhost,$dbuser,$dbpass) or die('Could not connect: ' . mysql_error());
mysql_select_db($dbname) or die('Could not select database');
$sql = "SET NAMES 'UTF8'";
mysql_query($sql,$db);

$max=20;
//------------------------------
function retPHP($res){
	$words = array();
	while($row = mysql_fetch_row($res)){
		$words[] = '"'.$row[0].'"';
	}
	$out = '';
	if( count($words)>0 ){
		$out = 'Array (' . implode(",",$words) .');';
	}
	return $out;
}

function retJSON($res){
	global $d,$DICT;
	$words = array();
	while($row = mysql_fetch_row($res)){
		$words[] = $row[0];
	}
	$out = '';
	if( count($words)>0 ){
		//$out = implode("\n",$words);
		$out = json_encode($words);
	}
	return $out;
}

function retHTML($res){
	$words = array();
	while($row = mysql_fetch_row($res)){
		$words[] = '<div class="ACList">'.$row[0].'</div>';
	}
	$out = '';
	if( count($words)>0 ){
		$out = implode("\n",$words);
	}
	return $out;
}

function retTXT($res,$sep){
	$words = array();
	while($row = mysql_fetch_row($res)){
		$words[] = $row[0];
	}
	$out = '';
	if( count($words)>0 ){
		$out = implode($sep,$words);
	}
	return $out;
}

function retXML($res){
	$words = array('<?xml version="1.0" ?>','<wordlist>');
	while($row = mysql_fetch_row($res)){
		$words[] = '<item>'.$row[0].'</item>';
	}
	$words[] = '</wordlist>';
	$out = implode("\n",$words);
	return $out;
}


if( isset($_GET['q']) && $_GET['q']!='' ){

	$d = strtolower( isset($_GET['d']) ? $_GET['d'] : 'en_vi');
	$f = strtolower(isset($_GET['f']) ? $_GET['f'] : '');

	$d = mysql_real_escape_string($d);
	if ( !isValidDictName( $d ) )
		exit;
	
	if (isset($_GET['n'])){
		$max = intval($_GET['n']);
		$max = ($max<0 || $max>50) ? 20 : $max;
	}
	$_q  = mysql_real_escape_string($_GET['q']);
	$q  = $_GET['q'].'%';

	if ( strlen( $q ) > 11 OR preg_match("/\.|\/|\-\-|=|\s/",$q) )
		exit;

	$out = '';
	$sql = 'SELECT word FROM '.$tblprefix.$d." WHERE word LIKE '$q' LIMIT $max";
	//echo "$query\n";
	$res = mysql_query($sql,$db);
	if($res){
		switch ($f){
			case 'xml'  : $out = retXML($res); break;
			case 'html' : $out = retHTML($res); break;
			case 'txt'  : $out = retTXT($res,' '); break;
			case 'csv'  : $out = retTXT($res,';'); break;
			case 'php'  : $out = retPHP($res); break;
			case 'json' : $out = retJSON($res); break;
			default     : $out = retTXT($res,"\n");
		}
	}
	echo $out;
}
