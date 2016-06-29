<?php
if (isset($_SESSION['posts']['seleciona_mensagem'])){
	include "includes/editar_mensagem.php";
}
elseif (isset($_SESSION['posts']['alterar_mensagem'])){
	include "includes/alterar_mensagem.php";
}
elseif(isset($_SESSION['posts']['nova_mensagem'])){
	include "includes/nova_mensagem.php";
}
elseif(isset($_SESSION['posts']['salvar_nova_mensagem'])){
	include "includes/salvar_nova_mensagem.php";
	Kint::dump($_SESSION['posts']);
}
elseif(isset($_SESSION['posts']['apagar_mensagem'])){
	include "includes/apagar_mensagem.php";
}
else {
	include "includes/lista_mensagens.php";
}
unset($_SESSION['posts']);
?>


