<?php
	$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn_root, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn_root, "utf8");
	$titulo_mensagem = mysqli_real_escape_string ( $conn_root, $_SESSION['posts']['titulo']);
	$descricao_mensagem = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['descricao']);
	$mensagem = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['mensagem']);
	$data_inicio = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['data_inicio']);
	if ($data_inicio<>''){
		$data_inicio = substr($data_inicio,6,4)."-".substr($data_inicio,3,2)."-".substr($data_inicio,0,2);
	}
	$data_fim = mysqli_real_escape_string ( $conn_root,$_SESSION['posts']['data_fim']);
	if ($data_fim<>''){
		$data_fim = substr($data_fim,6,4)."-".substr($data_fim,3,2)."-".substr($data_fim,0,2);
	}
	if (isset($_SESSION['posts']['tela_inicial'])){
		$tela_inicial = 1;
	}
	else {
		$tela_inicial = 0;
	}
	if (isset($_SESSION['posts']['permissao_usuarios'])){
		$lista_usuarios = $_SESSION['posts']['permissao_usuarios'];
	}
	if (isset($_SESSION['posts']['permissao'])){
		$permissao_edicao = $_SESSION['posts']['permissao'];
	}
	$query = "INSERT INTO mensagem (`id_mensagem`, `descricao`, `titulo`, `mensagem`, `data_inicio`, `data_fim`, `tela_inicial`) VALUES ('','$descricao_mensagem','$titulo_mensagem', '$mensagem', '$data_inicio', '$data_fim', '$tela_inicial')";
	$result = mysqli_query($conn_root, $query);
	$id_mensagem = mysqli_insert_id($conn_root);
	if ($result){
		$query = "DELETE FROM relacao_type_mensagem WHERE fk_id_mensagem='$id_mensagem'";
		$result = mysqli_query($conn_root, $query);
		if ($result){
			if (isset($permissao_edicao)){
				$query = "INSERT INTO relacao_type_mensagem (`fk_id_user_type`, `fk_id_mensagem`) VALUES ('1','$id_mensagem')";
				mysqli_query($conn_root, $query);
				foreach ($permissao_edicao as $permissao){
					$permissao = mysqli_real_escape_string ($conn_root,$permissao);
					$query = "INSERT INTO relacao_type_mensagem (`fk_id_user_type`, `fk_id_mensagem`) VALUES ('$permissao','$id_mensagem')";
					mysqli_query($conn_root, $query);
				}
				$query = "DELETE FROM relacao_mensagem_user WHERE fk_id_mensagem='$id_mensagem'";
				mysqli_query($conn_root, $query);
				if ($result){
					if (isset($lista_usuarios)){
						foreach ($lista_usuarios as $usuario){
							$usuario = mysqli_real_escape_string ($conn_root,$usuario);
							$query = "INSERT INTO relacao_mensagem_user (`fk_id_mensagem`, `fk_matricula`, `data_visualizacao`) VALUES ('$id_mensagem', '$usuario', NULL);";
							mysqli_query($conn_root, $query);
						}
						include "includes/salvo_com_sucesso.php";
						include "includes/lista_mensagens.php";
					}
				}
				else {
					include "includes/salvo_com_erro.php";
					include "includes/lista_mensagens.php";
				}
			}
		}
		else {
			include "includes/salvo_com_erro.php";
			include "includes/lista_mensagens.php";
		}
	}
	else {
		include "includes/salvo_com_erro.php";
		include "includes/lista_mensagens.php";
	}
?>