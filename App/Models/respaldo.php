<?php

class respaldo extends Model
{
	public $id;
	public $Semana;
    public $Link;
    public $TI;
    public $Manufactura;
    public $Calidad;
    public $Finanzas;
    public $RH;
    public $Compras;
    public $I4_0;
    public $FinanzasPI;
    public $SGC;
    public $FacturacionPI;
    public $Facturacion;
    public $PI;
    public $Almacenamiento;
    public $Comentarios;
    public $review;
    public $Firma;
    public $id_User;
    public $Fecha;
    public $Fecha_firma;

	function __construct()
	{
		parent::__construct(respaldo::class, $this);
	}
}