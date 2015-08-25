<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 

class jobs
	{
	var $mysql;
	function jobs()
		{
		$this->mysql = new mysql;
		}
	
	function add($ar)
		{
		 $sql = "insert into jobs(title,company,company_url,description,
		 contact,userid,maincategory_id,sub_maincategory_id,
		 category,currency_id,salary_basis,salary_minimum,salary_maximum,jobtype) values 
		 ('".$this->mysql->magicquotes($ar['requiredfor'])."','".$this->mysql->magicquotes($ar['company'])."',
		 '".$this->mysql->magicquotes($ar['companyurl'])."','".$this->mysql->magicquotes($ar['jobdescription'])."',
		 '".$this->mysql->magicquotes($ar['jobcontactinfo'])."','".$_SESSION['foongigs_userid']."',
		 '1','".$ar['state']."','".$ar['category']."','".$ar['salary_currency']."','".$ar['salary_basis']."','".$ar['salary_min']."','".$ar['salary_max']."','".$ar['jobtype']."')";
		$jobid = $this->mysql->queryinsert($sql,"jobs");
	
			/*foreach ($ar['jobtype'] as $data)
			{
				if(trim($data)!="")
				{
				$sql = "insert into jobs_listing(jobs_id,jobs_type_id) values (".$jobid.",".$data.")";
				$this->mysql->queryinsert($sql,"jobs_listing");
				}

			}*/
			
				
		}
	
	function update($ar)
		{
		 $sql = "update jobs set title='".$this->mysql->magicquotes($ar['requiredfor'])."',
		 company='".$this->mysql->magicquotes($ar['company'])."',
		 company_url='".$this->mysql->magicquotes($ar['companyurl'])."',
		 description='".$this->mysql->magicquotes($ar['jobdescription'])."',
		 contact='".$this->mysql->magicquotes($ar['jobcontactinfo'])."',
		 sub_maincategory_id='".$ar['state']."',category='".$ar['category']."',
		 currency_id='".$ar['salary_currency']."',salary_basis='".$ar['salary_basis']."',
		 salary_minimum='".$ar['salary_min']."',salary_maximum='".$ar['salary_max']."',
		 jobtype='".$ar['jobtype']."' where id='".$ar['jobid']."'";
		 $this->mysql->query($sql);
	
			/*foreach ($ar['jobtype'] as $data)
			{
				if(trim($data)!="")
				{
				$sql = "insert into jobs_listing(jobs_id,jobs_type_id) values (".$jobid.",".$data.")";
				$this->mysql->queryinsert($sql,"jobs_listing");
				}

			}*/
			
				
		}
	
	function getstatelist()
		{
		$sql = "select * from sub_maincategory where category_id='1' order by name";
		$category = $this->mysql->getdata($sql);
		return $category;		
		}
		
	
	function delete_job($id)
		{
		$sql = "delete from `jobs` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}
	
	
	function getalljobtypes()
		{
		$sql = "select * from `jobs_type` order by `name`";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
	
	function get_all_jobs()
		{
		$sql = "select * from `jobs` where DATEDIFF( CURDATE(), posted_time) < 31 and status='active' order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
	
	function get_all_jobs_by_userid($uid)
	{
		$sql = "select * from `jobs` where userid='".$uid."' order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
	}
	
	function get_job_by_id($id)
		{
		$sql = "select * from `jobs` where id='".$id."' ";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}	
		
	function get_open_jobs()
		{
		$sql = "select * from `jobs` where userid='".$_SESSION['foongigs_userid']."' and DATEDIFF( CURDATE(), posted_time) < 31 and (status='active' or status='block') order by `id` DESC";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
		
	function approve_job($id)
		{
					
					$status="active";
					$sql = "update jobs set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
		
	function block_job($id)
		{
				
					$status="block";
					$sql = "update jobs set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
	
	
	
	function suspend_job($id)
		{
				
					$status="suspended";
					$sql = "update jobs set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
	
	function action($status,$jid)
	{
			$sql = "update jobs set status='".$status."' where id='".$jid."'";
			$result=$this->mysql->query($sql);
					
	}
	
	function adddescription($description,$jid)
	{
		$sql="update jobs set description='".$description."' where id='".$jid."'";
		$this->mysql->query($sql);
	}

	function numofjobsbysubCat($catid)
		{
		$sql = "select * from `jobs` where sub_maincategory_id='".$catid."' and DATEDIFF( CURDATE(), posted_time) < 31 and status='active'";
		$data = $this->mysql->getdata($sql);
		$num = $this->mysql->num;
		return $num;
		}
	function display_jobs($maincategoryid=2,$sub_maincategoryid=0,$start_recno=0,$no_of_rec=0,$order="order by posted_time desc")
		{
		
		if($sub_maincategoryid==0)
			$filter_sub ="";
		else
			$filter_sub = " and sub_maincategory_id='".$sub_maincategoryid."'";
			
		$sql = "select * from `jobs` where maincategory_id='".$maincategoryid."' ".$filter_sub." and DATEDIFF( CURDATE(), posted_time) < 31 and status='active' ".$order;
	//	echo $sql;
		$data = $this->mysql->getdata($sql);
		if(is_array($data))
			{
			echo '<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
					<tr bgcolor="#cccccc">
						<td class="grey" align="center">Title</td>
						<td class="grey" align="center">Company</td>
						<td class="grey" align="center">Date</td>
					</tr>';
				foreach($data as $group_details)
					{
					$color=($color=="EEEEEE")?"E0E0E0":"EEEEEE";
					echo "<tr align='center' bgcolor='#".$color."'>		
					<td><a href='job_view.php?id=".$group_details['id']."'>".$group_details['title']."</a></td>
					<td>".$group_details['company']."</td>
					<td>".$group_details['posted_time']."</td>
				";		
				}
			echo '</table>';
			return true;
			}
		else
			{
			echo "No Job(s) Posted Yet!";
			return false;			
			}

		}
	
		
	function getDaysLeft($jid)
	{
	$sql = "select DATEDIFF( CURDATE(), posted_time) as d from jobs where id='".$jid."'";
	$result=$this->mysql->queryrow($sql);
	return $result['d'];	
	}
	
	
	function getstatus($jid)
	{
		$sql = "select DATEDIFF( CURDATE(), posted_time) as d from jobs where id='".$jid."'";
		$result=$this->mysql->queryrow($sql);
		
		if($result['d']>30)
		$status='<font style="color:red;">Expired</font>';
		else
		{
			$sql="SELECT * from jobs where id='".$jid."'";
			$data=$this->mysql->queryrow($sql);
			
			switch($data['status'])
			{
				case "active":
				$status='<font style="color:green;">Active</font>';
				break;
				
				case "block":
				$status='<font style="color:red;">Block</font>';
				break;
				
				case "suspended":
				$status='<font style="color:blue;">Suspended</font>';
				break;
			}
			
		}		
	return $status;		
	}	
	
	function getoption($jid)
	{
		$sql = "select DATEDIFF( CURDATE(), posted_time) as d from jobs where id='".$jid."'";
		$result=$this->mysql->queryrow($sql);
		
		if($result['d']>30)
		$status='<font style="color:red;">No Option</font>';
		else
		{
			$sql="SELECT * from jobs where id='".$jid."'";
			$data=$this->mysql->queryrow($sql);
			
			switch($data['status'])
			{
				case "active":
				$status="<a href='javascript:;'  onclick=\"loadPage('/ajax/jobs/blockjob.php?jid=".$jid."&action=block');\">Block</a>";
				break;
				
				case "block":
				$status="<a href='javascript:;'  onclick=\"loadPage('/ajax/jobs/blockjob.php?jid=".$jid."&action=active');\">Active</a>";
				break;
				
				case "suspended":
				$status='<font style="color:blue;">Suspended</font>';
				break;
			}
			
		}		
	return $status;		
	}	
		
	}
	
	
	
?>