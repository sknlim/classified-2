<?php require_once "header.php"; ?>
<?php require_once "subheader.php"; ?>
<table width="80%" border="0" align="center" bgcolor="#FF9900">
  <tr>
    <td class="header_text" align="left"><b><font color="#0033FF">&nbsp;&copy; Cerified Programmers &copy;</font></b></td>
    <td class="header_text" align="right"><b><font color="#0033FF">&copy; Verified Webmasters &copy;</font></b></td>
  </tr>
</table>
<table width="80%" border="0" align="center">
  <tr height="20" bgcolor="#dde1e8">
  <td>
<table width="40%" border="0" align="left">
  <tr height="20" bgcolor="#dde1e8">
    <!--Certified programmers-->
	<td align="center">
		<table align="left" border="0">
		<tr height="20" bgcolor="#dde1e8">
			<td>&nbsp;<b>Programmers</b></td>
			<td>&nbsp;<b>Ratings</b></td>
			<td>&nbsp;<b>Reviews</b></td>
		</tr>
		<?php 
			$sql="SELECT *,date_format(users.created_time,'%m/%d/%Y') as created_time FROM `users` ";
			$link = mysql_query($sql,$_SESSION['cn']) or die("Error cetified_members.php:".mysql_error());
			while ($row=mysql_fetch_assoc($link))
				{
			$user_account=get_user_profile($row['username']); 
			foreach ($user_account as $prog)
				{
				if ($prog['user_type'] =="p" && $prog['certified'] =="1")
					{ 
					echo "
					<tr>
						<td>&nbsp;<b><font color=\"#0000FF\">".strtoupper($prog['username'])."</font></b></td>
						<td>&nbsp;".$prog['total_rating']."</td>
						<td>&nbsp;".$prog['review']."</td>
					</tr>";
					}
				}
			}			
			?>
		</table>
	</td>
</tr>
</table>    
<table width="40%" border="0" align="right">
  <tr height="20" bgcolor="#dde1e8">
	    <!--Verified Webmaster-->
	<td align="center">
		<table align="right" border="0">
		<tr height="20" bgcolor="#dde1e8">
			<td>&nbsp;<b>Webmasters</b></td>
			<td>&nbsp;<b>Ratings</b></td>
			<td>&nbsp;<b>Reviews</b></td>
		</tr>
		<?php
			$sql="SELECT *,date_format(users.created_time,'%m/%d/%Y') as created_time FROM `users` ";
			$link = mysql_query($sql,$_SESSION['cn']) or die("Error cetified_members.php:".mysql_error());
			while ($row=mysql_fetch_assoc($link))
				{
			$user_account=get_user_profile($row['username']); 
				foreach ($user_account as $web)
					{
				if ($web['user_type'] =="w" && $web['certified'] =="1")
						{	 	
						echo "
						<tr>
							<td>&nbsp;<b><font color=\"#0000FF\">".strtoupper($web['username'])."</font></b></td>
							<td>&nbsp;".$web['total_rating']."</td>
							<td>&nbsp;".$web['reviews']."</td>
						</tr>";
						} 
					}
				}	
			?>
		</table>
   </td>
  </tr>
</table>
</td>
</tr>
</table>
<?php require_once "subfooter.php"; ?>
<?php require_once "footer.php"; ?>