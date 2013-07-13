<?php if (!defined('ROOT')) die('Access denied.');

/*
 * Controller.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

class Controller
{
	public function __construct()
	{}
	
	protected function import($strClass, $strKey=false)
	{
		$strKey = $strKey ? $strKey : $strClass;
		
		//$strFilename = ROOT . '/libraries/' . $strClass . '.php';
		if (!isset($this->$strKey))
		{
			$this->$strKey = (in_array('getInstance', get_class_methods($strClass))) ? call_user_func(array($strClass, 'getInstance')) : new $strClass();
		}
	}
	
	protected function redirect($strUrl)
	{
		header('Location: ' . $strUrl);
		exit; 
	}
}
