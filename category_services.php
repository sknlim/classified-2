<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subheader.php"; ?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
  <td class="heading">Services Category</td>
 </tr>
 <tr><td>
  <?php
	$objservicetype= new subcategory("services_category");
	$jobservice=$objservicetype->getcategory();
	if(is_array($jobservice))
	{
	echo '<table cellspacing="4" class="sub_categories" width="100%">';
			echo '<tr>';
			$countTd=0;
		foreach($jobservice as $d)
			{
			if($countTd%4==0 && $countTd>1)
					{
					echo "</tr><tr>";
					}
				$countTd++;
				echo '<td class="whiteBg"><div><div><a href="subcategory.php?seo_url='.$row['seo_url'].'" style="text-decoration:none;">';
		echo $d['name'];
		echo '</td>';
		if($countTd%4!=0) echo '<td width="20"></td>';
			}
			echo '</tr>';
			echo '</table>';
		}
else
		{
		echo "No Sub Category!";
		}
	
	?></td>
</tr>
</table>
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>
