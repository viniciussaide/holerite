<?php
	$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn_root, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn_root, "utf8");
	$id_mensagem = mysqli_real_escape_string ( $conn_root, $_SESSION['posts']['id_mensagem']);
	$query = "DELETE FROM mensagem WHERE id_mensagem='$id_mensagem';";
	$result = mysqli_query($conn_root, $query);
	if ($result){
		include "includes/salvo_com_sucesso.php";
		include "includes/lista_mensagens.php";
	}
	else {
		include "includes/salvo_com_erro.php";
		include "includes/lista_mensagens.php";
	}
?>