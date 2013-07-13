<?php if (!defined('ROOT')) die('Access denied.');

/*
 * ModuleForumThemes.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

class ModuleForumThemes extends Module
{
	protected $strView = 'themes.html';
	
	public function __construct()
	{
		$this->import('DB_MySQL', 'Database');
		$this->import('Input');
	}
	
	public function generate()
	{
		return parent::generate();
	}
	
	protected function moduleLogic()
	{
		$this->View->content = $this->renderTree(0);
		
		if ( $this->Input->get('act') == 'create' )
		{
			$this->View->showForm = true;
		}
		
		if ( $this->Input->post('FORM_SUBMIT') == 'create_theme' )
		{
			$this->Database->query("
				INSERT INTO forum 
				SET 
					pid='" . $this->Input->get('pid') . "',
					type='theme', 
					title='" . $this->Input->post('title') . "',
					author='" . $this->Input->post('author') . "',
					tstamp='" . time() . "'"
			);
			
			$this->redirect('/?show=themes');
		}
	}
	
	protected function renderTree($pid)
	{
		$objRes = $this->Database->query("SELECT * FROM forum WHERE type='theme' AND pid=" . $pid);
		if ($objRes->numRows() == 0)
		{
			return;
		}
		
		$strBuffer = '';
		
		while ($arrData = $objRes->fetchAssoc())
		{
			$view = new View( 'theme.html' );
			$view->setData($arrData);
			$view->subtheme = $this->renderTree($arrData['id']);
			
			$strBuffer .= $view->makeBuffer();
		}
		
		return $strBuffer;
	}
}
