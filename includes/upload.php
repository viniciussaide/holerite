<!--
<form action="upload.php" method="post" enctype="multipart/form-data">
	Selecione .csv: 
	<input type="file" name="teste" id='teste' accept=".xls,.xlsx,.csv,.txt">
	<input type="submit" value="Enviar Arquivo" name="submit">
</form>
-->
<?php
$uploaddir = 'upload/';
$uploadfile = $uploaddir . basename($_FILES['teste']['name']);
$filetype = pathinfo($uploadfile,PATHINFO_EXTENSION);
if ($filetype=='csv'){
	move_uploaded_file($_FILES['teste']['tmp_name'], $uploadfile);
	print_r($_FILES);
}
echo $filetype;
?>