<?php
/*------------------------------------------------------------------------
	WDict, yet another web-based dictionary

	@author  NGUYEN-DAI Quy <vnpenguin@vnoss.org>
	@license http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
	@date    Sun Jan  8 17:40:22 CET 2006
	@url     http://vnoss.org http://forum.vnoss.org 
--------------------------------------------------------------------------*/
$footer[] = 'Version '.DICT_VERSION.'&nbsp;-&nbsp; Copyleft 2008-2009 by VNOSS';
//$footer[] = '';

$tpl_main = str_replace('<!-- dict_footer -->',implode("\n", $footer),$tpl_main);
ob_end_clean();
exit($tpl_main);
?>