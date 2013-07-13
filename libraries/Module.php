<?php if (!defined('ROOT')) die('Access denied.');

/*
 * Module.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

abstract class Module extends Controller
{
	/**
	 * Module's view files
	 * @var string
	 */
	protected $strView;
	
	/**
	 * View data
	 * @var array
	 */
	protected $arrData = array();
	
	/**
	 * Set property
	 * @param string
	 * @param mixed
	 */
	public function __set($strKey, $varValue)
	{
		$this->arrData[$strKey] = $varValue;
	}
	
	/**
	 * Get property
	 * @param string
	 * @return mixed
	 */
	public function __get($strKey)
	{
		return $this->arrData[$strKey];
	}
	
	/**
	 * Check property is set
	 * @param string
	 * @return boolean
	 */
	public function __isset($strKey)
	{
		return isset($this->arrData[$strKey]);
	}
	
	public function generate()
	{
		$this->View = new View($this->strView);
		//$this->View->setData($this->arrData);
		
		// For add custom logic
		$this->moduleLogic();
		
		return $this->View->makeBuffer();
	}
	
	abstract protected function moduleLogic();
}
