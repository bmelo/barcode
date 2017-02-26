<?php
	define('FPDF_FONTPATH','fpdf/font/');
	require('fpdf/fpdf.php');
	include('escreveEtiquetas.php');
	session_start();
	include_once "geraCodigo.php";
?> 

<script> 
	function download(file){
		window.open('download.php?file='+file);
		//window.location.href ='download.php?file='+file;
	}
</script> 

<script>
	function imprimir(altura){
		alert("Configuração da página para impressão:\n\n     Largura: 10.15cm\n     Altura: "+ altura + "cm");
		window.print();
		window.close();
	}
</script>

<link rel="stylesheet" href="/barras/estilos.css"/>
<div id="Pagina" style="top:0; left:0;size 11mm 12mm;">
    	<table id="paginaEtiquetas">
<?php
	$posIni = ($_SESSION['posIni']>1)?$_SESSION['posIni']:1;
	$quant = $_SESSION['quant'] + $posIni; 
	$codigo = $_SESSION['codigo'];
	$tipo = $_SESSION['tipo'];
	$nome = $_SESSION['nome'];
	$cor = $_SESSION['cor'];
	$imgLink = geraCodigo($codigo,$tipo);
	for($i=1; $i<$quant; $i++){
		if($i>=$posIni){
			echo "<td id='Etiqueta'>";
			echo "<span class='Numero'>".$nome."</span>";
			echo "<span class='Titulo'>Mariah</span>";
			echo "<br/><center><div class='Cor'>".$cor."</center></div>";
			echo "<img src=".$imgLink."></td>";
		}else{
			echo "<td id='Etiqueta'/>"; // escreve etiquetas em branco
		}
		if( ($i%3)==0 || ($i+1==$quant) )
			echo "<tr/><td id='EspacoLinhas'/><tr/>";
	}
	$alturaPag = floor((($quant-2)/3)+1)*2.79;
	escrevePdf($posIni,$quant-$posIni,$codigo,$tipo,$nome,$cor);	
?>
	</table>
</div>

<script>
	//imprimir(<?= $alturaPag ?>);
</script>
