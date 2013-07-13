<?php if (!defined('ROOT')) die('Access denied.');

/*
 * DB_MySQL.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

class DB_MySQL
{
	protected static $instance = null;
	
	protected $resConnection;
	
	protected function __construct()
	{
		$this->connect();
	}
	
	public function __destruct()
	{
		$this->disconnect();
	}
	
	public static function getInstance()
	{
		return self::$instance ? self::$instance : new DB_MySQL();
	}
	
	protected function connect()
	{
		$strHost = $GLOBALS['CONFIG']['dbHost'];

		if ($GLOBALS['CONFIG']['dbPort'])
		{
			$strHost .= ':' . $GLOBALS['CONFIG']['dbPort'];
		}

		if ($GLOBALS['CONFIG']['dbPconnect'])
		{
			$this->resConnection = @mysql_pconnect($strHost, $GLOBALS['CONFIG']['dbUser'], $GLOBALS['CONFIG']['dbPass']);
		}
		else
		{
			$this->resConnection = @mysql_connect($strHost, $GLOBALS['CONFIG']['dbUser'], $GLOBALS['CONFIG']['dbPass']);
		}

		if (is_resource($this->resConnection))
		{
			@mysql_query("SET sql_mode=''", $this->resConnection);
			@mysql_query("SET NAMES " . $GLOBALS['CONFIG']['dbCharset'], $this->resConnection);
			@mysql_select_db($GLOBALS['CONFIG']['dbDatabase'], $this->resConnection);
		}
	}
	
	protected function disconnect()
	{
		@mysql_close($this->resConnection);
	}
	
	public function query($strQuery)
	{
		$result = @mysql_query($strQuery, $this->resConnection);
		
		return new DB_MySQL_Result($result);
	}
}

class DB_MySQL_Result
{
	protected $resResult;
	
	public function __construct($resResult)
	{
		if (!is_resource($resResult))
		{
			return;
		}
		
		$this->resResult = $resResult;
	}
	
	public function __destruct()
	{
		if (is_resource($this->resResult))
		{
			@mysql_free_result($this->resResult);
		}
	}
	

	/**
	 * Fetch the current row as enumerated array
	 * @return array
	 */
	public function fetchRow()
	{
		return @mysql_fetch_row($this->resResult);
	}


	/**
	 * Fetch the current row as associative array
	 * @return array
	 */
	public function fetchAssoc()
	{
		return @mysql_fetch_assoc($this->resResult);
	}


	/**
	 * Return the number of rows of the current result
	 * @return int
	 */
	public function numRows()
	{
		return @mysql_num_rows($this->resResult);
	}


	/**
	 * Return the number of fields of the current result
	 * @return int
	 */
	public function numFields()
	{
		return @mysql_num_fields($this->resResult);
	}
}
