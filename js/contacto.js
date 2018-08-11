$('#btn-enviar').click(function(e) {
	/* Act on the event */
	e.preventDefault();
	var form = $(this).parents('form');
	var action = form.attr('action');
	var data = form.serialize();

	//validaciones
	var nombre = form.find('input[name=nombre]').val();
	if( nombre=='' || nombre == null){
		swal('Error', 'Debe ingresar su nombre!', 'error');
		return false;
	}
	var correo = form.find('input[name=correo]').val();
	if( correo=='' || correo == null){
		swal('Error', 'Debe ingresar su correo!', 'error');
		return false;
	}
	if(validarEmail(correo) == false){
		swal('Error', 'Direccion de correo invalido!', 'error');
		return false;
	}
	var mensaje = form.find('textarea[name=mensaje]').val();
	if( mensaje=='' || mensaje == null){
		swal('Error', 'Debe ingresar su mensaje!', 'error');
		return false;
	}
	if(mensaje.length < 8){
		swal('Error', 'Su mensaje debe tener 8 caracteres como minimo!', 'error');
		return false;
	}

	//enviamos todo
	
	$.ajax({
        url: "enviar.php",
        type: "POST",
        data: data,
        success: function(result) {
        	resultado = JSON.parse(result);
        	if(resultado.respuesta == "ok"){
        		$('#frmContacto')[0].reset();
        		swal('Buen trabajo!',   'Tu mensaje ha sido enviado',   'success' );
        	}else{
        		$('#frmContacto')[0].reset();
        		swal('Error', 'Tu mensaje no fue enviado!', 'error');
        	}
        }
    });

});

function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
    	return false;
    }else{
    	return true;
    }
}