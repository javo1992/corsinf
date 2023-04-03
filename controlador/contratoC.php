<?php 
@session_start();
include('../modelo/contratosM.php');
include('../modelo/articulosM.php');
/**
 * 
 */
$controlador  = new contratoC();
if(isset($_GET['siniestroSave']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->guardar_siniestros($parametros));
}
if(isset($_GET['coberturaSave']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->guardar_cobertura($parametros));
}
if(isset($_GET['proveSave']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->guardar_prove($parametros));
}
if(isset($_GET['cargar_datos_seguro']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->cargar_datos_seguro($parametros));
}
if(isset($_GET['cargar_datos_seguro_art']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->cargar_datos_seguro_art($parametros));
}
if(isset($_GET['seguroSave']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->guardar_seguro($parametros));
}
if(isset($_GET['lista_cobertura']))
{
	$query = '';
	if(isset($_GET['q'])){$query=$_GET['q'];}
	echo json_encode($controlador->lista_cobertura($query));
}
if(isset($_GET['lista_articulos']))
{
	$query = '';
	if(isset($_GET['q'])){$query=$_GET['q'];}
	echo json_encode($controlador->lista_articulos($query));
}
if(isset($_GET['lista_proveedores']))
{
	$query = '';
	if(isset($_GET['q'])){$query=$_GET['q'];}
	echo json_encode($controlador->lista_proveedores($query));
}
if(isset($_GET['lista_siniestros']))
{
	$query = '';
	$cob = '';
	if(isset($_GET['q'])){$query=$_GET['q'];}
	if(isset($_GET['cob'])){$cob=$_GET['cob'];}
	echo json_encode($controlador->lista_siniestros($cob,$query));
}
if(isset($_GET['Articulo_contrato_Save']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->guardar_articulo_contrato($parametros));
}
if(isset($_GET['Articulo_contrato_delete']))
{
	$parametros = $_POST['id'];
	echo json_encode($controlador->Articulo_contrato_delete($parametros));
}
if(isset($_GET['Articulo_contrato_lista']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->lista_articulo_contrato($parametros));
}
if(isset($_GET['lista_contratos']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->lista_contratos($parametros));
}
if(isset($_GET['forma_pago']))
{
	echo json_encode($controlador->forma_pago());
}
if(isset($_GET['guardar_datos_siniestro']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->guardar_datos_siniestro($parametros));
}
if(isset($_GET['historial']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->historial_siniestro($parametros));
}
if(isset($_GET['detalle_siniestro']))
{
	$parametros = $_POST['parametros'];
	echo json_encode($controlador->detalle_siniestro($parametros));
}
if(isset($_GET['datos_seguros']))
{
	echo json_encode($controlador->datos_seguros());
}
class contratoC 
{
	private $modelo;
	private $arti;
	function __construct()
	{
		$this->modelo = new contratosM();	
		$this->arti = new articulosM();	
	}

	function guardar_siniestros($parametros)
	{
		// print_r($parametros);die();
		$datos[0]['campo'] = 'nombre_riesgo';
		$datos[0]['dato'] = utf8_decode($parametros['nombre']);
		$datos[1]['campo'] = 'cobertura';
		$datos[1]['dato'] = $parametros['detalle'];		
		$datos[2]['campo'] = 'subriesgo';
		$datos[2]['dato'] = utf8_decode($parametros['cobertura']);
		return $this->modelo->guardar($tabla='RIESGOS',$datos);
	}
	function guardar_cobertura($parametros)
	{
		// print_r($parametros);die();
		$datos[0]['campo'] = 'nombre_riesgo';
		$datos[0]['dato'] = utf8_decode($parametros['nombre']);
		return $this->modelo->guardar($tabla='RIESGOS',$datos);
	}
	function guardar_prove($parametros)
	{
		// print_r($parametros);die();
		$datos[0]['campo'] = 'nombre';
		$datos[0]['dato'] = utf8_decode($parametros['nombre']);
		$datos[1]['campo'] = 'ci_ruc';
		$datos[1]['dato'] = $parametros['ci'];
		$datos[2]['campo'] = 'telefono';
		$datos[2]['dato'] = $parametros['tel'];
		$datos[3]['campo'] = 'direccion';
		$datos[3]['dato'] = utf8_decode($parametros['dir']);
		$datos[4]['campo'] = 'email';
		$datos[4]['dato'] = $parametros['ema'];

		return $this->modelo->guardar($tabla='PROVEEDOR',$datos);
	}

	function guardar_seguro($parametros)
	{
		// print_r($parametros);die();
		$sini = '';
		foreach ($parametros['siniestro'] as $key => $value) {
			$sini.=$value.',';
		}
		$datos[0]['campo'] = 'proveedor';
		$datos[0]['dato'] = $parametros['proveedor'];
		$datos[1]['campo'] = 'desde';
		$datos[1]['dato'] = $parametros['desde'];
		$datos[2]['campo'] = 'hasta';
		$datos[2]['dato'] = $parametros['hasta'];
		$datos[3]['campo'] = 'prima';
		$datos[3]['dato'] = $parametros['prima'];
		$datos[4]['campo'] = 'suma_asegurada';
		$datos[4]['dato'] = $parametros['valor'];
		$datos[5]['campo'] = 'cobertura';
		$datos[5]['dato'] = $parametros['cobertura'];
		$datos[6]['campo'] = 'siniestro';
		$datos[6]['dato'] = substr($sini,0,-1);


		$datos[7]['campo'] = 'plan_seguro';
		$datos[7]['dato'] = $parametros['plan'];
		$datos[8]['campo'] = 'vigencia';
		$datos[8]['dato'] = $parametros['vigencia'];
		$datos[9]['campo'] = 'email_asesor';
		$datos[9]['dato'] = $parametros['email'];
		$datos[10]['campo'] = 'forma_pago';
		$datos[10]['dato'] = $parametros['forma_pago'];
		$datos[11]['campo'] = 'telefono_asesor';
		$datos[11]['dato'] = $parametros['telefono'];
		$datos[12]['campo'] = 'asesor';
		$datos[12]['dato'] = $parametros['asesor'];
		$datos[13]['campo'] = 'renovacion';
		$datos[13]['dato'] = $parametros['renovacion'];
		$datos[14]['campo'] = 'Dedusible';
		$datos[14]['dato'] = $parametros['deducible'];

		$datos[15]['campo'] = 'cobertura_porce';
		$datos[15]['dato'] = $parametros['cobertura_porce'];

		if($parametros['id']!='')
		{
			$where[0]['dato'] = $parametros['id'];
			$where[0]['campo'] = 'id_contratos';
			$this->modelo->update($tabla='SEGUROS',$datos,$where);
			return $parametros['id'];
		}else
		{
			$re = $this->modelo->guardar($tabla='SEGUROS',$datos);			
		}
		if($re==1)
		{
			$seguro =  $this->modelo->buscar_seguro($id=false,$parametros['proveedor'],$parametros['desde'],$parametros['hasta'],$parametros['prima'],$parametros['valor']);
			return $seguro[0]['id_contratos'];
			// print_r($seguro);die();
		}

	}
	function lista_cobertura($query)
	{
		// print_r($parametros);die();
		$dato = $this->modelo->lista_cobertura($cobertura=true,$siniestros=false,$query);
		$res = array();
		foreach ($dato as $key => $value) {
			$res[] = array('id'=>$value['id'],'text'=>utf8_encode($value['nombre']));
		}
		return $res;

	}
	function lista_siniestros($cob,$query)
	{
		// print_r($parametros);die();
		$dato = $this->modelo->lista_cobertura($cobertura=FALSE,$siniestros=true,$query,$id=false,$cob);
		$res = array();
		foreach ($dato as $key => $value) {
			$res[] = array('id'=>$value['id'],'text'=>utf8_encode($value['nombre']));
		}
		return $res;

	}
	function lista_proveedores($query)
	{
		// print_r($parametros);die();
		$dato = $this->modelo->lista_proveedores($query);
		// print_r($datos);die();
		$res = array();
		foreach ($dato as $key => $value) {
			$res[] = array('id'=>$value['id'],'text'=>utf8_encode($value['nombre']));
		}
		return $res;

	}
	function cargar_datos_seguro($parametros)
	{
		// print_r($parametros);die();
		$seguro =  $this->modelo->buscar_seguro($parametros['id'],false,false,false,false,false);
		$prove = $this->modelo->lista_proveedores(false,$seguro[0]['proveedor']);
		if(count($prove)>0)
		{
			$oppro = '<option value="'.$prove[0]['id'].'">'.$prove[0]['nombre'].'</option>';
		}
		$opcob = '';
		$cobertura = $this->modelo->lista_cobertura($cobertura=true,$siniestros=false,$query=false,$id=$seguro[0]['cobertura'],$idSini=false);		
		if(count($cobertura)>0)
		{
			$opcob.='<option value="'.$cobertura[0]['id'].'">'.utf8_encode($cobertura[0]['nombre']).'</option>';
		}

		$sini = explode(',', $seguro[0]['siniestro']);
		$opsini='';
		foreach ($sini as $key => $value) {
			// print_r($value);die();
			$siniestro = $this->modelo->lista_cobertura($cobertura=false,$siniestros=false,$query=false,$id=$value,$idSini=false);
			$opsini.='<option value="'.$siniestro[0]['id'].'" selected="">'.utf8_encode($siniestro[0]['nombre']).'</option>';
		}

		// print_r($opsini);die();

		$res = array('datos'=>$seguro,'proveedor'=>$oppro,'cobertura'=>$opcob,'siniestro'=>$opsini);
		return $res;
		// print_r($seguro);die();
	}

	function lista_articulos($query)
	{
		$datos = $this->modelo->lista_articulos($query);
		$op = array();
	    foreach ($datos as $key => $value) {
	    	$op[] = array('id'=>$value['id_plantilla'],'text'=>$value['TAG_SERIE'].' - '.$value['DESCRIPT'] .' - '.$value['CARACTERISTICA']);
	    }
	    return $op;
	}
	function guardar_articulo_contrato($parametros)
	{
		$exis = $this->modelo->lista_articulos_seguro($parametros['contrato'],$query=false,$parametros['articulo']);
		if(count($exis)==0)
		{
			$exis1 = $this->modelo->lista_articulos_seguro(false,$query=false,$parametros['articulo']);
			if(count($exis1)>0)
			{
				return -3;
			}else{
				$datos[0]['campo']='id_seguro';
				$datos[0]['dato']= $parametros['contrato'];
				$datos[1]['campo']='id_articulo';
				$datos[1]['dato']= $parametros['articulo'];
				return $this->modelo->guardar('ARTICULOS_ASEGURADOS',$datos);
			}
		}else
		{
			return -2;
		}
	}
    function lista_articulo_contrato($parametros)
    {
    	$datos = $this->modelo->lista_articulos_seguro($parametros['contrato'],$query=false);
    	$tr='';
    	foreach ($datos as $key => $value) {
    		$tr.='<tr>';
    			if($_SESSION['INICIO']['ELIMINAR']==1){
	    		 $tr.='<td><button class="btn btn-sm btn-danger" onclick="eliminar_art(\''.$value['id'].'\')"><i class=" bx bx-trash"></i></button></td>';
	    		}
	    		$tr.='<td>'.$value['DESCRIPT'].'</td>
	    		<td>'.$value['TAG_SERIE'].'</td>
	    		<td>'.$value['MODELO'].'</td>
	    		<td>'.$value['SERIE'].'</td>
	    		<td>'.$value['marca'].'</td>
	    		<td>'.$value['estado'].'</td>
	    		<td>'.$value['genero'].'</td>
	    		<td>'.$value['color'].'</td>
	    		</tr>';
    	}
    	return $tr;
    	print_r($parametros);die();
    }
    function Articulo_contrato_delete($id)
    {
    	return $this->modelo->Articulo_contrato_delete($id);
    }

    function lista_contratos($parametros)
	{
		if(isset($parametros['opcion'])){$opc=$parametros['opcion'];}else{$opc=false;}
		if($opc==0){$opc=false;}
		$provedor = $parametros['query'];
		$desde = $parametros['desde'];
		$hasta = $parametros['hasta'];
		$datos = $this->modelo->lista_contratos($provedor,$desde,$hasta,$opc);
		$tr='';
		foreach ($datos as $key => $value) {
			$tr.='<tr>
			<td><a href="contratos.php?id='.$value['id'].'">'.$value['nombre'].'</a></td>
			<td>'.$value['prima'].'</td>
			<td>'.$value['desde']->format('Y-m-d').'</td>
			<td>'.$value['hasta']->format('Y-m-d').'</td>
			<td>'.$value['suma_asegurada'].'</td>
			</tr>';
		}
		return $tr;
		print_r($datos);die();
	}

	function cargar_datos_seguro_art($parametros)
	{
		// print_r($parametros);die();
		$seguro =  $this->modelo->cargar_datos_seguro_art($parametros['id']);
		// $prove = $this->modelo->lista_proveedores(false,$seguro[0]['proveedor']);
		// if(count($prove)>0)
		// {
		// 	$oppro = '<option value="'.$prove[0]['id'].'">'.$prove[0]['nombre'].'</option>';
		// }
		// $opcob = '';
		// $cobertura = $this->modelo->lista_cobertura($cobertura=true,$siniestros=false,$query=false,$id=$seguro[0]['cobertura'],$idSini=false);		
		// if(count($cobertura)>0)
		// {
		// 	$opcob.='<option value="'.$cobertura[0]['id'].'">'.utf8_encode($cobertura[0]['nombre']).'</option>';
		// }

		// $sini = explode(',', $seguro[0]['siniestro']);
		// $opsini='';
		// foreach ($sini as $key => $value) {
		// 	// print_r($value);die();
		// 	$siniestro = $this->modelo->lista_cobertura($cobertura=false,$siniestros=false,$query=false,$id=$value,$idSini=false);
		// 	$opsini.='<option value="'.$siniestro[0]['id'].'" selected="">'.utf8_encode($siniestro[0]['nombre']).'</option>';
		// }

		// // print_r($opsini);die();

		// $res = array('datos'=>$seguro,'proveedor'=>$oppro,'cobertura'=>$opcob,'siniestro'=>$opsini);
		return $seguro;
		// print_r($seguro);die();
	}

	function forma_pago()
	{
		return $this->modelo->forma_pago();
	}

	function guardar_datos_siniestro($parametros)
	{
		$datos[0]['campo'] = 'articulo';
		$datos[0]['dato']  = $parametros['articulo'];
		$datos[1]['campo'] = 'detalle';
		$datos[1]['dato']  = $parametros['detalle'];
		$datos[2]['campo'] = 'fecha';
		$datos[2]['dato']  = $parametros['fecha_re'];
		$datos[3]['campo'] = 'estado';
		$datos[3]['dato']  = $parametros['estado'];
		$datos[4]['campo'] = 'encargado';
		$datos[4]['dato']  = $parametros['encargado'];
		$datos[5]['campo'] = 'fecha_siniestro';
		$datos[5]['dato']  = $parametros['fecha_si'];
		$datos[6]['campo'] = 'fecha_alertado';
		$datos[6]['dato']  = $parametros['fecha_al'];
		$datos[7]['campo'] = 'respuesta';
		$datos[7]['dato']  = $parametros['respuesta'];
		$datos[8]['campo'] = 'evaluacion';
		$datos[8]['dato']  = $parametros['evaluacion'];
		$datos[9]['campo'] = 'estado_proceso';
		$datos[9]['dato']  = $parametros['proceso'];

		// print_r($parametros);die();
		if($parametros['id']=='')
		{
			return $this->modelo->guardar($tabla='DETERIORO',$datos);
		}else
		{
			$where[0]['campo'] = 'id_deterioro';
			$where[0]['dato']  = $parametros['id'];
			return $this->modelo->update($tabla='DETERIORO',$datos,$where);
		}

	}

	function historial_siniestro($parametros)
	{
		$id = $parametros['id'];
		$datos = $this->modelo->historial_siniestro($id);
		$tr='';
		$pendiente = 0;

		foreach ($datos as $key => $value) {
			$es = '';
			if($value['estado_proceso']==0)
			{
				$es = '<button class="btn-default btn btn-sm" onclick="cerrar_siniestro('.$value['id_deterioro'].')"><i class="bx bx-edit-alt"></i></button>';
				$pendiente = 1;
			}
			$tr.='<tr>
			<td>'.$es.'</td>
			<td>'.$value['fecha_siniestro']->format('Y-m-d').'</td>
			<td class="text-left">
	            <h3><a href="javascript:;">Encargado: '.$value['encargado'].'</a></h3>
	            '.$value['detalle'].'
	        </td>
			<td>'.$value['DESCRIPCION'].'</td>
			<td>'.$value['fecha_alertado']->format('Y-m-d').'</td>
			<td class="unit">'.$value['evaluacion'].'</td>
			</tr>';
		}
		return array('tbl'=>$tr,'pendiente'=>$pendiente);
	}

	function detalle_siniestro($parametros)
	{
		$id = $parametros['id'];
		return $this->modelo->historial_siniestro($articulo=false,$id);
	}

	function datos_seguros()
	{
		$seguros = count($this->modelo->buscar_seguro($id=false,$prove=false,$desde=false,$hasta=false,$prima=false,$suma_asegurada=False));
		$asegurados = count($this->modelo->lista_articulos_seguro($contrato=false,$query=false,$id_art=false));
		$totalArt = $this->arti->cantidad_registros($query=false,$loc=false,$cus=false,$pag=false,$whereid=false);

		$sinseguro = $totalArt[0]['numreg']-$asegurados;


		return array('asegurados'=>$asegurados,'sinseguro'=>$sinseguro,'total'=>$totalArt[0]['numreg'],'seguros'=>$seguros);
	}


}
?>