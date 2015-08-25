<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php"; 

class projectaccount extends project
{
	var $mysql;
	function projectaccount()
	{
		$this->mysql= new mysql;
	}
	
	function getBiddedProjectList()
	{
		$sql="select *,UNIX_TIMESTAMP(projects_bids.bid_time) as bid_time,UNIX_TIMESTAMP(projects.created_time) as created_time from projects_bids,projects where projects.id=projects_bids.projectid and DATEDIFF(projects.expiry_date,CURDATE())>0 and projects_bids.userid='".$_SESSION['foongigs_userid']."'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function getOpenProjectList()
	{
		$sql="select *,UNIX_TIMESTAMP(created_time) as created_time from projects where DATEDIFF(expiry_date,CURDATE())>0 and userid='".$_SESSION['foongigs_userid']."' and (type='open' or type='frozen')";
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function getAllProjectList()
	{
		$sql="select *,UNIX_TIMESTAMP(created_time) as created_time from projects where userid='".$_SESSION['foongigs_userid']."'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}
	
	function getJobList()
	{
		$sql="select * from jobs where userid='".$_SESSION['foongigs_userid']."'";
		$data=$this->mysql->getdata($sql);
		return $data;
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
	
	function getStatus($pid)
	{
		$sql="select * from projects where id='".$pid."'";
		$result=$this->mysql->queryrow($sql);
		return $result['type'];
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
			
			if($this->getStatus($pid)=="open") 
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
	
}

?>