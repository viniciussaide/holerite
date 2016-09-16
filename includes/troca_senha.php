<?php
if ((isset($_SESSION['posts']['senha_atual']))AND(isset($_SESSION['posts']['senha_nova']))AND(isset($_SESSION['posts']['senha_nova_2']))){
	include "includes/ChangePassword.php";
}
elseif(isset($_SESSION['posts']['alterar_email'])){
	include "includes/alterar_email.php";
}
else{
	include "includes/form_troca_senha.php";
}
unset ($_SESSION['posts']);
?>