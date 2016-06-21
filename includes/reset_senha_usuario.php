<?php
$matricula = $_SESSION['posts']['matricula'];
$sql_verifica = "SELECT * FROM users where matricula = '$matricula'";
$result = mysqli_query($conn, $sql_verifica);
$row = mysqli_fetch_array($result, MYSQL_ASSOC);
$cpf = $row['cpf'];
$reset_senha = password_hash($cpf, PASSWORD_DEFAULT);
$query_atualiza_senha = "UPDATE users SET user_password_hash = '".$reset_senha."' WHERE matricula ='".$matricula."'";
$result = mysqli_query($conn, $query_atualiza_senha);
if($result) {
	include "includes/salvo_com_sucesso.php";
	include "includes/lista_usuarios.php";
}
else {
	include "includes/salvo_com_erro.php";
	include "includes/lista_usuarios.php";
}
?>