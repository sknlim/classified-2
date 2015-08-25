<?php
require_once "config.class.php";
require_once "common.class.php";

class image
{
	var $imageQuality;
	var $path;
	var $error;
	var $height;
	var $width;
	var $size;
	var $originalfilename;
	var $fileext;
	var $filename;


	function image($path)
		{
		$this->error="";
		$this->path=$path;
		list($this->width,$this->height)=getimagesize($path);
		$this->size=filesize($path);
		$this->originalfilename = basename($path); //test.jpg
		}

	function createAndResize($destination,$width,$height,$quality)
		{
			if($this->width > $width || $this->height > $height)
				{
					$re = $this->resizeRatio($this->width,$this->height,$width,$height);
					switch(strtoupper($this->fileext))
					{
						case "JPG":	case "JPEG":
						$r=$this->jpg($destination,$re[0],$re[1],$quality);
						break;
						
						case "GIF":	
						$r=$this->gif($destination,$re[0],$re[1],$quality);
						break;
						
						case "PNG":
						$r=$this->png($destination,$re[0],$re[1],$quality);
						break;
					}
				}
			else
				{
					switch(strtoupper($this->fileext))
					{
						case "JPG":	case "JPEG":
						$r=$this->jpg($destination,$width,$height,$quality);
						break;
						
						case "GIF":	
						$r=$this->gif($destination,$width,$height,$quality);
						break;
						
						case "PNG":
						$r=$this->png($destination,$width,$height,$quality);
						break;
					}	
				}
				imagedestroy($r[0]);
		}


	function getImageWidth()
	{
	return $this->height;
	}
	
	function getImageHeight()
	{
	return $this->width;
	}	
	
	function getFileName()
		{
			$code = substr(md5(microtime()),0,6); // Always Unique File Name ....
			$this->filename =substr($this->originalfilename,0,3).$code; // Create Unique File....
			return $this->filename;
		}
	
	function getFileExtension()
		{
			$ext_array=explode(".",$this->originalfilename);
			$this->fileext=$ext_array[count($ext_array)-1];
			return $this->fileext;
		}
	
	function getOriginalFileName()
	{
		echo $this->originalFileName;
	}
	
	function deleteMe()
		{
			unlink($this->path);
		}
		
	function getAttributes()
		{
			$ar['error']=$this->error;
			$ar['height']=$this->height;
			$ar['width']=$this->width;
			$ar['path']=$this->path;
			$ar['domainpath']=$this->domainPath;
			$ar['fullpath']=$this->fullPath;
			$ar['uploaddir']=$this->uploadDir;
			$ar['imagequality']=$this->imageQuality;
			$ar['size']=$this->size;
			$ar['filename']=$this->filename;
			return $ar;
		}	
	
	function byteSize($bytes) 
		{
		$size = $bytes / 1024;
		if($size < 1024)
			{
			$size = number_format($size, 2);
			$size .= ' KB';
			}  
		else 
			{
			if($size / 1024 < 1024) 
				{
				$size = number_format($size / 1024, 2);
				$size .= ' MB';
				} 
			else if ($size / 1024 / 1024 < 1024)  
				{
				$size = number_format($size / 1024 / 1024, 2);
				$size .= ' GB';
					} 
			}
		return $size;
		} 
	
	function moveTo($destination)
	{
		copy($this->path, $destination);
		unlink($this->path);
	}
	
	function jpg($filename,$newwidth,$newhight,$quality)
		{
			$src = imagecreatefromjpeg($this->path);
			$tmp=imagecreatetruecolor($newwidth,$newhight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newhight,$this->width,$this->height);
			imagejpeg($tmp,$filename,$quality);
			$size = filesize($filename);
			$re = array();
			$re[] = $src;
			$re[] = $tmp;
			$re[] = $size;
			$re[] = $filename;
			return $re;
		}
	function gif($filename,$newwidth,$newhight,$quality)
		{
			$src = imagecreatefromgif($this->path);
			$tmp=imagecreatetruecolor($newwidth,$newhight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newhight,$this->width,$this->height);
			imagegif($tmp,$filename,$quality);
			$size = filesize($filename);
			$re = array();
			$re[] = $src;
			$re[] = $tmp;
			$re[] = $size;
			$re[] = $filename;
			return $re;
		}
	function png($filename,$newwidth,$newhight,$quality)
		{
			$src = imagecreatefrompng($this->path);
			$tmp=imagecreatetruecolor($newwidth,$newhight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newhight,$this->width,$this->height);
			imagepng($tmp,$filename,$quality);
			$size = filesize($filename);
			$re = array();
			$re[] = $src;
			$re[] = $tmp;
			$re[] = $size;
			$re[] = $filename;
			return $re;
		}
	
	function resizeRatio($width,$height,$resize_width,$resize_height)
		{
		$ratio = $width/$height;
		$ratioResizeTo = $resize_width/$resize_height;
	
		if($ratio > $ratioResizeTo)
			{
			$width = $resize_width;
			$height = $width/$ratio;
			}
		else
			{
			$height = $resize_height;
			$width = $height*$ratio;
			}
		
		$re = array();
		$re[] = $width;
		$re[] = $height;
		return $re;
		}

	function rotateImage($img,$type)// Image Path, ccw / cw And ''( Original File) 
	{
		if($type=="cw" || $type=="CW")
			$degrees= -90;
		else if($type=="ccw" || $type=="CCW")
			$degrees= 90;	
		else
			$degrees=0;	
		
		$newfile10=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";	
		$source = imagecreatefromjpeg($img);
		$white = imagecolorallocate($source,255,255,255);
		$rotate = imagerotate($source, $degrees, $white);
		imagejpeg($rotate,$newfile10,100);
		imagedestroy($rotate);
		
		return $newfile10;
	}

	function resizeTo($filename,$width,$height)
		{
		$dstfile=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";
			
		$convertcmd = $_SESSION['IMAGE_MAGICK_PATH']."convert ".$filename." -resize ".$width."x".$height."\> ".$dstfile;
		
	//	echo $convertcmd;
		exec($convertcmd);
			
		return $dstfile;
		}



//FLIP IMAGE
	function flip($img,$type) //Image Path, Type=( v/ h ) Vertical Flip, Horizontel Flip
		{
			if($type=="h" || $type=="H")
				$y=true;
			else
				$y=false;
					
			if($type=="v" || $type=="V")
				$x=true;
			else
				$x=false;
					
			$newfile9=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";	
			$img=imagecreatefromjpeg($img);	
		
			if($y)
				{
					$size_x = imagesx($img);
					$size_y = imagesy($img);
					$temp = imagecreatetruecolor($size_x, $size_y);
					imagecopyresampled($temp, $img, 0, 0, 0, ($size_y-1), $size_x, $size_y, $size_x, 0-$size_y);
					$img=$temp;
					imagejpeg($img,$newfile9,100);
					imagedestroy($img);
				}
			else if($x)	
				{
					$size_x = imagesx($img);
					$size_y = imagesy($img);
					$temp = imagecreatetruecolor($size_x, $size_y);
					imagecopyresampled($temp, $img, 0, 0, ($size_x-1), 0, $size_x, $size_y, 0-$size_x, $size_y);
					$img=$temp;
					imagejpeg($img,$newfile9,100);
					imagedestroy($img);
				
				}
			else
				{
					imagejpeg($img,$newfile9,100);
					imagedestroy($img);
				}
		
			return $newfile9;
		}

  //CROPPING IMAGE
  function Crop($gdimg, $left, $right, $top, $bottom) 
  	{
		$newfile1=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";
		$gdimg = imagecreatefromjpeg($gdimg);
		$oldW = imagesx($gdimg);
		$oldH = imagesy($gdimg);
		if (($left   > 0) && ($left   < 1)) { $left   = round($left   * $oldW); }
		if (($right  > 0) && ($right  < 1)) { $right  = round($right  * $oldW); }
		if (($top    > 0) && ($top    < 1)) { $top    = round($top    * $oldH); }
		if (($bottom > 0) && ($bottom < 1)) { $bottom = round($bottom * $oldH); }
		$right  = min($oldW - $left - 1, $right);
		$bottom = min($oldH - $top  - 1, $bottom);
		$newW = $oldW - $left - $right;
		$newH = $oldH - $top  - $bottom;

		if ($imgCropped = imagecreatetruecolor($newW, $newH)) {
			imagecopy($imgCropped, $gdimg, 0, 0, $left, $top, $newW, $newH);
			if ($gdimg = imagecreatetruecolor($newW, $newH)) {
				imagecopy($gdimg, $imgCropped, 0, 0, 0, 0, $newW, $newH);
				imagejpeg($imgCropped,$newfile1,100);
				imagedestroy($imgCropped);
				
			
			}
		}
		return $newfile1;
	}
//BRIGHTNESS IMAGE
	function Brightness($gdimg, $amount) 
		{
			$newfile2=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";	 
			
			if ($amount == 0)
				 {
				return true;
				 }
			$newfile2=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";	 
			$gdimg=imagecreatefromjpeg($gdimg);	 
			$amount = max(-255, min(255, $amount));
			$scaling = (255 - abs($amount)) / 255;
			$baseamount = (($amount > 0) ? $amount : 0);
			for ($x = 0; $x < imagesx($gdimg); $x++) 
				{
				for ($y = 0; $y < imagesy($gdimg); $y++) 
					{
					$OriginalPixel = imagecolorsforindex($gdimg, imagecolorat($gdimg, $x, $y));
					foreach ($OriginalPixel as $key => $value) 
						{
						$NewPixel[$key] = round($baseamount + ($OriginalPixel[$key] * $scaling));
						}
					$newColor = imagecolorallocate($gdimg, $NewPixel['red'], $NewPixel['green'], $NewPixel['blue']);
					imagesetpixel($gdimg, $x, $y, $newColor);
					}
				}
				imagejpeg($gdimg,$newfile2,100);
				imagedestroy($gdimg);  
		
		
		/* $convertcmd = $_SESSION['IMAGE_MAGICK_PATH']."convert ".$gdimg." mogirfy -modulate ".((100)+($amount))." ".$newfile2;
		exec($convertcmd); */
		//echo "++--".$newfile2."--++";
			return ($newfile2);
		}	
	
	//CONTRAST IMAGE
	function Contrast($gdimg, $amount) 
		{
			$newfile3=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";
			$gdimg = imagecreatefromjpeg($gdimg);
			$amount = max(-255, min(255, $amount));
		
			if ($amount > 0) {
				$scaling = 1 + ($amount / 255);
			} else {
				$scaling = (255 - abs($amount)) / 255;
			}
			for ($x = 0; $x < imagesx($gdimg); $x++) {
				for ($y = 0; $y < imagesy($gdimg); $y++) {
					$OriginalPixel = imagecolorsforindex($gdimg, imagecolorat($gdimg, $x, $y));
		
				foreach ($OriginalPixel as $key => $value) 
					{
						$NewPixel[$key] = min(255, max(0, round($OriginalPixel[$key] * $scaling)));
					}
					$newColor = imagecolorallocate($gdimg, $NewPixel['red'], $NewPixel['green'], $NewPixel['blue']);
					imagesetpixel($gdimg, $x, $y, $newColor);
				}
			}
				imagejpeg($gdimg,$newfile3,100);
				imagedestroy($gdimg); 
				
				return $newfile3;
		
		}	
	//COLOR IMAGE
	function Color($gdimg,  $red, $green, $blue) 
		{		
				$newfile4=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";
		/*		$gdimg = imagecreatefromjpeg($gdimg);
				if ($amount == 0) 
					{
					return true;
					}
								
				// overridden below for grayscale
				if ($targetColor != 'gray') 
					{
					$TargetPixel['red']   = $red;//hexdec(substr($targetColor, 0, 2));
					$TargetPixel['green'] = $green;//hexdec(substr($targetColor, 2, 2));
					$TargetPixel['blue']  = $blue;//hexdec(substr($targetColor, 4, 2));
					}
		
				for ($x = 0; $x < imagesx($gdimg); $x++) 
					{
					for ($y = 0; $y < imagesy($gdimg); $y++) 
						{
						$OriginalPixel = imagecolorsforindex($gdimg, imagecolorat($gdimg, $x, $y));
						if ($targetColor == 'gray') 
							{
							$TargetPixel = $OriginalPixel;
							}
						foreach ($TargetPixel as $key => $value) 
							{
							$NewPixel[$key] = round(max(0, min(255, ($OriginalPixel[$key] * ((100 - $amount) / 100)) + ($TargetPixel[$key] * ($amount / 100)))));
							}
						$newColor = imagecolorallocate($gdimg, $NewPixel['red'], $NewPixel['green'], $NewPixel['blue']);
						imagesetpixel($gdimg, $x, $y, $newColor);
						}
					}		
				imagejpeg($gdimg,$newfile4,255);
				imagedestroy($gdimg);
				return $newfile4; */
				$convertcmd = $_SESSION['IMAGE_MAGICK_PATH']."convert ".$gdimg." -colorize ".$red.",".$green.",".$blue." ".$newfile4;
				exec($convertcmd);
				return $newfile4;
				
		}

//AUTO 
	function ANalysis($gdimg, $calculateGray=false) 
		{
			$ImageSX = imagesx($gdimg);
			$ImageSY = imagesy($gdimg);
			for ($x = 0; $x < $ImageSX; $x++) {
				for ($y = 0; $y < $ImageSY; $y++) {
					$OriginalPixel = imagecolorsforindex($gdimg, imagecolorat($gdimg, $x, $y));
					$Analysis['red'][$OriginalPixel['red']]++;
					$Analysis['green'][$OriginalPixel['green']]++;
					$Analysis['blue'][$OriginalPixel['blue']]++;
					$Analysis['alpha'][$OriginalPixel['alpha']]++;
					if ($calculateGray) {
						$GrayPixel = imagecolorsforindex($gdimg, imagecolorat($gdimg, $x, $y));
						$Analysis['gray'][$GrayPixel['red']]++;
					}
				}
			}
			$keys = array('red', 'green', 'blue', 'alpha');
			if ($calculateGray) {
				$keys[] = 'gray';
			}
			foreach ($keys as $dummy => $key) {
				ksort($Analysis[$key]);
			}
			return $Analysis;
		}

	function HistogramStretch($gdimg, $band='*', $method=5, $threshold=5)
		{
			$newfile5=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";
			$gdimg=imagecreatefromjpeg($gdimg);
			// equivalent of "Auto Contrast" in Adobe Photoshop
			// method 0 stretches according to RGB colors. Gives a more conservative stretch.
			// method 1 band stretches according to grayscale which is color-biased (59% green, 30% red, 11% blue). May give a punchier / more aggressive stretch, possibly appearing over-saturated
			$Analysis = ANalysis($gdimg, true);
			$keys = array('r'=>'red', 'g'=>'green', 'b'=>'blue', 'a'=>'alpha', '*'=>(($method == 0) ? 'all' : 'gray'));
			$band = substr($band, 0, 1);
			if (!isset($keys[$band])) {
				return false;
			}
			$key = $keys[$band];
	
			// If the absolute brightest and darkest pixels are used then one random
			// pixel in the image could throw off the whole system. Instead, count up/down
			// from the limit and allow <threshold> (default = 0.1%) of brightest/darkest
			// pixels to be clipped to min/max
			$threshold = floatval($threshold) / 100;
			$clip_threshold = imagesx($gdimg) * imagesx($gdimg) * $threshold;
			//if ($min >= 0) {
			//	$range_min = min($min, 255);
			//} else {
				$countsum = 0;
				for ($i = 0; $i <= 255; $i++) {
					if ($method == 0) {
						$countsum = max($Analysis['red'][$i], $Analysis['green'][$i], $Analysis['blue'][$i]);
					} else {
						$countsum += $Analysis[$key][$i];
					}
					if ($countsum >= $clip_threshold) {
						$range_min = $i - 1;
						break;
					}
				}
				$range_min = max($range_min, 0);
			//}
			//if ($max > 0) {
			//	$range_max = max($max, 255);
			//} else {
				$countsum = 0;
				for ($i = 255; $i >= 0; $i--) {
					if ($method == 0) {
						$countsum = max($Analysis['red'][$i], $Analysis['green'][$i], $Analysis['blue'][$i]);
					} else {
						$countsum += $Analysis[$key][$i];
					}
					if ($countsum >= $clip_threshold) {
						$range_max = $i + 1;
						break;
					}
				}
				$range_max = min($range_max, 255);
			//}
			$range_scale = (($range_max == $range_min) ? 1 : (255 / ($range_max - $range_min)));
			if (($range_min == 0) && ($range_max == 255)) {
				// no adjustment neccesary - don't waste CPU time!
				return true;
			}
	
			$ImageSX = imagesx($gdimg);
			$ImageSY = imagesy($gdimg);
			for ($x = 0; $x < $ImageSX; $x++) {
				for ($y = 0; $y < $ImageSY; $y++) {
					$OriginalPixel = imagecolorsforindex($gdimg, imagecolorat($gdimg, $x, $y));
					if ($band == '*') {
						$new['red']   = min(255, max(0, ($OriginalPixel['red'] - $range_min) * $range_scale));
						$new['green'] = min(255, max(0, ($OriginalPixel['green'] - $range_min) * $range_scale));
						$new['blue']  = min(255, max(0, ($OriginalPixel['blue']  - $range_min) * $range_scale));
						$new['alpha'] = min(255, max(0, ($OriginalPixel['alpha'] - $range_min) * $range_scale));
					} else {
						$new = $OriginalPixel;
						$new[$key] = min(255, max(0, ($OriginalPixel[$key] - $range_min) * $range_scale));
					}
					$newColor = imagecolorallocatealpha($gdimg, $new['red'], $new['green'], $new['blue'], $new['alpha']);
					imagesetpixel($gdimg, $x, $y, $newColor);
				}
			}
			imagejpeg($gdimg,$newfile5,100);
			imagedestroy($gdimg);
			return $newfile5;
		}		

//WATERMARK IMAGE
	function Watermark($gdimg, $watermarking, $x, $y) 
		{
			$newfile6=$_SESSION['tempdir'].substr(md5(microtime()),0,5).".jpg";
			list($width, $height) = getimagesize($watermarking);
			$gdimg=imagecreatefromjpeg($gdimg);
			$watermarking=imagecreatefromjpeg($watermarking);
			imagecopymerge($gdimg, $watermarking, $x, $y, 0, 0, $width, $height, 15);
			imagejpeg($gdimg,$newfile6,100);
			imagedestroy($gdimg);
			return $newfile6;
		}

}

?>
