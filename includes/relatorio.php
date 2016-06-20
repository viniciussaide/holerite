<?php
if (isset($_SESSION['posts']['relatorio'])){
	include ("includes/relatorio_chaves.php");
}
elseif(isset($_SESSION['posts']['order'])||isset($_SESSION['posts']['busca'])){
	include ("includes/lista_usuarios.php");
}
else {
	include ("includes/lista_usuarios.php");
}
unset ($_SESSION['posts']);
?>
