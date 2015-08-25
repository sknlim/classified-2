<?php

$ex_date=mktime(0, 0, 0, date("m")  , date("d")+20, date("Y"));
echo date("Y-m-d",$ex_date);
//		$ex_date=date("Y-m-d", $edate);
?>