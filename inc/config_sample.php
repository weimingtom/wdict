<?php
/*------------------------------------------------------------------------
	WDict, another web-based dictionary

	@author  NGUYEN-DAI Quy <vnpenguin@vnoss.org>
	@license http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
	@date    Sun Jan  8 17:40:22 CET 2006
	@url     http://vnoss.org http://forum.vnoss.org 
--------------------------------------------------------------------------*/
$dbname = 'webdict';
$dbuser = '';
$dbpass = '';
$dbhost = 'localhost';
$tblprefix = 'dict_'; // Table prefix

define('DICT_VERSION','dev-20090101');

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
