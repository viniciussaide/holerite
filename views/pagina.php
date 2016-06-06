<?php	
	if(isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	
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
		include("includes/home.php"); 
?>