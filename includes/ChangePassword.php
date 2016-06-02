<?php
	
	$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS)
	or die ("erro ao conectar");
	
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");

	$user_name = $_SESSION['user_name'];
	$senha_atual = $_POST['senha_atual'];
	$senha_nova = $_POST['senha_nova'];
	$senha_nova_2 = $_POST['senha_nova_2'];

	$sql = "SELECT matricula, cpf, nome, user_password_hash FROM users
                        WHERE matricula = '" . $user_name."'";
    $result_of_login_check = mysqli_query($conn, $sql);
    // if this user exists
    if ($result_of_login_check->num_rows == 1) {
    	// get result row (as an object)
	    $result_row = $result_of_login_check->fetch_object();
        // using PHP 5.5's password_verify() function to check if the provided password fits
        // the hash of that user's password
		if ($_POST['senha_atual']==''){
			header("Location: index.php");
			}
        if (password_verify($_POST['senha_atual'], $result_row->user_password_hash)) {	
			if($senha_nova == $senha_nova_2) {
				if ($senha_nova==''){
					header("Location: index.php");
				}
				$senha_nova = password_hash($senha_nova, PASSWORD_DEFAULT);
				$query_atualiza_senha = "UPDATE users SET user_password_hash = '".$senha_nova."' WHERE matricula ='".$user_name."'";
				$result = mysqli_query($conn, $query_atualiza_senha);
				if($result) {
					header("Location: index.php?pagina=SenhaSucesso.php");
                }	
			} else {
				header("Location: index.php?pagina=SenhaNcombinam.php");
				echo "<div class='alert alert-danger' role='alert'>";
			}
        } else {
			header("Location: index.php?pagina=SenhaErrada.php");
        }
    } else {
		header("Location: index.php?pagina=UserErrado.php");
    }
	


?>