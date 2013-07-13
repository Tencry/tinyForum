<?php if (!defined('ROOT')) die('Access denied.');

/*
 * Frontend.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

class Frontend extends Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->import('Input');
	}
}
