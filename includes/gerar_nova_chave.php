<?php
function randomCode($length = 4) {
    $characters = '23456789abcdefghijkmnpqrstuvwxyzABCDEFGHKMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
$bd = mysqli_select_db($conn_root, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
mysqli_set_charset($conn_root, "utf8");
$uniqueCode = randomCode();
$matricula = $_SESSION['posts']['matricula'];
$query = "SELECT * FROM users where matricula = $matricula";
$result = mysqli_query($conn_root, $query);
if ($result){
	$row = mysqli_fetch_array($result,  MYSQL_ASSOC);
	$nome = $row['nome'];
	$query = "UPDATE users SET uniqueCode='".$uniqueCode."' WHERE matricula='".$matricula."'";
	$result = mysqli_query($conn_root, $query);
	if($result) {
		include "includes/salvo_com_sucesso.php";
		?>
		<div align='right' class='hidden-print'>
			<p>
			  <button type="button" class="btn btn-default" onClick='window.print()'>
			  <span><i class="glyphicon glyphicon-print"></i></span> Imprimir</button>
			</p>
		</div>	
		<div class='row' style='border-bottom: 1px solid #999999; border-top: 1px solid #999999; line-height: 1.2;'>
			<div class='col-xs-7' style='border-right: 1px solid #999999;'>
				<p align='center'><b>CHAVE DE SEGURANÇA</b></p>
				<p align='center' style='font-size: 12px;'>Holerite Online Sankyu: <b>http://holeriteonline.sankyu.com.br</b></p>
				<p style='font-size: 12px;'>Você está recebendo um código com 4 caracteres, ele será sua chave de segurança para acessar seu holerite, use-o em conjunto com sua senha pessoal. Guarde-o em local seguro, não revele a terceiros, ele é de uso pessoal e de sua responsabilidade.</p>
				<div align='center' style='font-size: 12px;'><i>Dúvidas entre em contato com a Administração.</i></div>
				<p align='center' style='font-size: 12px;'><i>Ramal: 6099</i></p>
			</div>
			<div class='col-xs-5'>
				</p>
				<p align='center'><b>ESTA É SUA CHAVE DE SEGURANÇA</b></p>
				<?php 
				echo "<p align=center style='font-size: 20px ;font-family:Palatino Linotype, Book Antiqua, Palatino, serif'><b>".$uniqueCode."</b></p>";
				?>
				<img class="img-responsive" src="imgs/logonovo.png" style="height: 30px;">
				</br>
				<p align='center' style='font-size: 12px;'>A chave de segurança deverá ser digitada como mostrada neste informe.</p>
			</div>
		</div>
		<div class='row' style='border-bottom: 1px solid #999999;'>
			<div class='col-xs-5'>
				<?php 
				echo "</p><p style='font-size: 12px;'>Nome: <b>".$nome."</b></p>";
				echo "<p style='font-size: 12px;'>Matrícula: <b>".$matricula."</b></p></div>";
				?>
			<div class='col-xs-4' style="margin-top: 13px;">
				<div align='center' style='font-size: 12px;'></p>Recebido em:____/_____/______.</div>
			</div>
			<div class='col-xs-3'>
				<div align='center' style="margin-top: 13px;">_______________________</div>
				<p align='center' style='font-size: 12px;'>Assinatura Empregado</p>
			</div>
		</div>
		<?php	
	}
	else {
		include "includes/salvo_com_erro.php";
		include "includes/lista_usuarios.php";
	}
}
mysqli_close($conn_root);
?>