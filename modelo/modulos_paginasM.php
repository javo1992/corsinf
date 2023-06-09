<?php 
if(!class_exists('db'))
{
 include('../db/db.php');
}
/**
 * 
 */
class modulos_paginasM
{
	private $db;
	
	function __construct()
	{
		$this->db = new db();

	}

	
	function guardar($datos,$tabla)
	{
		$datos = $this->db->inserts($tabla,$datos);
		if($datos==1)
		{
			return 1;
		}else
		{
			return -1;
		}

	}
	function update($tabla,$datos,$where)
	{
		$datos = $this->db->update($tabla,$datos,$where);
		if($datos==1)
		{
			return 1;
		}else
		{
			return -1;
		}

	}

	function paginas($query=false,$modulo=false)
	{
		$sql = "SELECT P.id_paginas,nombre_pagina,detalle_pagina,estado_pagina,link_pagina,icono_paginas,P.id_modulo,M.nombre_modulo,P.default_pag,subpagina 
		FROM PAGINAS P
		INNER JOIN ACCESOS AC ON P.id_paginas = AC.id_paginas
		LEFT JOIN MODULOS M ON P.id_modulo = M.id_modulo WHERE 1 = 1  AND subpagina =0 AND AC.id_tipo_usu = '".$_SESSION['INICIO']['PERFIL']."' ";
		if($query)
		{
			$sql.=" AND nombre_pagina like '%".$query."%'";
		}
		if($modulo)
		{
			$sql.=" AND M.id_modulo = '".$modulo."'";
		}
		$sql.='AND AC.Ver = 1';

		// print_r($_SESSION['INICIO']);
		// print_r($sql);die();
		$datos = $this->db->datos($sql);
		return $datos;

	}

	function paginas_all($query=false,$modulo=false)
	{
		$sql = "SELECT id_paginas,nombre_pagina,detalle_pagina,estado_pagina,link_pagina,icono_paginas,P.id_modulo,M.nombre_modulo,P.default_pag,subpagina 
		FROM PAGINAS P
		LEFT JOIN MODULOS M ON P.id_modulo = M.id_modulo WHERE 1 = 1 ";
		if($query)
		{
			$sql.=" AND nombre_pagina like '%".$query."%'";
		}
		if($modulo)
		{
			$sql.=" AND M.id_modulo = '".$modulo."'";
		}

		// print_r($sql);die();
		$datos = $this->db->datos($sql);
		return $datos;

	}

	function eliminar($id)
	{
		$sql = "DELETE FROM MODULOS WHERE id_modulo = '".$id."'";
		return $this->db->sql_string($sql);

	}
	function eliminar_pagina($id)
	{
		$sql = "DELETE FROM ACCESOS WHERE id_paginas = '".$id."';DELETE FROM PAGINAS WHERE id_paginas = '".$id."'";
		return $this->db->sql_string($sql);

	}

	function accesos($pagina,$perfil)
	{
		$sql = "SELECT * FROM ACCESOS A
		INNER JOIN PAGINAS P ON A.id_paginas = P.id_paginas
		WHERE link_pagina ='".$pagina."' AND id_tipo_usu = '".$perfil."'";

		// print_r($sql);die();
		$datos = $this->db->datos($sql);
		return $datos;

	}
}

?>