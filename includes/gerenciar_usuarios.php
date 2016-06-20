<?php
if (isset($_SESSION['posts']['seleciona_usuario'])){
	include "includes/editar_usuario.php";
}
elseif (isset($_SESSION['posts']['relatorio'])){
	include ("includes/relatorio_chaves.php");
}
elseif(isset($_SESSION['posts']['reset_senha'])){
	echo "Reset Senha!";
	//include "includes/alterar_grupo.php";
}
elseif(isset($_SESSION['posts']['gerar_nova_chave'])){
	echo "Gerar nova chave!";
	//include "includes/novo_grupo.php";
}
elseif(isset($_SESSION['posts']['apagar_grupo'])){
	//include "includes/apagar_grupo.php";
}
elseif(isset($_SESSION['posts']['salvar_novo_grupo'])){
	//include "includes/salvar_novo_grupo.php";
}
else {
	include "includes/lista_usuarios.php";
}
unset($_SESSION['posts']);

?>
