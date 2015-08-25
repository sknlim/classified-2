<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/photo.class.php"; 

class rentorhire
	{
	var $mysql;
	function rentorhire()
		{
		$this->mysql = new mysql;
		}
	function getbyid($id)
		{
		$sql = "select * from `rentorhire` where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}
		
	function add($ar)
		{
		 $sql = "insert into rentorhire 
		 			(name, description,
					quantity, chargetype,
					maincategory_id, sub_maincategory_id,
					product_category,hire_period_hr,hire_period_4hr,
					hire_period_day,hire_period_week,hire_period_month,
					hire_period_fortnight,minimum_charge,fixed_rate,userid) 
				values 
					('".$this->mysql->magicquotes($ar['itemname'])."','".$this->mysql->magicquotes($ar['description'])."',
					'".$this->mysql->magicquotes($ar['quantity'])."','".$this->mysql->magicquotes($ar['chargetype'])."',
					'1','".$this->mysql->magicquotes($ar['subcategory'])."',
					'".$this->mysql->magicquotes($ar['categoryproduct'])."',
					'".$this->mysql->magicquotes($ar['text_hour'])."','".$this->mysql->magicquotes($ar['text_4hour'])."',
					'".$this->mysql->magicquotes($ar['text_day'])."','".$this->mysql->magicquotes($ar['text_week'])."',
					'".$this->mysql->magicquotes($ar['text_month'])."','".$this->mysql->magicquotes($ar['text_fortnight'])."',
					'".$this->mysql->magicquotes($ar['minimum_charge'])."','".$this->mysql->magicquotes($ar['text_fixed'])."','".$_SESSION['foongigs_userid']."')";

		$rentorhireid=$this->mysql->queryinsert($sql,"rentorhire");
		return $rentorhireid;
		
		}
		
	function update($ar)
		{
		 $sql = "update rentorhire set 	name='".$this->mysql->magicquotes($ar['itemname'])."',
		 				 				description='".$this->mysql->magicquotes($ar['description'])."',
										quantity='".$this->mysql->magicquotes($ar['quantity'])."',
										chargetype='".$this->mysql->magicquotes($ar['chargetype'])."',
										sub_maincategory_id='".$ar['state']."',
										product_category='".$this->mysql->magicquotes($ar['productcategory'])."',
										hire_period_hr='".$this->mysql->magicquotes($ar['text_hour'])."',
										hire_period_4hr='".$this->mysql->magicquotes($ar['text_4hour'])."',
										hire_period_day='".$this->mysql->magicquotes($ar['text_day'])."',
										hire_period_week='".$this->mysql->magicquotes($ar['text_week'])."',
										hire_period_month='".$this->mysql->magicquotes($ar['text_month'])."',
										hire_period_fortnight='".$this->mysql->magicquotes($ar['text_fortnight'])."',
										minimum_charge='".$this->mysql->magicquotes($ar['minimum_charge'])."',
										fixed_rate='".$this->mysql->magicquotes($ar['text_fixed'])."' where id='".$ar['rentorhireid']."'"; 
		$this->mysql->query($sql);
			
		}	
	
	function hasfiles($rid)
	{
		$sql = "select * from `rentorhire_images` where rentorhire_id='".$rid."'";
		$result=$this->mysql->queryrow($sql);
		return is_array($result);
	}
	
	function editphotos($rid)
	{
		$sql = "select * from `rentorhire_images` where rentorhire_id='".$rid."'";
		$result=$this->mysql->getdata($sql);
		$str="";
		$i=1;
		$photos=$this->getPhotos($rid);

		if(is_array($photos))
		{
		$ph=new photo;
		foreach($photos as $data)
			{
			$img=$ph->getPhotoById($data['photo_id'],2);
			$str.= '<div id="image'.$i.'">'.$i.'. <a href="javascript:;" onclick="loadPage(\'/ajax/display_image.php?id='.$data['photo_id'].'\')"><img src="'.$img.'" border="0"></a>';
			$str.= "<a href=\"javascript:;\" onclick=\"loadAjax('/ajax/rentorhire/removeimage.php?imageid=".$data['photo_id']."','image".$i."');\">Remove this Image</a></div>";
			$i++;
			}
			
		}
		return $str;
	}
	
	
	function removeimage($id)
	{
		$sql = "delete from `rentorhire_images` where photo_id='".$id."'";
		$result=$this->mysql->query($sql);
		$ph=new photo;
		$ph->deletePhoto($id);
	}
	
	function getPhotos($rid)
		{
		$sql ="select * from rentorhire_images where rentorhire_id='".$rid."'";
		$data = $this->mysql->getdata($sql);
		if(is_array($data))
			return $data;
		else
			return false;
		}
	
	
	function getstatelist()
		{
		$sql = "select * from sub_maincategory where category_id='1' order by name";
		$category = $this->mysql->getdata($sql);
		return $category;		
		}
	
	function addimages($rentorhireid,$pid)
	{
		$sql="insert into rentorhire_images(rentorhire_id,photo_id) values ('".$rentorhireid."','".$pid."')";
		$this->mysql->queryinsert($sql,"rentorhire_images");
	}
	
	
	function display_rentorhire_category()
		{
		$subcategory = new subcategory("rentorhire_category");
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
				echo '<td class="whiteBg"><div><div><a href="'.$_SERVER['PHP_SELF'].'?rentorhire_seo_url='.($row['seo_url']).'&seo_url='.$_GET['seo_url'].'" style="text-decoration:none;">';
				echo $row['name']." &nbsp; ";
				echo "<font color='green'>";
	
				$sql = "select * from `rentorhire`,`rentorhire_category`,`sub_maincategory` 
					where 
					sub_maincategory.id = rentorhire.sub_maincategory_id and 
					rentorhire.product_category = rentorhire_category.id and
					rentorhire_category.seo_url='".$row['seo_url']."' and
					sub_maincategory.seo_url='".$_GET['seo_url']."'";
			//	echo $sql;
			$getresults = $this->mysql->getdata($sql);
			$num = $this->mysql->num;
				if($num == "")
				$num = 0;
				echo $num;		 
				echo "</font>";
				echo '</a></div></div></td>';
				if($countTd%4!=0) echo '<td width="20"></td>';
				}
			echo '</tr>';
			echo '</table>';
			}
		else
			echo "No Sub Category Found!";
		}
	
	
	function display_category()
		{
	//	$category = new maincategory;
			$category = $this->get_all_category();
			echo '<select id="categoryproduct" name="categoryproduct" style="width:200px;" class="vldnoblank">';
			
			foreach($category as $data)
			{
				echo "<option value='".$data['id']."'>".stripslashes($data['name'])."</option>";
			}
			echo '</select>';
		
		}
		
	

	
	function display_subcategory($cat_id)
		{
		$sql="select * from rentorhire_subcategory where category_id='".$cat_id."'";
		$data = $this->mysql->getdata($sql);
		if(!is_array($data)) return false;
		echo '<select name="subcategoryproduct">';
	
		foreach($data as $row)
			{
			echo '<option value="'.$row['id'].'">'.$row['name']."</option>";
			}
		echo '</select>';
		}
	
	
	function get_all_category()
		{
		$sql = "select * from `rentorhire_category` order by `id` ASC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
		
	function get_all_rentorhire()
		{
		$sql = "select * from `rentorhire` where DATEDIFF( CURDATE(), posted_time) < 31 and status='active' order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}

	function delete_rentorhire($id)
		{
		$sql = "delete from `rentorhire` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}
	function numofrentorhirebysubCat($catid)
		{
		$sql = "select * from `rentorhire` where sub_maincategory_id='".$catid."' and DATEDIFF( CURDATE(), posted_time) < 31 and status='active' ";
		$data = $this->mysql->getdata($sql);
		$num = $this->mysql->num;
		return $num;
		}
	
	function getOpenRentorHire()
	{
		$sql = "select * from `rentorhire` where userid='".$_SESSION['foongigs_userid']."'";
		$data = $this->mysql->getdata($sql);
		return $data;
	}
	
	
	function get_open_rentorhire()
		{
		$sql = "select * from `rentorhire` where userid='".$_SESSION['foongigs_userid']."' and DATEDIFF( CURDATE(), posted_time) < 31 and (status='active' or status='block') order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
	
	function get_all_rentorhire_by_userid($uid)
	{
		$sql = "select * from `rentorhire` where userid='".$uid."' order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
	}
	
	function action($status,$rid)
	{
			$sql = "update rentorhire set status='".$status."' where id='".$rid."'";
			$result=$this->mysql->query($sql);
					
	}
	
	
	function getstatus($jid)
	{
		$sql = "select DATEDIFF( CURDATE(), posted_time) as d from rentorhire where id='".$jid."'";
		$result=$this->mysql->queryrow($sql);
		
		if($result['d']>30)
		$status='<font style="color:red;">Expired</font>';
		else
		{
			$sql="SELECT * from rentorhire where id='".$jid."'";
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
		$sql = "select DATEDIFF( CURDATE(), posted_time) as d from rentorhire where id='".$jid."'";
		$result=$this->mysql->queryrow($sql);
		
		if($result['d']>30)
		$status='<font style="color:red;">No Option</font>';
		else
		{
			$sql="SELECT * from rentorhire where id='".$jid."'";
			$data=$this->mysql->queryrow($sql);
			
			switch($data['status'])
			{
				case "active":
				$status="<a href='javascript:;'  onclick=\"loadPage('/ajax/rentorhire/blockrentorhire.php?rid=".$jid."&action=block');\">Block</a>";
				break;
				
				case "block":
				$status="<a href='javascript:;'  onclick=\"loadPage('/ajax/rentorhire/blockrentorhire.php?rid=".$jid."&action=active');\">Active</a>";
				break;
				
				case "suspended":
				$status='<font style="color:blue;">Suspended</font>';
				break;
			}
			
		}		
	return $status;		
	}	
	
	
	function display_rentofhire($maincategoryid=2,$sub_maincategoryid=0,$product_category_seo_url="",$start_recno=0,$no_of_rec=0,$order="order by posted_time desc")
		{
		if($sub_maincategoryid==0)
			$filter_sub ="";
		else
			$filter_sub = " and sub_maincategory_id='".$sub_maincategoryid."'";
		if($product_category_seo_url=="")
			$filter_product_category = "";
		else
			$filter_product_category = " and rentorhire_category.seo_url='".$product_category_seo_url."'";
			
		$sql = "select rentorhire.* from `rentorhire`,`rentorhire_category` where rentorhire_category.id=rentorhire.product_category and maincategory_id='".$maincategoryid."' ".$filter_sub.$filter_product_category."  and DATEDIFF( CURDATE(), posted_time)  < 31 and status='active' ".$order;
		//echo $sql;and  and DATEDIFF( CURDATE(), posted_time) < 31 
		$data = $this->mysql->getdata($sql);
		if(is_array($data))
			{
			echo '<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
					<tr bgcolor="#cccccc">
						<td class="grey" align="center">Rent or Hire Things</td>
						<td class="grey" align="center">Quantity</td>
						<td class="grey" align="center">Minimum Charge</td>
						<td class="grey" align="center">Charge Type</td>
						<td class="grey" align="center">Date</td>
					</tr>';
				foreach($data as $group_details)
					{
					$color=($color=="EEEEEE")?"E0E0E0":"EEEEEE";
					echo "<tr align='center' bgcolor='#".$color."'>		
					<td><a href='rentofhire_view.php?id=".$group_details['id']."'>".$group_details['name']."</a></td>
					<td>".$group_details['quantity']."</td>
					<td>$".$group_details['minimum_charge']."</td>
					<td>".$group_details['chargetype']."</td>
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