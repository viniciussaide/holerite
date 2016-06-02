	$(document).ready(function() {
		$("form").submit(function(){
			var dados = jQuery( this ).serialize();
			if (this.etapa.value=='senha_1'){
				jQuery.ajax({
					type: "POST",
					url: "senha_request_2.php",
					data: dados,
					success: function( data )
					{
						$(".form-horizontal").html(data);
					}
				});
			return false;
			}
			if (this.etapa.value=='senha_2'){
				jQuery.ajax({
					type: "POST",
					url: "senha_request_3.php",
					data: dados,
					success: function( data )
					{
						$(".form-horizontal").html(data);
					}
				});
			return false;
			}
			if (this.etapa.value=='senha_3'){
				jQuery.ajax({
					type: "POST",
					url: "senha_request_4.php",
					data: dados,
					success: function( data )
					{
						$(".form-horizontal").html(data);
					}
				});
			return false;
			}
		});
	});