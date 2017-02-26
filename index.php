<? 	
	session_start();
 ?>
 
 <script> 
	function download(file){
		window.open('download.php?file='+file);
		//window.location.href ='download.php?file='+file;
	}
</script>

<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Sistema de Etiquetas</title>
		<link rel="stylesheet" href="/barras/estilos.css"/>
        <link href="estilos.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <form action="<?= $PHP_SELF ?>" method="post">
        <label for="nome">Número:
      <input type="text" name="nome" id="nome" tabindex="1" value="Nº 39"/><br/>
        <label for="cor">Cor:
      <input type="text" name="cor" id="cor" tabindex="2" value="CAFÉ"/><br/>
        <label for="codigo">Código:
      <input type="text" name="codigo" id="codigo" tabindex="3" value="4062639"/><br/>
        <label for="quant">Quantidade:
      <input type="text" name="quant" id="quant" tabindex="4" value="9"/><br/>
        <label for="posIni">Posição Inicial:
      <input type="text" name="posIni" id="posIni" tabindex="5" value="1"/><br/>
		<label for="tipo">Tipo de Código:
<select name="tipo" id="tipo" tabindex="6">
        	<option value="code128" selected>code128</option>
			<option value="code39">Code39</option>            
            <option value="ean13">ean13</option>
            <option value="int25">int25</option>
            <option value="postnet">postnet</option>
            <option value="upca">upca</option>
      </select><br/>
      <input type="submit" class="botao" value="Gerar Etiquetas">
      <br/><br/>
    </form>
    <div id="Pagina" class="espaco">
    	<table id="paginaEtiquetas">
			<?
			include_once "escreveEtiquetas.php";
            if($_POST["codigo"]){
				$_SESSION['posIni'] = $_POST["posIni"];
				$_SESSION['quant'] = $_POST["quant"];
				$_SESSION['codigo'] = $_POST["codigo"];
				$_SESSION['tipo'] = $_POST["tipo"];
				$_SESSION['nome'] = $_POST["nome"];
				$_SESSION['cor'] = $_POST["cor"];
				escreveBrowser($_POST["posIni"],$_POST["quant"],$_POST["codigo"],$_POST["tipo"],$_POST["nome"],$_POST["cor"]);
				escrevePdf($_POST["posIni"],$_POST["quant"],$_POST["codigo"],$_POST["tipo"],$_POST["nome"],$_POST["cor"]); 
			?>
				<script>	
					var ender = "popup.php";
					window.open(ender,"Lista de Etiquetas","toolbar=0,location=0, directories=0, status=1, menubar=1, resizable=1, width=420, height=600,scrollbars=1");
				</script>
			<? } ?>
	    </table>
    </div>
</body>
</html>