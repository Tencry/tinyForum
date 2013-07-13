<?php if (!defined('ROOT')) die('Access denied.');

/*
 * View.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

class View
{
	/**
	 * View file
	 * @var string
	 */
	protected $strView;
	
	/**
	 * Output buffer
	 * @var string
	 */
	protected $strBuffer;
	
	/**
	 * View data
	 * @var array
	 */
	protected $arrData;
	
	/**
	 * Constructor
	 * @param string
	 */
	public function __construct($strView='')
	{
		$this->strView = $strView;
	}
	
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
		return isset($this->arrData[$strKey]) ? $this->arrData[$strKey] : '';
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
	
	/**
	 * Set view data from array
	 * @param array
	 */
	public function setData($arrData)
	{
		$this->arrData = $arrData;
	}
	
	/**
	 * Get view data
	 * @return array
	 */
	public function getData()
	{
		return $this->arrData;
	}
	
	/**
	 * Set view filename
	 * @param string
	 */
	public function setView($strView)
	{
		$this->strView = $strView;
	}
	
	/**
	 * Get view filename
	 * @return string
	 */
	public function getView()
	{
		return $this->strView;
	}
	
	/**
	 * Write view to buffer as string
	 * @return string
	 */
	public function makeBuffer()
	{
		ob_start();
		include(ROOT . '/view/' . $this->strView);
		$strBuffer = ob_get_contents();
		ob_end_clean();
		
		return $strBuffer;
	}
	
	public function output()
	{
		if (!$this->strBuffer)
		{
			$this->strBuffer = $this->makeBuffer();
		}
		
		echo $this->strBuffer;
	}
}
