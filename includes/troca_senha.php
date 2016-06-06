<?php
if ((isset($_POST['senha_atual']))AND(isset($_POST['senha_nova']))AND(isset($_POST['senha_nova_2']))){
	include "includes/ChangePassword.php";
}
else {
	include "includes/form_troca_senha.php";
}
?>