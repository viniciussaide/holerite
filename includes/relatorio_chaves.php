<div align='right' class='hidden-print'>
	<p>
	  <button type="button" class="btn btn-default" onClick='window.print()'>
	  <span><i class="glyphicon glyphicon-print"></i></span> Imprimir</button>
	</p>
</div>	
<?php
$espaco = 0;
if(!empty($_SESSION['posts']['matriculas'])) {
    foreach($_SESSION['posts']['matriculas'] as $matricula) {
		$query = "SELECT * FROM users WHERE matricula=$matricula";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($result,  MYSQL_ASSOC);
		echo "<div class=row style='border-bottom: 1px solid #999999; border-top: 1px solid #999999; line-height: 1.2;'>";
		echo "<div class=col-xs-7 style='border-right: 1px solid #999999;'>";
		?>
				<p align='center'><b>CHAVE DE SEGURANÇA</b></p>
				<p align='center' style='font-size: 12px;'>Holerite Online Sankyu: <b>http://holeriteonline.sankyu.com.br</b></p>
				<p style='font-size: 12px;'>Você está recebendo um código com 4 caracteres, ele será sua chave de segurança para acessar seu holerite, use-o em conjunto com sua senha pessoal. Guarde-o em local seguro, não revele a terceiros, ele é de uso pessoal e de sua responsabilidade.</p>
				<div align='center' style='font-size: 12px;'><i>Dúvidas entre em contato com a Administração.</i></div>
				<p align='center' style='font-size: 12px;'><i>Ramal: 6099</i></p>
			</div>
			<div class='col-xs-5'>
				</p>
				<p align='center'><b>ESTA É SUA CHAVE DE SEGURANÇA</b></p>
				<?php 
				echo "<p align=center style='font-size: 20px ;font-family:Palatino Linotype, Book Antiqua, Palatino, serif'><b>".$row['uniqueCode']."</b></p>";
				?>
				<img class="img-responsive" src="imgs/logonovo.png" style="height: 30px;">
				</br>
				<p align='center' style='font-size: 12px;'>A chave de segurança deverá ser digitada como mostrada neste informe.</p>
			</div>
		</div>
		<div class='row' style='border-bottom: 1px solid #999999;'>
			<div class='col-xs-5'>
				<?php 
				echo "</p><p style='font-size: 12px;'>Nome: <b>".$row['nome']."</b></p>";
				echo "<p style='font-size: 12px;'>Matrícula: <b>".$row['matricula']."</b></p></div>";
				?>
			<div class='col-xs-4' style="margin-top: 13px;">
				<div align='center' style='font-size: 12px;'></p>Recebido em:____/_____/______.</div>
			</div>
			<div class='col-xs-3'>
				<div align='center' style="margin-top: 13px;">_______________________</div>
				<p align='center' style='font-size: 12px;'>Assinatura Empregado</p>
			</div>
		</div>
		<?php
		$espaco += 1;
		if ($espaco%4==0){
			echo "</br></br></br></br></br></br></br></br>";
		}
	}
}
else {
	echo "Selecione alguma matrícula.";
}
?>
