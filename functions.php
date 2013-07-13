<?php if (!defined('ROOT')) die('Access denied.');

/*
 * functions.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

function __autoload($strClass)
{
	// Libraries
	$strFilename = ROOT . '/libraries/' . $strClass . '.php';
	if (file_exists($strFilename))
	{
		include_once($strFilename);
		return;
	}
	
	// Modules
	$strFilename = ROOT . '/modules/' . $strClass . '.php';
	if (file_exists($strFilename))
	{
		include_once($strFilename);
		return;
	}
}
