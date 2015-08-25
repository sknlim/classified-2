<?php
class vImage{

	var $numChars = 2; # Tamanho da String: default 3;
	var $w; # Largura da imagem
	var $h = 40; # Altura da Imagem: default 15;
	var $colBG = "220 220 220"; # Change Background Color
	var $colTxt = "0 0 0";
	var $colBorder = "000 000 000";
	var $charx = 20; # Espaço lateral de cada char
	var $numCirculos = 25; #Numeros de circulos randomicos
	
	
	function vImage(){
		session_start();
	}
	
	function gerText($num){
		# receber tamanho da string
		if (($num != '')&&($num > $this->numChars)) $this->numChars = $num;		
		# gerar string randmica
		$this->texto = $this->gerString();
		
		$_SESSION['vImageCodS'] = $this->texto;
	}
	
	function loadCodes(){
		$this->postCode = $_POST['vImageCodP'];
		$this->sessionCode = $_SESSION['vImageCodS'];
	}
	
	function checkCode(){
		if (isset($this->postCode)) $this->loadCodes();
		if ($this->postCode == $this->sessionCode)
			return true;
		else
			return false;
	}
	
	function showCodBox($mode=0,$extra=''){
		$str = "<input type=\"text\" name=\"vImageCodP\" ".$extra." > ";
		
		if ($mode)
			echo $str;
		else
			return $str;
	}
	
	function showImage(){
		
		
		$this->gerImage();
		
		header("Content-type: image/png");
		ImagePng($this->im);
		
	}
	
	function gerImage(){
		# Calcular tamanho para caber texto
		$this->w = ($this->numChars*$this->charx) + 40; #5px de cada lado, 4px por char
		# Criar img
		$this->im = imagecreatetruecolor($this->w, $this->h); 
		#desenhar borda e fundo
		imagefill($this->im, 0, 0, $this->getColor($this->colBorder));
		imagefilledrectangle ( $this->im, 1, 1, ($this->w-2), ($this->h-2), $this->getColor($this->colBG) );

		#desenhar circulos
		for ($i=1;$i<=$this->numCirculos;$i++) {
			$randomcolor = imagecolorallocate ($this->im , rand(120,255), rand(120,255),rand(120,255));
				imageellipse($this->im,rand(0,$this->w-10),rand(0,$this->h-3), rand(20,60),rand(20,60),$randomcolor);
		}
		#escrever texto
		$ident = 20;
		for ($i=0;$i<$this->numChars;$i++){
			$char = substr($this->texto, $i, 1);
			$font = rand(5,5);
			$y = round(($this->h-15)/4);
			$col = $this->getColor($this->colTxt);
			if (($i%4) == 0){
				imagechar ( $this->im, $font, $ident, $y, $char, $col );
			}else{
				imagechar ( $this->im, $font, $ident, $y+rand(3,18), $char, $col );
			}
			$ident = $ident+$this->charx;
		}

	}
	
	function getColor($var){
		$rgb = explode(" ",$var);
		$col = imagecolorallocate ($this->im, $rgb[0], $rgb[1], $rgb[2]);
		return $col;
	}
	
	function gerString(){
		rand(0,time());
		$possible="FATCATJBSTV123456789";
		while(strlen($str)<$this->numChars)
		{
				$str.=substr($possible,(rand()%(strlen($possible))),1);
		}

		$txt = $str;
		
		return $txt;
	}
} 

?>