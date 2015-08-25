<?php
require_once "config.class.php"; 
require_once "mysql.class.php";
require_once "common.class.php";
require_once "email.class.php";
require_once "image.class.php";

class photo
{
	var $domainPath;
	var $fullPath;
	var $uploadDir;
	var $imageQuality;
	var $error;
	var $fileext;
	var $randfilename;
	var $height;
	var $width;
	var $mysql;

	function photo()
		{
		$objConfig=new config;
		$objCommon=new common;
		$this->domainPath="http://".$_SERVER['HTTP_HOST']."/";
		$this->fullPath=$_SERVER['DOCUMENT_ROOT']."/";
		$this->uploadDir=$_SERVER['DOCUMENT_ROOT']."/userimages/";
		$this->imageQuality=$objCommon->getConfigValue("imageQuality");
		$this->error="";
		$this->mysql=new mysql;
		}

		
	function createPhotos($size,$imagepath) // paas the size array e.g. $size[0]="120x90"; $size[0]="600x450"; and the temparory image path
		{
		// getting paths
			$uploadedfile = $imagepath;
			$uploaddir = $this->uploadDir;

		// creating Directory of logged in  userid
			
			$dir = $_SESSION['foongigs_userid'];
			
			if($dir)
			{
				if(!file_exists($uploaddir.$dir."/"))			mkdir($uploaddir.$dir."/", 0777);
			}

	
		// creating files
			$image= new image($imagepath);
			
			$this->randfilename=$image->getFileName();
			$this->fileext=$image->getFileExtension();
			$this->width=$image->getImageHeight();
			$this->height=$image->getImageWidth();
			
			
			for($i=0;$i<count($size);$i++)
				{
				$dimension=explode("x",$size[$i]);
				$destination=$uploaddir.$dir."/".$this->randfilename."_".$size[$i].".".$this->fileext;
				$image->createAndResize($destination,$dimension[0],$dimension[1],$this->imageQuality);
				}
			
	  // Upload Original File....	
	  		$destination=$uploaddir.$dir."/".$this->randfilename."_original".".".$this->fileext;	
			$image->moveTo($destination);
		
						
	}

	// Private for Vibes Jokes		
	function insertimage($title='',$description='')
	{
		$sql="insert into photos(userid,filename,height,width,ext,title,description) values('".$_SESSION['foongigs_userid']."','".$this->mysql->magicquotes($this->randfilename)."','".$this->height."','".$this->width."','".$this->mysql->magicquotes($this->fileext)."','".$this->mysql->magicquotes($title)."','".$this->mysql->magicquotes($description)."')";
		$insertid=$this->mysql->queryinsert($sql,"photos");
		return $insertid;
	}

	function getPhotoById($pid,$size)
	{
		$sql="select * from photos where id='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		
		switch($size)
		{
		
		case "0":
		$str=$this->domainPath."userimages/".$data['userid']."/".$data['filename']."_original.".$data['ext'];
		break;
		
		case "1":
		$str=$this->domainPath."userimages/".$data['userid']."/".$data['filename']."_32x32.".$data['ext'];
		break;
	
		case "2":
		$str=$this->domainPath."userimages/".$data['userid']."/".$data['filename']."_120x90.".$data['ext'];
		break;
		
		case "3":
		$str=$this->domainPath."userimages/".$data['userid']."/".$data['filename']."_600x480.".$data['ext'];
		break;
	
				
		default:
		echo "Error Wrong Size: $size";
		exit();
		break;
		}	
		
		return $str;
	}	
	
	function addTags($pid,$tags)
		{
		$table="tags_photos";
		$str=$tags;
		$st=str_replace(","," ",$str);
		$ex=explode(" ",$st);

			foreach($ex as $w)
			{
				if($this->isvalidtag($w))
				{
				$sql = "insert into tags_photos(`tag`,`photos_id`) values ('".$this->mysql->magicquotes($w)."','".$pid."')";
				$result = $this->mysql->queryinsert($sql,$table);
				}	
			}

		}
		
		function isvalidtag($word)
		{
				$ans=1;
				for ($i=0;$i<strlen($word);$i++)
				{
					$char=substr($word,$i,1);
					if (!(ord($char)==32 || ord($char)==44 || ord($char)>64 && ord($char)<92 || ord($char)>96 && ord($char)<123 || ord($char)>47 && ord($char)<58))	
					{
						$ans=0;
					}
				}	
				if (($ans==1) && (trim($word)!=""))
				{
						return true;
				}
				
		}
		
		function user_photos($uid,$start=0,$end=0)
		{
			$table="photos";
			if($start==0 && $end==0)
			$sql = "select *,UNIX_TIMESTAMP(uploadtime) as uploadtime from photos where userid=".$uid." order by uploadtime DESC";
			else
			$sql = "select *,UNIX_TIMESTAMP(uploadtime) as uploadtime from photos where userid=".$uid." order by uploadtime DESC limit $start,$end";
			$i=1;
			return $result = $this->mysql->getdata($sql);
				
		}
		
		function total_photos_user($uid)
		{
		$table="photos";
				
				$sql = "select count(*) as cnt from photos where userid='".$uid."' ";
	
				return $result = $this->mysql->queryrow($sql);
		
		
		}
		
		function getfunnyphotos($start='0',$end='0')
		{
			$table="photos";
			if($start==0 && $end==0)
			$sql = "select *,UNIX_TIMESTAMP(uploadtime) as uploadtime from photos where id!='1' and status='approved' order by uploadtime DESC";
			else
			$sql = "select *,UNIX_TIMESTAMP(uploadtime) as uploadtime from photos where id!='1' and status='approved' order by uploadtime DESC LIMIT $start, $end";
			return $result = $this->mysql->getdata($sql);
		}
		
		function countfunnyphotos()
		{
			$table="photos";
			$sql = "select count(*) as cnt from photos where id!='1' and status='approved'";
			$result = $this->mysql->queryrow($sql);
			return $result['cnt'];
		}
				
		
		function countviews($pid)
		{
		$sql="select * from photos where id='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['views'];
		}	
		
		function updateviews($pid)
		{
		$sql="update photos set views=views+1 where id='".$pid."'";
		$data=$this->mysql->query($sql);
		}
		
		function countcomments($pid)
		{
		$sql="select count(*) as cnt from comments_photos where photoid='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['cnt'];
		}
		
		function getPhotoTitle($pid)
		{
		$sql="select * from photos where id='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['title'];
		}
		
		function getPhotoDescription($pid)
		{
		$sql="select * from photos where id='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['description'];
		}
		
		function getUserIdFromPhotoId($pid)
		{
		$sql="select * from photos where id='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['userid'];
		}
		
		function getRelatedPhoto($pid,$sl=0,$el=0)
		{

			$sql="select * from tags_photos where photos_id='".$pid."'";
			$relatedtags=$this->mysql->getdata($sql);
			$num=$this->mysql->num;
			$i=1;
			$sql="select * from tags_photos where (";
			foreach ($relatedtags as $data)
			{
				if ($i==$num)
				$sql.="tag='".$data['tag']."' ";
				else
				$sql.="tag='".$data['tag']."' or ";
				$i++;
			}
			$sql.=") and photos_id<>'".$pid."' group by photos_id";
			if($sl!=0 || $el!=0)
			$sql.=" LIMIT $sl,$el";
			
			$tags=$this->mysql->getdata($sql);
			return $tags;
		}
		
		function deletePhoto($pid)
		{
			$sql = "select * from photos where id='".$pid."'";
			$data = $this->mysql->queryrow($sql);

			$imagepath1=$this->fullPath."userimages/".$data['userid']."/".$data['filename']."_32x32.".$data['ext'];
			$imagepath2=$this->fullPath."userimages/".$data['userid']."/".$data['filename']."_120x90.".$data['ext'];
			$imagepath3=$this->fullPath."userimages/".$data['userid']."/".$data['filename']."_600x450.".$data['ext'];
			$imagepathorg=$this->fullPath."userimages/".$data['userid']."/".$data['filename']."_original.".$data['ext'];
			
					if(file_exists($imagepath1))  unlink($imagepath1); 
					if(file_exists($imagepath2))  unlink($imagepath2); 
					if(file_exists($imagepath3))  unlink($imagepath3); 
					if(file_exists($imagepathorg))  unlink($imagepathorg); 
					$sql = "delete from photos where id='".$pid."'";
					$result = $this->mysql->query($sql);
		}
		
		function countRelatedPhoto($pid)
		{

			$sql="select * from tags_photos where photos_id='".$pid."'";
			$relatedtags=$this->mysql->getdata($sql);
			$num=$this->mysql->num;
			$i=1;
			$sql="select * from tags_photos where (";
			foreach ($relatedtags as $data)
			{
				if ($i==$num)
				$sql.="tag='".$data['tag']."' ";
				else
				$sql.="tag='".$data['tag']."' or ";
				$i++;
			}
			$sql.=") and photos_id<>'".$pid."' group by photos_id";
						
			$tags=$this->mysql->getdata($sql);
			$num=$this->mysql->num;
			return $num;
		}
		
		function getPhotoTags($pid)
		{
			$sql="select * from tags_photos where photos_id='".$pid."'";
			$relatedtags=$this->mysql->getdata($sql);
			$objconfig=new config;
			$domain=$objconfig->get_domain_path()."tag/photos/";			
			foreach ($relatedtags as $data)
			{
				$str.="<a href='tags/photo_tags.php?type=photo&tag=".$data['tag']."'>".$data['tag']."</a>  ";
			}
			return $str;
		}
		function countRelatedphoto_tag($tag)
			{
	
				
				 $sql="select * from tags_photos where tag='".$tag."' group by photos_id";				
				$tags=$this->mysql->getdata($sql);
				$num=$this->mysql->num;
				return $num;
			}
		function getRelatedphoto_tag($tag,$sl=0,$el=0)
			{
	
				if($sl!=0 || $el!=0)
				$sql="select * from tags_photos where tag='".$tag."' group by photos_id LIMIT $sl,$el";
				$tags=$this->mysql->getdata($sql);
				return $tags;
			}
		
		
		function edit_photo($id)
		{
			$table="photos";
			
			$sql = "select *,UNIX_TIMESTAMP(uploadtime) as uploadtime from photos where id='".$id."'";

			return $result = $this->mysql->queryrow($sql,$table);
				
		}
		
		function edit_photo_tag($id)
			{
				$table="tags_photos";
				
				$sql = "select * from tags_photos where photos_id='".$id."' ";
	
				return $result = $this->mysql->getdata($sql,$table);
					
			}
		function updatePhoto($ar)
		{
			$sql = "update `photos` set title='".$this->mysql->magicquotes($ar['title'])."',description='".$this->mysql->magicquotes($ar['description'])."', status='pending' where id='".$ar['photo_id']."'";
			 $result = $this->mysql->query($sql);
		
			$sql1="delete from `tags_photos` where photos_id='".$ar['photo_id']."'";
			$result = $this->mysql->query($sql1);
			$this->addTags($ar['photo_id'],$ar['tags']);
				
		}
		function select_photo($id)
			{
				$table="photos";
				
				$sql = "select *,UNIX_TIMESTAMP(uploadtime) as time_stamp from photos where id='".$id."' and status = 'approved' ";
	
				return $result = $this->mysql->queryrow($sql);
					
			}
		function count_tag($tag)
			{
	
				
				 $sql="select * from tags_photos";				
				$tags=$this->mysql->getdata($sql);
				$num=$this->mysql->num;
				return $num;
			}
		function getphoto_tag($tag,$sl=0,$el=0)
			{
	
				if($sl!=0 || $el!=0)
				 $sql="select * from tags_photos  LIMIT $sl,$el";
				$tags=$this->mysql->getdata($sql);
				return $tags;
			}
		
}
	