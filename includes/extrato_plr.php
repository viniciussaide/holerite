<?php
	$user_name = $_SESSION['user_name'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	$query = "SELECT * FROM plr WHERE fk_matricula = '$user_name'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result)>=1) {
		?>
		<div align=right class=hidden-print>
			<p>
			  <a href="termo_plr.pdf" class="btn btn-default" >
			  <span><i class="glyphicon glyphicon-file" target=_blank></i></span> Cálculo PLR</a>
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
				</br></br>
				<div align=center><b>EXTRATO PLR</b></div>
		<?php
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$user_name = $row["matricula"];
			$situacao = $row["situacao"];
			$base_fixa = $row["base_fixa"];
			$falta_just = $row["falta_just"];
			$falta_injust = $row["falta_injust"];
			$total_falta = $row["total_falta"];
			$falta_atendimento = $row["falta_atendimento"];
			$total_atendimento = $row["total_atendimento"];
			$total_disciplina = $row["total_disciplina"];
			$danos = $row["danos"];
			$subtotal = $row["subtotal"];
			$bonus = $row["bonus"];
			$total_itens = $row["total_itens"];
			$meses = $row["meses"];
			$total_bruto = $row["total_bruto"];
			$plano_saude = $row["plano_saude"];
			$total_liquido = $row["total_liquido"];

			$query = "SELECT * FROM users WHERE matricula = '$user_name'";
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_array($result, MYSQL_ASSOC);
			$nome = $row["nome"];
			$cpf = $row["cpf"];
			$cpf_mask = substr($cpf,0,3).".".substr($cpf,3,3).".".substr($cpf,6,3)."-".substr($cpf,9,2);
			?>
			<!-- Inicio da tabela da PLR para apresentação e impressão -->
					<div align=right><b>Ano base: </b>2015</div>
					<thead style="font-weight:bold;border-top: 1px solid #D5D5D5;border-bottom: 1px solid #D5D5D5;" bgcolor="#D5D5D5"><td>Matrícula</td><td colspan=2>Nome</td><td>CPF</td></thead>
					<tr><td><?php echo $user_name; ?></td><td colspan=2><?php echo $nome; ?></td><td><?php echo $cpf_mask; ?></td></tr><tr><td colspan=4></br></br></br></td></tr>
			<?php
			echo "<thead style='font-weight:bold;border-top: 1px solid #D5D5D5;border-bottom: 1px solid #D5D5D5;'bgcolor='#D5D5D5'><td colspan=4 align=center>Base Variável</td></thead>";
			echo "<tr><td colspan=4></br></td></tr>";
			echo "<tr align=center><td><b>Frequência</b></td><td><b>Disciplina</b></td><td><b>Atendimento(HE)</b></td><td><b>Patrimônio</b></td></tr>";
			echo "<tr align=center>";
			if ($falta_injust==0){
				echo "<td>Faltas: $falta_just</td>";
			}
			else {
				echo "<td>Faltas não justificadas: $falta_injust</td>";
			}
			if ($total_disciplina=='42,00'){
				echo "<td>100%</td>";
			}
			elseif ($total_disciplina=='25,00') {
				echo "<td>60%</td>";
			}
			elseif ($total_disciplina=='13,00') {
				echo "<td>60%</td>";
			}
			else {
				echo "<td>0%</td>";
			}
			if ($total_atendimento=='122,00'){
				echo "<td>Todos</td>";
			}
			else{
				echo "<td>Faltou $falta_atendimento atendimento(s)</td>";
			}
			echo "<td>Sem Danos</td>";
			echo "</tr>";
			echo "<tr align=center><td>Máximo: R$ 219,00</td><td>Máximo: R$ 42,00</td><td>Máximo: R$ 122,00</td><td>Máximo: R$ 37,00</td></tr>";

			echo "<tr align=center>";
			echo "<td>Recebido: R$ $total_falta</td>";
			echo "<td>Recebido: R$ $total_disciplina</td>";
			echo "<td>Recebido: R$ $total_atendimento</td>";
			echo "<td>Recebido: R$ $danos</td>";
			echo "</tr>";
			echo "<tr><td colspan=4></br></br></br></td></tr>";
			echo "<thead align=center style='font-weight:bold;border-top: 1px solid #D5D5D5;border-bottom: 1px solid #D5D5D5;'bgcolor='#D5D5D5'><td><b>Base Fixa</b></td><td><b>Base Variável + Fixa</b></td>";
			if ($bonus==''){
				echo "<td></td>";
			}
			else {
				echo "<td><b>Bônus</b></td>";
			}
			echo "<td><b>Subtotal</b></td>";
			echo "</thead>";
			
			echo "<tr align=center><td>R$ $base_fixa</td>";
			echo "<td>R$ $subtotal</td>";
			if ($bonus==''){
				echo "<td></td>";
			}
			else {
				echo "<td>R$ $bonus</td>";
			}
			echo "<td>R$ $total_itens</td></tr>";
			echo "<tr><td colspan=4></br></br></br></td></tr>";
			echo "<thead align=center style='font-weight:bold;border-top: 1px solid #D5D5D5;border-bottom: 1px solid #D5D5D5;'bgcolor='#D5D5D5'><td><b>Meses Trabalhados</b></td><td><b>Saldo Proporcional</b></td>";
			if ($plano_saude==''){
				echo "<td></td>";
			}
			else {
				echo "<td><b>Plano de Saúde</b></td>";
			}
			echo "<td>Valor Líquido</td></thead>";
			echo "<tr align=center><td>$meses</td><td>R$ $total_bruto</td>";
			if ($plano_saude==''){
				echo "<td></td>";
			}
			else {
				echo "<td>R$ $plano_saude</td>";
			}
			echo "<td>R$ $total_liquido</td></tr>";
		}
	}
	else {?>
		<div class="alert alert-danger" role="alert">
		<a href='' class=close data-dismiss=alert aria-label=close>&times;</a>
		Seu extrato de PLR não está disponível.</div>
		<p></p>
	<?php
	}
?>	
</table>   
</body>
</html>