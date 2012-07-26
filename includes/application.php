<?php
/*****************************************************
 * Created by: Randy Baker
 * Created on: 20-JUL-2012
 * ---------------------------------------------------
 * Application Setup (application.php)
 *****************************************************/

/************************************
 * Setup the environment...
 ************************************/
@ini_set('memory_limit', '1024M');
@set_time_limit(3600);
@date_default_timezone_set('America/Chicago');
@error_reporting(E_ERROR | E_WARNING | E_PARSE);

/************************************
 * Session management...
 ************************************/
if (!isset($_SESSION))
{
	@session_start();
}

/************************************
 * Initialize the environment...
 ************************************/
define ('CRLF', "\r\n");
define ('COMPANY_NAME', 'Our News');
define ('NEWS_TABLE', 'news_releases');
define ('NEWS_SOURCE_TABLE', 'news_sources');
define ('SITE_SETTINGS_TABLE', 'site_settings');

/*************************************************
 * Application initialization...
 *************************************************/
if ($_SERVER['HTTP_HOST'] == 'localhost' || strpos($_SERVER['REMOTE_ADDR'], '192.168.1.') === 0)
{
	$arrConnect['db_user'] = 'root';
	$arrConnect['db_pass'] = '';
	$arrConnect['db_host'] = 'localhost';
	$arrConnect['db_name'] = 'news_sample';
	define ('BASE_URL_RSB', 'http://192.168.1.200/ournews/');
	define ('SITE_BASEPATH', 'C:/dev/wamp/www/ournews/');
} else {
	$arrConnect['db_user'] = 'username';
	$arrConnect['db_pass'] = 'password';
	$arrConnect['db_host'] = 'hostname';
	$arrConnect['db_name'] = 'database';
	define ('BASE_URL_RSB', 'http://www.ournews.com/');
	define ('SITE_BASEPATH', '/var/www/html/ournews/');
}

/************************************
 * Script filename declarations...
 ************************************/
$strScript = str_replace(SITE_BASEPATH, '', $_SERVER['SCRIPT_FILENAME']);

/************************************
 * Load the core functions...
 ************************************/
require_once ('functions.php');

/************************************
 * Load the core actions...
 ************************************/
require ('actions.php');
?>