<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/maincategory.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php"; 

class project
	{
	var $mysql;
	function project()
		{
		$this->mysql = new mysql;
		}
	
		
	function add($ar)
		{
		//print_r($ar);
		
		if($ar['maincategory']=="2")
		$subcat=0;
		else
		$subcat=$ar['subcategory'];
		
		if($ar['makePrivate']!="on")
		$private="no";
		else
		$private="yes";
		
		
		if($ar['makeFeatured']!="on")
		$featured="no";
		else
		$featured="yes";
		if($ar['hideBid']!="on")
		$hidden="no";
		else
		$hidden="yes";
		
		$ex_date=mktime(0, 0, 0, date("m")  , date("d")+$ar['days'], date("Y"));
		$ex_date=date("Y-m-d",$ex_date);
//		$ex_date=date("Y-m-d", $edate);
		
		
		if(trim($ar['privateInvitaitonList'])=="[ADD_CERTIFIED]")
		$pinvite="yes";
		else
		$pinvite="no";

		
		$sql = "insert into `projects`(userid,project_title,
		 								max_budget,min_budget,
										description,featured,
										private,hidden,expiry_date,
										maincategory_id,sub_maincategory_id,jobtype,add_certified)
		  		values 
										('".$_SESSION['foongigs_userid']."',
										'".$this->mysql->magicquotes($ar['title'])."',
										'".$ar['max']."','".$ar['min']."',
										'".$this->mysql->magicquotes($ar['description'])."',
										'".$featured."','".$private."',
										'".$hidden."','".$ex_date."',
										'".$ar['maincategory']."','".$subcat."','".$this->mysql->magicquotes($ar['jobtype'])."','".$pinvite."')";	
					$projectid=$this->mysql->queryinsert($sql,"projects");
// code for private invitation project
					
					if($private=="yes")
					{
						$certified=$ar['privateInvitaitonList'];
						$clist=explode("\n",$certified);
						$objuser=new user;		
						foreach ($clist as $data)
						{
							if($data!="")
							{
								$userarray=$objuser->isexist($data);
								if(is_array($userarray)) 
								{
								$sql="insert into project_invitelist(userid,projectid) values ('".$userarray['id']."','".$projectid."')";
								$this->mysql->queryinsert($sql,"project_invitelist");
								}
							}
						}
			
					}	
					
					
					return $projectid;
		}
		
	function update($ar)
	{
		if($ar['maincategory']=="2")
		$subcat=0;
		else
		$subcat=$ar['subcategory'];
		
		$sql = "update `projects` set project_title='".$this->mysql->magicquotes($ar['title'])."',
									  max_budget='".$ar['max']."',
									  min_budget='".$ar['min']."',
									  description='".$this->mysql->magicquotes($ar['description'])."',
									  maincategory_id='".$ar['maincategory']."',
									  sub_maincategory_id='".$subcat."',
									  jobtype='".$this->mysql->magicquotes($ar['jobtype'])."' where id='".$ar['projectid']."'";
		$this->mysql->query($sql);	  		
	}
		
	function getAllBids($pid)
	{
		$sql="select *,UNIX_TIMESTAMP(bid_time) as bid_time from projects_bids where projectid='".$pid."'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}	
		
	function addfile($filename,$filetype,$filesize,$content,$projectid)
	{
	$sql = "INSERT INTO filemanager (name,type,size,content,project_id) ".
"VALUES ('".$this->mysql->magicquotes($filename)."', '$filetype', '$filesize', '".addslashes($content)."','$projectid')";
	$this->mysql->queryinsert($sql,"filemanager");
	}	
		
	function delete_project($id)
		{
		$sql = "delete from `projects` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}
		
	function listprojects()
	{
		$sql = "select * from `projects`";
		$result=$this->mysql->getdata($sql);
		return $result;
	}	
	
	function adddescription($description,$pid)
	{
		$sql="update projects set description='".$description."' where id='".$pid."'";
		$this->mysql->query($sql);
	}
	
	function listfiles($pid)
	{
		$sql = "select * from `filemanager` where project_id='".$pid."'";
		$result=$this->mysql->getdata($sql);
		$str="";
		if(is_array($result))
		{
			foreach($result as $data)
			{
		//		print_r($data);
					echo "<a href='download.php?id=".$data['id']."'>".$data['name']."</a><br>";
			}
		}		
		return $str;
	}
	
	function hasfiles($pid)
	{
		$sql = "select * from `filemanager` where project_id='".$pid."'";
		$result=$this->mysql->queryrow($sql);
		return is_array($result);
	}
	
	function editfiles($pid)
	{
		$sql = "select * from `filemanager` where project_id='".$pid."'";
		$result=$this->mysql->getdata($sql);
		$str="";
		$i=1;
		if(is_array($result))
		{
			foreach($result as $data)
			{
		//		print_r($data);
					echo "<div id='files".$i."'>".$i.".  <a href='download.php?id=".$data['id']."'>".$data['name']."</a>  
					<a href=\"javascript:;\" onclick=\"loadAjax('/ajax/project/removefile.php?fileid=".$data['id']."','files".$i."');\">Remove this File</a></div>";
					$i++;
			}
		}		
		return $str;
	}
	
	
	function removefiles($id)
	{
		$sql = "delete from `filemanager` where id='".$id."'";
		$result=$this->mysql->query($sql);
	}
	
		
	function ishidden($pid)
	{
		$sql = "select * from `projects` where id='".$pid."' and hidden='yes'";
		$result=$this->mysql->queryrow($sql);
		return is_array($result);
	}
		
	function disposefile($id)
	{
		$sql = "select * from `filemanager` where id='".$id."'";
		$result=$this->mysql->queryrow($sql);
		return $result;
	}
	
	function getDaysLeft($pid)
	{
		$sql = "SELECT DATEDIFF(expiry_date, CURDATE()) AS d FROM projects where id='".$pid."'";
		$result=$this->mysql->queryrow($sql);
		return $result['d'];	
	}
	
	function getDaysLeftText($pid)
	{
		$sql = "SELECT *,DATEDIFF(expiry_date, CURDATE()) AS d FROM projects where id='".$pid."'";
		$result=$this->mysql->queryrow($sql);
		$str="<font style='color:red;'>";
		if($result['d']>0)
		{
			$str.=$result['d']." days left ";
			if($result['type']=='frozen' || $result['type']=='cancelled')
			$str.="(Bidding Closed)";	
		}
		else
		{
			$str.="(Bidding Closed)";
		}	
		$str.="</font>";
		return $str;
	}
	
	function getstatus($pid)
	{
		//if($this->getDaysLeft($pid)>0)
//		return "open";
		
	//	else
	//	{
			$sql="SELECT * from projects where id='".$pid."'";
			$data=$this->mysql->queryrow($sql);
			return $data['type'];
	//	}		
	}
		
	function display_category()
		{
		$category = new maincategory;
		$data = $category->getcategory();
		if(!is_array($data)) return false;
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
		}
	
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

	function display_editsubcategory($subcat_id,$selected)
	{
		$category = new maincategory;
		$data = $category->getsubcategory($subcat_id);
		if(!is_array($data)) return false;
		echo '<select name="subcategory">';
		
		foreach($data as $row)
			{
			echo '<option value="'.$row['id'].'"';
			if($row['id']==$selected)
			echo "selected='selected'";
			echo '>'.$row['name']."</option>";
			}
		echo '</select>';
	}	
	
	function isReviewed($userid,$pid)
	{
		$sql="select * from user_review where userid='".$userid."' and projectid='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return is_array($data);	
	}
	
	function markReview($uid,$pid,$points,$details)
	{
		$sql="insert into user_review(userid,fromuserid,projectid,review,point) values('".$uid."','".$_SESSION['foongigs_userid']."','".$pid."','".$details."','".$points."')";
		$this->mysql->queryinsert($sql,"user_review");		
	}

	function display_projects($filter='all',$maincategoryid=2,$sub_maincategoryid=0,$start_recno=0,$no_of_rec=0,$order="order by created_time desc")
		{
		// $filter  = all / featured / private / hidden / 
		switch($filter)
			{
			case "featured": $filter = " and `featured`='yes'"; break;
			case "private": $filter = " and `private`='yes'"; break;
			case "hidden": $filter = " and `hidden`='yes'"; break;
			case "featured_private": $filter = " and `featured`='yes' or (featured='yes' and private='yes')"; break;
			default: $filter ="";
			}
		$sql = "select * from `projects` where `maincategory_id`='".$maincategoryid."' and DATEDIFF(expiry_date,CURDATE())>0 and `status`='active' and `type`='open' ".$filter;
		if($sub_maincategoryid!=0)
		$sql .= " and `sub_maincategory_id`='".$sub_maincategoryid."'";
			
		$sql .= " ".$order;
	
		if($no_of_rec!=0)
			$sql .= " limit ".$start_recno.",".$no_of_rec;
		//echo $sql;
		$projects = $this->mysql->getdata($sql);
		if(!is_array($projects))
			{
			echo "No Open Project(s) !";
			return false;
			}
		
			//print_r($list);
			echo '
	<table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#EEEEEE" class="sub_categories">
    <tr>
      <td><table width="100%" align="center" cellpadding="1" cellspacing="1">
          <tr bgcolor="#dedede" height="25">
            <td align="center">Project Name</td>
            <td align="center">Bids</td>
            <td align="center">Avg Bid</td>
            <td align="center">Job Type</td>
            <td align="center">Started</td>
            <td align="center">End</td>
          </tr>';
		  foreach($projects as $list)
			{
			$color=($color=="EEEEEE")?"E0E0E0":"EEEEEE";
			echo '
          <tr bgcolor="#'.$color.'" height="25">
            <td align="center"><a href="projects.php?id='.$list['id'].'">'.$list['project_title'].'</a> ';
			
			if($list['featured']=="yes")
			echo "[F]";
			
			if($list['private']=="yes")
			echo "[P]";
			
			if($list['hidden']=="yes")
			echo "[H]";
			echo '</td>
            <td align="center">'.$this->countbid($list['id']).'</td>
            <td align="center">';
			if($list['hidden']=="yes")
			echo "N/A";
			else
			echo $this->getaveragegbid($list['id']);
			echo '</td>
            <td align="center">'.$list['jobtype'].'</td>
            <td align="center">'.$this->shortDateFormat($list['created_time']).'</td>
			<td align="center">'.$this->shortDateFormat($list['expiry_date']).'</td>
          </tr>
        
';
			} 
			echo '</table></td>
 		   	</tr>
			</table>';
			return true;
		}
		
	function countbid($pid)
	{
		$sql = "select count(*) as cnt from `projects_bids` where `projectid`='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['cnt'];
	}	
	
	function countmessage($pid)
	{
		$sql = "select count(*) as cnt from `projects_message` where `projectid`='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['cnt'];
	}
	
	function getMessages($pid)
	{
		$sql = "select *,UNIX_TIMESTAMP(postedtime) as postedtime from `projects_message` where `projectid`='".$pid."'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function postmessage($ar)
	{
		$objuser=new user;
		if($ar['private']!="")
		$touserid=$objuser->getUserIdFromUserName($ar['private']);
		else
		$touserid="";
		
		$sql = "insert into projects_message(projectid,message,fromuserid,touserid) 
				values ('".$ar['projectid']."','".$this->mysql->magicquotes($ar['details'])."','".$_SESSION['foongigs_userid']."','".$touserid."')";
		$data=$this->mysql->queryinsert($sql,"projects_message");
		return $data;
		
	}
	
	
	function getaveragegbid($pid)
	{
		$sql = "select sum(amount) as total, count(*) as cnt, sum(amount)/count(*) as average from `projects_bids` where `projectid`='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		if($data['cnt']!=0)
		return "$".$data['average'];
		else
		return "$0";
	}
	
	function longDateFormat($d)
		{
		$str=date("jS M Y",strtotime($d)); 
		return $str; 
		}
	function shortDateFormat($d)
		{
		$str=date("jS M Y",strtotime($d)); 
		return $str; 
		}
		
	function getdetails($pid)
	{
		$sql = "select * from `projects` where `id`='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data;
	}
	
	function is_private($pid)
	{
		$sql = "select * from `projects` where `id`='".$pid."' and private='yes'";
		$data=$this->mysql->queryrow($sql);
		return is_array($data);
	}
	
	function isuserinvited($pid,$uid)
	{
		$sql = "select * from `project_invitelist` where `projectid`='".$pid."' and userid='".$uid."'";
		$data=$this->mysql->queryrow($sql);
		return is_array($data);
	}
	
	
	function placebid($ar)
	{
		if($_POST['notification']=="on")
		$notification="yes";
		else
		$notification="no";
	
		$sql="select count(*) as cnt from projects_bids where projectid='".$ar['projectid']."' and userid='".$_SESSION['foongigs_userid']."'";
		$check=$this->mysql->queryrow($sql);

		if($check['cnt']>0)
		{
			$sql="update projects_bids set comment='".$ar['details']."',days='".$ar['days']."',amount='".$ar['bidamount']."',notification='".$notification."' where projectid='".$ar['projectid']."' and userid='".$_SESSION['foongigs_userid']."'";
		$this->mysql->query($sql);	
		return "Update";
		}
		else
		{
		$sql="insert into projects_bids(projectid,userid,comment,days,amount,notification)
			values
			('".$ar['projectid']."','".$_SESSION['foongigs_userid']."','".$ar['details']."','".$ar['days']."','".$ar['bidamount']."','".$notification."')";
		$this->mysql->queryinsert($sql,"projects_bids");	
		return "Add";
		}
	}
		
	function numOfProjectByCat($categoryid)
		{
		$sql = "select count(*) as cnt from `projects` where `maincategory_id`='".$categoryid."' group by `maincategory_id`";
		$cnt = $this->mysql->queryrow($sql);
		if($cnt['cnt'] <= 0 )
			return 0;
		return $cnt['cnt'];
		}
	function numOfProjectBySubCat($categoryid)
		{
		$sql = "select count(*) as cnt from `projects` where `sub_maincategory_id`='".$categoryid."' and DATEDIFF(expiry_date,CURDATE())>0 and status='active' and type='open' group by `maincategory_id`";
		$cnt = $this->mysql->queryrow($sql);
		if($cnt['cnt'] <= 0 )
			return 0;
		return $cnt['cnt'];
		}
	function get_subcategory()
		{
		$sql = "select * from `category`  group by `id`";
		$cnt = $this->mysql->getdata($sql);
		return $cnt;
		}
	function getProjects()
		{
		$sql = "select *,DATEDIFF(expiry_date, created_time) as diff_days from `projects`  order by created_time DESC";
		$cnt = $this->mysql->getdata($sql);
		return $cnt;
		}
		
	function active_project($id)
		{
				
					$status="active";
					$sql = "update projects set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
		
	function block_project($id)
		{
				
					$status="block";
					$sql = "update projects set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
	
	function getOpenProjectList()
	{
		$sql="select *,UNIX_TIMESTAMP(created_time) as created_time from projects where DATEDIFF(expiry_date,CURDATE())>0 and userid='".$_SESSION['foongigs_userid']."' and (type='open' or type='frozen') and provider_confirm='no'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function getAllProjectList()
	{
		$sql="select *,UNIX_TIMESTAMP(created_time) as created_time from projects where userid='".$_SESSION['foongigs_userid']."'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function getBiddedProjectList()
	{
		$sql="select *,UNIX_TIMESTAMP(projects_bids.bid_time) as bid_time,UNIX_TIMESTAMP(projects.created_time) as created_time from projects_bids,projects where projects.id=projects_bids.projectid and DATEDIFF(projects.expiry_date,CURDATE())>0 and projects_bids.userid='".$_SESSION['foongigs_userid']."' and projects.provider_confirm='no'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function getRunningProjects($type,$records='all')
	{
		
	if($type=="provider")
		$filter=" projects.selected_userid = users.id AND ";
		else
		$filter=" projects.userid = users.id AND ";
		
			$sql="SELECT projects. *
				FROM projects, users
				WHERE ".$filter."
				 projects.provider_confirm = 'yes'
				
				AND users.id = '".$_SESSION['foongigs_userid']."'
				AND projects.id NOT
				IN (
				
				SELECT projects.id AS pid
				FROM projects, user_review, users
				WHERE projects.id = user_review.projectid
				AND users.id = user_review.fromuserid
				AND user_review.fromuserid = '".$_SESSION['foongigs_userid']."'
				)";

			if($records=="recent")
			$sql.=" LIMIT 0,10";		
	
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function rejectInvitation($pid)
	{
		$sql="update projects set provider_confirm='no', selected_userid='0' where id='".$pid."'";
		$this->mysql->query($sql);
	}
	
	function acceptInvitation($pid)
	{
		$st=date("Y-m-d H:i:s",time());
		$sql="update projects set provider_confirm='yes', type='closed', started_time='".$st."' where id='".$pid."'";
		$this->mysql->query($sql);
	}
	
	function getBidRank($pid)
	{
		$sql="select * from projects_bids where projectid='".$pid."' order by amount ASC";
		$result=$this->mysql->getdata($sql);
		$max=0;
		$i=1;
		foreach($result as $data)
		{
			if($data['amount']>$max)
			{
			$max=$data['amount'];
			$rank=$i;
			}
		$i++;	
		}
		return $rank;
	}
	
	function removeBid($pid)
	{
		$sql="delete from projects_bids where projectid='".$pid."' and userid='".$_SESSION['foongigs_userid']."'";
		$result=$this->mysql->query($sql);
	}
	
	function cancelProject($pid)
	{
		$sql="update projects set type='cancelled' where id='".$pid."' and userid='".$_SESSION['foongigs_userid']."'";
		$result=$this->mysql->query($sql);
	}
	
	
	function getSelectedProvider($pid)
	{
		$sql="select * from projects where id='".$pid."'";
		$result=$this->mysql->queryrow($sql);
		return $result['selected_userid'];
	}
	
	function displayProviderList($pid)
	{
		$sql="select * from projects_bids where projectid='".$pid."'";
		$result=$this->mysql->getdata($sql);
		$objuser= new user;
		
		$providerid=$this->getSelectedProvider($pid);
		
		if(is_array($result))
		{
			$str='<select name="provider" id="provider_'.$pid.'">';
			
			foreach ($result as $data)
			{
				$str.= '<option value="'.$data['userid'].'"';
				if($data['userid']==$providerid)
				$str.="selected='selected'";
				$str.='>'.$objuser->getUserNameFromUserId($data['userid']).'</option>';
			}
			$str.='</select>';
			
			if($providerid==0) 
			$str.="<input type=\"button\" value=\"Confirm\" onclick=\"selectprovider('".$pid."');\">";
			else
			{
			$str.="<input type=\"button\" value=\"Waiting for provider\" disabled='disabled'>";
			$str.="<input type=\"button\" value=\"Cancel Provider\" onclick=\"cancelprovider('".$pid."');\" >";
			}
		}
		else
		$str="No Bids Placed";
		return $str;
	}
	
	function selectProvider($projectid,$providerid)
	{
		$sql="update projects set selected_userid='".$providerid."', type='frozen' where id='".$projectid."'";
		$result=$this->mysql->query($sql);
	}
	
	function cancelProvider($projectid)
	{
		$sql="update projects set selected_userid='', type='Open' where id='".$projectid."'";
		$result=$this->mysql->query($sql);
	}
	
	function getduration($pid)
	{
		$sql="SELECT DATEDIFF( expiry_date, created_time ) AS d
				FROM projects
				WHERE id = '".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['d'];
	}
	function fuzzyTime($time)
		{
			define("ONE_DAY",86400);
		
			$now = time();
			// sod = start of day :)
			$sod = mktime(0,0,0,date("m",$time),date("d",$time),date("Y",$time));
			$sod_now = mktime(0,0,0,date("m",$now),date("d",$now),date("Y",$now));
			
			// check 'today'
			if ($sod_now == $sod)
			{
				return "Today at " . date("g:ia",$time);
			}
			// check 'yesterday'
			if (($sod_now-$sod) <= 86400)
			{
				return "Yesterday at " . date("g:ia",$time);
			}
			// give a day name if within the last 5 days
			if (($sod_now-$sod) <= (ONE_DAY*5))
			{
				return date("l \a\\t g:ia",$time);
			}
			// miss off the year if it's this year
			if (date("Y",$now) == date("Y",$time))
			{
				return date("F j,Y \a\\t g:ia",$time);
			}
			// return the date as normal
			return date("M j, Y \a\\t g:ia",$time);
		} 
		
		function markProjectExpired()
		{
			$sql = "UPDATE projects set type='closed' where DATEDIFF(expiry_date, CURDATE())<0";
			$this->mysql->query($sql);
		}
		
	}
?>