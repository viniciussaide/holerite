<?php
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	//seleciona anos distintas do banco
	$sql_datas = "SELECT DISTINCT mes, ano, data_credito FROM holerite WHERE matricula = '$user_name' ORDER BY data_credito ASC";
	$result = mysqli_query($conn, $sql_datas);
	$num_rows = mysqli_num_rows($result);
	$num_rows = (int) ($num_rows/2);
	$linha =0;
	echo "<div class='btn-group btn-group-justified' role='group'>";
	if(mysqli_query($conn, $sql_datas)) {
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$data_credito = $row['data_credito'];
			$dia = substr($data_credito,2,2);
			$mes = $row['mes'];
			$ano = $row['ano'];
			if (($dia==15)&&($mes==12)){
				echo "<button class='btn btn-default' type=Submit name=data value=$data_credito>$mes/$ano 13º</button>";
			}
			else {
				echo "<button class='btn btn-default' type=Submit name=data value=$data_credito>$mes/$ano</button>";
			}
			$linha = $linha+1;
			if ($linha==3){
				$linha = 0;
				echo "
					</div>
					<div class='btn-group btn-group-justified' role='group'>";
			}
		}
		echo "</div></div>";
	}
?>

