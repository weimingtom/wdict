<?php
/*------------------------------------------------------------------------
	WDict, another web-based dictionary

	@author  NGUYEN-DAI Quy <vnpenguin@vnoss.org>
	@license http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
	@date    Sun Jan  8 17:40:22 CET 2006
	@url     http://vnoss.org http://forum.vnoss.org 
--------------------------------------------------------------------------*/
include('inc/config.php');
include('inc/functions.php');

$db = mysql_connect($dbhost,$dbuser,$dbpass) or die('Could not connect: ' . mysql_error());
mysql_select_db($dbname) or die('Could not select database');
$sql = "SET NAMES 'UTF8'";
mysql_query($sql,$db);

$_q = '';
$word_list = '';

//-------------------------------------------------------------------------------
if(isset($_POST['submit']) 
	OR (isset($_REQUEST['q']) AND isset($_REQUEST['d']))
	OR (isset($_REQUEST['id']) AND isset($_REQUEST['d']))
){
	$d   = isset($_REQUEST['d']) ? $_REQUEST['d'] : '';
	$q   = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
	$f   = isset($_REQUEST['f']) ? $_REQUEST['f'] : '';
	$id  = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
	
	$q 	= mysql_real_escape_string($q);
	$id = intval($id);
	if(!isValidDictName($d)){
		echo "Error: Invalid Dict name!";
		exit;
	}
	
	if($id > 0)
		$sql = 'SELECT * FROM '.$tblprefix.$d.' WHERE id=\''.$id.'\'';
	elseif (strpos($q,'*')){
		$_q = str_replace('*','%',$q);
		$sql = 'SELECT * FROM '.$tblprefix.$d.' WHERE word LIKE \''.$_q.'\' LIMIT '.DICT_LIST_NUM;
		$fmt = 'html';
	} else {
		$sql = 'SELECT * FROM '.$tblprefix.$d.' WHERE word=\''.$q.'\'';
	}
	$res = mysql_query($sql,$db);
	//echo get_resource_type ( $res );
	if($res){
		$row  = ( $id || $_q ) ? mysql_fetch_assoc($res) : fetchRow($res,$q);
		$query = isset($query) ? $query : $row['word'];
		switch(strtolower($f)){
			case 'context':
				$content = fmtCONTEXT($row); break;
			case 'latex':
				$content = fmtLATEX($row); break;
			case 'xml':
				$content = fmtXML($row); break;
			case 'txt':
				echo fmtTXT($row); break;
			default:
				if ($_q){
					$word_list = makeWordList( $res );
				} else {
					$content = fmtHTML($row);
					$word_list = makeWordList(intval($row['id']));
				}
		}

	} else {
		$content = 'SQL = '.$sql.'<br>Error: '.mysql_error();
	}
}

include('headers.php');

//$form[] = '<h1><a href="'.$_SERVER['SELF_PHP'].'">VnOSS webdict</a> (<span id="dName"></span>)</h1>';
$form[] = '<h1>WDict</h1>';
$form[] = '<form id="fDict" name="fmdict" method="post" action="'.$_SERVER['PHP_SELF'].'">';
$form[] = makeSelectDict($d);
$form[] = '<input id="qStr" type="text" name="q" value="'.(isset($query)?$query:'').'" class="text" maxlength="32" onChange="doSubmit();">';
$form[] = '<input id="bSubmit" type="submit" name="submit" value="Go">';
$form[] = '<input id="wordId" type="hidden" name="id" value="">';
$form[] = '<input id="oFmt" type="hidden" name="f" value="html">';
//$form[] = '<input id="oList" type="hidden" name="l" value="1">';
//$form[] = '<input id="oNum" type="hidden" name="n" value="20">';
$form[] = '</form>';

$tpl_main = str_replace('<!-- dict_header -->', implode("\n", $form), $tpl_main);

$tpl_main = str_replace('<!-- dict_left -->', $word_list, $tpl_main);

if (!isset($result) && isset($word) ) {
	$content = '<h3>Không tìm thấy từ yêu cầu!</h3>';
}

$tpl_main = str_replace('<!-- dict_content -->', $content, $tpl_main);

include('footers.php');
?>