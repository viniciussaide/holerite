<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ){
	setcookie('matricula', $_POST['matricula']);
	$matricula = $_POST['matricula'];
	require_once("config/db.php");
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	$sql_verifica = "SELECT * FROM users WHERE matricula = '$matricula'";
	if($result = mysqli_query($conn, $sql_verifica)) {
		$num_rows = mysqli_num_rows($result);
		if ($num_rows == 1){
			echo "<div class='panel-body'><p><div class='alert alert-info' role='alert' align=center><strong>Matrícula nº. $matricula encontrada!</strong></div></p>";
			echo "<label>Selecione seu nome completo:</label>";
			echo "<input type='hidden' name='etapa' value='senha_2'></input>";
			//seleciona nomes aleatorios + o nome relacionado a matricula passada
			$sql_nomes = "SELECT * FROM (SELECT a.nome FROM users a ORDER BY RAND() LIMIT 10) AS X
							UNION
						SELECT nome FROM users WHERE matricula = '$matricula' ORDER BY nome ASC;";
			$result = mysqli_query($conn, $sql_nomes);
			echo "<div>";
			if(mysqli_query($conn, $sql_nomes)) {
				while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
					$nome = $row['nome'];
					echo "<input type=radio name=nome value='$nome' required>$nome</input></br>";
				}
			}
			?>
			</div></div>
			<div class="panel-footer clearfix">
			<a href="index.php" class="btn btn-primary pull-left" id="btn">Página Inicial</a>
			<input type="submit" name="senha_1" class="btn btn-success pull-right" value="Enviar"></button>
			</div>
			<?php
		}
		else{
			echo "<div class='panel-body'><p><div class='alert alert-danger' role='alert' align=center>Matrícula nº. $matricula não encontrada!</div></div></p>";
			echo "<div class='panel-footer clearfix' align=center><a href='recuperar_senha.php' class='btn btn-primary' name='voltar'>Voltar</a></div>";
		}
	}
} else {
header("Location: index.php");
}
	
	