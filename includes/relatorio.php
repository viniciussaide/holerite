<?php
foreach ($_SESSION['user_type'] as $type) {
	if (($type=='super_admin')||($type=='admin')){
		if (isset($_POST['relatorio'])){
			include ("includes/relatorio_chaves.php");
		}
		elseif(isset($_POST['order'])||isset($_POST['busca'])){
			include ("includes/lista_usuarios.php");
		}
		else {
			include ("includes/lista_usuarios.php");
		}
	}
}
?>
