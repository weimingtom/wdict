<?php
$footer[] = 'Version '.DICT_VERSION.'&nbsp;-&nbsp;(C) 2008 by VNOSS.org';
//$footer[] = '';

$tpl_main = str_replace('<!-- dict_footer -->',implode("\n", $footer),$tpl_main);
ob_end_clean();
exit($tpl_main);
?>