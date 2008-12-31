<?php
/*-----------------------------------------------------------------
  Webdict 
  @author: Nguyen Dai Quy <vnpenguin@vnoss.org>
  @License: GPL
  @Date: Sun Jan  8 17:40:22 CET 2006
  @Last update: 
-----------------------------------------------------------------*/
$dbname = 'webdict';
$dbuser = '';
$dbpass = '';
$dbhost = 'localhost';
$tblprefix = 'dict_'; // Table prefix

define('DICT_VERSION','dev-20081231');

// Working template in $DICTHOME/template/DICT_TEMPLATE
define('DICT_TEMPLATE','default.tpl');

// Method nearby Words 
define('DICT_LIST_TYPE',1); # Query word is in top of list
#define('DICT_LIST_TYPE',2); # Query word is in middle of list

define('DICT_LIST_NUM',24); # Number of item in left list

$DICT = array(
	"en_vi" => "Anh - Việt",
	"vi_en" => "Việt - Anh",
	"fr_vi" => "Pháp - Việt",
	"vi_fr" => "Việt - Pháp",
);
/*
	"de_vi" => "Ðức - Việt",
	"vi_de" => "Việt - Ðức",
	"no_vi" => "Nauy - Việt",
	"vi_vi" => "Việt - Việt",
	"ru_vi" => "Nga - Việt"
);
*/
?>
