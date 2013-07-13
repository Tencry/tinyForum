<?php if (!defined('ROOT')) die('Access denied.');

/*
 * Input.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

class Input
{
	static protected $instance = null;
	
	protected function __construct()
	{}
	
	static public function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new Input();
		}
		
		return self::$instance;
	}
	
	public function get($strKey)
	{
		return isset($_GET[$strKey]) ? $_GET[$strKey] : '';
	}
	
	public function post($strKey)
	{
		return isset($_POST[$strKey]) ? $_POST[$strKey] : '';
	}
}
