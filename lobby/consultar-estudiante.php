<?php 

session_start();

if (!$_SESSION['login']) {
	header('Location: ../index.php');
	exit();
}

require('../clases/estudiante.php');
require('../clases/representantes.php');
require('../clases/padres.php');

require('../clases/ficha-medica.php');
require('../clases/sociales-estudiantes.php');
require('../clases/tallas-estudiantes.php');

require('../clases/grado.php');
require('../clases/año-escolar.php');
require('../clases/estudiantes-repitentes.php');

require('../controladores/conexion.php');

$conexion = conectarBD();

$Estudiante = new Estudiantes();
$Representante = new Representantes();
$Padre = new Padres();

$Datos_medicos = new FichaMedica();
$Datos_sociales = new DatosSociales();
$Datos_Tallas = new TallasEstudiante();
$Estudiante_repitente = new EstudiantesRepitentes();
$Grado = new GradoAcademico();
$Año = new Año_Escolar();

$estudiante = $Estudiante->consultarEstudiante($_POST['id_estudiante']);

$datos_medicos = $Datos_medicos->consultarFicha_Medica($_POST['id_estudiante']);
$datos_sociales = $Datos_sociales->consultarDatosSociales($_POST['id_estudiante']);
$datos_tallas = $Datos_Tallas->consultarTallasEstudiante($_POST['id_estudiante']);

$representante = $Representante->consultarRepresentante($_POST['id_representante']);

$estudiante_repitente = $Estudiante_repitente->consultarEstudiantesRepitentes($_POST['id_estudiante']);
$grado = $Grado->consultarGrado($_POST['id_estudiante']);

$padre = $Padre->consultarPadres($estudiante['idPadre']);

$nombres_estudiante = explode(" ",$estudiante['Nombres']);
$apellidos_estudiante = explode(" ",$estudiante['Apellidos']);

$nombres_representante = explode(" ",$representante['Nombres']);
$apellidos_representante = explode(" ",$representante['Apellidos']);

$nombres_padre = explode(" ",$padre['Nombres']);
$apellidos_padre = explode(" ",$padre['Apellidos']);

desconectarBD($conexion);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Consultar registros</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/colores.css"/>
	
</head>
<body>

	<div style="width: 80%; margin: auto; max-height: 85vh; overflow-y: auto;">

		<table id="estudiante" class="table table-bordered">
			<thead>
				<th colspan="4">Datos de inscripción del estudiante</th>
			</thead>
			<tbody>
				<tr>
					<th colspan="4">Datos del estudiante</th>
				</tr>
				<tr>
					<td>Nombres: <?php echo $estudiante['Nombres']?></td>
					<td>Apellidos: <?php echo $estudiante['Apellidos']?></td>
					<td>Cédula: <?php echo $estudiante['Cédula']?></td>
					<td>Género: <?php echo $estudiante['Género']?></td>
				</tr>
				<tr>
					<td colspan="2">Fecha_Nacimiento: <?php echo $estudiante['Fecha_Nacimiento']?></td>
					<td colspan="2">Lugar_Nacimiento: <?php echo $estudiante['Lugar_Nacimiento']?></td>
				</tr>
				<tr>
					<td colspan="4">Dirección: <?php echo $estudiante['Dirección']?></td>
				</tr>
				<tr>
					<td colspan="2">Correo_Electronico: <?php echo $estudiante['Correo_Electronico']?></td>
					<td colspan="2">Estado_Civil: <?php echo $estudiante['Estado_Civil']?></td>
				</tr>
				<tr>
					<td colspan="2">Teléfono_Principal: <?php echo $estudiante['Teléfono_Principal']?></td>
					<td colspan="2">Teléfono_Auxiliar: <?php echo $estudiante['Teléfono_Auxiliar']?></td>
				</tr>
				<tr>
					<td>Plantel_Procedencia: <?php echo $estudiante['Plantel_Procedencia']?></td>
					<td>Año a cursar: <?php echo $grado['Grado_A_Cursar']?></td>
					<td colspan="2">Periodo academico: <?php echo $Año->getInicio_Año_Escolar()."-".$Año->getFin_Año_Escolar()?></td>
				</tr>
				<tr>
					<th colspan="4">Datos médicos</th>
				</tr>
				<tr>
					<td>Estatura: <?php echo $datos_medicos['Estatura'] ?> </td>
					<td>Peso: <?php echo $datos_medicos['Peso'] ?> </td>
					<td>Indice: <?php echo $datos_medicos['Indice'] ?> </td>
					<td>Circ_Braquial: <?php echo $datos_medicos['Circ_Braquial'] ?> </td>
				</tr>
				<tr>
					<td>Lateralidad: <?php echo $datos_medicos['Lateralidad'] ?> </td>
					<td>Tipo_Sangre: <?php echo $datos_medicos['Tipo_Sangre']?></td>
				</tr>
				<tr>
					<td colspan="4">Medicación: <?php echo $datos_medicos['Medicación']?></td>
				</tr>
				<tr>
					<td colspan="4">Dieta_Especial: <?php echo $datos_medicos['Dieta_Especial']?></td>
				</tr>
				<tr>
					<td colspan="4">Impedimento_Físico: <?php echo $datos_medicos['Impedimento_Físico']?></td>
				</tr>
				<tr>
					<td colspan="4">Alergias: <?php echo $datos_medicos['Alergias']?></td>
				</tr>
					<td>Cond_Vista: <?php echo $datos_medicos['Cond_Vista']?></td>
					<td>Cond_Dental: <?php echo $datos_medicos['Cond_Dental']?></td>
					<td colspan="2">Carnet_Discapacidad: <?php echo $datos_medicos['Carnet_Discapacidad']?></td>
				</tr>
				<tr>
					<td colspan="4">Institucion_Medica: <?php echo $datos_medicos['Institucion_Medica']?></td>
				</tr>

				<tr>
					<th colspan="4">Datos sociales</th>
				</tr>
				<tr>
					<td>Posee_Canaima: <?php echo $datos_sociales['Posee_Canaima']?> </td>
					<td colspan="3">Condicion_Canaima: <?php echo $datos_sociales['Condicion_Canaima']?> </td>
				</tr>
				<tr>
					<td>Posee_Carnet_Patria: <?php echo $datos_sociales['Posee_Carnet_Patria']?> </td>
					<td colspan="1">Codigo_Carnet_Patria: <?php echo $datos_sociales['Codigo_Carnet_Patria']?> </td>
					<td colspan="2">Serial_Carnet_Patria: <?php echo $datos_sociales['Serial_Carnet_Patria']?> </td>
				</tr>
				<tr>
					<td colspan="4">Acceso_Internet: <?php echo $datos_sociales['Acceso_Internet']?> </td>
				</tr>
				<tr>
					<th colspan="4">Tallas</th>
				</tr>
				<tr>
					<td>Talla_Camisa: <?php echo $datos_tallas['Talla_Camisa']?> </td>
					<td>Talla_Pantalón: <?php echo $datos_tallas['Talla_Pantalón']?> </td>
					<td>Talla_Zapatos: <?php echo $datos_tallas['Talla_Zapatos']?> </td>
				</tr>
				<tr>
					<th colspan="4">Datos del representante</th>
				</tr>
				<tr>
					<td>Nombres: <?php echo $representante['Nombres']?></td>
					<td>Apellidos: <?php echo $representante['Apellidos']?></td>
					<td>Cédula: <?php echo $representante['Cédula']?></td>
					<td>Género: <?php echo $representante['Género']?></td>
				</tr>
				<tr>
					<td colspan="2">Fecha_Nacimiento: <?php echo $representante['Fecha_Nacimiento']?></td>
					<td colspan="2">Lugar_Nacimiento: <?php echo $representante['Lugar_Nacimiento']?></td>
				</tr>
				<tr>
					<td colspan="4">Dirección: <?php echo $representante['Dirección']?></td>
				</tr>
				<tr>
					<td colspan="2">Correo_Electronico: <?php echo $representante['Correo_Electronico']?></td>
					<td colspan="2">Estado_Civil: <?php echo $representante['Estado_Civil']?></td>
				</tr>
				<tr>
					<td colspan="2">Teléfono_Principal: <?php echo $representante['Teléfono_Principal']?></td>
					<td colspan="2">Teléfono_Auxiliar: <?php echo $representante['Teléfono_Auxiliar']?></td>
				</tr>
				<tr>
					<th colspan="4">Datos economicos</th>
				</tr>
				<tr>
					<td>Banco: <?php echo $representante['Banco']?></td>
					<td>Tipo_Cuenta: <?php echo $representante['Tipo_Cuenta']?></td>
					<td colspan="2">Cta_Bancaria: <?php echo $representante['Cta_Bancaria']?></td>
				</tr>
				<tr>
					<td colspan="4">Grado_Inst: <?php echo $representante['Grado_Inst']?></td>
				</tr>
				<tr>
					<td colspan="2">Empleo: <?php echo $representante['Empleo']?></td>
					<td colspan="2">Teléfono_Trabajo: <?php echo $representante['Teléfono_Trabajo']?></td>
				</tr>
				<tr>
					<td colspan="2">Remuneracion: <?php echo $representante['Remuneracion']?> Bs. (Aprox.)</td>
					<td colspan="2">Tipo_Remuneración: <?php echo $representante['Tipo_Remuneración']?></td>
				</tr>
				<tr>
					<td colspan="4">Lugar_Trabajo: <?php echo $representante['Lugar_Trabajo']?></td>
				</tr>
				<tr>
					<th colspan="4">Datos del padre o madre</th>
				</tr>
				<tr>
					<td>Nombres: <?php echo $padre['Nombres']?></td>
					<td>Apellidos: <?php echo $padre['Apellidos']?></td>
					<td>Cédula: <?php echo $padre['Cédula']?></td>
					<td>Género: <?php echo $padre['Género']?></td>
				</tr>
				<tr>
					<td>Fecha_Nacimiento: <?php echo $padre['Fecha_Nacimiento']?></td>
					<td colspan="2">Lugar_Nacimiento: <?php echo $padre['Lugar_Nacimiento']?></td>
					<td colspan="2">Parentezco: <?php echo $padre['Parentezco']?></td>
				</tr>
				<tr>
					<td colspan="4">Dirección: <?php echo $padre['Dirección']?></td>
				</tr>
				<tr>
					<td colspan="2">Correo_Electronico: <?php echo $padre['Correo_Electronico']?></td>
					<td colspan="2">Estado_Civil: <?php echo $padre['Estado_Civil']?></td>
				</tr>
				<tr>
					<td colspan="2">Teléfono_Principal: <?php echo $padre['Teléfono_Principal']?></td>
					<td colspan="2">Teléfono_Auxiliar: <?php echo $padre['Teléfono_Auxiliar']?></td>
				</tr>
			</tbody>
		</table>
		
		</div>
		
		<table style="width: 100%; text-align: center;" border="1" cellpadding="10">
			<tr>
				<td>
					<?php if ($_SESSION['usuario'][2] != "2"): ?>
					<form action="editar-estudiante.php" method="POST">
						<input type="hidden" name="id_estudiante" value="<?php echo $estudiante['idEstudiantes'];?>">
						<input type="hidden" name="id_representante" value="<?php echo $estudiante['idRepresentante'];?>">
						<input type="hidden" name="id_padre" value="<?php echo $estudiante['idPadre'];?>">
					
						<input class="btn btn-primary" type="submit" name="Editar estudiante" value="Editar estudiante">
					</form>
					<?php endif ?>
				</td>
				<td>
					<form action="../controladores/control-estudiantes.php" method="POST">
						<input type="hidden" name="id_estudiante" value="<?php echo $estudiante['idEstudiantes'];?>">
						<input type="hidden" name="id_representante" value="<?php echo $estudiante['idRepresentante'];?>">
						<input type="hidden" name="id_padre" value="<?php echo $estudiante['idPadre'];?>">

						<input class="btn btn-primary" type="submit" name="Eliminar estudiante" value="Eliminar estudiante">
					</form>
				</td>
				<td>
					<form action="../controladores/generar-planilla.php" method="POST">
						<input type="hidden" name="id_estudiante" value="<?php echo $estudiante['idEstudiantes'];?>">
						<input type="hidden" name="id_representante" value="<?php echo $estudiante['idRepresentante'];?>">
						<input type="hidden" name="id_padre" value="<?php echo $estudiante['idPadre'];?>">

						<input class="btn btn-primary" type="submit" name="Generar planilla" value="Generar planilla">
					</form>
				</td>
				<td><a class="btn btn-primary" href="index.php">Volver al menú</a></td>
			</tr>
		</table>
	</div>
<script type="text/javascript" src="../js/bootstrap.bundle.min"></script>
</body>
</html>