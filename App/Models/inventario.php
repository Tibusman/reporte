<?php

class inventario extends Model
{
    public $id;
    public $titulo;
    public $descripcion;

	function __construct()
	{
		parent::__construct(inventario::class, $this);
	}
}

?>