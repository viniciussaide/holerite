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