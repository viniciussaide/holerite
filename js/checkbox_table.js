	  $('#lista_usuario tr').click(function(event) {
		if (event.target.type !== 'checkbox') {
		  $(':checkbox', this).trigger('click');
		}
	  });