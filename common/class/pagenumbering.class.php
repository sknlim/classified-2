<?php
/* Example 

$sql = "select * from shopping";
$filename = $_SERVER['PHP_SELF']."?something=asfsdf";
$pagenumber = new pagenumbering($sql,$filename,$_GET['pageno'],10,14,connectdb(),"","");
$sql = $pagenumber->getSQL();
echo $sql;
$pagenumber->showHTML();
exit();

*/

class pagenumbering
	{
	var $start_page;
	var $end_page;
	var $current_page;
	var $page_size;
	var $totalnum;
	var $view_size;
	var $query_string;
	var $css_sel;
	var $css_unsel;
	function pagenumbering($totalrec,$query_string,$current_page,$page_size,$view_size,$css_selected_classname="selectedPage",$css_unselected_classname="unselectedPage")
		{
		$this->css_sel = $css_selected_classname;
		$this->css_unsel = $css_unselected_classname;
		$this->query_string = $query_string;
		if($current_page =="")
			$this->current_page = 1;
		else
			$this->current_page = $current_page;
		$this->view_size = $view_size;
		$this->page_size = $page_size;
		$this->totalnum = $totalrec;
		}
	
	function getPageLimit()
		{
			$max_val = $this->totalpages();
			$start_i = (($this->current_page)-(($this->view_size)/(2)));
			if($start_i < 1)
				$start_i = 1;
			if($max_val == $start_i)
				$end_page = $start_i;
			else
				$end_page = (($start_i) + ($this->view_size));
		
			if($end_page > $max_val)
				{
				$end_page = $max_val;
				$start_i = $end_page - ($this->view_size);
				}
			if($start_i < 1)
				$start_i = 1;
		return array($start_i,$end_page);

		}
	function showHTML()
		{
		//	print_r($this->getPageLimit());
			list($start,$end) = $this->getPageLimit();
			if($start > 1)
				{
				echo "&nbsp;<a href=\"".$this->query_string."&pageno=1\" class='".$this->css_unsel."'>";
				echo " << ";
				echo "</a>&nbsp;";
				}
			if($this->current_page > 1)
				{
				echo "&nbsp;<a href=\"".$this->query_string."&pageno=";
				if($start!=1)
					echo (($start) - 1);
				else
					echo ($start);
				echo "\"  class='".$this->css_unsel."'>";
				echo " < ";
				echo "</a>&nbsp;";
				}
			for($i=$start;$i<=$end;$i++)
				{
				if($i==$this->current_page)
					echo "&nbsp;<span class='".$this->css_sel."'>".$i."</span>&nbsp;";
				else
					echo "&nbsp;<a href=\"".$this->query_string."&pageno=".$i."\"  class='".$this->css_unsel."'>".$i."</a>&nbsp;";
				}
			if($this->current_page < $end)
				{
				echo "&nbsp;<a href=\"".$this->query_string."&pageno=".($end)."\" class='".$this->css_unsel."'>";
				echo " > ";
				echo "</a>&nbsp;";
				}
			if($end!=$this->totalpages())
				{
				echo "&nbsp;<a href=\"".$this->query_string."&pageno=".$this->totalpages()."\" class='".$this->css_unsel."'>";
				echo " >> ";
				echo "</a>&nbsp;";
				}
		}
		
	function showAjax($acr,$div_id)
		{
		//	print_r($this->getPageLimit());
			list($start,$end) = $this->getPageLimit();
			if($start > 1)
				{
				echo "&nbsp;<a href=\"#".$acr."\" onclick=\"loadAjax('".$this->query_string."&pageno=1','".$div_id."'); void(0);\" class='".$this->css_unsel."' >";
				echo " << ";
				echo "</a>&nbsp;";
				}
			if($this->current_page > 1)
				{
				echo "&nbsp;<a href=\"#".$acr."\" onclick=\"javascript:loadAjax('".$this->query_string."&pageno=";
				if($start!=1)
					echo (($start) - 1);
				else
					echo ($start);
				echo "','".$div_id."'); void(0);\" class='".$this->css_unsel."'>";
				echo " < ";
				echo "</a>&nbsp;";
				}
			for($i=$start;$i<=$end;$i++)
				{
				if($i==$this->current_page)
					echo "&nbsp;<span class='".$this->css_sel."'>".$i."</span>&nbsp;";
				else
					echo "&nbsp;<a href=\"#".$acr."\" onclick=\"loadAjax('".$this->query_string."&pageno=".$i."','".$div_id."'); void(0);\" class='".$this->css_unsel."'>".$i."</a>&nbsp;";
				}
			if($this->current_page < $end)
				{
				echo "&nbsp;<a href=\"#".$acr."\" onclick=\"loadAjax('".$this->query_string."&pageno=".($end)."','".$div_id."'); void(0);\" class='".$this->css_unsel."'>";
				echo " > ";
				echo "</a>&nbsp;";
				}
			if($end != $this->totalpages())
				{
			//	echo "-".$end."-".$this->totalpages();
				echo "&nbsp;<a href=\"#".$acr."\" onclick=\"loadAjax('".$this->query_string."&pageno=".$this->totalpages()."','".$div_id."');\" class='".$this->css_unsel."'>";
				echo " >> ";
				echo "</a>&nbsp;";
				}
		}
		
	function totalpages()
		{
		$max_int = (int)(($this->totalnum) / ($this->page_size));
		$max_float = (($this->totalnum) / ($this->page_size));
		$max_val = 	$max_float-(int)(($this->totalnum) / ($this->page_size));
		if($max_val>0.01)
			$max_int = $max_int + 1;
	//	echo "Total Pages : ".$max_int."<br>";
		return ($max_int);
		}
	
	}