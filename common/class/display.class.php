<?php
require_once "config.class.php";  
class box
{
var $getDomainPath;
var $color;
var $heading;
function box()
{
	$objconfig=new config;
	$this->getDomainPath=$objconfig->get_domain_path();	
	$this->color="";
	$this->heading="";
}
function boxTop()
	{
		$str ='<div';
		if(!($this->color=="")) $str .=' style="border: 1px solid '.$this->color.';"';
		$str .='><div class="upperBox"><span> '.$this->heading.' </span></div>';
		return $str;
	}
function setColor($getColor)
	{
		$this->color=$getColor;
	}
function setHeading($getHeading)
	{
		$this->heading=$getHeading;
	}
function boxBottom()
	{
		return $str = "</div>";
	}

}

class roundedBox
{
var $getDomainPath;
var $color;
var $heading;
function roundedBox()
{
	$objconfig=new config;
	$this->getDomainPath=$objconfig->get_domain_path();	
	$this->color="";
	$this->heading="";
}
function roundedBoxTop()
	{
		$str ='<div';
		if(!($this->color=="")) $str .=' style="border: 1px solid '.$this->color.';"';
		$str .='><div class="upperBox"><span> '.$this->heading.' </span></div>';
		return $str;
	}
function setColor($getColor)
	{
		$this->color=$getColor;
	}
function setHeading($getHeading)
	{
		$this->heading=$getHeading;
	}
function roundedBoxBottom()
	{
		return $str = "</div>";
	}

}


?>
