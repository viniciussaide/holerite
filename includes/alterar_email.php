<?php
	$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn_root, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn_root, "utf8");
	$i = 1;
	$matricula = $_SESSION['user_name'];
	$email = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['email']);
	$query = "UPDATE users SET email='$email' WHERE matricula='$matricula'";
	$result = mysqli_query($conn_root, $query);
	if ($result){
		$_SESSION['email'] = $email;
		include "includes/salvo_com_sucesso.php";
		include "includes/form_troca_senha.php";
	}
	else {
		include "includes/salvo_com_erro.php";
		include "includes/form_troca_senha.php";
	}
	mysqli_close($conn_root);
?>