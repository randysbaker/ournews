<?php
/******************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ----------------------------------------------------
 * Core Functions (functions.php)
 ******************************************************/

/************************************
 * Environment setup...
 ************************************/
if (!is_resource($sqli))
{
	$sqli = connectToDB($arrConnect);
}

/*************************************************
 * Pagination class...
 *************************************************/
include ('class.pager.php');

/************************************
 * Friendly view of an array...
 ************************************/
if (!function_exists('showDebug'))
{
	function showDebug($arrData, $strTitle='')
	{
		echo '<hr><b>'. strtoupper($strTitle) .':</b><br /><pre>';
		print_r($arrData);
		echo '</pre><hr>';
		return;
	}
}

/************************************
 * Friendly redirect...
 ************************************/
if (!function_exists('doRedirect'))
{
	function doRedirect($strLocation)
	{
		echo "<script>\n";
		echo "  location.href='{$strLocation}';\n";
		echo "</script>\n";
		return;
	}
}

/************************************
 * Friendly alert...
 ************************************/
if (!function_exists('showAlert'))
{
	function showAlert($strAlert)
	{
		echo "<script>\n";
		echo "  alert('{$strAlert}');\n";
		echo "</script>\n";
		return;
	}
}

/************************************
 * Connect to the database...
 ************************************/
function connectToDB($arrConnect)
{
	global $sqli;
	$sqli = new mysqli($arrConnect['db_host'], $arrConnect['db_user'], $arrConnect['db_pass'], $arrConnect['db_name']);
	if ($sqli->connect_error) 
	{
		die('Connection failed: '. mysqli_connect_error() ."\n");
	}
	return $sqli;
}

/************************************
 * Free the MySQL resource...
 ************************************/
if (!function_exists('closeMeUp'))
{
	function closeMeUp($strRes)
	{
		if (is_resource($strRes))
		{
			$strRes->close();
		}
		return;
	}
}

/************************************
 * Reset the MySQL resource...
 ************************************/
if (!function_exists('resetMe'))
{
	function resetMe($strRes)
	{
		if (is_object($strRes))
		{
			$strRes->reset();
			$strRes->close();
		}
		return;
	}
}

/******************************************
 * Get the database tables...
 ******************************************/
if (!function_exists('getTables'))
{
	function getTables($strDatabase)
	{
		global $sqli;
		$arrTables = array();
		$sql = "SHOW TABLES FROM {$strDatabase};";
		$res = $sqli->query($sql) or die($sqli->error);
		while ($row = $res->fetch_assoc())
		{
			$arrTables[] = $row['Tables_in_'.$strDatabase];
		}
		closeMeUp($res);
		return $arrTables;
	}
}

/******************************************
 * Get the table column definitions...
 ******************************************/
if (!function_exists('getTableFields'))
{
	function getTableFields($strTable)
	{
		global $sqli;
		$arrFields = array();
		$sql = "SHOW COLUMNS FROM `{$strTable}`;";
		$res = $sqli->query($sql) or die($sqli->error);
		while ($row = $res->fetch_assoc())
		{
			$arrFields[] = $row['Field'];
		}
		closeMeUp($res);
		return $arrFields;
	}
}

/************************************
 * Trim an array...
 ************************************/
if (!function_exists('trimArray'))
{
	function trimArray($arrData, $maxEntries)
	{
		if (is_array($arrData))
		{
			$cnt = 0;
			$tmpSize = max(array_keys($arrData));
			foreach ($arrData as $key => $val)
			{
				if ($key > $maxEntries)
				{
					unset($arrData[$key]);
				}
			}
			return $arrData;
		} else {
			return;
		}
	}
}

/************************************
 * Convert array to an object...
 ************************************/
if (!function_exists('arrayToObject'))
{
	function arrayToObject($arrData)
	{
		$arrObject = array();
		$objObject = (object) $arrObject;
		if (is_array($arrData) && count($arrData) > 0)
		{
			foreach ($arrData as $key => $val)
			{
				$key = strtolower(trim($key));
				if (!empty($key))
				{
					$objObject->$key = $val;
				}
			}
		}
		return $objObject;
	}
}

/************************************
 * Convert object to an array...
 ************************************/
if (!function_exists('objectToArray'))
{
	function objectToArray($objObject)
	{
		$arrData = array();
		if (is_object($objObject))
		{
			$arrData = get_object_vars($objObject);
		}
		return $arrData;
	}
}

/******************************************
 * Generate SEO URL...
 ******************************************/
if (!function_exists('generateSEOURL'))
{
	function generateSEOURL($strURL)
	{
		$arrFind = array(' ', ',', '.', '"', "'", '?', '!');
		$arrReplace = array('-', '', '', '', '', '', '');
		$strURL = strtolower(trim($strURL));
		$strURL = str_replace($arrFind, $arrReplace, $strURL);
		return $strURL;
	}
}

/******************************************
 * Generate page URL...
 ******************************************/
if (!function_exists('generateDisplayURL'))
{
	function generateDisplayURL($strURL)
	{
		$arrFind = array(' ', ',', '.', '/', '\\', '"', "'", '?', '!', ':');
		$arrReplace = array('-', '', '', '', '', '', '', '', '', '');
		$strURL = strtolower(trim($strURL));
		$strURL = str_replace($arrFind, $arrReplace, $strURL);
		return $strURL;
	}
}

/******************************************
 * Generate displayed text format...
 ******************************************/
if (!function_exists('generateProperString'))
{
	function generateProperString($strData)
	{
		$arrFind = array('-');
		$arrReplace = array(' ');
		$strData = str_replace($arrFind, $arrReplace, $strData);
		$strData = ucwords(strtolower(trim($strData)));
		return $strData;
	}
}

/******************************************
 * Generate date string...
 ******************************************/
if (!function_exists('generateDateString'))
{
	function generateDateString($intMonth=1, $intDay=1, $intYear=1980)
	{
		return date('l \- F j, Y', mktime(0, 0, 0, $intMonth, $intDay, $intYear));
	}
}

/***************************************
 * Advanced HTML strip_tags...
 ***************************************/
if (!function_exists('strip_html_tags'))
{
	function strip_html_tags($text)
	{
		$text = preg_replace(
				array(
						/* Remove invisible content... */
						'@<head[^>]*?>.*?</head>@siu',
						'@<style[^>]*?>.*?</style>@siu',
						'@<script[^>]*?.*?</script>@siu',
						'@<object[^>]*?.*?</object>@siu',
						'@<embed[^>]*?.*?</embed>@siu',
						'@<applet[^>]*?.*?</applet>@siu',
						'@<noframes[^>]*?.*?</noframes>@siu',
						'@<noscript[^>]*?.*?</noscript>@siu',
						'@<noembed[^>]*?.*?</noembed>@siu',
						/* Add line breaks before & after blocks... */
						'@<((br)|(hr))@iu',
						'@</?((address)|(blockquote)|(center)|(del))@iu',
						'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
						'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
						'@</?((table)|(th)|(td)|(caption))@iu',
						'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
						'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
						'@</?((frameset)|(frame)|(iframe))@iu',
				),
				array(
						' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
						"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
						"\n\$0", "\n\$0",
				),
				$text);
		return strip_tags($text);
	}
}

/************************************
 * Get the system config settings...
 ************************************/
if (!function_exists('getSystemSettings'))
{
	function getSystemSettings($strID)
	{
		global $sqli;
		$arrTemp = array();
		$strID = $sqli->real_escape_string($strID);
		$sql = "SELECT * FROM ".SYSTEM_TABLE." WHERE id={$strID} LIMIT 1";
		$res = $sqli->query($sql) or die($sqli->error);
		$row = $res->fetch_assoc();
		$arrTemp['status']         = $row['status'];
		$arrTemp['website_title']  = $row['website_title'];
		$arrTemp['admin_email']    = $row['admin_email'];
		$arrTemp['admin_message']  = $row['admin_message'];
		$arrTemp['system_message'] = $row['system_message'];
		closeMeUp($res);
		return $arrTemp;
	}
}

/************************************
 * Create the news sources array...
 ************************************/
if (!function_exists('buildNewsSources'))
{
	function buildNewsSources()
	{
		global $sqli;
		$arrData = array();
		$sql = "SELECT `id`,`source_thumbnail` FROM `".NEWS_SOURCE_TABLE."` WHERE `status`=1;";
		$res = $sqli->query($sql) or die($sqli->error);
		while ($row = $res->fetch_assoc())
		{
			$arrData[$row['id']] = $row['source_thumbnail'];
		}
		closeMeUp($res);
		return $arrData;
	}
}

/************************************
 * Get the number of headlines...
 ************************************/
if (!function_exists('countNewsHeadlines'))
{
	function countNewsHeadlines()
	{
		global $sqli;
		$intData = 0;
		$sql = "SELECT COUNT(1) AS `total` FROM `".NEWS_TABLE."`;";
		$res = $sqli->query($sql) or die($sqli->error);
		$row = $res->fetch_assoc();
		$intData = $row['total'];
		closeMeUp($res);
		return $intData;
	}
}

/************************************
 * Get the number of headlines...
 ************************************/
if (!function_exists('getHeadlineID'))
{
	function getHeadlineID($strData='')
	{
		global $sqli;
		$intData = 1;
		$strData = $sqli->real_escape_string($strData);
		$sql = "SELECT `id` FROM `".NEWS_TABLE."` WHERE `news_title`='{$strData}' LIMIT 1;";
		$res = $sqli->query($sql) or die($sqli->error);
		$row = $res->fetch_assoc();
		$intData = $row['id'];
		closeMeUp($res);
		return $intData;
	}
}

/************************************
 * Get the news headline content...
 ************************************/
if (!function_exists('getNewsHeadlineData'))
{
	function getNewsHeadlineData($intID=1)
	{
		global $sqli;
		$arrData = array();
		$arrFields = getTableFields(NEWS_TABLE);
		$sql = "SELECT ". implode(',', $arrFields) ." FROM `".NEWS_TABLE."` WHERE `id`={$intID} LIMIT 1;";
		$res = $sqli->query($sql) or die($sqli->error);
		$row = $res->fetch_assoc();
		foreach ($arrFields as $key => $val)
		{
			$arrData[$val] = $row[$val];
		}
		closeMeUp($res);
		return $arrData;
	}
}

/************************************
 * Get the news headlines...
 ************************************/
if (!function_exists('getNewsHeadlines'))
{
	function getNewsHeadlines($intLimit=7, $isPaged=false)
	{
		global $sqli;
		$arrData = array();
		$arrFields = getTableFields(NEWS_TABLE);
		$intLimit = $sqli->real_escape_string($intLimit);
		if ($isPaged === true)
		{
			$strLimit = $intLimit;
		} else {
			$strLimit = "LIMIT {$intLimit}";
		}
		$sql = "SELECT ". implode(',', $arrFields) ." FROM `".NEWS_TABLE."` WHERE `status`=1 ORDER BY CONCAT(`news_post_month`,`news_post_day`,`news_post_year`) DESC {$strLimit};";
		$res = $sqli->query($sql) or die($sqli->error);
		while ($row = $res->fetch_assoc())
		{
			$arrTemp = array();
			foreach ($arrFields as $key => $val)
			{
				$arrTemp[$val] = $row[$val];
			}
			$arrData[$row['id']] = $arrTemp;
		}
		closeMeUp($res);
		return $arrData;
	}
}

/************************************
 * Get the number of headlines...
 ************************************/
if (!function_exists('getPrevNextArticle'))
{
	function getPrevNextArticle($intID=0, $strDirection='next')
	{
		global $sqli;
		$arrData = array();
		$intID = $sqli->real_escape_string($intID);
		$strDirection = $sqli->real_escape_string($strDirection);
		if ($strDirection == 'prev')
		{
			$sqlWhere = "`id` > {$intID}";
			$sqlDir = 'ASC';
		} else {
			$sqlWhere = "`id` < {$intID}";
			$sqlDir = 'DESC';
		}
		$sql = "SELECT `id`,`news_title` FROM `".NEWS_TABLE."` WHERE {$sqlWhere} AND `status`=1 ORDER BY `id` {$sqlDir} LIMIT 1;";
		$res = $sqli->query($sql) or die($sqli->error);
		$row = $res->fetch_assoc();
		$arrData['url'] = $row['news_title'];
		closeMeUp($res);
		return $arrData;
	}
}
?>