<?php
require_once "mysql.class.php";
require_once "config.class.php";

class common extends mysql
{
		function getCountryList()
		{
		$sql="select * from user_country ";
		$array = $this->getdata($sql);
		return $array;
		}
		
		function getcountrybyid($cid)
		{
		$sql="select * from user_country where countryid='".$cid."'";
		$array = $this->queryrow($sql);
		return $array['country'];
		}
		
		function formatTimeAgo($timestamp)
		{
			$now = time();
			//If the difference is positive "ago" - negative "away"
			($timestamp >= $now) ? $action = 'away' : $action = 'ago';
	
			switch($action) {
			case 'away':
					$diff = $timestamp - $now;
					break;
			case 'ago':
			default:
					// Determine the difference, between the time now and the timestamp
					$diff = $now - $timestamp;
					break;
			}

			// Set the periods of time
			$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	
			// Set the number of seconds per period
			$lengths = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
	
			// Go from decades backwards to seconds
			for ($val = sizeof($lengths) - 1; ($val >= 0) && (($number = $diff / $lengths[$val]) <= 1); $val--);
	
			// Ensure the script has found a match
			if ($val < 0) $val = 0;
	
			// Determine the minor value, to recurse through
			$new_time = $now - ($diff % $lengths[$val]);
	
			// Set the current value to be floored
			$number = floor($number);
	
			// If required create a plural
			if($number != 1) $periods[$val].= "s";
	
			// Return text
			$text = sprintf("%d %s ", $number, $periods[$val]);
			return $text . $action;
		}

		function getConfigValue($cname)
		{
		$sql="select * from configuration where variable='".$cname."'";
		$array = $this->queryrow($sql);
		return $array['value'];
		}
		
		function getTemplateFormat($tname)
		{
		$sql="select * from templates where tplformat='".$tname."'";
		$array = $this->getdata($sql);
		return $array['tplformat'];
		}
		
		function uniqueid()
		{
		$str=time().rand(10,99);
		return $str;
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
	
		function checkReferrer($checkstr)
		{
			$objconfig=new config;
			if($_SERVER['HTTP_REFERER']==$objconfig->get_domain_path().$checkstr)
			return true;
			else
			return false;
		}
	
		function getCurrentTimestamp()
		{
			$str= date("Y-m-d H:i:s",time());
			return $str;
		}
		
		function getCurrentDate()
		{
			$str= date("Y-m-d",time());
			return $str;
		}
		
		function wordseparator($str,$len)
		{
			$arword=explode(" ",$str);
			
			foreach ($arword as $w)
			{
				if (strlen($w)>=$len)
				{
				$arnew[]=substr($w,0,$len);
				}
				else
				{
				$arnew[]=$w;
				}
			}
			$stnew = implode(" ", $arnew);
			return $stnew;
		}


		function magicquotes($text)
		{
			if (!get_magic_quotes_gpc()) 
			{
			   $text = addslashes($text);
			}    
			return $text;
		}

		function dateDiff($dformat, $endDate, $beginDate)
		{
			$date_parts1=explode($dformat, $beginDate);
			$date_parts2=explode($dformat, $endDate);
			$start_date=gregoriantojd($date_parts1[1], $date_parts1[0], $date_parts1[2]);
			$end_date=gregoriantojd($date_parts2[1], $date_parts2[0], $date_parts2[2]);
			return $end_date - $start_date;
		}

		function formattext($str)
		{
			$str=str_replace("\n","<br>",$str);
			return $str;
		}

		function returnformattext($str)
		{
			$str=str_replace("<br>","\n",$str);
			return $str;
		}

		function validatedate($d , $m , $y )
		{
		$months = array(1=>"January","February" ,"March" , "April" , "May" , "June" , "July" , "August" , "September" , "October" , "November" , "December");
			if ( (($y % 4) == 0) && ($m == 2) && ($d > 29) )
			$message="0";
			else if ( (($y % 4) > 0) && ($m == 2) && ($d > 28) )
			$message="0";
			else if( (($m == 4) || ($m == 6) || ($m == 9) || ($m == 11) ) && ($d == 31))
			$message="0";
			else
			$message="1";
			return $message;  
		}

		function wordcount($str) 
		{ 
			$str=str_replace("\n"," ",$str);	
		  	return count(explode(" ",$str));
		}  
}		
?>