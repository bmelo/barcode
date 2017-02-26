<?php
	include_once "geraCodigo.php";
	function escreveBrowser($posIni,$quant,$codigo,$tipo,$nome,$cor){
		$posIni = ($posIni>0)?$posIni:1;
		$quant = $quant+$posIni;
		$imgLink = geraCodigo($codigo,$tipo);
		for($i=1; $i<$quant; $i++){
			if($i>=$posIni){
				echo "<td id='Etiqueta'>";
				echo "<span class='Numero'>".$nome."</span>";
				echo "<span class='Titulo'>Mariah</span>";
				echo "<br/><center><div class='Cor'>".$cor."</center></div>";
				//echo "<img src=".$imgLink."></td>";
			}else{
				echo "<td id='Etiqueta'/>"; // escreve etiqueta vazia!
			}
			if( ($i%3)==0 || ($i+1==$quant) )
				echo "<tr/><td id='EspacoLinhas'/><tr/>";
		}
	}
	function escrevePdf($posIni,$quant,$codigo,$tipo,$nome,$cor){
	
		// Variaveis de Tamanho
		$mesq = "1.1"; // Margem Esquerda (mm)
		$mdir = "1.1"; // Margem Direita (mm)
		$msup = "0"; // Margem Superior (mm)
		$leti = "32"; // Largura da Etiqueta (mm)
		$aeti = "25"; // Altura da Etiqueta (mm)
		$ehet = "0.2"; // Espaço horizontal entre as Etiquetas (mm)
		$evet = "2.1"; // Espaço vertical entre as Etiquetas (mm)
		$quantEtiLinha = 3; // Quantidade de Etiquetas por Linha

		
		// Calculos para definir altura e largura
		$alturaPag = floor((($quant-2)/ $quantEtiLinha )+1)*($evet+$aeti);
		$larguraPag = $mdir + ($quantEtiLinha*$leti) + ($quantEtiLinha-1*$ehet) + $mesq;

		//Define configuração do PDF
		$pdf = new FPDF('P','mm', array(99,$alturaPag)); // Cria um arquivo novo.
		$pdf->Open(); // inicia documento
		$pdf->AddPage(); // adiciona a primeira pagina
		$pdf->SetMargins($mesq,$mdir,$msup); // Define as margens do documento
		$pdf->SetAuthor("Sistema de Etiquetas"); // Define o autor
		$pdf->SetDisplayMode('real');
		
		//Variáveis para estiquetas!
		$posIni = ($posIni>0)?$posIni:1;
		$quant = $quant+$posIni;
		$imgLink = geraCodigo($codigo,$tipo);
		
		$linha = floor(($posIni-1)/3);
		$coluna = ($posIni-1)%3; 
		
		for($i=1; $i<$quant; $i++){
//			if($linha == "10") {
//				$pdf->AddPage();
//				$linha = 0;
//			}
			
			if($coluna == "3") { // Se for a terceira coluna
				$pdf->Cell(0);
				$coluna = 0; // $coluna volta para o valor inicial
				$linha = $linha +1; // $linha é igual ela mesma +1
			}
			
			$posicaoV = $linha*($aeti+$evet);
			$posicaoH = $coluna*($leti+$ehet);
			
			if($coluna == "0") { // Se a coluna for 0
				$somaH = $mesq; // Soma Horizontal é apenas a margem da esquerda inicial
			} else { // Senão
				$somaH = $mesq+$posicaoH; // Soma Horizontal é a margem inicial mais a posiçãoH
			}
			
			if($linha =="0") { // Se a linha for 0
					$somaV = $msup; // Soma Vertical é apenas a margem superior inicial
			} else { // Senão
					$somaV = $msup+$posicaoV; // Soma Vertical é a margem superior inicial mais a posiçãoV
			}
			$pdf->SetFont('helvetica','',12); // Define a fonte
			$pdf->SetXY($somaH+2,$somaV+2);
			$largNum=strlen($nome)*2.5;
			$pdf->Cell($largNum,4,$nome,0,0,'L');
			//$pdf->Text($somaH+2,$somaV+5,$nome); // Imprime o numero
			$pdf->SetFont('helvetica','B',10); // Define a fonte
			$pdf->Cell(28-$largNum,4,'Mariah',0,1,'R');
			//$pdf->Text($somaH+(strlen($nome)*3.5),$somaV+5,'Mariah'); // Imprime o titulo da empresa
			$pdf->SetXY($somaH,$somaV+8);
			$pdf->SetFont('Courier','B',18); // Define a fonte
			$pdf->Cell(32,6,$cor,0,0,'C');
			$pdf->Image($imgLink,$somaH,$somaV+14,32.5); // Imprime a imagem
			//$pdf->Text($somaH+8,$somaV+12,$cor); // Imprime a cor da etiqueta
			$pdf->SetXY($somaH,$somaV);
			$pdf->Cell(32,25,'',1);
			
			$coluna = $coluna+1;
		}
		$nomePDF = 'codigo.pdf';
		$pdf->Output($nomePDF);
		echo "<script> download('$nomePDF'); </script>";
	}
?>