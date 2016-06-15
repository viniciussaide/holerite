<?php
include 'verifica_senha.php';
if (isset($_SESSION['posts']['mensagem'])){
	include "includes/email.php";
	unset ($_SESSION['posts']);
}
else {
	include "includes/form_contato.php";
	unset ($_SESSION['posts']);
}
?>