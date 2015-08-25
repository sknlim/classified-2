<?php

	include("PageNavigator.php");
	include("functions.inc.php");
	$PN=new pageNavigator(100,"navigazione","select",10,"navigazione");
	
	$PN->setLanguage("english");
	
	
	echo "SQL LIMIT:".$PN->getLimit()."<br /><br />";
	
	echo $PN->show_page_browsing(false)."<br /><br />";
	echo $PN->show_page_browsing(true,3)."<br /><br />";
	//echo $PN->show_RPP_browsing(3,4);
	
?>
