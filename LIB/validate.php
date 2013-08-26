<?php
session_start();
$text="123456789";

$rand=substr(str_shuffle($text),0,3);
$_SESSION['verify']=$rand;

$im=imagecreate(55,25);
$bgcolor=imagecolorallocate($im,144,144,144);
$textcolor=imagecolorallocate($im,0,0,0);

imagestring($im,5,14,5,$rand,$textcolor);

header('Content-type: image/jpeg');
imagejpeg($im);
imagedestroy($im);

?>
