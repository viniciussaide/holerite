<?php
if (isset($_SESSION['status_upload'])){
	if ($_SESSION['status_upload']=='Falha ao copiar'){
		echo "<p><div class='alert alert-danger' role='alert'>
			<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Falha ao copiar o arquivo!
			</div></p>";
	}
	elseif ($_SESSION['status_upload']=='Sucesso'){
		echo "<p><div class='alert alert-success' role='alert'>
			<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Upload do arquivo feito com sucesso! A atualização está agendada para as 23:59 de hoje.
			</div></p>";
	}
	elseif ($_SESSION['status_upload']=='Data duplicada'){
		echo "<p><div class='alert alert-danger' role='alert'>
			<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Arquivo incorreto! Data do holerite já existente no banco de dados!
			</div></p>";
	}
	elseif ($_SESSION['status_upload']=='Arquivo incorreto'){
		echo "<p><div class='alert alert-danger' role='alert'>
			<span class='glyphicon glyphicon-remove' aria-hidden='true'></span> Arquivo incorreto! Este arquivo está fora dos padrões para upload!
			</div></p>";
	}
}

$dir = 'arquivos/holerite/';
$files = scandir($dir);
$qt_files = count(scandir($dir)) - 2;
if ($qt_files>=1){
	$nome_arquivo = $files[2];
	echo "<p><div class='alert alert-danger' role='alert'>
			<strong><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> Cuidado!</strong><br>O arquivo <strong>$nome_arquivo</strong> já está agendado para atualização as 23:59 de hoje. Se importar um novo arquivo, o mais antigo será apagado e não será atualizado no sistema!
		  </div></p>";
}
unset ($_SESSION['status_upload']);
?>
<form class="col-sm-12 well"  action="?pagina=importar_holerite.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8">
            Selecione o arquivo .txt: 
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10">           
            <input class='btn btn-newinfo' style='width:100%' type="file" name="arquivo_holerite" id='arquivo_holerite' accept=".txt" required>
        </div>
        <div class="col-sm-2">
            <input class='btn btn-newinfo'  type="submit" value="Enviar Arquivo" name="importar_holerite">
        </div>
    </div>
</form>