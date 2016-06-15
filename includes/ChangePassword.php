<?php
	$user_name = $_SESSION['user_name'];
	$senha_atual = $_SESSION['posts']['senha_atual'];
	$senha_nova = $_SESSION['posts']['senha_nova'];
	$senha_nova_2 = $_SESSION['posts']['senha_nova_2'];

	$sql = "SELECT matricula, cpf, nome, user_password_hash FROM users
                        WHERE matricula = '" . $user_name."'";
    $result_of_login_check = mysqli_query($conn, $sql);
    // if this user exists
    if ($result_of_login_check->num_rows == 1) {
    	// get result row (as an object)
	    $result_row = $result_of_login_check->fetch_object();
        // using PHP 5.5's password_verify() function to check if the provided password fits
        // the hash of that user's password
		if ($_SESSION['posts']['senha_atual']==''){
			header("Location: index.php");
			}
        if (password_verify($_SESSION['posts']['senha_atual'], $result_row->user_password_hash)) {	
			if($senha_nova == $senha_nova_2) {
				if ($senha_nova==''){
					header("Location: index.php");
				}
				$senha_nova = password_hash($senha_nova, PASSWORD_DEFAULT);
				$query_atualiza_senha = "UPDATE users SET user_password_hash = '".$senha_nova."' WHERE matricula ='".$user_name."'";
				$result = mysqli_query($conn, $query_atualiza_senha);
				if($result) {
					include "includes/SenhaSucesso.php";
                }	
			} else {
				include "includes/SenhaNcombinam.php";
			}
        } else {
			include "includes/SenhaErrada.php";
        }
    } else {
		include "includes/UserErrado.php";
    }
	


?>