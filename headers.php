<?php 
/*------------------------------------------------------------------------
	WDict, another web-based dictionary

	@author  NGUYEN-DAI Quy <vnpenguin@vnoss.org>
	@license http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
	@date    Sun Jan  8 17:40:22 CET 2006
	@url     http://vnoss.org http://forum.vnoss.org 
--------------------------------------------------------------------------*/
// Send no-cache headers
header('Expires: Thu, 21 Jul 1977 07:30:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Content-type: text/html; charset=utf-8');

ob_start();

$tpl_main = file_get_contents('template/'.DICT_TEMPLATE);

// Define HTML HEAD
$head['title'] 	= 'VnOSS - Webdict';
$head['css1'] 	= 'css/dict.css';
$head['css2'] 	= 'css/style1.css';
$head['css3'] 	= 'css/jquery.autocomplete.css';
$head['js1'] 	= 'js/mudim-0.8-r153.js';
$head['js2'] 	= 'js/jquery-1.2.6.min.js';
$head['js3'] 	= 'js/jquery.autocomplete.js';
$head['js4'] 	= 'js/webdict.js';
//$head['js5']	= 'js/swfobject.js';

$tpl_main = str_replace('<!-- dict_head -->', makeHtmlHead($head), $tpl_main);
unset($head);

?>
