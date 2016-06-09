<?php
include 'verifica_senha.php';
?>
<div class="well">
    <p style="font-size:16px;"><b>Seja bem vindo!</b></p><br>
    <p align='justify'>
    Este é o mais novo portal com informações relevantes para facilitar a comunicação entre a empresa
	<b><i>Sankyu S/A</i></b> e seus colaboradores. O intuito principal, é a disponibilização dos holerites (contra-cheques) dos últimos 6 meses.
	Ou seja, todo colaborador poderá acessar e imprimir o seu contra-cheque de qualquer lugar, no trabalho, de casa, pelo seu smartphone, 
	lanhouse ou qualquer outro dispositivo que esteja conectado a internet. 
	Com isso, estamos economizando com tempo e estamos também diminuindo a burocracia com a divulgação de certas informações. 
	Esse é mais um avanço da <b><i>Sankyu S/A</i></b> e de certo que será um grande ganho para o colaborador. </br></br>
    Contamos com a colaboração de todos.</br></br>
    <p align="right" style="font-family:Cambria; font-size:18px; line-height:1px;">Carlos Ito</p>
    <p align="right">Diretor Executivo</p></br>
    <p align='justify'>Qualquer dúvida, crítica ou sugestões referentes a este novo canal de comunicação, favor entrar em contato <a href="?pagina=contato.php">clicando aqui.</a>Teremos o prazer em solucionar qualquer questão.
	</p>
</div>

<?php
/* 	$conn = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	$query = "SELECT * FROM holerite";
	$result = mysqli_query($conn, $query);
	if ($result){
		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
			$id_holerite = $row['id_holerite'];
			$matricula = $row['fk_matricula'];
			$data_credito = $row['data_credito'];
			$query = "UPDATE provento SET fk_holerite='$id_holerite' WHERE fk_matricula='$matricula' AND data_credito='$data_credito'";
			mysqli_query($conn, $query);
			$query = "UPDATE desconto SET fk_holerite='$id_holerite' WHERE fk_matricula='$matricula' AND data_credito='$data_credito'";
			mysqli_query($conn, $query);
		}
	}
	mysqli_close($conn); */
?>