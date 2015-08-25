<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/photo.class.php"; 

class service
	{
	var $mysql;
	function service()
		{
		$this->mysql = new mysql;
		}
	function getPhotos($sid)
		{
		$sql ="select * from service_images where service_id='".$sid."'";
		$data = $this->mysql->getdata($sql);
		if(is_array($data))
			return $data;
		else
			return false;
		}
	function add($ar)
		{
		 $sql = "insert into service 
		 			(title,description,mobileorphone,userid,maincategory,subcategory,service_category) 
				values 
					('".$this->mysql->magicquotes($ar['title'])."',
					'".$this->mysql->magicquotes($ar['description'])."',
					'".$this->mysql->magicquotes($ar['mobileorphone'])."',
					'".$_SESSION['foongigs_userid']."',
					'1',
					'".$this->mysql->magicquotes($ar['subcategory'])."',
					'".$ar['servicecategory']."'
					)";
				$serviceid=$this->mysql->queryinsert($sql,"service");
					
	/*	foreach ($ar['servicecategory'] as $data)
			{
				if(trim($data)!="")
				{
				$sql = "insert into service_listing(service_id,service_category_id) values (".$serviceid.",".$data.")";
				$this->mysql->queryinsert($sql,"service_listing");
				}

			}
			return $serviceid;			*/
		}
	
	function update($ar)
		{
		 $sql = "update service set title='".$this->mysql->magicquotes($ar['title'])."',
		 							description='".$this->mysql->magicquotes($ar['description'])."',
									mobileorphone='".$this->mysql->magicquotes($ar['mobileorphone'])."',
									subcategory='".$this->mysql->magicquotes($ar['state'])."',
									service_category='".$ar['servicecategory']."' where id='".$ar['serviceid']."'"; 
		$this->mysql->query($sql);
	}
	
	function hasfiles($sid)
	{
		$sql = "select * from `service_images` where service_id='".$sid."'";
		$result=$this->mysql->queryrow($sql);
		return is_array($result);
	}
	
	function editphotos($sid)
	{
		$sql = "select * from `service_images` where service_id='".$sid."'";
		$result=$this->mysql->getdata($sql);
		$str="";
		$i=1;
		$photos=$this->getPhotos($sid);

		if(is_array($photos))
		{
		$ph=new photo;
		foreach($photos as $data)
			{
			$img=$ph->getPhotoById($data['photo_id'],2);
			$str.= '<div id="image'.$i.'">'.$i.'. <a href="javascript:;" onclick="loadPage(\'/ajax/display_image.php?id='.$data['photo_id'].'\')"><img src="'.$img.'" border="0"></a>';
			$str.= "<a href=\"javascript:;\" onclick=\"loadAjax('/ajax/service/removeimage.php?imageid=".$data['photo_id']."','image".$i."');\">Remove this Image</a></div>";
			$i++;
			}
			
		}
		return $str;
	}
	
	
	function removeimage($id)
	{
		$sql = "delete from `service_images` where photo_id='".$id."'";
		$result=$this->mysql->query($sql);
		$ph=new photo;
		$ph->deletePhoto($id);
	}
	
	
	function getstatelist()
		{
		$sql = "select * from sub_maincategory where category_id='1' order by name";
		$category = $this->mysql->getdata($sql);
		return $category;		
		}
	
	function addimages($serviceid,$pid)
	{
		$sql="insert into service_images(service_id,photo_id) values ('".$serviceid."','".$pid."')";
		$this->mysql->queryinsert($sql,"service_images");
	}
	
	function getbyid($id)
		{
		$sql = "select * from `service` where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}
	
	function numofServicebysubCat($catid)
		{
		$sql = "select * from service where subcategory='".$catid."' and status='active' and DATEDIFF( CURDATE(), posted_time) < 31 ";
		$data = $this->mysql->getdata($sql);
		$num = $this->mysql->num;
		return $num;
		}
	
	function getOpenServices()
	{
		$sql = "select * from `service` where userid='".$_SESSION['foongigs_userid']."'";
		$data = $this->mysql->getdata($sql);
		return $data;
	}
	
	function get_open_services()
		{
		$sql = "select * from `service` where userid='".$_SESSION['foongigs_userid']."' and DATEDIFF( CURDATE(), posted_time) < 31  and (status='active' or status='block') order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}
		
	function get_all_services_by_userid($uid)
	{
		$sql = "select * from `service` where userid='".$uid."' order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
	}		
	
	function action($status,$sid)
	{
			$sql = "update service set status='".$status."' where id='".$sid."'";
			$result=$this->mysql->query($sql);
					
	}
	
	function getstatus($jid)
	{
		$sql = "select DATEDIFF( CURDATE(), posted_time) as d from service where id='".$jid."'";
		$result=$this->mysql->queryrow($sql);
		
		if($result['d']>30)
		$status='<font style="color:red;">Expired</font>';
		else
		{
			$sql="SELECT * from service where id='".$jid."'";
			$data=$this->mysql->queryrow($sql);
			
			switch($data['status'])
			{
				case "active":
				$status='<font style="color:green;">Active</font>';
				break;
				
				case "block":
				$status='<font style="color:red;">Block</font>';
				break;
				
				case "suspended":
				$status='<font style="color:blue;">Suspended</font>';
				break;
			}
			
		}		
	return $status;		
	}	
	
	function getoption($jid)
	{
		$sql = "select DATEDIFF( CURDATE(), posted_time) as d from service where id='".$jid."'";
		$result=$this->mysql->queryrow($sql);
		
		if($result['d']>30)
		$status='<font style="color:red;">No Option</font>';
		else
		{
			$sql="SELECT * from service where id='".$jid."'";
			$data=$this->mysql->queryrow($sql);
			
			switch($data['status'])
			{
				case "active":
				$status="<a href='javascript:;'  onclick=\"loadPage('/ajax/service/blockservice.php?sid=".$jid."&action=block');\">Block</a>";
				break;
				
				case "block":
				$status="<a href='javascript:;'  onclick=\"loadPage('/ajax/service/blockservice.php?sid=".$jid."&action=active');\">Active</a>";
				break;
				
				case "suspended":
				$status='<font style="color:blue;">Suspended</font>';
				break;
			}
			
		}		
	return $status;		
	}	
	
	
	function display_category()
		{
		$subcategory = new subcategory("services_category");
		$category = $subcategory->getcategory();
		if(is_array($category))
			{
			echo '<table cellspacing="4" class="sub_categories" width="100%">';
			echo '<tr>';
			$countTd=0;
			foreach($category as $row)
				{
				if($countTd%4==0 && $countTd>1)
					{
					echo "</tr><tr>";
					}
				$countTd++;
				echo '<td class="whiteBg"><div><div><a href="'.$_SERVER['PHP_SELF'].'?service_seo_url='.($row['seo_url']).'&seo_url='.$_GET['seo_url'].'" style="text-decoration:none;">';
				echo $row['name']." &nbsp; ";
				echo "<font color='green'>";
				$sql = "select * from `service`,`services_category`,`service_listing`,`sub_maincategory` 
					where 
					sub_maincategory.id = service.subcategory and 
					service.id=service_listing.service_id and 
					services_category.id=service_listing.service_category_id and 
					services_category.seo_url='".$row['seo_url']."' and
					sub_maincategory.seo_url='".$_GET['seo_url']."' group by service.id";
				$getresults = $this->mysql->getdata($sql);
				$num = $this->mysql->num;
				if($num == "")
				$num = 0;
				echo $num;		
				echo "</font>";
				echo '</a></div></div></td>';
				//if($countTd%4!=0) echo '<td width="20"></td>';
				}
			echo '</tr>';
			echo '</table>';
			}
		else
			echo "No Sub Category Found!";
		}

	
	function display_service($maincategoryid=2,$sub_maincategoryid=0,$start_recno=0,$no_of_rec=0,$order="order by posted_time desc",$service_list="")
		{
	if($service_list=="")
		 $service_filter ="";
	else
		 $service_filter = " and services_category.seo_url='".$service_list."'";
	if($sub_maincategoryid=="")
		$filter_sub = "";
	else
		$filter_sub =  " and subcategory='".$sub_maincategoryid."'";
			$sql = "select service.* from `service`,`services_category` where maincategory='".$maincategoryid."' "
			.$service_filter." ".$filter_sub." and DATEDIFF( CURDATE(), posted_time) < 31 and status='active'  group by service.id ".$order;
		$data = $this->mysql->getdata($sql);
		//echo $sql;
		if(is_array($data))
			{
			echo '<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
					<tr bgcolor="#cccccc">
						<td class="grey" align="center">Title</td>
						<td class="grey" align="center">Service Category</td>
						<td class="grey" align="center">Date</td>
					</tr>';
				foreach($data as $group_details)
					{
					$color=($color=="EEEEEE")?"E0E0E0":"EEEEEE";
					echo "<tr align='center' bgcolor='#".$color."'>		
					<td>";
				//	print_r($group_details);
				//	exit();
					echo "<a href='service_view.php?id=".$group_details['id']."'>".$group_details['title']."</a></td>
					<td>Service Category to be listed</td>
					<td>".$group_details['posted_time']."</td></tr>
				";		
				}
			echo '</table>';
			return true;
			}
		else
			{
			echo "No Service(s) Posted Yet!";
			return false;			
			}

		}
		
	}
?>