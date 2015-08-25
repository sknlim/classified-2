<?php include "header.php";
require_once "../common/class/configuration.class.php";
$configuration=new configuration();

if($_GET['wtdo']=='add_variable' && $_POST!="")
	{
	$configuration->add_variable($_POST);
	}
if($_GET['wtdo']=='edit_variable' && $_POST!="")
	{
	$add=$configuration->edit_configuration($_POST,$_GET['cid']);
	}
$config=$configuration->getall_values();
?>


<table align="center" >
    <tr>
    <td><img src="images/configuration.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of Configuration Values</td>
    </tr>
    </table>
<br />
<a href='add_variable.php'>ADD VARIABLE</a>
<table width="100%" cellspacing="3" cellpadding="3" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;" align="center">
<tr bgcolor="#3262bd" align="left" >
<th style="font-weight:bold; font-size:13px;color:#ffffff;" width="300">Configuration Name</th>
<th style="font-weight:bold; font-size:13px;color:#ffffff;" width="300">Value</th>
<th style="font-weight:bold; font-size:13px;color:#ffffff;" width="30">Type</th>
<th style="font-weight:bold; font-size:13px;color:#ffffff;" width="30" >Edit</th>
</tr>

<?php	foreach($config as $value)
		{
		echo "<tr ";
		$color=!$color;
		if($color)
			echo 'bgcolor="#FFFFFF"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo "><td>".$value['variable']."</td>
		<td width='300'><div style=\"width:300px; overflow: auto;\">".htmlspecialchars($value['value'])."</div></td>
		<td>".$value['type']."</td>
		<td><a href=editconfiguration.php?cid=".$value['id']."&action=edit&type=".$value['type']."><img src='images/edit.png' border='0'></td>";
		echo "</tr>";
		}
	//	disconnect_db($cn);
?>
</table>
<a href='add_variable.php'>ADD VARIABLE</a>

