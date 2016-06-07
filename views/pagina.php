<?php	
	if(isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	else {
		$pagina = "home.php";
	}
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ("erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	foreach ($_SESSION['user_type'] as $type){
		if ($restricao<>''){
			$restricao .= " OR ";
		}
		$restricao .= "fk_id_user_type = $type";
	}
	$query = "SELECT * FROM funcao JOIN relacao_type_funcao ON funcao.id_funcao = relacao_type_funcao.fk_id_funcao WHERE $restricao";
	$result = mysqli_query($conn, $query);
	if ($result){
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$pagina_php = $row['pagina_php'];
			if ($pagina==$pagina_php){
				include "includes/".$pagina_php;
				break;
			}
		}
	}
 	/* if(@$pagina == "")
		include("includes/home.php");
	elseif($pagina == "home.php")
		include("includes/home.php");
	elseif($pagina == "holerite.php")
		include("includes/holerite.php");
	elseif($pagina == "links.php")
		include("includes/links.php");	
	elseif($pagina == "contato.php")
		include("includes/contato.php");
	elseif($pagina == "troca_senha.php")
		include("includes/troca_senha.php");
	elseif($pagina == "ChangePassword.php")
		include("includes/ChangePassword.php");
	elseif($pagina == "selectHolerite.php")
		include("includes/selectHolerite.php");
	elseif($pagina == "SenhaSucesso.php")
		include("includes/SenhaSucesso.php");
	elseif($pagina == "SenhaErrada.php")
		include("includes/SenhaErrada.php");
	elseif($pagina == "SenhaNcombinam.php")
		include("includes/SenhaNcombinam.php");
	elseif($pagina == "UserErrado.php")
		include("includes/UserErrado.php");
	elseif($pagina == "EmailSucesso.php")
		include("includes/EmailSucesso.php");
	elseif($pagina == "EmailErro.php")
		include("includes/EmailErro.php");
	elseif($pagina == "email.php")
		include("includes/email.php");
	elseif($pagina == "impostoRenda.php")
		include("includes/impostoRenda.php");
	elseif($pagina == "relatorio.php")
		include("includes/relatorio.php");
	elseif($pagina == "extrato_plr.php")
		include("includes/extrato_plr.php");
	else
		include("includes/home.php");  */
?>