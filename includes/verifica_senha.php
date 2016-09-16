<?php
	$user_name = $_SESSION['user_name'];
	$sql = "SELECT * FROM users WHERE matricula = $user_name";
    $result_of_login_check = mysqli_query($conn, $sql);
	if($row = mysqli_fetch_array($result_of_login_check)){
			$password = $row['user_password_hash'];	
			$pass_verifica = $row['cpf'];
		if (password_verify($pass_verifica, $password)){?>
			<p>
				<div class="alert alert-danger hidden-print" role="alert">
				<a href='' class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Prezado(a) <strong><?php echo $row['nome']; ?></strong> verificamos que está utilizando a <b>senha padrão</b> do sistema.<br> Como precaução e para a segurança de suas informações, recomendamos a alteração da mesma clicando <a href="?pagina=troca_senha.php"><?php echo "aqui"; ?></a> ou em "Alterar Senha" no canto superior direito do seu navegador.
				</div>
			</p>
			<?php
		}
	}
?>