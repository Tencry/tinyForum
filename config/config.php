<?php if (!defined('ROOT')) die('Access denied.');

/*
 * config.php
 * 
 * Copyright 2012 Arman Sarsenov <tencry@mail.ru>
 * 
 * Use it for free.
 * 
 */

$GLOBALS['CONFIG']['showErrors'] = true;

// Database
$GLOBALS['CONFIG']['dbDriver']   = 'MySQL';
$GLOBALS['CONFIG']['dbHost']     = 'localhost';
$GLOBALS['CONFIG']['dbUser']     = 'root';
$GLOBALS['CONFIG']['dbPass']     = '';
$GLOBALS['CONFIG']['dbDatabase'] = 'tinyforum';
$GLOBALS['CONFIG']['dbPconnect'] = false;
$GLOBALS['CONFIG']['dbCharset']  = 'UTF8';
$GLOBALS['CONFIG']['dbPort']     = 3306;

// Dublicate for additionals
$GLOBALS['CONFIG'][''] = '';
