<div align=right class=hidden-print>
	<p>
	  <button type="button" class="btn btn-default" onClick=window.print()>
	  <span><i class="glyphicon glyphicon-print"></i></span> Imprimir</button>
	</p>
</div>							
<table align=center class="table table-condensed table-hover">
		<h6 align=right>
		<small >
			<img src="imgs/logonovo.png" width="150" class="img-responsive" align=left></img>
			SANKYU S/A RUA FRANCISCO OTAVIANO, 185 JARDIM AMÁLIA II VOLTA REDONDA - RJ</br>
			CEP.: 27.251-025 CNPJ.: 43.211.325/0012-89 
		</small>
		</h6>
<?php
	$user_name = $_SESSION['user_name'];
	if(isset($_POST['data'])){
		$_SESSION['data_credito'] = $_POST['data'];
		$mes = substr($_SESSION['data_credito'],0,2);
		$dia = substr($_SESSION['data_credito'],2,2);
		$ano = substr($_SESSION['data_credito'],4,4);
	}
	else{
		$_SESSION['data_credito'] = $_POST['data'];
		$mes = substr($_SESSION['data_credito'],0,2);
		$dia = substr($_SESSION['data_credito'],2,2);
		$ano = substr($_SESSION['data_credito'],4,4);
	}
	$data_bd = null;
	$cpf_mask = null;
	$nome = null;
	$cpf = null;
	$data_credito = null;
	$cod_referencia_cred = null;
	$nome_credito = null;
	$valor_credito = null;
	$cod_referencia_deb = null;
	$nome_debito = null;
	$valor_debito = null;
	$salario_base = null;
	$base_inss = null;
	$base_irrf = null;
	$base_fgts = null;
	$fgts_mes = null;
	$total_credito = null;
	$total_debito = null;
	$valor_liquido = null;
	

	
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS)
	or die ("erro ao conectar");
	
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	
	
	//seleciona dados da tabela holerite
	$sql_holerite = "SELECT * FROM holerite WHERE matricula = '$user_name' AND data_credito='".$_SESSION['data_credito']."' ";
	$result = mysqli_query($conn, $sql_holerite);
	if(mysqli_query($conn, $sql_holerite)) {
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$user_name = $row["matricula"];
			$nome = $row["nome"];
			$mes = $row["mes"];
			$ano = $row["ano"];
			$cpf = $row["cpf"];
			$cpf_mask = substr($cpf,0,3).".".substr($cpf,3,3).".".substr($cpf,6,3)."-".substr($cpf,9,2);
			$salario_base = $row["salario_base"];
			$base_irrf = $row["base_irrf"];
			$base_fgts = $row["base_fgts"];
			$base_inss = $row["base_inss"];
			$fgts_mes = $row["fgts_mes"];
			$total_credito = $row["total_credito"];
			$total_debito = $row["total_debito"];
			$valor_liquido = $row["valor_liquido"];
			$data_bd = $row["data_credito"]." \n";?><?php		
	}
	$novaData = substr($data_bd,2,2)."/".substr($data_bd,0,2)."/".substr($data_bd,4,4);
	?>
    <!-- Inicio da tabela do holerite para apresentação e impressão -->
			<div align=right><b>Competência: </b><?php echo $mes."/".$ano; ?></div>
			<div align=right><b> Data do Crédito: </b><?php echo $novaData; ?></div>
			<tr style="font-weight:bold;border-top: 1px solid #D5D5D5;border-bottom: 1px solid #D5D5D5;" bgcolor="#D5D5D5"><td>Matrícula</td><td  colspan=2>Nome</td><td>CPF</td></tr>
        	<tr><td><?php echo $user_name; ?></td><td colspan=2><?php echo $nome; ?></td><td><?php echo $cpf_mask; ?>
	        <tr style="font-weight:bold;font-size:12px;border-top: 1px solid #D5D5D5;border-bottom: 1px solid #D5D5D5;" bgcolor="#D5D5D5"><td>Código</td><td>Discriminação</td><td align=right>Proventos</td><td align=right>Descontos</td></tr>
    <?php
	
	//seleciona dados da tabela provento
	$sql_provento = "SELECT * FROM provento WHERE matricula = '$user_name' AND data_credito='".$_SESSION['data_credito']."' ";
	$result = mysqli_query($conn, $sql_provento);
	if (!$result) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
		$cod_referencia_cred = $row["cod_referencia_cred"];
		$nome_credito = $row["nome_credito"];
		$valor_credito = $row["valor_credito"];	
		$cod_referencia_cred = str_replace("13O", "13º", $cod_referencia_cred);
		$nome_credito = str_replace("13O", "13º", $nome_credito);
		$valor_credito = str_replace("13O", "13º", $valor_credito);
		$cod_referencia_cred = str_replace("13(o)", "13º", $cod_referencia_cred);
		$nome_credito = str_replace("13(o)", "13º", $nome_credito);
		$valor_credito = str_replace("13(o)", "13º", $valor_credito);

		
	?>		
        <tr class="success" style="font-size:12px;"><td><?php echo $cod_referencia_cred; ?></td><td><?php echo $nome_credito; ?></td><td align="right"><?php echo $valor_credito; ?></td><td></td></tr>
	<?php
	}
	//seleciona dados da tabela desconto
	$sql_provento = "SELECT * FROM desconto WHERE matricula = '$user_name' AND data_credito='".$_SESSION['data_credito']." ' ";
	$result = mysqli_query($conn, $sql_provento);
	if (!$result) {
    	printf("Error: %s\n", mysqli_error($conn));
    	exit();
	}
	while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$cod_referencia_deb = $row["cod_referencia_deb"];
			$nome_debito = $row["nome_debito"];
			$valor_debito = $row["valor_debito"];	
			$cod_referencia_deb = str_replace("13O", "13º", $cod_referencia_deb);
			$nome_debito = str_replace("13O", "13º", $nome_debito);
			$valor_debito = str_replace("13O", "13º", $valor_debito);
			$cod_referencia_deb = str_replace("(o)", "º", $cod_referencia_deb);
			$nome_debito = str_replace("(o)", "º", $nome_debito);
			$valor_debito = str_replace("(o)", "º", $valor_debito);
	?>
		
        <tr class="danger" style="font-size:12px;"><td><?php echo $cod_referencia_deb; ?></td><td><?php echo $nome_debito; ?></td><td></td><td align="right"><?php echo $valor_debito; ?></td></tr>
	<?php		
			
	}
	?>
        <tr style="font-weight:bold;font-size:12px;border-top: 1px solid #D5D5D5;" bgcolor="#D5D5D5"align=right><td>Base INSS</td><td>Base IRRF</td><td>Total Proventos</td><td>Total Descontos</td>
        <tr style="font-size:12px;">
		<td align="right"><?php echo $base_inss; ?>
		</td><td align="right"><?php echo $base_irrf; ?>
		</td><td align="right"><?php echo $total_credito; ?>
		</td><td align="right"><?php echo $total_debito; ?></td></tr>
		<tr style="font-weight:bold; font-size:12px; border-top: 1px solid #D5D5D5;" bgcolor="#D5D5D5" align=right>
		<td>Base FGTS</td><td>Valor FGTS</td><td>Salário Base</td><td>Total Líquido</td>
		</tr>
		<tr style="font-size:12px;">
		<td align="right"><?php echo $base_fgts; ?>
		</td><td align="right"><?php echo $fgts_mes; ?>
		<td align=right><?php echo $salario_base; ?>
		</td><td align="right"><?php echo "R$ ". $valor_liquido; ?>
		</td></tr>
        </tr>	
    <?php
	} else
		echo "Não existe holerite para este período.";
?>
    </table>   
</body>
</html>