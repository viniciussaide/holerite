<?php	
	$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn_root, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn_root, "utf8");
	$id_user_type = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['id_user_type']);
	$nome_grupo = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['nome_grupo']);
	if (isset($_SESSION['posts']['permissao_funcao'])){
		$permissao_funcao =  $_SESSION['posts']['permissao_funcao'];
	}
	if (isset($_SESSION['posts']['permissao_usuarios'])){
		$permissao_usuarios = $_SESSION['posts']['permissao_usuarios'];
	}
	if (isset($_SESSION['posts']['permissao_mensagem'])){
		$permissao_mensagem = $_SESSION['posts']['permissao_mensagem'];
	}
	$query = "UPDATE user_type SET type='$nome_grupo' WHERE id_user_type='$id_user_type'";
	$result = mysqli_query($conn_root, $query);
	if ($result){
		$query = "DELETE FROM relacao_type_funcao WHERE fk_id_user_type='$id_user_type'";
		mysqli_query($conn_root, $query);
		if (isset($permissao_funcao)){
			foreach ($permissao_funcao as $permissao){
				$permissao = mysqli_real_escape_string ($conn_root,$permissao);
				$query = "INSERT INTO relacao_type_funcao (`fk_id_funcao`, `fk_id_user_type`) VALUES ('$permissao','$id_user_type')";
				mysqli_query($conn_root, $query);
			}
		}
		$query = "DELETE FROM relacao_type_user WHERE fk_id_user_type='$id_user_type'";
		mysqli_query($conn_root, $query);
		if (isset($permissao_usuarios)){
			foreach ($permissao_usuarios as $permissao){
				$permissao = mysqli_real_escape_string ($conn_root,$permissao);
				$query = "INSERT INTO relacao_type_user (`fk_matricula`, `fk_id_user_type`) VALUES ('$permissao','$id_user_type')";
				mysqli_query($conn_root, $query);
			}
		}
		$query = "DELETE FROM relacao_type_mensagem WHERE fk_id_user_type='$id_user_type'";
		mysqli_query($conn_root, $query);
		if (isset($permissao_mensagem)){
			foreach ($permissao_mensagem as $permissao){
				$permissao = mysqli_real_escape_string ($conn_root,$permissao);
				$query = "INSERT INTO relacao_type_mensagem (`fk_id_mensagem`, `fk_id_user_type`) VALUES ('$permissao','$id_user_type')";
				mysqli_query($conn_root, $query);
			}
		}
		include "includes/salvo_com_sucesso.php";
		include "includes/lista_grupos.php";
	}
	else {
		include "includes/salvo_com_erro.php";
		include "includes/lista_grupos.php";
	}
	mysqli_close($conn_root);
?>