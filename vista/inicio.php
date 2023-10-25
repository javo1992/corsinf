<?php 

include('../cabeceras/header.php');

if($_GET['acc']=='perfil')
{
	include('perfil.php');
}
if($_GET['acc']=='descargas')
{
	include('ACTIVOS/descargas.php');
}

if($_GET['acc']=='pagina_error')
{
	include('pagina_error.php');
}

//ACTIVOS
	if($_GET['acc']=='articulos')
	{
		include('ACTIVOS/articulos.php');
	}
	if($_GET['acc']=='cambios_custodio_localizacion')
	{
		include('ACTIVOS/cambios_custodio_localizacion.php');
	}
	if($_GET['acc']=='lista_patrimoniales')
	{
		include('ACTIVOS/lista_patrimoniales.php');
	}
	if($_GET['acc']=='detalle_articulo')
	{
		include('ACTIVOS/detalle_articulo.php');
	}
	if($_GET['acc']=='cargar_bajas')
	{
		include('ACTIVOS/cargar_bajas.php');
	}
	if($_GET['acc']=='cargar_datos')
	{
		include('ACTIVOS/cargar_datos.php');
	}
	if($_GET['acc']=='parametros_art')
	{
		include('ACTIVOS/parametros_art.php');
	}
	if($_GET['acc']=='localizacion')
	{
		include('ACTIVOS/localizacion.php');
	}
	if($_GET['acc']=='localizacion_detalle')
	{
		include('ACTIVOS/localizacion_detalle.php');
	}
	if($_GET['acc']=='custodio')
	{
		include('ACTIVOS/custodio.php');
	}
	if($_GET['acc']=='custodio_detalle')
	{
		include('ACTIVOS/custodio_detalle.php');
	}
	if($_GET['acc']=='proyectos')
	{
		include('ACTIVOS/proyectos.php');
	}
	if($_GET['acc']=='detalle_proyectos')
	{
		include('ACTIVOS/detalle_proyectos.php');
	}
	if($_GET['acc']=='clase_movimiento')
	{
		include('ACTIVOS/clase_movimiento.php');
	}
	if($_GET['acc']=='detalle_clase_movimiento')
	{
		include('ACTIVOS/detalle_clase_movimiento.php');
	}
	if($_GET['acc']=='impresiones_tag')
	{
		include('ACTIVOS/impresiones_tag.php');
	}
	if($_GET['acc']=='actas')
	{
		include('ACTIVOS/actas.php');
	}
	if($_GET['acc']=='reportes')
	{
		include('ACTIVOS/reportes.php');
	}
	if($_GET['acc']=='nuevo_reporte')
	{
		include('ACTIVOS/nuevo_reporte.php');
	}	
	if($_GET['acc']=='reporte_detalle')
	{
		include('ACTIVOS/reporte_detalle.php');
	}
	if($_GET['acc']=='siniestros')
	{
		include('ACTIVOS/siniestros.php');
	}	
	if($_GET['acc']=='lista_contratos')
	{
		include('ACTIVOS/lista_contratos.php');
	}
	if($_GET['acc']=='contratos')
	{
		include('ACTIVOS/contratos.php');
	}
	if($_GET['acc']=='bajas')
	{
		include('ACTIVOS/bajas.php');
	}
	if($_GET['acc']=='terceros')
	{
		include('ACTIVOS/terceros.php');
	}
	if($_GET['acc']=='patrimoniales')
	{
		include('ACTIVOS/patrimoniales.php');
	}
	if($_GET['acc']=='reporte_detalle')
	{
		include('ACTIVOS/reporte_detalle.php');
	}

//EMPRESA
	if($_GET['acc']=='usuarios')
	{
		include('EMPRESA/usuarios.php');
	}
	if($_GET['acc']=='tipo_usuario')
	{
		include('EMPRESA/tipo_usuario.php');
	}
	if($_GET['acc']=='modulos_paginas')
	{
		include('EMPRESA/modulos_paginas.php');
	}
	if($_GET['acc']=='vinculacion')
	{
		include('EMPRESA/vinculacion.php');
	}
	if($_GET['acc']=='detalle_usuario')
	{
		include('EMPRESA/detalle_usuario.php');
	}


//SEGUROS
	if($_GET['acc']=='lista_solicitudes')
	{
		include('SEGUROS/lista_solicitudes.php');
	}
	if($_GET['acc']=='ingresar_proceso')
	{
		include('SEGUROS/ingresar_proceso.php');
	}
	if($_GET['acc']=='formulario_prestamos')
	{
		include('SEGUROS/formulario_prestamos.php');
	}

//LIBRERIA
	if($_GET['acc']=='nuevo_libro')
	{
		include('LIBRERIA/nuevo_libro.php');
	}
	if($_GET['acc']=='lista_libros')
	{
		include('LIBRERIA/lista_libros.php');
	}
	if($_GET['acc']=='detalle_libro')
	{
		include('LIBRERIA/detalle_libro.php');
	}


if($_GET['acc']=='index')
{
	// print_r($_SESSION['INICIO']);die();
	switch($_SESSION['INICIO']['MODULO_SISTEMA'])
	{
		case '1':
			include('EMPRESA/index.php');
			break;
		case '2':
		include('ACTIVOS/index.php');
			break;
		case '3':
		include('SRI/index.php');
			break;
		case '4':
		include('LIBRERIA/index.php');
			break;
		case '5':
			include('SEGUROS/index.php');
			break;
		case '6':
			include('SEGUROS/index.php');
			break;
		case 'variable':
		
			break;
	}


}


include('../cabeceras/footer.php');

?>