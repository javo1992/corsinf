<?php 
if(!class_exists('db'))
{
 include('../db/db.php');
}
/**
 * 
 */
class formato_tagsM
{
	private $db;
	
	function __construct()
	{
		$this->db = new db();

	}

	function lista_formato_tags($id='')
	{
		$sql = "SELECT * FROM formato_tags ";
		if($id!='')
		{
			$sql.= ' WHERE id_formato_eti='.$id;
		}
		$sql.=" ORDER BY id_formato_eti DESC";
		$datos = $this->db->datos($sql);
		return $datos;
	}
	// function buscar_formato_tags($buscar)
	// {
	// 	$sql = "SELECT ID_formato_tags,CODIGO,DESCRIPCION FROM formato_tags WHERE DESCRIPCION +' '+CODIGO LIKE '%".$buscar."%'";
	// 	$datos = $this->db->datos($sql);
	// 	return $datos;
	// }

	function insertar($datos)
	{
		$rest = $this->db->inserts('formato_tags',$datos);	   
		return $rest;
	}
	function editar($datos,$where)
	{
		
	    $rest = $this->db->update('formato_tags',$datos,$where);
		return $rest;
	}
	function eliminar($datos)
	{
	    $rest = $this->db->delete('formato_tags',$datos);
		return $rest;
	}
}

?>