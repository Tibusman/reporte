<?php

class reportes extends Model
{
	public $id;
	public $Titulo;
    public $Fecha_req;
	public $Estado;
    public $Idus;
    public $Tipo_r;
    public $Descripcion;

	function __construct()
	{
		parent::__construct(reportes::class, $this);
	}
}