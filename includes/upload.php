<?php
error_reporting(E_ALL ^ E_NOTICE);
require "includes/SpreadsheetReader.php";
use \PHPExcelReader\SpreadsheetReader as Reader;
	
if (isset($_SESSION['posts']['importar_holerite'])){
	$tmpdir = 'tmp/holerite/';
	$uploaddir = 'arquivos/holerite/';
	$tmpfile = $tmpdir . basename($_FILES['arquivo_holerite']['name']);
	$uploadfile = $uploaddir . basename($_FILES['arquivo_holerite']['name']);
	$filetype = pathinfo($tmpfile,PATHINFO_EXTENSION);
	if ($filetype=='txt'){
		move_uploaded_file($_FILES['arquivo_holerite']['tmp_name'], $tmpfile);
		$arquivo = fopen($tmpfile, "r");
		if($arquivo == false) die("Erro ao ler arquivo");
		$line = fgets($arquivo);
		$hash = substr($line,0,23);
		$nome = substr($line,35,10);
		$data_credito = substr($line,106,8);
		$select_data = "SELECT * FROM holerite WHERE data_credito = '$data_credito'";		
		$result = mysqli_query($conn, $select_data);
		fclose($arquivo);
		//Verifica se data já existe no sistema
		if(!mysqli_fetch_array($result, MYSQL_ASSOC)) {
			//Verifica a hash inicial para ver se o arquivo está dentro do padrão
			if (($hash=='0E00333377008300451416T') AND ($nome=='SANKYU S/A')){
				//Apaga arquivos anteriores agendados para upload
				$files = glob('arquivos_holerite/*');
				foreach($files as $file){
				  if(is_file($file))
					unlink($file);
				}
				//Arquivo correto, porém ainda é necessário mover da pasta temporária
				if (!copy($tmpfile, $uploadfile)) {
					$_SESSION['status_upload'] = 'Falha ao copiar';
				}
				else {
					//Sucesso no upload
					$_SESSION['status_upload'] = 'Sucesso';
					unlink ($tmpfile);
				}
			}
			else {
				//Arquivo não é o certo, pois hash inicial não bate com a verificação
				$_SESSION['status_upload'] = 'Arquivo incorreto';
				unlink ($tmpfile);
			}
		}
		else {
			//Data já existe no banco
			$_SESSION['status_upload'] = 'Data duplicada';
			unlink ($tmpfile);
		}
	}
	else {
		//Arquivo não é o certo, pois tipo do arquivo não bate com a verificação
		$_SESSION['status_upload'] = 'Arquivo incorreto';
		unlink ($tmpfile);
	}
	header('HTTP/1.1 303 See Other');
	header ("Location:?pagina=importar_holerite.php");
}
elseif (isset($_SESSION['posts']['importar_efetivo'])){
	$tmpdir = 'tmp/efetivo/';
	$uploaddir = 'arquivos/efetivo/';
	$tmpfile = $tmpdir . basename($_FILES['arquivo_efetivo']['name']);
	$uploadfile = $uploaddir . basename($_FILES['arquivo_efetivo']['name']);
	$filetype = pathinfo($tmpfile,PATHINFO_EXTENSION);
	if (($filetype=='xls') OR ($filetype=='xlsx')){
		move_uploaded_file($_FILES['arquivo_efetivo']['tmp_name'], $tmpfile);
		$data = new Reader($tmpfile);
		$itens = $data->rowcount($sheet_index=0);
		$coluna1 = $data->value(1,1);
		$coluna2 = $data->value(1,2);
		$coluna3 = $data->value(1,3);
		$coluna4 = $data->value(1,4);
		$coluna5 = $data->value(1,5);
		if (($coluna1=='Nº pessoal')AND($coluna2=='Nome completo')AND($coluna3=='Centro de custo')AND($coluna4=='VR')AND($coluna5=='Cargo')){
			$files = glob('arquivos/efetivo/*');
			foreach($files as $file){
			  if(is_file($file))
				unlink($file);
			}
			//Arquivo correto, porém ainda é necessário mover da pasta temporária
			if (!copy($tmpfile, $uploadfile)) {
				$_SESSION['status_upload'] = 'Falha ao copiar';
			}
			else {
				//Sucesso no upload
				$_SESSION['status_upload'] = 'Sucesso';
				unlink ($tmpfile);
			}
		}
		else {
			//Arquivo não é o certo, pois colunas não batem com a verificação
			$_SESSION['status_upload'] = 'Arquivo incorreto';
			unlink ($tmpfile);
		}
	}
	else {
		//Arquivo não é o certo, pois tipo do arquivo não bate com a verificação
		$_SESSION['status_upload'] = 'Arquivo incorreto';
		unlink ($tmpfile);
	}
	header('HTTP/1.1 303 See Other');
	header ("Location:?pagina=importar_efetivo.php");
}
else {
	echo "Problemas ao fazer upload!";
}
?>