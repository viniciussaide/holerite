<?php
require 'php-debug-bar/Kint.class.php';

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Desculpe, sistema não roda com versões do php anteriores a 5.3.7!");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

//Inclui as configurações principais e constantes
require_once("config/db.php");

//Contador de visitas
require_once("includes/contador_principal.php");

//Inclui Classe de login
require_once("classes/Login.php");

//Inicia objeto de login, que realiza toda a operação de login
$login = new Login();
$manutencao = false;

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if ($manutencao){
	include("views/maintenance.php");
}
else {
	//Verifica se usuário possui uma sessão aberta
	if ($login->isUserLoggedIn() == true) {
		//Conexão com o banco para verificar se sessão aberta ainda é válida
		$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS) or die ("Erro ao conectar");
		$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
		$matricula = $_SESSION['user_name'];
		$sql = "SELECT id_sessao FROM users WHERE matricula = '$matricula'";
		$result_of_login_check = mysqli_query($conn, $sql);
		$result_row = mysqli_fetch_array($result_of_login_check);
		$id_sessao = $result_row['id_sessao'];
			
			//Testa se a sessão do usuário é válida
			if((isset($_COOKIE['id_sessao']))&&($id_sessao<>$_COOKIE['id_sessao'])){
				//Caso o cookie de id_sessao seja diferente do id_sessao no banco força logout
				header ("location:index.php?forcedlogout");
			}
			elseif ($id_sessao==''){
				//Caso id_sessao no banco esteja vazio, mesmo com login aberto, força logout
				header ("location:index.php?forcedlogout");
			}
			elseif (isset($_SESSION['id_sessao']) AND ($_SESSION['id_sessao']==$id_sessao)){
				//Se as sessão foi verificada, observa se o tempo da sessao é válido
				if ($_SESSION['tempo_sessao']<time()) {
					//Caso o tempo da sessão esteja esgotado, expira o login
					header ("location:index.php?timeout");
				}
				else {
					//Caso o tempo da sessão esteja correto, renova tempo da sessão
					include("views/logged_in.php");
				}
			}
			elseif (!(isset($_COOKIE['id_sessao'])) AND (isset($_SESSION['id_sessao']))) {
				//Casos raros onde os cookies são apagados manualmente com a sessao ainda aberta, expira o login
				header ("location:index.php?timeout");
			}
			else {
				//Caso possua algum erro não documentado, força logout
				header ("location:index.php?forcedlogout");
			}


	} else {
		//Caso queira mostrar uma mensagem para o usuário na tela inicial, chamar a função $login->message();
		//Para editar a mensagem, verificar o arquivo classes/login.php
		$login->message();
		
		//Caso usuário não possua sessão abre página inicial
		include("views/not_logged_in.php");
	}
}

/* if (isset($_SESSION['user_type'])){
	foreach ($_SESSION['user_type'] as $type){
		if ($type==1){
			echo "<div class='hidden-print'>";
			Kint::dump( $_SERVER['REQUEST_METHOD'] );
			Kint::dump( $_POST );
			Kint::dump( $_FILES );
			Kint::dump( $_SESSION );
			Kint::dump( $GLOBALS );
			echo "</div>";
		}
	}
} */

