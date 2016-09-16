$(document).ready(function() {
	$("form").each(function(){
		if ($(this).is("#upload_holerite")) {
			var dados = jQuery( this ).serialize();
			jQuery.ajax({
				type: "POST",
				url: "uploadHolerite.php",
				data: dados,
				success: function( data )
				{
					$("#upload").append(data);
				}
			});
		};
	});
});