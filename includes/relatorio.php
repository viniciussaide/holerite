<?php
	if (isset($_SESSION['posts']['relatorio'])){
		include ("includes/relatorio_chaves.php");
		unset ($_SESSION['posts']);
	}
	elseif(isset($_SESSION['posts']['order'])||isset($_SESSION['posts']['busca'])){
		include ("includes/lista_usuarios.php");
		unset ($_SESSION['posts']);
	}
	else {
		include ("includes/lista_usuarios.php");
		unset ($_SESSION['posts']);
	}
?>
