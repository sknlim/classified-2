<?php
class maincategory
	{
	var $mysql;
	function maincategory()
		{
		$this->mysql = new mysql;
		}
	function getbyseo($category_seo)
		{
		$sql = "select * from sub_maincategory where seo_url='".$category_seo."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}
	
	function getsubcategory($id)
		{
		$sql = "select * from sub_maincategory where category_id=$id order by name";
		$category = $this->mysql->getdata($sql);
		return $category;		
		}
		
	function getcategory()
		{
		$sql = "select * from maincategory";
		$data = $this->mysql->getdata($sql);
		return $data;
		}
//Private for this project foongigs
	function display_category_usa($type="all",$linkurl='subcategory.php',$selected="")
		{
		$project = new project;
		$service = new service;
		$rentorhire = new rentorhire;
		$jobs = new jobs;
		$category = $this->getsubcategory(1);
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
				echo '<td ';
				if($type=="jobs" && $selected==$row['seo_url'])
				echo "class='redBg'";
				else
				echo "class='whiteBg'";
				echo ' ><div><div><a href="'.$linkurl.'?seo_url='.$row['seo_url'].'" style="text-decoration:none;">';
				if($row['markbold']=="yes")
					echo "<strong>".$row['name']."</strong> &nbsp; ";
				else
					echo $row['name']." &nbsp; ";
				
				echo "<font color='green'>";
				if($type=="services")
					echo $service->numofServicebysubCat($row['id']);
				else if($type=="rentorhire")
					echo $rentorhire->numofrentorhirebysubCat($row['id']);	
				else if($type="jobs")
					echo $jobs->numofjobsbysubCat($row['id']);	
				else if($type=="all")
					{
					echo $project->numOfProjectBySubCat($row['id']).","
				.$rentorhire->numofrentorhirebysubCat($row['id']).","
				.$jobs->numofjobsbysubCat($row['id']).","
				.$service->numofServicebysubCat($row['id']);
					}
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
	function add($cat_name,$sub_cat,$markbold)
		{
		// $markbold = yes/no
//		Below Example for SEO URL UPdate
/*		$mysql = new mysql;
		$seo = new seo;
		$sql = "select * from category";
		$data = $mysql->getdata($sql);
		foreach($data as $row)
			{
			$sql = "update category set seo_url='".$seo->get_seo_url($row['sub_cat'])."' where id='".$row['id']."'";
			echo $row['id']."<br>";
			$mysql->query($sql);
			}
			*/
		}
		

	function getsubcategoryname($cid)
	{
		$sql = "select * from `sub_maincategory` where id='".$cid."'";
		$data = $this->mysql->queryrow($sql);
		return $data['name'];
	}		
	}
?>