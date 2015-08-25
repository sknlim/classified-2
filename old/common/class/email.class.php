<?php
class email
{
	var $to;
	var $from;
	var $subject;
	var $body;
	var $identifier;
	
	var $error;
	
	function email()
	{
		$this->to="";
		$this->from="";
		$this->subject="";
		$this->body="";
		$this->identifier="";
	}

	function sendMail($to,$from,$subject,$body,$identifier)
	{
		if (strtoupper(substr(PHP_OS,0,3)=='WIN')) 
		{
		  $eol="\r\n";
		} 
		elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) 
		{
		  $eol="\r";
		} 
		else 
		{
		  $eol="\n";
		} 
	
		foreach ($identifier as $key => $value )
		{
		$body=str_replace("%".$key."%", "$value", "$str");
		}		
		
	$headers .= 'From: '.$from['name'].' <'.$from['email'].'>'.$eol;
	$headers .= 'Reply-To: '.$to['name'].' <'.$to['email'].'>'.$eol;
	$headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
	$headers .= "X-Mailer: PHP v".phpversion().$eol;           // These two to help avoid spam-filters
	$headers.= "Content-Type: text/html; charset=ISO-8859-1 ".$eol;
	$headers .= "MIME-Version: 1.0 ".$eol;; 
	ini_set(sendmail_from,$from['email']);  // the INI lines are to force the From Address to be used !

	if(!mail($to['email'], $subject, $body, $headers))
		{		
		$this->error="Error Email Sending "; 
		exit();
		}
	ini_restore(sendmail_from);	

}

function forgetmail($to,$subject,$data,$filename,$from)
{
		if (strtoupper(substr(PHP_OS,0,3)=='WIN')) 
		{
		  $eol="\r\n";
		} 
		elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) 
		{
		  $eol="\r";
		} 
		else 
		{
		  $eol="\n";
		} 
	//$filename = "email/signup.tpl";
	if(!file_exists($filename))
		{
		echo "Error Loading file";
		exit();
		}
	$str="";
	$str=file_get_contents($filename);
	
	foreach ($data as $key => $value )
		{
		$str=str_replace("%".$key."%", "$value", "$str");
		}		
		
	$headers .= 'From: '.$from['name'].' <'.$from['email'].'>'.$eol;
	$headers .= 'Reply-To: '.$to['name'].' <'.$to['email'].'>'.$eol;
	$headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
	$headers .= "X-Mailer: PHP v".phpversion().$eol;           // These two to help avoid spam-filters
	$headers.= "Content-Type: text/html; charset=ISO-8859-1 ".$eol;
	$headers .= "MIME-Version: 1.0 ".$eol;; 
	ini_set(sendmail_from,$from['email']);  // the INI lines are to force the From Address to be used !

	if(!mail($to['email'], $subject, $str, $headers))
		{		
		echo "Error Email Sending "; 
		exit();
		}
	ini_restore(sendmail_from);	

}

}
?>