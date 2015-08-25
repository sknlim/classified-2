<?

include("ImgVerification.php");

$vImage = new vImage();
$vImage->gerText($_GET['size']);
$vImage->showimage();


?>