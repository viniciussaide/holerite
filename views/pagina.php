<?php	
	if(isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	@$id = $_REQUEST['id'];
	echo $id;
	if(@$pagina == "")
		include("includes/home.php");
	elseif($pagina == "home.php")
		include("includes/home.php");
	elseif($pagina == "holerite.php")
		include("includes/holerite.php");
	elseif($pagina == "links.php")
		include("includes/links.php");	
	elseif($pagina == "contato.php")
		include("includes/contato.php");	
	elseif($pagina == "senha_request.php")
		include("includes/senha_request.php");
	elseif($pagina == "form_troca_senha.php")
		include("includes/form_troca_senha.php");
	elseif($pagina == "selectholerite.php")
		include("includes/selectholerite.php");
	elseif($pagina == "ChangePassword.php")
		include("includes/ChangePassword.php");
	elseif($pagina == "form_troca_senha.php")
		include("includes/form_troca_senha.php");
	elseif($pagina == "selectHolerite.php")
		include("includes/selectHolerite.php");
	elseif($pagina == "SenhaSucesso.php"){
		include("includes/SenhaSucesso.php");
		include("includes/form_troca_senha.php");
		}
	elseif($pagina == "SenhaErrada.php"){
		include("includes/SenhaErrada.php");
		include("includes/form_troca_senha.php");
		}
	elseif($pagina == "SenhaNcombinam.php"){
		include("includes/SenhaNcombinam.php");
		include("includes/form_troca_senha.php");
		}
	elseif($pagina == "UserErrado.php"){
		include("includes/UserErrado.php");
		include("includes/form_troca_senha.php");
		}
	elseif($pagina == "EmailSucesso.php"){
		include("includes/EmailSucesso.php");
		include("includes/home.php");
		}
	elseif($pagina == "EmailErro.php"){
		include("includes/EmailErro.php");
		include("includes/home.php");
		}
	elseif($pagina == "email.php"){
		include("includes/email.php");
		}
	elseif($pagina == "impostoRenda.php"){
		include("includes/impostoRenda.php");
		}
	elseif($pagina == "relatorio.php"){
		include("includes/relatorio.php");
		}
	elseif($pagina == "extrato_plr.php"){
		include("includes/extrato_plr.php");
		}
	else
		include("includes/home.php");
?>