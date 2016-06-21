<?php
$gerenciar = "gerenciar_usuarios_super_admin.php";
if (isset($_SESSION['posts']['seleciona_usuario'])){
	include "includes/editar_usuario_super_admin.php";
}
elseif (isset($_SESSION['posts']['relatorio'])){
	include ("includes/relatorio_chaves.php");
}
elseif(isset($_SESSION['posts']['reset_senha'])){
	include "includes/reset_senha_usuario.php";
}
elseif(isset($_SESSION['posts']['gerar_nova_chave'])){
	include "includes/gerar_nova_chave.php";
}
elseif(isset($_SESSION['posts']['apagar_usuario'])){
	include "includes/apagar_usuario.php";
}
else {
	include "includes/lista_usuarios.php";
}
unset($_SESSION['posts']);
?>