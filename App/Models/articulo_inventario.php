<?php

class articulo_inventario extends Model
{
    public $id;
    public $id_inventario;
    public $articulo;
    public $descripcion;
    public $id_usuario;
    public $No_serie;

	function __construct()
	{
		parent::__construct(articulo_inventario::class, $this);
	}
}

?>