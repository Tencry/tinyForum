<?php

/*
 * index.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

/***************          Begin initialization          ***************/
define('ROOT', dirname(__FILE__));

include(ROOT . '/config/config.php');
require(ROOT . '/functions.php');

error_reporting( $GLOBALS['CONFIG']['showErrors'] ? E_ALL|E_STRICT : 0 );
/***************           End initialization           ***************/



class Index extends Frontend
{
	public function run()
	{
		
		$this->import('View');
		$this->View->setView('main.html5');
		$this->View->title = 'This is my forum';
		
		$strBuffer = '';
		
		if ( $this->Input->get('show')=='themes' || $this->Input->get('show')=='')
		{
			$themes = new ModuleForumThemes();
			$strBuffer .= $themes->generate();
		}
		else if ($this->Input->get('show')=='messages')
		{
			$messages = new ModuleForumMessages();
			$strBuffer .= $messages->generate();
		}
		
		$this->View->content = $strBuffer;
		$this->View->output();
		
		/*
		$messages = new ModuleForumMessages();
		$login = new ModuleLogin();
		$login
		*/
		
		/*
		echo $this->Input->get('id');
		*/
	}
}



/***************      Create and start application      ***************/
$index = new Index();
$index->run();
