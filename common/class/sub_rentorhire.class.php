<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 

class sub_rentorhire
	{
	var $mysql;
	function sub_rentorhire()
		{
		$this->mysql = new mysql;
		}
	
	
	
	
	
	function display_category()
		{
	//	$category = new maincategory;
		$category = $this->get_all_category();
		echo '<select id="category" name="category" style="width:200px;" onchange="loadAjax(\'/ajax/rentorhire/admin_subcategory.php?id=\'+this.value,\'subcategory\');">';
		
		echo '<option value="">Select One</option>';

		foreach($category as $data)
        {
			echo "<option value='".$data['id']."'>".stripslashes($data['name'])."</option>";
        }
		echo '</select>';
		
		}
		/*
	function dasfs()
	{	
  	foreach($data as $row)
			{
			echo '<input name="maincategory" id="maincategory" value="'.$row['id'].'" type="radio"';
			$subcategory = $category->getsubcategory($row['id']);
			if(is_array($subcategory))
				echo ' onclick="showDiv(\'subcategory\'); loadAjax(\'/ajax/project/subcategory.php?id='.$row['id'].'\',\'div_subcategory\'); ';
			else
			
				echo ' onclick="hideDiv(\'subcategory\');" ';
			if(strtoupper($row['name'])=="USA") echo '"  checked="checked"';
			echo '> '.$row['name']." &nbsp;&nbsp;&nbsp;&nbsp;";
			}
			
			echo '<input name="maincategory" id="maincategory" value="'.$row['id'].'" type="radio"';
			$subcategory = $category->getsubcategory($row['id']);
			if(is_array($subcategory))
				echo ' onclick="showDiv(\'subcategory\'); loadAjax(\'/ajax/project/subcategory.php?id='.$row['id'].'\',\'div_subcategory\'); ';
			else
				echo ' onclick="hideDiv(\'subcategory\');" ';
			if(strtoupper($row['name'])=="USA") echo '"  checked="checked"';
			echo '> '.$row['name']." &nbsp;&nbsp;&nbsp;&nbsp;";
			
		}
	
	*/
	function display_subcategory($subcat_id)
		{
		$category = new maincategory;
		$data = $category->getsubcategory($subcat_id);
		if(!is_array($data)) return false;
		echo '<select name="subcategory">';
		
		foreach($data as $row)
			{
			echo '<option value="'.$row['id'].'">'.$row['name']."</option>";
			}
		echo '</select>';
		}
	
	
	function get_all_category()
		{
		$sql = "select * from `rentorhire_category` order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
	
	function get_all_sub_category($id)
		{
		$sql = "select * from `rentorhire_subcategory` where category_id='".$id."'order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	

	
		
	function delete_sub_category($id)
		{
				
		$sql = "delete from `rentorhire_subcategory` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}
	
	function get_name_category_id($id)
		{
		$sql = "select * from `rentorhire_category` where id=".$id." order by `id` DESC";
		$data = $this->mysql->queryrow($sql);
		return $data['name'];
		}	
	
	function add_sub_category($name,$id)
		{
		 $sql = "insert into rentorhire_subcategory(name,category_id) values ('".$this->mysql->magicquotes($name)."','".$id."')";
		$jobid = $this->mysql->queryinsert($sql,"rentorhire_subcategory");				
		}
		
	
	function display_category_by_id($id)
		{
	//	$category = new maincategory;
		$category = $this->get_all_category();
		echo '<select id="category" name="category" style="width:200px;" onchange="loadAjax(\'/ajax/rentorhire/admin_subcategory.php?id=\'+this.value,\'subcategory\');">';
		
		echo '<option value="">Select One</option>';

		foreach($category as $data)
        {
			echo "<option value='".$data['id']."'";if($id==$data['id']) { echo "selected='selected'";} echo ">".stripslashes($data['name'])."</option>";
        }
		echo '</select>';
		
		}
		
	function get_name_subcategory_id($id)
		{
		$sql = "select * from `rentorhire_subcategory` where id=".$id." ";
		$data = $this->mysql->queryrow($sql);
		return $data['name'];
		}	
	
	function edit_sub_category($name,$id)
		{
		$sql = "update `rentorhire_subcategory` set name='".$this->mysql->magicquotes($name)."' where id='".$id."'";;
		$result = $this->mysql->query($sql);
		}
		
	}
?>