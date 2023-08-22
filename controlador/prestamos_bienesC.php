<?php 
include('../modelo/prestamos_bienesM.php');
require_once('../db/codigos_globales.php');
/**
 * 
 */
$controlador = new prestamos_bienesC();
if(isset($_GET['lista_bienes']))
{
	$query = '';
	if(isset($_GET['q']))
	{
		$query = $_GET['q'];
	}
	echo json_encode($controlador->lista_bienes($query));
}

if(isset($_GET['add_linea']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->add_linea($parametros));
}

if(isset($_GET['cargar_lineas']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->cargar_lineas($parametros));
}
if(isset($_GET['eliminar_solicitud']))
{
	// $parametros = $_POST['parametros'];
	echo json_encode($controlador->eliminar_solicitud());
}
if(isset($_GET['generar_solicitud']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->generar_solicitud($parametros));
}
if(isset($_GET['eliminar_linea']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->eliminar_linea($parametros));
}
if(isset($_GET['lista_solicitudes']))
{
	echo json_encode($controlador->lista_solicitudes());
}
if(isset($_GET['lista_solicitudes_all']))
{
	echo json_encode($controlador->lista_solicitudes_all());
}

class prestamos_bienesC
{
	private $modelo;
	private $cod_global;
	
	function __construct()
	{
		$this->modelo = new prestamos_bienesM();
		$this->cod_global = new codigos_globales();
	}

	function cargar_lineas($parametros)
	{
		$datos = $this->modelo->lineas_solicitud($parametros['id']);
		$soli = $this->modelo->datos_solicitud_all($parametros['id']);

		print_r($soli);die();
		$tr='';
		foreach ($datos as $key => $value) {
			$tr.="<tr>
			<td><button type='button' onclick='elimnar_linea(".$value["id_linea_salida"].")' class='btn btn-danger btn-sm'><i class='bx bx-trash'></i></button></td>
			<td>".$value["TAG_SERIE"]."</td>
			<td>".$value["DESCRIPT"]."</td>
			<td>".$value["SERIE"]."</td>
			<td>".$value["MODELO"]."</td>
			</tr>";
		}
		return $tr;
	}

	function eliminar_solicitud()
	{
		$datos = $this->modelo->lista_solicitudes_null();
		foreach ($datos as $key => $value) {
			$id = $value['id_solicitud'];
			$this->modelo->eliminar_solicitud($id);
		}
	}

	function eliminar_linea($parametros)
	{
		return $this->modelo->delete_lineas($parametros['id']);
		// print_r($parametros);die();
	}

	function generar_solicitud($parametros)
	{
		$tabla = "SOLICITUD_SALIDA";
		$datos[0]["campo"]= "estado";
		$datos[0]["dato"]= "0";

		$where[0]["campo"] = "id_solicitud";
		$where[0]["dato"] = $parametros['id'];

		return $this->modelo->update($tabla,$datos,$where);
		// print_r($parametros);die();
	}

	function lista_bienes($query)
	{		
		$datos = $this->modelo->buscar_bien($query);
		// print_r($datos);die();
		$list = array();
		foreach ($datos as $key => $value) {
			$list[] = array('id'=>$value['id'],'text'=>$value['TAG_SERIE'].'-'.$value['DESCRIPT']);
		}
		return $list;
	}

	function add_linea($parametros)
	{
		//ingresar solicitud
		$id = $parametros['id'];
		if($id=='')
		{
			$datos[0]['campo'] = 'solicitante';
			$datos[0]['dato'] = $parametros['solicitante'];
			$datos[1]['campo'] = 'fecha';
			$datos[1]['dato'] = $parametros['fecha'];
			$datos[2]['campo'] = 'fecha_salida';
			$datos[2]['dato'] = $parametros['fecha2'];
			$datos[3]['campo'] = 'fecha_regreso';
			$datos[3]['dato'] = $parametros['fecha3'];
			$datos[4]['campo'] = 'observacion';
			$datos[4]['dato'] = $parametros['observacion'];
			$this->modelo->add('SOLICITUD_SALIDA',$datos);
			$soli = $this->modelo->datos_solicitud($id=false,$parametros['solicitante'],$parametros['fecha'],$fecha_salida=false,$fecha_regreso=false,$observacion=false,$estado ='null');
			$id = $soli[0]['id_solicitud']; 
		}

			$datos2[0]['campo'] = 'id_solicitud';
			$datos2[0]['dato'] = $id;
			$datos2[1]['campo'] = 'id_activo';
			$datos2[1]['dato'] = $parametros['bien'];
			$this->modelo->add('LINEAS_SOLICITUD',$datos2);
			return $id;
	}

	function lista_solicitudes()
	{
		return  $this->modelo->datos_solicitud_all($id=false,$solicitante=false,$fecha=false,$fecha_salida=false,$fecha_regreso=false,$observacion=false,"0",$paso=1);
	}
	function lista_solicitudes_all()
	{
		return  $this->modelo->datos_solicitud_all($id=false,$solicitante=false,$fecha=false,$fecha_salida=false,$fecha_regreso=false,$observacion=false,true,$paso=false);
	}


}
?>