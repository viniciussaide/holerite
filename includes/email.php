<?php
$to       = 'informaticavr@sankyu.com.br';
$subject  = $_POST['assunto']." - ".$_SESSION['user_name'].":".$_SESSION['nome'];
$subject  = '=?UTF-8?B?' . base64_encode($subject) . '?=';
$message  = $_POST['mensagem'];
$headers  = 'From: Holerite_Online' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
if(mail($to, $subject, $message, $headers))
	include "includes/EmailSucesso.php";
else
	include "includes/EmailErro.php";
?>