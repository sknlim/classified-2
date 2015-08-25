<?php
class seo
	{
	
	function get_seo_url($uniqueurl)
		{
		for($i=0;$i<strlen($uniqueurl); $i++)
			{
			if($uniqueurl[$i] >= 'A' && $uniqueurl[$i] <= 'Z')
				$mystr .= $uniqueurl[$i];
			else if($uniqueurl[$i] >= 'a' && $uniqueurl[$i] <= 'z')
				$mystr .= $uniqueurl[$i];
			if($uniqueurl[$i] >= '0' && $uniqueurl[$i] <= '9')
				$mystr .= $uniqueurl[$i];
			else if($uniqueurl[$i]==" ")
				$mystr .= $uniqueurl[$i];
			else if($uniqueurl[$i]==",")
				$mystr .= " ";
			else if($uniqueurl[$i]=="-")
				$mystr .= " ";
			}
		$mystr = str_replace(" ","_",trim($mystr));
		$mystr = str_replace("____","_",$mystr);	 
		$mystr = str_replace("___","_",$mystr);	 
		$mystr = str_replace("__","_",$mystr);
		return $mystr;
		}
	}
	