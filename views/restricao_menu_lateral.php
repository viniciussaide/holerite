<?php
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn, "utf8");
	$query = "SELECT * FROM funcao JOIN relacao_type_funcao 
	ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao 
	WHERE (".$restricao.") AND  tipo_menu LIKE '%lateral%' 
	ORDER BY prioridade";
	$result = mysqli_query($conn, $query);
	if (($result)AND(mysqli_num_rows($result)>=1)){
		include "views/menu_lateral.php";
	}
	else{
		include "pagina.php";
	}
?>


