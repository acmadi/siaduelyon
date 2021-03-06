<?php
session_start();

// System files
require_once('../../shared/config.php');
require_once('../system/config.php');
require_once(DBFILE);
require_once(LIBDIR.'common.php');
require_once(MODDIR.'date.php');
require_once(MODDIR.'xtable/xtablepf.php');

function doc_nofile(){
	echo 'File tidak tersedia.';
}

$filetype=gets('filetype');
$file=gets('file');
$print=gets('print');
$content=$print!=''?$print.'.php':VWDIR.$file.'.php';

if($filetype=='xls'){
	header('Content-Type: application/vnd.ms-excel'); //IE and Opera  
	header('Content-Type: application/x-msexcel'); // Other browsers  
	header('Content-Disposition: attachment; filename=SIADU_PUS_Katalog.xls');
	header('Expires: 0');  
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
}

function callback($buffer)
{
  $buffer=(preg_replace("/<input\s+type=\"hidden\"[^>]+\/>/", "", $buffer));
  return $buffer;
}

ob_start("callback");

echo '<html><head><title>'.$content.'</title>';
require_once(SHAREDSTYLE.'print.php');
echo '</head><body onload="">';

if(file_exists($content)){
	require_once($content);
} else {
	doc_nofile();
}
echo '</body>';
ob_end_flush();

?>