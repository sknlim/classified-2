<?php require_once "header.php"; ?>
<?php require_once "function.php"; ?>
<?php require_once "sidemenu.php"; ?>

<?php
if(!isset($_GET['id']))
	{
		echo "<script>window.location='index.php';</script>";
		exit();
	}
$job=job_type($_GET['id']);
$project=get_project_details($_GET['id']);
$total_mp=total_mp_pmb($_GET['id']); 
$project_job=get_user_profile($_GET['id']);
if($project['username'] == NULL)
	{
		echo "<script>window.location='index.php'</script>";
		exit();
	}
?>

<SCRIPT>
function GetXmlHttpObject()
{
var XMLHttpRequestObject=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  XMLHttpRequestObject=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    XMLHttpRequestObject=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    XMLHttpRequestObject=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return XMLHttpRequestObject;
}


function submitForm(con)
{
  var http = null;
  if(window.XMLHttpRequest)
    http = new XMLHttpRequest();
  else if (window.ActiveXObject)
    http = new ActiveXObject("Microsoft.XMLHTTP");

  http.onreadystatechange = function()
  {
  	document.getElementById("post_msg").innerHTML="";
    if(http.readyState == 4 && http.status==200)
		{ 
			if(con==1)
				{
					document.getElementById("post_msg1").innerHTML="";
					document.getElementById("post_msg").innerHTML=http.responseText; 
				}
			else
				{
					document.getElementById("post_msg").innerHTML="";
					document.getElementById("post_msg1").innerHTML=http.responseText; 
				}
		}
  }

  http.open("POST", "place_bid.php", true);
  http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  http.send("id="+<? echo $_GET['id']; ?>);
  // This Code Is Used For Wait for reloaded the page...
  var loadingImg = document.createElement('img');
  loadingImg.src = 'wait.gif';
  if(con==1)
  	{
	  document.getElementById("post_msg").appendChild(loadingImg);
	  document.getElementById("post_msg").ajaxInProgress = true;
	}
	else
	{
	  document.getElementById("post_msg1").appendChild(loadingImg);
	  document.getElementById("post_msg1").ajaxInProgress = true;
	}
}

function submitform()
	{
	  var http = null;
		http=GetXmlHttpObject();
	  http.onreadystatechange = function()
	  {
		document.getElementById("post_msg").innerHTML="";
		var checking=http.responseText;
		if(http.readyState == 4 && http.status==200)
			{ 

				if(checking==0)
					{
						alert("Thank's For Place Bid...!");
						window.location='';
						return false;
					}
				else
					{	
						document.getElementById("post_msg").innerHTML=http.responseText;
						document.getElementById("post_msg1").innerHTML=http.responseText; 
					}
			}
	  }
		var p_id=<? echo $_GET['id']; ?>;	
		var username=document.getElementById("user1").value;
		var password=document.getElementById("pass1").value;
		var bid_amount=document.getElementById("bid_amount").value;	
		var no_days=document.getElementById("no_days").value;	
		var comment=document.getElementById("desc").value;		
	  http.open("POST", "place_bid.php", true);
	  http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	  http.send("user="+username+"&pass="+password+"&condition=1&id="+p_id+"&comment="+comment+"&no_days="+no_days+"&bid_amount="+bid_amount);
	  // This Code Is Used For Wait for reloaded the page...
	  var loadingImg = document.createElement('img');
	  loadingImg.src = 'wait.gif';
	  document.getElementById("post_msg").appendChild(loadingImg);
	  document.getElementById("post_msg").ajaxInProgress = true;
	  document.getElementById("post_msg1").appendChild(loadingImg);
	  document.getElementById("post_msg1").ajaxInProgress = true;
	}

	
function display_orderby(order)
{
	var type;
	var project_id=<? echo $_GET['id']; ?>;
	if(document.getElementById(order).innerHTML=='ASC')
		{ document.getElementById(order).innerHTML="DESC";type=1; }
	else
		{ document.getElementById(order).innerHTML="ASC";type=0; }

  var http = null;
  if(window.XMLHttpRequest)
    http = new XMLHttpRequest();
  else if (window.ActiveXObject)
    http = new ActiveXObject("Microsoft.XMLHTTP");

  http.onreadystatechange = function()
  {
    if(http.readyState == 4 && http.status==200)
		{ 
			document.getElementById("bid_data").innerHTML="";
			document.getElementById("bid_data").innerHTML=http.responseText; 
		}
  }

  http.open("POST", "order_by.php", true);
  http.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  http.send("user="+order+"&type="+type+"&project_id="+project_id);
  // This Code Is Used For Wait for reloaded the page...
  var loadingImg = document.createElement('img');
  loadingImg.src = 'wait.gif';
  document.getElementById("bid_data").appendChild(loadingImg);
  document.getElementById("bid_data").ajaxInProgress = true;
}
	

</SCRIPT>

<table width="96%" align="center">
	<tr bgcolor="#CCCCFF">
		<td align="" class="border" colspan="5">
			Project Details 
		</td>
	</tr>
	<tr><td class="dark">Project ID</td><td class="dark"><?php echo $_GET['id'];?></td></tr>
	<tr><td class="dark">Created By</td><td class="dark"><a href="profile.php?username=<?php echo $project['username']; ?>">
				<?php echo ucwords($project['username']);
					$rating=rate_value($project['username']);
					if($rating[0]['count_reviews'] != 0)
						{
						echo "
						<a href=\"reviews.php?user=".$project['username']."\">
						<img src=\"images/rating.jpg\" width=\"".($rating[0]['reviews'])*'10'."\" height=\"5\" style=\"border:none;\">
						</a>
						<b>(".$rating[0]['count_reviews'].") ".$rating[0]['reviews']."</b>";
			 	} else { echo "<font color=\"orange\">[ No Rating ]</font>"; }
 			?></a></td></tr>
	<tr><td class="dark">Title</td><td class="dark"><?php echo ucwords($project['project_title']); ?></td></tr>
	<tr><td class="dark">Created Time</td><td class="dark"><?php echo $project['created_time'];?></td></tr>
	<tr><td class="dark">Biding Ends</td><td class="dark"><?php if($project['leftdays'] <=0) $project['leftdays']=0;
				echo $project['leftdate']." (".$project['leftdays']." days left)";?></td></tr>
	<tr><td class="dark">Project Budget</td><td class="dark">$ <?php echo $project['min_budget'];?> - <?php echo $project['max_budget'];?></td></tr>
	<tr><td class="dark">Status</td><td class="dark">
	<?php echo $project['status']; ?></td></tr>
	<tr><td class="dark">Description</td><td class="dark"><?php echo $project['description'];?></td></tr>
	<tr><td class="dark">Job Type</td><td class="dark"><?php echo $job;?></td></tr>

</table>
<a href="pmb.php?id=<?php echo $_GET['id'];?>">Private Message Board</a><br />
Messages Posted : <?php echo $total_mp;?><br />

<?php 
if ($project['status'] == "Open")
	{
	echo "<b id=\"color1\" onclick=\"submitForm(0);\" style=\"cursor:pointer;\" onmouseover=\"this.className='btnover'\" onmouseout=\"this.className='btnout'\">Place a Bid</b>";
	echo '<div id="post_msg1"></div>';
	}
	else if ($project['status'] != "Open")
		{
		echo "<font color=\"#CCCCCC\"><b>Place Bid Closed</b></font>";
		}
?>
<?php $bid_list = get_listof_bid($_GET['id']);
if (is_array($bid_list))
{
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr bgcolor="#dde1e8">
    <td class="header_text" align="center" width="20%">Programmers [ <span id="username" onmouseover="this.className='btnover'" onmouseout="this.className='btnout'" onclick="display_orderby('username')">ASC</span> ]</td>
    <td class="header_text" align="center" width="20%">Bid[ <span id="bid_amount" onmouseover="this.className='btnover'" onmouseout="this.className='btnout'" onclick="display_orderby('bid_amount')">ASC</span> ]</td>
    <td class="header_text" align="center" width="20%">Delivery within[ <span id="no_days" onmouseover="this.className='btnover'" onmouseout="this.className='btnout'" onclick="display_orderby('no_days')">ASC</span> ] </td>
    <td class="header_text" align="center" width="20%">Time of Bid[ <span id="created_time" onmouseover="this.className='btnover'" onmouseout="this.className='btnout'" onclick="display_orderby('created_time')">ASC</span> ] </td>
    <td class="header_text" align="center" width="20%">Rating</td>
  </tr>
</table>
<?
}
?>
<div id="bid_data">
<table width="100%" border="0" align="center">
<?php 
//$bid_list = get_listof_bid($_GET['id']);
if (is_array($bid_list))
{

foreach ($bid_list as $bid)
{
echo"
    <tr>
    <td class=\"dark\" width=\"20%\"><a href=\"profile.php?username=".$bid['username']."\">".$bid['username']."</a></td>
    <td class=\"dark\" width=\"20%\">$ ".$bid['bid_amount']."</td>
    <td class=\"dark\" width=\"20%\">".$bid['no_days']." Days</td>
    <td class=\"dark\" width=\"20%\" align=\"center\">".$bid['created_time']." </td>
    <td class=\"dark\" width=\"10%\">";
			$rating=rate_value($bid['username']);
			if($rating[0]['count_reviews'] != 0)
			{
			foreach($rating as $rate)
			 	{
				echo "
				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">
					<tr>
						<td width=\"100%\" height=\"100%\">
							<a href=\"reviews.php?user=".$bid['username']."\">
						<img src=\"images/rating.jpg\" width=\"".($rate['reviews'])*'10'."\" height=\"5\" style=\"border:none;\">				
							</a>
						</td>
						<td width=\"100%\" height=\"100%\" class=\"dark\"><b>(".$rate['count_reviews'].")".$rate['reviews']."</b></td>
					</tr>		
				</table>";
			 	}
			 } else { echo "<font color=\"orange\">[ No Rating ]</font>"; }
			 
	echo "													
	</td>
  </tr>";
echo "<tr>
	<td colspan='5' class=\"dark\">".$bid['comment']."</td>
	</tr>";
	
		  
  
 }
 }
?>

</table>
</div>
<p>
  <?php

if ($project['status'] == "Open")
	{
	echo "
		<script>
				function count_word(data)
				{
					if(data.length <= 600)
						{ document.getElementById(\"count\").value=(600-data.length);}
					else
						{document.getElementById(\"desc\").disabled=true;}	
				}
		
		</script>";
	echo "<b id=\"color2\" onclick=\"submitForm(1);\" style=\"cursor:pointer;\"onmouseover=\"this.className='btnover'\" onmouseout=\"this.className='btnout'\">Place a Bid</b>";
	echo '<div id="post_msg"></div>';
	}
?>
  
  <?php require_once "footer.php"; ?>
</p>

