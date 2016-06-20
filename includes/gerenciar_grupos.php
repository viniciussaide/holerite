<?php
if (isset($_SESSION['posts']['seleciona_grupo'])){
	include "includes/editar_grupo.php";
}
elseif(isset($_SESSION['posts']['alterar_grupo'])){
	include "includes/alterar_grupo.php";
}
elseif(isset($_SESSION['posts']['novo_grupo'])){
	include "includes/novo_grupo.php";
}
elseif(isset($_SESSION['posts']['apagar_grupo'])){
	include "includes/apagar_grupo.php";
}
elseif(isset($_SESSION['posts']['salvar_novo_grupo'])){
	include "includes/salvar_novo_grupo.php";
}
else {
	include "includes/lista_grupos.php";
}
unset($_SESSION['posts']);
?>