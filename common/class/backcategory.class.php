<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php"; 

class subcategory
	{
	var $mysql;
	function subcategory()
		{
		$this->mysql = new mysql;
		}
	function getbyseo($category_seo)
		{
		$sql = "select * from category where seo_url='".$category_seo."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}
	function getsubcategory($id)
		{
		$sql = "select * from sub_category where category_id=$id";
		$category = $this->mysql->getdata($sql);
		return $category;		
		}
	function getcategory()
		{
		$sql = "select * from category";
		$data = $this->mysql->getdata($sql);
		return $data;
		}
	function get_category_by_id($id,$table)
		{
		$sql = "select * from ".$table." where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}
	
//Private for this project foongigs
	function display_category_usa()
		{
		$this->getsubcategory(1);
		if(is_array($category))
			{
			echo '<table cellspacing="4" class="sub_categories">';
			echo '<tr>';
			$countTd=0;
			foreach($category as $row)
				{
				if($countTd%4==0 && $countTd>1)
					{
					echo "</tr><tr>";
					}
				$countTd++;
				echo '<td class="whiteBg"><div><div><a href="subcategory.php?seo_url='.$row['seo_url'].'" style="text-decoration:none;">';
				if($row['markbold']=="yes")
					echo "<strong>".$row['sub_cat']."</strong> &nbsp; ";
				else
					echo $row['sub_cat']." &nbsp; ";
				echo "<font color='green'>".$project->numOfProjectByCat($row['id'])."</font>";
				echo '</a></div></div></td>';
				if($countTd%4!=0) echo '<td width="20"></td>';
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
	function deletecategory($id,$table)
				{
					 $sql = "select * from `".$table."` where id='".$id."'";
					$result1 = $this->mysql->queryrow($sql);
				if($result1!=0)
					{
					$ans=true;
					$sql = "delete from `".$table."` where id='".$id."'";
					$result1=$this->mysql->query($sql);
			
					}
					else
					{
					$ans=false;
					}
					return $ans;
				}
	function add_category($name,$table)
		{
		
		 $sql = "insert into ".$table."(`name`) values ('".$name."')";
		$result1=$this->mysql->queryinsert($sql,$table);
		}
	function edit_category($name,$id,$table)
		{
		
		 $sql = "update `".$table."` set name='".$this->mysql->magicquotes($name)."' where id='".$id."'";;
				 $result = $this->mysql->query($sql);
		}
	function deleteSubCategory($id,$table)
				{
					 $sql = "select * from `".$table."` where id='".$id."'";
					$result1 = $this->mysql->queryrow($sql);
				if($result1!=0)
					{
					$ans=true;
					$sql = "delete from `".$table."` where id='".$id."'";
					$result1=$this->mysql->query($sql);
			
					}
					else
					{
					$ans=false;
					}
					return $ans;
				}
	function getCategoryNameById($id)
		{
		$sql = "select * from category where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data['name'];
		}
	function add_sub_category($name,$table,$markbold,$category_id)
		{
		require_once $_SERVER['DOCUMENT_ROOT']."/common/class/seo.class.php"; 
		$seo_class=new seo();
		 $sql = "insert into ".$table."(`name`,`markbold`,`category_id`,`seo_url`) values ('".$name."','".$markbold."','".$category_id."','".$seo_class->get_seo_url($name)."')";
		$result1=$this->mysql->queryinsert($sql,$table);
		}	
	function edit_sub_category($name,$id,$table,$markbold,$category_id)
		{
		require_once $_SERVER['DOCUMENT_ROOT']."/common/class/seo.class.php"; 
		$seo_class=new seo();
		 $sql = "update `".$table."` set name='".$this->mysql->magicquotes($name)."',markbold='".$this->mysql->magicquotes($markbold)."',category_id='".$this->mysql->magicquotes($category_id)."',seo_url='".$this->mysql->magicquotes($seo_class->get_seo_url($name))."' where id='".$id."'";;
				 $result = $this->mysql->query($sql);
		}
	
				
	}