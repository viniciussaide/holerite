function checkPass()
{
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
	var message = document.getElementById('confirmMessage');
	var goodColor = "#66cc66";
    var badColor = "#ff6666";
    if(pass1.value == pass2.value){
        pass2.style.background = goodColor;
		message.innerHTML = "Senhas combinam!";
		message.className = "hidden";
		document.getElementById('btn').disabled = false;
    }else{
        pass2.style.background = badColor;
		message.innerHTML = "Senhas não combinam";
		message.className = "alert alert-danger pull-left";
		document.getElementById('btn').disabled = "disabled";
    }
}