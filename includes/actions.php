<?php
/******************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ----------------------------------------------------
 * Core Actions (actions.php)
 ******************************************************/

/************************************
 * Enable / disable debugging mode...
 ************************************/
$isDebug = false;

/************************************
 * Get the arguments passed in...
 ************************************/
$strURL = ((isset($_REQUEST['url']) && $_REQUEST['url'] != '')?($_REQUEST['url']):(''));
$intRenderID = ((isset($_REQUEST['rid']) && $_REQUEST['rid'] != '')?($_REQUEST['rid']):(1));
$strModifier = ((isset($_REQUEST['modifier']) && $_REQUEST['modifier'] != '')?($_REQUEST['modifier']):('home'));

/************************************
 * Clean up the arguments...
 ************************************/
$strModifierClean = str_replace('-', ' ', $strModifier);

/************************************
 * Data array definitions...
************************************/
$arrNewsSources = buildNewsSources();

/************************************
 * Display debugging information...
 ************************************/
if ($isDebug === true)
{
	if (count($_SESSION) > 0)
	{
		echo 'SESSION:';
		showDebug($_SESSION);
	}
	
	if (count($_REQUEST) > 0)
	{
		echo 'REQUEST:';
		showDebug($_REQUEST);
	}
	
	if (count($_SERVER) > 0)
	{
		echo 'SERVER:';
		showDebug($_SERVER);
	}
	
	if (count($_POST) > 0)
	{
		echo 'POST:';
		showDebug($_POST);
	}
	
	if (count($_FILES) > 0)
	{
		echo 'FILES:';
		showDebug($_FILES);
	}
}
?>