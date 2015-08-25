<?php include "header.php";
include $_SERVER['DOCUMENT_ROOT']."/common/class/contactus.class.php";
$delete_contactus=new contactus();
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
if($_GET['action']=="delete")
	{   
		
				$midarray = explode(",",$_POST['selectcheck']);
					foreach($midarray as $w)
						{
						$delete_contactus->deletecontactus($w);
						}	
					//disconnect_db($cn);
				echo "<script>alert('Contact us message Deleted ...'); window.location='contact_management.php';</script>";
			
	}

	
?>

