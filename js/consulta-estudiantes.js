	//Datatables estudiantes
	$(document).ready( function () {
		var table = $('#estudiantes').DataTable({
			
			"order": [[ 0, "desc" ]],
			"pagingType": "full",
			"language": {"url": "../../js/datatables-español.json"},
			
			dom: 'Bfrtip',
			buttons: [
				// Botones de exportación a excel
				{
					extend: 			'collection',
					className: 		'btn btn-secondary dropdown-toggle',
					text: 				'<i class="fas fa-lg fa-file-export me-2"></i>Generar reporte',
					span: 				'container',
					autoClose: 		true,	
					popoverTitle: 'Seleccione la información a exportar',
					buttons: [

						// Reporte de estudiantes
						{
							extend: 		'excelHtml5',
							text: 			'<i class="fas fa-lg fa-children me-2"></i>Estudiantes',
							exportOptions: {
								columns: [1,2,3,4,5,6,7,8,9,10],
							},
							autoFilter: true,
							filename: 	'Reporte de datos de estudiantes',
							sheetName: 	'Datos de estudiantes',
							messageTop: 'Datos de estudiantes',
						},

						// Reporte médico
						{
							extend: 		'excelHtml5',
							text: 			'<i class="fas fa-lg fa-notes-medical me-2"></i>Reporte médico',
							exportOptions: {
								columns: [1,2,3,5,7,11,12,13,14,15,16,17,18,19,20,21],
							},
							autoFilter: true,
							filename: 	'Reporte médico de estudiantes',
							sheetName: 	'Fichas médicas de estudiantes',
							messageTop: 'Fichas médicas de estudiantes',
						},

						// Reporte de estudiantes y su representante
						{
							extend: 		'excelHtml5',
							text: 			'<i class="fas fa-lg fa-people-roof me-2"></i>Estudiante-Representante',
							exportOptions: {
								columns: [1,2,3,4,5,6,7,8,9,10,23,24,25,26,27,28],
							},
							autoFilter: true,
							filename: 	'Reporte de estudiantes-representantes',
							sheetName: 	'Reporte de estudiantes',
							messageTop: 'Reporte de estudiantes',
						},

						// Reporte general de estudiantes
						{
							extend: 		'excelHtml5',
							text: 			'<i class="fas fa-lg fa-clipboard-check me-2"></i>Todo',
							exportOptions: {
								columns: 	':not(:last-child)',
							},
							autoFilter: true,
							filename: 	'Reporte general de estudiantes',
							sheetName: 	'Reporte general de estudiantes',
							messageTop: 'Reporte general de estudiantes',
						}
					]
				}
				
			],

			responsive: 	
			{
				// Modal responsive
				details: {
          display: $.fn.dataTable.Responsive.display.modal( {
              header: function ( row ) {
                  var data = row.data();
                  return 'Detalles de '+data[2];
              }
          } ),
          renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
              tableClass: 'table table-borderless table-striped '
          })
        }
      }

		});
	});