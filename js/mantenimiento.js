//validacion y envio
$.fn.isValid = function(){
  return this[0].checkValidity()
}

//Boton para generar respaldo
$( "#boton-respaldar" ).click(function( event ) {
	event.preventDefault();

	//Pregunta si desea realizar la acción la cancela si selecciona NO
	Swal.fire({
		title: '¿Desea generar un respaldo?',
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#0d6efd',
		cancelButtonColor: '#d33',
		cancelButtonText: '¡No, detente! <i class="ms-1 fas fa-lg fa-thumbs-down"></i>',
		confirmButtonText: '<i class="me-1 fas fa-lg fa-thumbs-up"></i> ¡Sí, continua!'
	}).then((result) => {
		//Procede a continuar
		if (result.isConfirmed) {
			let timerInterval
			Swal.fire({
				title: '¡De acuerdo!',
				icon: 'success',
				text: 'Se generará un nuevo punto de respaldo.',
				timer: 1000,
				timerProgressBar: true,
				didOpen: () => {
					Swal.showLoading()
					const b = Swal.getHtmlContainer().querySelector('b')
					timerInterval = setInterval(() => {
						b.textContent = Swal.getTimerLeft()
					}, 100)
				},
				willClose: () => {
					clearInterval(timerInterval)
				}

			}).then((result) => {
				/* Read more about handling dismissals below */
				if (result.dismiss === Swal.DismissReason.timer) {
					console.log('Cerrado por el temporizador')
				}
				
			})
			$("#respaldar-bd").submit();
		}
		// Negar o presionar fuera de la alerta
		else {
			let timerInterval
			Swal.fire({
				title: '¡Accion cancelada!',
				icon: 'error',
				text: 'Se generará un nuevo punto de respaldo.',
				timer: 1000,
				timerProgressBar: true,
				didOpen: () => {
					Swal.showLoading()
					const b = Swal.getHtmlContainer().querySelector('b')
					timerInterval = setInterval(() => {
						b.textContent = Swal.getTimerLeft()
					}, 100)
				},
				willClose: () => {
					clearInterval(timerInterval)
				}
			}).then((result) => {
				/* Read more about handling dismissals below */
				if (result.dismiss === Swal.DismissReason.timer) {
					console.log('Cerrado por el temporizador')
				}
			})
		}
	})
});

$( "#boton-restaurar" ).click(function( event ) {
	if ($( "#FormularioRepresentante").isValid() == true) {
     // Envia el formulario si es valido
     $("#seccion2, #seccion3, #seccion4, #seccion5").hide();
     $("#link1").addClass("active");
          $( "#FormularioRepresentante" ).submit();
  }
  else { 
     //Da un mensaje de alerta si no es valido y retorna a la seccion de datos de contacto
     Swal.fire(
      'Atención',
      'Faltan campos por llenar <br><br> <span class="form-text">Será regresado a la primera sección, pero se mantendrán los cambios.</span>',
      'info'
    );
     $("#seccion2, #seccion3, #seccion4, #seccion5").hide();
     $("#link1").addClass("active");
  }
});