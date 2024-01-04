<?php

class usuario extends Model
{
	public $id;
	public $mail;
    public $password;

	function __construct()
	{
		parent::__construct(usuario::class, $this);
	}
}