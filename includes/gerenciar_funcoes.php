<?php
if (isset($_SESSION['posts']['seleciona_funcao'])){
	include "includes/editar_funcoes.php";
	unset($_SESSION['posts']);
}
elseif(isset($_SESSION['posts']['alterar_funcao'])){
	$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn_root, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn_root, "utf8");
	
	$i = 1;
	$id_funcao = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['id_funcao']);
	$nome_funcao = mysqli_real_escape_string ( $conn_root, $_SESSION['posts']['nome_funcao']);
	$pagina_php = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['pagina_php']);
	$nome_menu = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['nome_menu']);
	$tipo_menu = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['tipo_menu']);
	$menu_pai = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['menu_pai']);
	$permissao = $_SESSION['posts']['permissao'];
	$prioridades = $_SESSION['posts']['prioridades'];
	if ($pagina_php==''){
		$pagina_php='#';
	}
	if ($menu_pai<>'--'){
		$tipo_menu = $menu_pai;
	}
	$query = "UPDATE funcao SET funcao='$nome_funcao', pagina_php='$pagina_php', nome_menu='$nome_menu', tipo_menu='$tipo_menu' WHERE id_funcao='$id_funcao'";
	$result = mysqli_query($conn_root, $query);
	Kint::dump( $result );
	Kint::dump( $query );
	foreach ($prioridades as $prioridade){
		$prioridade = mysqli_real_escape_string ($conn_root,$prioridade);
		$query = "UPDATE funcao SET prioridade='$i' WHERE id_funcao='$prioridade'";
		$result = mysqli_query($conn_root, $query);
		Kint::dump( $result );
		Kint::dump( $query );
		$i += 1;
	}
	$query = "DELETE FROM relacao_type_funcao WHERE fk_id_funcao='$id_funcao'";
	$result = mysqli_query($conn_root, $query);
	Kint::dump( $result );
	Kint::dump( $query );
	foreach ($permissao as $user_type){
		$user_type = mysqli_real_escape_string ($conn_root,$user_type);
		$query = "INSERT INTO relacao_type_funcao (`fk_id_funcao`, `fk_id_user_type`) VALUES ('$id_funcao','$user_type')";
		$result = mysqli_query($conn_root, $query);
		Kint::dump( $result );
		Kint::dump( $query );
	}
	mysqli_close($conn_root);
	unset($_SESSION['posts']);
}
else {
	include "includes/lista_funcoes.php";
	unset($_SESSION['posts']);
}
?>