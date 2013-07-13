<?php if (!defined('ROOT')) die('Access denied.');

/*
 * ModuleForumMessages.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

class ModuleForumMessages extends Module
{
	protected $strView = 'messages.html';
	
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
		$pid = (int) $this->Input->get('pid');
		$themeid = (int) $this->Input->get('themeid');
		
		$arrTheme = $this->Database->query("SELECT * FROM forum WHERE type='theme' AND id=" . $themeid)->fetchAssoc();
		
		$viewTheme = new View('theme.html');
		$viewTheme->setData($arrTheme);
		$strContent = $viewTheme->makeBuffer();
		
		$strContent .= $this->renderTree($themeid);
		
		$this->View->content = $strContent;
		//$this->View->header = 'Сообщения';
		$this->View->pid = $pid;
		$this->View->themeid = $themeid;
		
		
		if ( $this->Input->get('act') == 'create' )
		{
			$this->View->showForm = true;
		}
		
		if ( $this->Input->get('act') == 'delete' )
		{
			$this->Database->query("DELETE FROM forum WHERE type='message' AND id=" . $pid);
			$this->redirect('/?show=messages&themeid=' . $themeid);
		}
		
		if ( $this->Input->post('FORM_SUBMIT') == 'create_message' )
		{
			$this->Database->query("
				INSERT INTO forum 
				SET 
					pid='" . ($pid ? $pid : $themeid) . "',
					type='message', 
					author='" . $this->Input->post('author') . "',
					text='" . $this->Input->post('message') . "',
					tstamp='" . time() . "'"
			);
			
			$this->redirect('/?show=messages&themeid=' . $themeid);
		}
	}
	
	protected function renderTree($pid)
	{
		$objRes = $this->Database->query("SELECT * FROM forum WHERE type='message' AND pid=" . $pid);
		if ($objRes->numRows() == 0)
		{
			return;
		}
		
		$strBuffer = '';
		
		while ($arrData = $objRes->fetchAssoc())
		{
			$view = new View( 'message.html' );
			$view->setData($arrData);
			$view->themeid = (int) $this->Input->get('themeid');
			$view->submessage = $this->renderTree($arrData['id']);
			
			$strBuffer .= $view->makeBuffer();
		}
		
		return $strBuffer;
	}
}
