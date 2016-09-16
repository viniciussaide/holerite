<!DOCTYPE html>
<?php 
require_once("config/db.php");
error_reporting(E_ALL ^ E_NOTICE);
require "includes/SpreadsheetReader.php";
use \PHPExcelReader\SpreadsheetReader as Reader;
function randomCode($length = 4) {
    $characters = '23456789abcdefghkmnpqrstuvwxyzABCDEFGHKMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

	$matricula = null;
	$nome = null;
	$cpf = null;
	$mes = null;
	$ano = null;
	$data_credito = null;
	$cod_referencia_cred = null;
	$nome_credito = null;
	$valor_credito = null;
	$cod_referencia_deb = null;
	$nome_debito = null;
	$valor_debito = null;
	$salario_base = null;
	$base_inss = null;
	$base_irrf = null;
	$base_fgts = null;
	$fgts_mes = null;
	$total_credito = null;
	$total_debito = null;
	$valor_liquido = null;
	$uniqueCode = null;
	$dataCadastro = new DateTime();
	
	$conn = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	
	$bd = mysqli_select_db($conn, DB_NAME) or die("Não foi possível selecionar o banco de dados.");
	
	mysqli_set_charset($conn, "utf8");
	
	if (isset($_POST["arquivo_holerite"])){
		foreach($_POST["arquivo_holerite"] as $arquivo_holerite) {
			//abre arquivo em modo somente leitura com o parametro "r"
			$arquivo = fopen('arquivos/holerite/'.$arquivo_holerite, "r");
			echo $arquivo_holerite."<br>";
			//se não retornar arquivo nenhum, mostra mensagem de erro
			if($arquivo == false) die("Erro ao ler arquivo");	
			$cont = 0;
			
			$line = fgets($arquivo);
			if($line{0} =="0"){
					$ano = substr($line,96,4);
					$mes = substr($line,100,2);
					$data_credito = substr($line,106,8);
					$dia = substr($data_credito,2,2);
					$date = new DateTime($ano.'-'.$mes.'-'.$dia);
					$diff = $dataCadastro->diff($date);
					$diff = $dataCadastro->diff($date);
					$diff = $diff->format('%m');
					$dataCadastro = (new \DateTime())->format('Y-m-d H:i:s');
			}
			$select_mes = "SELECT mes FROM holerite WHERE data_credito = '$data_credito'";		
			$result = mysqli_query($conn, $select_mes);
			if ($diff<7){
				if(!mysqli_fetch_array($result, MYSQL_ASSOC)) {

				//enquanto existir linha no arquivo
				while(!feof($arquivo)) {
					//fgets retorna linha por linha do arquivo		
					$line = fgets($arquivo);
					
					
					//verifica se o início da linha é 1 [dados do funcionário do holerite_]
					if($line{0} == "1") {
						$matricula = substr($line,33,8);
						$cpf = substr($line,41,11);
						$nome = ucwords(strtolower(substr($line,52,40)));
						$cargo = substr($line,252,15);
						$user_password_hash = password_hash($cpf, MYSQL_ASSOC);
						$uniqueCode = randomCode();
						echo "</br>".$matricula." ";
						echo $cpf." ";
						echo $nome." ";
						echo $cargo." ";
						$nome = mysqli_real_escape_string($conn,$nome);
						$verifica_user = "SELECT * FROM users WHERE matricula = $matricula";
						$consulta = mysqli_query($conn, $verifica_user);
						if(mysqli_fetch_array($consulta, MYSQL_ASSOC)) {
							echo "Usuário existente <br>";				
						}else {			
							//insere efetivo no banco de dados = matricula, nome, password e email [email em branco]
							$query = "INSERT INTO users (matricula, cpf, nome, user_password_hash, uniqueCode, dataCadastro, id_sessao, cargo, email, fk_id_setor) VALUES ('$matricula', '$cpf','$nome','$user_password_hash', '$uniqueCode', '$dataCadastro','','','',NULL);";
							if(mysqli_query($conn, $query)){
								$query = "INSERT INTO relacao_type_user (fk_id_user_type, fk_matricula) VALUES ('2','$matricula');";
								mysqli_query($conn, $query);
								echo "Efetivo atualizado com sucesso. <br>";
							}
							else{
								echo "Efetivo não atualizado. Problema na query. <br>";
								echo mysqli_error($conn)."<br>";
							}
						}
						$sql = "INSERT INTO holerite (id_holerite, fk_matricula, mes, ano, data_credito, dataCadastro)
						VALUES('','$matricula','$mes','$ano','$data_credito', '$dataCadastro');";
						if($result = mysqli_query($conn, $sql)) {
							echo "Dados inseridos com sucesso";
							$id_holerite = mysqli_insert_id($conn);
						}else {
							echo mysqli_error($conn);	
						}
						?><br><br><?php
					
					//verifica se o início da linha é 2 [descontos e proventos do holerite]
					} if($line{0} == "2") {
						?><br><?php
						//se for crédito, retorna os créditos do funcionário
						if($line{146} == "C") {								
							$cod_credito = substr($line,27,4);
							$nome_credito = substr($line,31,25);
							$credito = substr($line,57,7).",".substr($line,64,2);
							$historico =  substr($line,156,5);
							$i = 0;
							while ($credito{$i}=="0"){
								$i++;
							}
							if ($credito{$i}==","){
								$i--;
							}
							$valor_credito = substr($credito,$i,strlen($credito));							
							$cod_referencia_cred = substr($line,156,3).".".substr($line,159,2);			
							echo "C ".$cod_credito." ";
							echo $nome_credito." ";
							echo $valor_credito." ";
							echo $cod_referencia_cred." ";
							echo $historico." ";
							$tipo_1 = strpos($nome_credito,"SALARIO BASE");
							$tipo_2 = strpos($nome_credito,"HORAS REPOUSO");
							$tipo_3 = strpos($nome_credito,"13(o) SALARIO - DEZEMBR");
							$tipo_4 = strpos($nome_credito,"FERIAS NO MES SEGUINTE");
							$tipo_5 = strpos($nome_credito,"BOLSA COMPL. EDUCACIONA");
							if ($tipo_4===0){
								$tipo_4 = null;
							}
							else{
								$tipo_4 = strpos($nome_credito,"FERIAS NO MES");
							}
							//echo "1-$tipo_1,2-$tipo_2,3-$tipo_3,4-$tipo_4,5-$tipo_5";
							
							if(($tipo_1===0)||($tipo_2===0)||($tipo_3===0)||($tipo_4===0)||($tipo_5===0)) {
								if ($historico!="00000"){
									echo "Salário base atualizado com sucesso! ";
									$salario_base = floatval (str_replace(",",".",$salario_base)) + floatval (str_replace(",",".",$valor_credito));
									$salario_base = str_replace(".",",",strval(sprintf("%01.2f", $salario_base)));
								}
							}
							//inserindo os dados na tabela proventos. Dados do holerite referentes ao CREDITO.
							$sql = "INSERT INTO provento (id_provento, fk_holerite, cod_referencia_cred, nome_credito, valor_credito)
								VALUES('','$id_holerite','$cod_referencia_cred','$nome_credito','$valor_credito');";
							if($result = mysqli_query($conn, $sql)) {				
								echo "Dados inseridos com sucesso";
							}else {
								echo mysqli_error($conn);
							}
						}
						//tratamento se forem débitos
						if($line{146} == "D") {
							$cont = 0;
							$cod_debito = substr($line,27,4);
							$nome_debito = substr($line,31,25);
							$debito = substr($line,57,7).",".substr($line,64,2);
							$i = 0;
							while ($debito{$i}=="0"){
								$i++;
							}
							if ($debito{$i}==","){
								$i--;
							}
							$valor_debito = substr($debito,$i,strlen($debito));
							$cod_referencia_deb = substr($line,156,3).".".substr($line,159,2);
							echo "D ".$cod_debito." ";
							echo $nome_debito." ";
							echo $valor_debito." ";
							echo $cod_referencia_deb." ";
							
							//inserindo os dados na tabela descontos. Dados do holerite referentes ao DEBITO.
							$sql = "INSERT INTO desconto (id_desconto, fk_holerite, cod_referencia_deb, nome_debito, valor_debito)
								VALUES('','$id_holerite','$cod_referencia_deb','$nome_debito','$valor_debito');";
						
							if($result = mysqli_query($conn, $sql)) {				
								echo "Dados inseridos com sucesso";
							}else {
								echo mysqli_error($conn);
							}
						}
						
					//verifica se o início da linha é 3 [rodapé do holerite]
					} if($line{0} == "3") {
						?><br><br><?php
							//informação de total de créditos tratando os zeros na frente do valor.
							$total_credito = substr($line,36,13).",".substr($line,49,2);
							$i = 0;
							while ($total_credito{$i}=="0"){
								$i++;
							}
							if ($total_credito{$i}==","){
								$i--;
							}
							$total_credito = substr($total_credito,$i,strlen($total_credito));				
							
							//informações de total de débitos tratando os zeros na frente do valor.
							$total_debito = substr($line,21,13).",".substr($line,34,2);	
							$i = 0;
							while ($total_debito{$i}=="0"){
								$i++;
							}
							if ($total_debito{$i}==","){
								$i--;
							}
							$total_debito = substr($total_debito,$i,strlen($total_debito));				
						
							//informação de base INSS
							$base_inss = substr($line,116,7);
							echo "R$ ".$base_inss." ";
							
							//informação de BASE IRRF
							$base_irrf = substr($line,87,8);
							echo "R$ ".$base_irrf." ";
						
							//informação de BASE FGTS
							$base_fgts = substr($line,135,7);
							echo "R$ ".$base_fgts." ";
							
							//informação de FGTS depositado no mês
							$fgts_mes = substr($line,164,7);
							echo "R$ ".$fgts_mes." ";
							
							//informação sobre TOTAL líquido a receber.
							$valor_liquido = substr($line,51,13).",".substr($line,64,2);
							$i = 0;
							while ($valor_liquido{$i}=="0"){
								$i++;
							}
							if ($valor_liquido{$i}==","){
								$i--;
							}
							$valor_liquido = substr($valor_liquido,$i,strlen($valor_liquido));												
							
						?><br><br><?php	
						$sql = "INSERT INTO total_final (fk_id_holerite, salario_base, base_inss, base_irrf, base_fgts, fgts_mes, total_credito, total_debito, valor_liquido)
								VALUES('$id_holerite','$salario_base','$base_inss','$base_irrf','$base_fgts','$fgts_mes','$total_credito','$total_debito','$valor_liquido');";
						if($result = mysqli_query($conn, $sql)) {
							echo "Dados inseridos com sucesso";
							$salario_base = null;
						}else {
							echo mysqli_error($conn);	
						}
						?><br><br><?php
						echo "==============FIM=============";	?><br><br><?php
					}
				}
				//fim do if existe mes já cadastrado
				} else {
					echo "Período ".substr($data_credito,0,2)."/".substr($data_credito,2,2)." já cadastrado no sistema.</br>";	
				}
			fclose($arquivo);
			unlink('arquivos/holerite/'.$arquivo_holerite);
			}
			else{
				//exclusão de arquivos e dados no banco, caso o arquivo seja antigo
				$select_data = "SELECT dataCadastro FROM holerite WHERE data_credito = '$data_credito' LIMIT 1";		
				$result = mysqli_query($conn, $select_data);
				$row = mysqli_fetch_array($result, MYSQL_ASSOC);
				$dataCadastro = $row["dataCadastro"];
				$delete_holerite = "DELETE FROM holerite WHERE dataCadastro='$dataCadastro'";
				mysqli_query($conn, $delete_holerite);
				fclose($arquivo);
				echo $arquivo_holerite." foi apagado, por ter mais de 6 meses!</br>";
				unlink('arquivos/holerite/'.$arquivo_holerite);
			}
		}
		
	}
	if (isset($_POST["arquivo_efetivo"])){
		foreach($_POST["arquivo_efetivo"] as $arquivo_efetivo) {
			$data = new Reader(__DIR__ ."/arquivos/efetivo/".$arquivo_efetivo);
			$itens = $data->rowcount($sheet_index=0);
			for ($i=2; $i<=$itens;$i++){
				$matricula = $data->val($i,1);
				$setor = $data->val($i,4);
				$cargo = $data->val($i,5);
			 	$query = "INSERT INTO setor (setor) 
							SELECT '$setor' AS setor
							FROM dual
							WHERE NOT EXISTS(
								SELECT *
								FROM setor 
								WHERE setor = '$setor'
							);";
				mysqli_query($conn, $query);
				$query = "UPDATE users SET cargo='$cargo' WHERE matricula='$matricula';";
				mysqli_query($conn, $query);
				$query = "SELECT * FROM setor WHERE setor='$setor'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_array($result, MYSQL_ASSOC);
				$id_setor = $row['id_setor'];
				$query = "UPDATE users SET fk_id_setor=$id_setor WHERE matricula=$matricula;";
				$result = mysqli_query($conn, $query);
				if ($result){
					echo "Matrícula: $matricula Setor: $setor Cargo: $cargo >>>>Efetivo Atualizado</br>";
				}
			}
			unset($data);
			unlink('arquivos/efetivo/'.$arquivo_efetivo);
			//echo $data->dump(true,true);
		}
	}
	mysqli_close($conn);
?>
