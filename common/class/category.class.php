<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php"; 

class subcategory
	{
	var $mysql;
	var $table;

	function subcategory($table)
		{
			if($table=="") {
				echo "Error Table Must Be Passed!"; 
				exit();
			}
		$this->table = $table;
		$this->mysql = new mysql;
		}

	function getcategory()
		{
		$sql = "select * from ".$this->table;
		$data = $this->mysql->getdata($sql);
		return $data;
		}
	
	function getcategory_admin()
		{
		$sql = "select * from `".$this->table."` where name<>'OutSources'";
		$data = $this->mysql->getdata($sql);
		return $data;
		}

	function deletecategory($id)
		{
		$sql = "delete from `".$this->table."` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}
		
	function add_category($name)
		{
		$sql = "insert into ".$this->table."(`name`) values ('".$name."')";
		$result1=$this->mysql->queryinsert($sql,$this->table);
		}
		
	function edit_category($name,$id)
		{
		$sql = "update `".$this->table."` set name='".$this->mysql->magicquotes($name)."' where id='".$id."'";;
		$result = $this->mysql->query($sql);
		}
		
	function getById($id)
		{
		$sql = "select * from `".$this->table."` where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data['name'];
		}
	//START for the sub category( sub_maincategory table)
	function deleteSubCategory($id)
				{
					 $sql = "select * from `".$this->table."` where id='".$id."'";
					$result1 = $this->mysql->queryrow($sql);
				if($result1!=0)
					{
					$ans=true;
					$sql = "delete from `".$this->table."` where id='".$id."'";
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
		$sql = "select * from `maincategory` where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data['name'];
		}
		
	function add_sub_category($name,$markbold,$category_id)
		{
		require_once $_SERVER['DOCUMENT_ROOT']."/common/class/seo.class.php"; 
		$seo_class=new seo();
		 $sql = "insert into ".$this->table."(`name`,`markbold`,`category_id`,`seo_url`) values ('".$name."','".$markbold."','".$category_id."','".$seo_class->get_seo_url($name)."')";
		$result1=$this->mysql->queryinsert($sql,$this->table);
		}
			
	function edit_sub_category($name,$id,$markbold,$category_id)
		{
		require_once $_SERVER['DOCUMENT_ROOT']."/common/class/seo.class.php"; 
		$seo_class=new seo();
		 $sql = "update `".$this->table."` set name='".$this->mysql->magicquotes($name)."',markbold='".$this->mysql->magicquotes($markbold)."',category_id='".$this->mysql->magicquotes($category_id)."',seo_url='".$this->mysql->magicquotes($seo_class->get_seo_url($name))."' where id='".$id."'";;
				 $result = $this->mysql->query($sql);
		}
		
	function get_category_by_id($id)
		{
		$sql = "select * from ".$this->table." where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}
//END for the sub category( sub_maincategory table)
	}