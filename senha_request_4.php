<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ){
	require_once("config/db.php");
	setcookie('cpf', $_POST['cpf']);
	$cpf = $_POST['cpf'];
	$chave = $_POST['chave'];
	$matricula = $_COOKIE['matricula'];
	$nome = $_COOKIE['nome'];
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	$sql_verifica = "SELECT * FROM users where matricula = '$matricula' and nome = '$nome'";
	$result = mysqli_query($conn, $sql_verifica);
	$row = mysqli_fetch_array($result, MYSQL_ASSOC);
	if ($cpf == $row['cpf']){
		if ($chave == $row['uniqueCode']){
			$senha_nova = password_hash($cpf, PASSWORD_DEFAULT);
			$query_atualiza_senha = "UPDATE users SET user_password_hash = '".$senha_nova."' WHERE matricula ='".$matricula."'";
			$result = mysqli_query($conn, $query_atualiza_senha);
				if($result) {
					echo "<div class='panel-body'><p><div class='alert alert-info' role='alert' align=center>";
					echo "Verificação do CPF bem sucedido!</br>
					$matricula - $nome</br>";
					echo "<b>Sua Senha foi reconfigurada!</br></br>
					Passou a ser os 11 digitos do seu CPF sem pontos e traços.</br></br>
					Acesse usando:</b></br>
					<b>Matrícula: </b>$matricula</br>
					<b>Senha: </b>$cpf";
					echo "<form action=senha_request_4.php method=post>
					<input type=hidden name=restricao></input></div></div></p>";
					
					echo "<div class='panel-footer clearfix' align=center><a class='btn btn-primary' href='index.php'>Voltar</a></div>";
				}
		}
		else {
			echo "<div class='panel-body'><div class='alert alert-danger' role='alert' align=center>Chave de Segurança informada está incorreta!</div></div>";
			echo "<div class='panel-footer clearfix' align=center><a href='recuperar_senha.php' class='btn btn-primary' name='voltar'>Voltar</a></div>";
		}
	}
	else{
		echo "<div class='panel-body'><div class='alert alert-danger' role='alert' align=center>CPF informado está incorreto!</div></div>";
		echo "<div class='panel-footer clearfix' align=center><a href='recuperar_senha.php' class='btn btn-primary' name='voltar'>Voltar</a></div>";
	}
} else {
header("Location: index.php");
}
?>
