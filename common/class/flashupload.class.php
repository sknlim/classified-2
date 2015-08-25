<?php
class flashUpload
	{
	var $name;
	public $redirectLink;
	public $uploadPath;
	public $vldnoblank;
	public $filetypes;
	public $filetypedesc;
	public $maxfilesize;
	function flashUpload($name="flashUpload")
		{
		$this->name=$name;
		$this->vldnoblank="true"; // Default Required Field
		$this->filetypes=""; // Default All Extensions
		$this->filetypedesc="All files"; // Default All Files
		$this->maxfilesize=400*1024*1024; // Default 4MB
		}
	function writeCode()
		{
		switch($this->filetypedesc)
			{
			case "All files":
				$this->filetypes="";
			break;
			case "Image files":
				$this->filetypes="*.jpg;*.jpeg;*.gif;*.png";
			break;
			case "Video files":
				$this->filetypes="*.mpg;*.mpeg;*.mp4;*.avi;*.mov;*.wmv;*.flv;*.3gp";
			break;
			case "Document files":
				$this->filetypes="*.doc;*.docx;*.pdf";
			break;
			default:
			break;
			}

		echo '<embed src="swf/fileUpload.swf" width="300" height="25" menu="false" quality="high" 
  type="application/x-shockwave-flash" pluginspage=
  "http://www.macromedia.com/go/getflashplayer" flashvars="redirectLink='.urlencode($this->redirectLink).'&uploadPath='.urlencode($this->uploadPath).'&sid='.session_id().'&vldnoblank='.$this->vldnoblank.'&filetypes='.urlencode($this->filetypes).'&filetypedesc='.urlencode($this->filetypedesc).'&maxfilesize='.$this->maxfilesize.'" name="'.$this->name.'" wmode="transparent" />';
		}
	}
?>