<?php
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) ){
	require_once("config/db.php");
	setcookie('nome', $_POST['nome']);
	$nome = $_POST['nome'];
	$matricula = $_COOKIE['matricula'];
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	//seleciona nomes aleatorios + o nome relacionado a matricula passada
	$sql_verifica = "SELECT * FROM users where matricula = '$matricula' and nome = '$nome'";
	$result = mysqli_query($conn, $sql_verifica);
	if($result = mysqli_query($conn, $sql_verifica)) {
		$num_rows = mysqli_num_rows($result);
		if ($num_rows == 1){
			echo "<div class='panel-body'><p><div class='alert alert-info' role='alert' align=center>Verificação de matrícula e nome bem sucedida!</br>
			<strong>$matricula - $nome</strong></div></p>";
			echo "<input type='hidden' name='etapa' value='senha_3'></input>";
			echo "<label>Digite seu CPF para verificação:</label>";
			echo "<div class='input-group' style='padding-bottom: 5px;'>
			<span class='input-group-addon' id='basic-addon1'>CPF:</span>
			<input class='form-control' required type=text maxlength=11 name=cpf onkeypress='return numbersOnly(event)' placeholder='Digite seu CPF'></input></div>
			<div class='input-group' style='padding-bottom: 5px;'>
			<span class='input-group-addon' id='basic-addon1'>Chave de Segurança:</span>
			<input class='form-control' required type=password maxlength=4 name=chave placeholder='Digite sua chave de segurança'></input></div></div>";?>
		
				</div></div>
				<div class="panel-footer clearfix">
				<a href="index.php" class="btn btn-primary pull-left" id="btn">Página Inicial</a>
				<input type="submit" name="senha_1" class="btn btn-success pull-right" value="Enviar"></button>
				</div>
		<?php
		}
		else{
			echo "<div class='panel-body'><div class='alert alert-danger' role='alert' align=center>Nome do Usuário não bate com a matrícula!</div></div>";
			echo "<div class='panel-footer clearfix' align=center><a href='recuperar_senha.php' class='btn btn-primary' name='voltar'>Voltar</a></div>";
		}
	}
} else {
header("Location: index.php");
}
?>