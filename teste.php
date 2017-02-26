<?
	
	require_once("Image/Barcode.php"); // chamada para a biblioteca Image_Barcode
	$texto = $_GET['codigo']; // recuperando o CEP
	$type = $_GET['tipo']; // tipo de barra gerada
	$img = Image_Barcode::draw($texto, $type,"png",0); // Imprimindo o código de barras na tela
	$larg = imagesx($img);
	$alt = imagesy($img);
	//echo $larg." x ".$alt.'<br/>';
	//header('Content-type: image/png');
	//imagepng($img);
	$largu = 34*2.83;
	$altu = $largu*$alt/$larg;
	//echo $largu." x ".$altu;
	
	$thumb = imagecreatetruecolor($largu, $altu);
	imagecopyresampled($thumb, $img, 0, 0, 0, 0, $largu, $altu, $larg, $alt);
	header('Content-type: image/png');
	imagepng($thumb);
?>