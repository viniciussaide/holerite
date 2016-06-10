<?php
if (isset($_POST['funcao'])){
	$id_funcao = $_POST['funcao'];
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn, "utf8");
	$query = "SELECT * FROM funcao WHERE id_funcao='$id_funcao'";
	$result = mysqli_query($conn, $query);
	if ($result){
		$row = mysqli_fetch_array($result, MYSQL_ASSOC);
		$funcao = $row['funcao'];
		$nome_menu = $row['nome_menu'];
		$pagina_php = $row['pagina_php'];
		$prioridade = $row['prioridade'];
		$tipo_menu = $row['tipo_menu'];
		echo $funcao." - ".$nome_menu." - ".$tipo_menu." - ".$prioridade."<br>";
		$query = "SELECT * FROM relacao_type_funcao JOIN user_type ON fk_id_user_type=id_user_type WHERE fk_id_funcao='$id_funcao'";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
			$type = $row['type'];
			echo $type."<br>";
		}
		
	}
}
elseif(isset($_POST['nova_funcao'])){
	
}
else {
	include "includes/lista_funcoes.php";
}
?>