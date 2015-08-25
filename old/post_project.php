<?php
session_start();
include "function.php"; ?>
<?php 
$js = $_POST['array']; 
$array = explode(',',$js);
$check=post_project($_POST['title'],$_POST['min_bud'],$_POST['max_bud'],$attachment_link='',$_POST['feat'],$private='0',$_POST['hide'],$_POST['days'],$_POST['disc'],$array);
if($check > 0)
	echo "Thank's For Project Posting";
else
	echo $_SESSION['error'];	


/*
$js = $_POST['array']; 
$array = explode(',',$js);
print_r($array);



//$array=$_POST['array'];
//echo $array." Next -> ";
//print_r($array);

foreach($array as $key => $val)
{
echo "<br>".$val;
//echo $sql="INSERT INTO `working_field`(username,experts_area_id,projects_id) VALUES('".$_SESSION['username']."','".$val."','".$row['id']."') ";
}

//print_r($_POST);
*/
?>
