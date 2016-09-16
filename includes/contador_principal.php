<?php
include ("contador.php");
   if (isset($_COOKIE['counte'])) {
      $counte = $_COOKIE['counte'] + 1;
  } else {
    $counte = 1;
    $a++;
	$abre =@fopen("contador.php","w");
	$ss ='<?php $a='.$a.'; ?>';
	$escreve =fwrite($abre, $ss);
}
setcookie('counte', "$counte", time()+1800);
?>