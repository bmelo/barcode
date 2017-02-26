<?
	function geraCodigo($texto,$tipo="code128",$tipoImg="png"){
		require_once("Image/Barcode.php"); // chamada para a biblioteca Image_Barcode
		$pathImagem = "codigos/".$texto."_".$tipo.".png";
		$img = Image_Barcode::draw($texto, $tipo,$tipoImg,0); // Gerando o código de barras
		
		$larg = imagesx($img);
		$alt = imagesy($img);
		$largu = 32*3.85;
		$altu = $largu*$alt/$larg;
		$corte = ($altu > 40)?$altu-40:0;

		$thumb = imagecreatetruecolor($largu, $altu);
		$thumb2 = imagecreatetruecolor($largu, $altu-$corte);
		
		imagecopyresampled($thumb, $img, 0, 0, 0, 0, $largu, $altu, $larg, $alt);

		$thumb = imagerotate($thumb,180,0);
		imagecopy($thumb2, $thumb, 0, 0, 0, 0, $largu, $altu);
		$thumb2 = imagerotate($thumb2, 180,0);

		imagepng($thumb2,$pathImagem);
		
		imagedestroy($img);
		imagedestroy($thumb);
		imagedestroy($thumb2);
		
		return $pathImagem;
	}
?>