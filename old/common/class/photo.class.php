<?php
require_once "config.class.php";
require_once "common.class.php";
class photo
{
var $description;
var $fileType;
var $title;
var $tags;
var $files;
var $domainPath;
var $fullPath;
var $uploadDir;
var $imageQuality;
function photo($files)
	{
	$objConfig=new config;
	$objCommon=new common;
	
	$this->domainPath=$objConfig->get_domain_path();
	$this->fullPath=$objConfig->get_full_domain_path();
	$this->uploadDir=$objConfig->get_upload_dir();
	$this->imageQuality=$objCommon->getConfigValue("imageQuality");
	$this->files=$files;
	$this->description="";
	$this->fileType="";
	$this->title="";
	$this->tags="";
	}
function getphotoquality()
{
$cn=connect_db();
$sql="select * from `photopreferences` where preference='photoquality'";
$link=mysql_query($sql,$cn) ;
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['value'];
}	
	
function ByteSize($bytes) 
    {
    $size = $bytes / 1024;
    if($size < 1024)
        {
        $size = number_format($size, 2);
        $size .= ' KB';
        }  
    else 
        {
        if($size / 1024 < 1024) 
            {
            $size = number_format($size / 1024, 2);
            $size .= ' MB';
            } 
        else if ($size / 1024 / 1024 < 1024)  
            {
            $size = number_format($size / 1024 / 1024, 2);
            $size .= ' GB';
	            } 
        }
    return $size;
    } 
	
function jpg($width,$hight,$uploadedfile,$thumbs_folder,$file_name,$newwidth,$newhight,$quality)
	{
		$src = imagecreatefromjpeg($uploadedfile);
		$tmp=imagecreatetruecolor($newwidth,$newhight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newhight,$width,$hight);
		imagejpeg($tmp,$thumbs_folder.$file_name,$quality);
		$size = filesize($thumbs_folder.$file_name);
		$re = array();
		$re[] = $src;
		$re[] = $tmp;
		$re[] = $size;
		$re[] = $thumbs_folder.$file_name;
		return $re;
	}
function gif($width,$hight,$uploadedfile,$thumbs_folder,$file_name,$newwidth,$newhight,$quality)
	{
		$src = imagecreatefromgif($uploadedfile);
		$tmp=imagecreatetruecolor($newwidth,$newhight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newhight,$width,$hight);
		imagegif($tmp,$thumbs_folder.$file_name,$quality);
		$size = filesize($thumbs_folder.$file_name);
		$re = array();
		$re[] = $src;
		$re[] = $tmp;
		$re[] = $size;
		$re[] = $thumbs_folder.$file_name;
		return $re;
	}
function png($width,$hight,$uploadedfile,$thumbs_folder,$file_name,$newwidth,$newhight,$quality)
	{
		$src = imagecreatefrompng($uploadedfile);
		$tmp=imagecreatetruecolor($newwidth,$newhight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newhight,$width,$hight);
		imagepng($tmp,$thumbs_folder.$file_name,$quality);
		$size = filesize($thumbs_folder.$file_name);
		$re = array();
		$re[] = $src;
		$re[] = $tmp;
		$re[] = $size;
		$re[] = $thumbs_folder.$file_name;
		return $re;
	}

// Image Resize Function.......	


//thumb 80

function resize_ratio($width,$height,$resize_width)
	{
//	echo "width = ".$resize_width."<br>\n";
//	echo "height = ".(($resize_width/100)*75)."<br>\n";
	$ratio = $width/$height;
//	echo $ratio;
	if($ratio > (4/3))
		{
	//	echo "-1-";
		$width = $resize_width;
		$height = $width/$ratio;
		}
	else
		{
	//	echo "-2-";
		$height = (($resize_width/100)*75);
		$width = $height*$ratio;
		}
	
	$re = array();
	$re[] = $width;
	$re[] = $height;
	return $re;
	}

function getimagedata()
{
	$cn = connect_db();
	$sql = "select * from image_manager order by upload_time DESC";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$num = mysql_num_rows($link);
	$array=array();
	while($data=mysql_fetch_assoc($link))
	{
	$array[]=$data;
	}
	disconnect_db($cn);
	return $array;
}

function isvalidimagesize($files)
{
	$fileSize = $files['size'] / 1024 ;
//	$fileSize=$fileSize / 1024;
	$maxsize=getmaxuploadsize();
	if($fileSize>$maxsize)
	{
	$ans=false;
	}
	else
	{
	$ans=true;
	}
	return $ans;
}

function image_add()
{
$path=substr($this->domainPath,0,-1);
$uploadedfile = $this->files['tmp_name'];
$uploaddir = $this->uploadDir;
$file_name = $this->files['name'];
$ext_array=explode(".",$file_name);
$ext=$ext_array[count($ext_array)-1];

$code = substr(md5(microtime()),0,6); // Always Unique File Name ....
$file_name =substr($file_name,0,3).$code.".".$ext; // Create Unique File....

$uploadfile = $uploaddir . basename($file_name);

// Create Directory...
$dir = $_SESSION['vibes_userid'];
if($dir)
{
	if(!file_exists("userimages/".$dir."/"))
		{
		mkdir("userimages/".$dir."/", 0777);
		mkdir("userimages/".$dir."/original/", 0777);
		mkdir("userimages/".$dir."/550x412/", 0777);
		mkdir("userimages/".$dir."/100x75/", 0777);
		mkdir("userimages/".$dir."/52x52/", 0777);
		mkdir("userimages/".$dir."/180x135/", 0777);
		}	
}

// Check File Size..

list($width,$height)=getimagesize($uploadedfile);

$imageOriginal = "userimages/".$dir."/original/";
$image550x412 = "userimages/".$dir."/550x412/";
$image100x75 = "userimages/".$dir."/100x75/";



//$imageOriginal = $this->domainPath."userimages/".$dir."/original/";
//$image550x412 = $this->domainPath."userimages/".$dir."/550x412/";
//$image100x75 = $this->domainPath."userimages/".$dir."/100x75/";
//$image52x52 = $this->domainPath."userimages/".$dir."/52x52/";
//$image180x135 = $this->domainPath."userimages/".$dir."/180x135/";
$quality=$this->imageQuality;

switch ($ext) 
{
   	case "jpg":
	case "JPG":
   	case "jpeg":
	case "JPEG":
      // $image_type = IMG_GIF;
	   $func = "jpg";
	break;
	
   	case "gif":
	case "GIF":
   	   $func ="gif";
    break;
	
   	case "png":
	case "PNG":
	   $func = "png";
    break;
}



// Call Function For Jpeg Files......	
if($func == "jpg")
	{
//resize medium 550
		if($width > 550 || $height > 412)
			{
				$re = $this->resize_ratio($width,$height,550);
				$r=$this->jpg($width,$height,$uploadedfile,$image550x412,$file_name,$re[0],$re[1],$quality);
			//	echo $r[2]." <a href='".$r[3]."'>Middle</a><br>";
				$medimage = $path.str_replace("../","/",$r[3]);
				$medsize = $r[2];
			}
		else
			{
				$r=$this->jpg($width,$height,$uploadedfile,$image550x412,$file_name,$width,$height,$quality);
			//	echo $r[2]." <a href='".$r[3]."'>Middle</a><br>";
				$medimage = $path.str_replace("../","/",$r[3]);
				$medsize = $r[2];
			}

//resize thumb 100	
				if($width > 100 || $height > 75)
			{	
				$re = $this->resize_ratio($width,$height,100);
				$r=$this->jpg($width,$height,$uploadedfile,$image100x75,$file_name,$re[0],$re[1],100);
			//	echo $r[2]." <a href='".$r[3]."'>Thumb</a><br>";
				$thumbimage = $path.str_replace("../","/",$r[3]);
				$thumbsize = $r[2];
			}
		else
			{
				$r=$this->jpg($width,$height,$uploadedfile,$image100x75,$file_name,$width,$height,100);
			//	echo $r[2]." <a href='".$r[3]."'>Thumb</a><br>";
				$thumbimage = $path.str_replace("../","/",$r[3]);
				$thumbsize = $r[2];
			}		
	imagedestroy($r[0]);
	imagedestroy($r[1]);
	}	
	/*
if($func == "gif")
	{
//resize medium 640
		if($width > 400 || $height > 300)
			{
				$re = $this->resize_ratio($width,$height,400);
				$r=gif($width,$height,$uploadedfile,$thumbs_medium,$file_name,$re[0],$re[1],$quality);
			//	echo $r[2]." <a href='".$r[3]."'>Middle</a><br>";
				$medimage = $path.str_replace("../","/",$r[3]);
				$medsize = $r[2];
			}
		else
			{
				$r=gif($width,$height,$uploadedfile,$thumbs_medium,$file_name,$width,$height,$quality);
			//	echo $r[2]." <a href='".$r[3]."'>Middle</a><br>";
				$medimage = $path.str_replace("../","/",$r[3]);
				$medsize = $r[2];
			}

//resize thumb 80			
				if($width > 80 || $height > 60)
			{	
				$re = $this->resize_ratio($width,$height,120);
				$r=gif($width,$height,$uploadedfile,$thumbs_thumb,$file_name,$re[0],$re[1],100);
			//	echo $r[2]." <a href='".$r[3]."'>Thumb</a><br>";
				$thumbimage = $path.str_replace("../","/",$r[3]);
				$thumbsize = $r[2];
			}
		else
			{
				$r=gif($width,$height,$uploadedfile,$thumbs_thumb,$file_name,$width,$height,100);
			//	echo $r[2]." <a href='".$r[3]."'>Thumb</a><br>";
				$thumbimage = $path.str_replace("../","/",$r[3]);
				$thumbsize = $r[2];
			}		
	
	imagedestroy($r[0]);
	imagedestroy($r[1]);
	}	
	
if($func == "png")
	{
//resize medium 640
		if($width > 400 || $height > 300)
			{
				$re = $this->resize_ratio($width,$height,400);
				$r=png($width,$height,$uploadedfile,$thumbs_medium,$file_name,$re[0],$re[1],$quality);
			//	echo $r[2]." <a href='".$r[3]."'>Middle</a><br>";
//			http://sahusoft.homelinux.org/final_gallery./userimages/117672256124/original/amr31a46962a.jpg
				$medimage = $path.str_replace("../","/",$r[3]);
				$medsize = $r[2];
			}
		else
			{
				$r=png($width,$height,$uploadedfile,$thumbs_medium,$file_name,$width,$height,$quality);
			//	echo $r[2]." <a href='".$r[3]."'>Middle</a><br>";
				$medimage = $path.str_replace("../","/",$r[3]);
				$medsize = $r[2];
			}

//resize thumb 80			
				if($width > 80 || $height > 60)
			{	
				$re = $this->resize_ratio($width,$height,120);
				$r=png($width,$height,$uploadedfile,$thumbs_thumb,$file_name,$re[0],$re[1],100);
			//	echo $r[2]." <a href='".$r[3]."'>Thumb</a><br>";
				$thumbimage = $path.str_replace("../","/",$r[3]);
				$thumbsize = $r[2];
			}
		else
			{
				$r=png($width,$height,$uploadedfile,$thumbs_thumb,$file_name,$width,$height,100);
			//	echo $r[2]." <a href='".$r[3]."'>Thumb</a><br>";
				$thumbimage = $path.str_replace("../","/",$r[3]);
				$thumbsize = $r[2];
			}		
	
	imagedestroy($r[0]);
	imagedestroy($r[1]);
	}	
	*/
// Upload Original File....	
$t=$imageOriginal.$file_name;
move_uploaded_file($uploadedfile,$t);

$s = filesize($t);
$orgimage = $path.str_replace("../","/",$t);
$orgsize = $s;
$filename = $files['name'];

$d1 = date("Y-m-d");
$d1 .= date(" H:i:s",time());
/*$cn = connect_db();

$sql = "INSERT INTO `photo` (id,userid,title,description,original_url,medium_url,thumb_url,original_filesize,medium_filesize,thumb_filesize,upload_filename,upload_time) VALUES ('".$id."','".$_SESSION['gallery_userid']."','No Title','No Description','".magicquotes($orgimage)."','".magicquotes($medimage)."','".magicquotes($thumbimage)."','".$orgsize."','".$medsize."','".$thumbsize."','".magicquotes($filename)."','".$d1."')";
$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
disconnect_db($cn);
image_original_delete($id);*/
}

function image_original_delete($pid)
{
	$cn = connect_db();
	$sql = "SELECT * FROM `photo` WHERE id='".$pid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);
	$path=str_replace(get_domain_path(),"",$data['original_url']);
	unlink(addslashes(get_full_domain_path().$path));
	$sql = "update `photo` set original_url=\"".magicquotes($data['medium_url'])."\", original_filesize=\"".$data['medium_filesize']."\" WHERE id='".$pid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function image_delete($pid)
{
	$cn = connect_db();
	$sql = "SELECT * FROM `photo` WHERE id='".$pid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);

	
	$path=str_replace(get_domain_path(),"",$data['original_url']);
	unlink(addslashes(get_full_domain_path().$path));
	
//	$path=str_replace(get_domain_path(),"",$data['medium_url']);
	//unlink(get_full_domain_path().$path);
	
	$path=str_replace(get_domain_path(),"",$data['thumb_url']);
	unlink(addslashes(get_full_domain_path().$path));

	$sql = "DELETE FROM `photo` WHERE id='".$pid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function image_edit($id)
{
	$cn = connect_db();
	$sql = "SELECT *,UNIX_TIMESTAMP(upload_time) as upload_time FROM `photo` WHERE id='".$id."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);
	disconnect_db($cn);
	return $data;
}

function getimagedetailfromid($id)
{
	$cn = connect_db();
	$sql = "SELECT * FROM `photo` WHERE id='".$id."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);
	disconnect_db($cn);
	return $data;
}

function image_update($id,$date,$title,$description,$rotate)
{
	$cn = connect_db();
	if($title=="")
	{
		$title="No Title";
	}
	
	if($description=="")
	{
		$description="No Description";
	}
	
	$sql = "SELECT * FROM `photo` WHERE id='".$id."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);

	$path1=get_full_domain_path().str_replace(get_domain_path(),"",$data['original_url']);
	$path2=get_full_domain_path().str_replace(get_domain_path(),"",$data['medium_url']);
	$path3=get_full_domain_path().str_replace(get_domain_path(),"",$data['thumb_url']);


	if($rotate=="CW")
	{
	rotateImage($path1,"CW");
	rotateImage($path2,"CW");
	rotateImage($path3,"CW");
	}
	
	if($rotate=="CCW")
	{
	rotateImage($path1,"CCW");
	rotateImage($path2,"CCW");
	rotateImage($path3,"CCW");
	}

	$d1 = date("Y-m-d",strtotime($date));
	$d1 .= date(" H:i:s",time());
	
	$sql = "update `photo` set upload_time='".$d1."', title='".formattext(htmlspecialchars(magicquotes($title)))."', description='".formattext(magicquotes(htmlspecialchars($description)))."' where id='".$id."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function getallimagedetails($uid,$sr="",$ps="")
{
	$cn = connect_db();
	
	if($sr=="" && $ps=="")
	{
	$sql = "select * from `photo` where userid='".$uid."'";
	}
	else
	{
	$sql = "select * from `photo` where userid='".$uid."' LIMIT $sr,$ps";
	}

	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	//$array=array();
	while($data = mysql_fetch_assoc($link))
		{
		$array[]=$data;
		}
	disconnect_db($cn);
	return $array;
}

function getprofileimagedetails($uid)
{
	$cn = connect_db();
	$sql = "select * from `photo` where userid='".$uid."' order by upload_time DESC LIMIT 0,100";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$array=array();
	while($data = mysql_fetch_assoc($link))
		{
		$array[]=$data;
		}
	disconnect_db($cn);
	return $array;
}

function countphoto($uid)
{
	$cn = connect_db();
	$sql = "select count(*) AS cnt from `photo` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data = mysql_fetch_assoc($link);
	disconnect_db($cn);
	return $data['cnt'];
}

function getthumbimagefromid($id)
{
	$cn = connect_db();
	$sql = "SELECT *,UNIX_TIMESTAMP(upload_time) as upload_time FROM `photo` WHERE id='".$id."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);
	disconnect_db($cn);
	if ($data['thumb_url']=="")
	{
	$str=get_domain_path()."images/nophoto.gif";
	}
	else
	{
	$str=$data['thumb_url'];
	}
	return $str;
}

function getmediumimagefromid($id)
{
	$cn = connect_db();
	$sql = "SELECT *,UNIX_TIMESTAMP(upload_time) as upload_time FROM `photo` WHERE id='".$id."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);
	disconnect_db($cn);
	return $data['medium_url'];
}

function rotateImage($img,$type)// Image Path, ccw / cw And ''( Original File) 
{

	if($type=="cw" || $type=="CW")
		$degrees= -90;
	else if($type=="ccw" || $type=="CCW")
		$degrees= 90;	
	else
	$degrees=0;	
	$source = imagecreatefromjpeg($img);
	$white = imagecolorallocate($source,255,255,255);
	$rotate = imagerotate($source, $degrees, $white);
	imagejpeg($rotate,$img,100);
	imagedestroy($rotate);

	return true;
}


}

?>