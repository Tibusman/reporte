<?php

class apps extends Model
{
    public $id;
    public $app_name;
    public $version;
    public $url;
    public $icon;
    public $Descripcion; 
    
	function __construct()
	{
		parent::__construct(apps::class, $this);
	}
}

?>