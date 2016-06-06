<?php
include 'verifica_senha.php';
if (isset($_POST['mensagem'])){
	include "includes/email.php";
}
else {
	include "includes/form_contato.php";
}
?>