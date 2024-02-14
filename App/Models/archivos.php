<?php

class archivos extends Model
{
    public $id;
    public $No_Empleado;
    public $Nombre;
    public $Puesto;
    public $Correo;
    public $Area;
    public $Fecha;
    public $Tipo;
    public $Nombre_E;
    public $Marca;
    public $Modelo;
    public $No_Serie;
    public $Procesador;
    public $Memoria;
    public $Disco;
    public $Mouse;
    public $Teclado;
    public $Monitor;
    public $Cargador;
    public $Celular;
    public $USB;
    public $Sistema;
    public $Ofice;
    public $Compresor;
    public $Navegador;
    public $Antivirus;
    public $Lector_pdf;
    public $Nx;
    public $Master;
    public $Tulip;
    public $Firma;
    public $tipo_doc;

	function __construct()
	{
		parent::__construct(archivos::class, $this);
	}
}

?>