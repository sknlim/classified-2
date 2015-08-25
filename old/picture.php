<?
	session_start();	
	include("common/class/verification_image.class.php");	
	$image = new verification_image(120,40,"common/fonts/garamond.ttf");	
	$image->_output();
	
?>
