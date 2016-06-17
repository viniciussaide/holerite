<?php
if (isset($_SESSION['posts']['editar_funcao'])){
	include "includes/editar_funcao.php";
}
elseif(isset($_SESSION['posts']['nova_funcao'])){
	include "includes/nova_funcao.php";
}
elseif(isset($_SESSION['posts']['salvar_nova_funcao'])){
	include "includes/salvar_nova_funcao.php";
}
elseif(isset($_SESSION['posts']['alterar_funcao'])){
	include "includes/alterar_funcao.php";
}
elseif(isset($_SESSION['posts']['apagar_funcao'])){
	include "includes/apagar_funcao.php";
}
else {
	include "includes/lista_funcoes.php";
}
unset($_SESSION['posts']);
?>