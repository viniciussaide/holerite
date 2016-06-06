function contador() {
	var digitado = document.getElementById('mensagem');
	var texto = document.getElementById('texto_contador');
		texto.innerHTML = "Limite de caracteres: " + (500 - digitado.value.length);
}