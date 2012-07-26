<?php
/*****************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ---------------------------------------------------
 * Public HTML Header (public_header.php)
 *****************************************************/

/************************************
 * Variable initialization...
 ************************************/
switch ($strScript)
{
	case 'index.php':
		$strTitle = COMPANY_NAME." | Your Favorite News Headlines in One Place";
		$strMetaDesc = "";
		$strMetaKW = "";
		break;
	case 'article.php':
		$strTitle = $strPageTitle;
		$strMetaDesc = $strPageDescription;
		$strMetaKW = $strPageKeywords;
		break;
	case 'headlines.php':
		$strTitle = $strPageTitle;
		$strMetaDesc = $strPageDescription;
		$strMetaKW = $strPageKeywords;
		break;
	default:
		$strTitle = COMPANY_NAME." | Your Favorite News Headlines in One Place";
		$strMetaDesc = "";
		$strMetaKW = "";
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php echo $strTitle?></title>
  <meta name="description" content="<?php echo $strMetaDesc?>" />
  <meta name="keywords" content="<?php echo strtolower($strMetaKW)?>" />
  <link href="<?php echo BASE_URL_RSB?>styles/default.css" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <script type="text/javascript" src="<?php echo BASE_URL_RSB?>js/custom.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL_RSB?>js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL_RSB?>js/jquery-ui-1.8.2.custom.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL_RSB?>js/jquery.counter-1.0.min.js"></script>
  <script type="text/javascript" src="<?php echo BASE_URL_RSB?>js/jquery.corner.js"></script>
  <script language="javascript" src="<?php echo BASE_URL_RSB?>js/scripts.js"></script>
 </head>
 <body onload="writeCurDate('currentDate', 'en');">
  <div class="container home" style="padding:5px;">
   <div class="header">
    <div>
      <div class="one">
        <div><a href="<?php echo BASE_URL_RSB?>"><img src="<?php echo BASE_URL_RSB?>images/our_news_logo.png" alt="logo" height="45px" width="305px" border="0px"></a></div>
      </div>
        <div class="two" style="width: 350px; font-size: 10px;">
        <div style="text-align: right;">
          <a class="loginBtn" href="<?php echo BASE_URL_RSB?>login/"><span style="font-size: 11px;"></span></a>
        </div>
        <div style="text-align:right; height:50px; width:350px;">
          <a href="<?php echo BASE_URL_RSB?>login/" id="gsf12" class="alt" style="color:#FFFFFF; float:right;"><span style="float:right;">Login</span></a>
          <a href="<?php echo BASE_URL_RSB?>signup/" id="gsf12" class="alt" style="color:#FFFFFF; float:right; margin-right:5px;"><span>Create Free Account</span></a>
        </div>
      </div>
      <br clear="all">
    </div>
    <div class="mainNav">
      <div class="navigation clearfix">
            <a href="<?php echo BASE_URL_RSB?>" class="tab"><span>Home</span></a>
            <a href="<?php echo BASE_URL_RSB?>news/" class="tab"><span>News Headlines</span></a>
            <a href="<?php echo BASE_URL_RSB?>faq/" class="tab"><span>FAQs</span></a>
            <a href="<?php echo BASE_URL_RSB?>add/" class="tab"><span>Submit a Headline</span></a>
            <a href="<?php echo BASE_URL_RSB?>events/" class="tab"><span>Events</span></a>
            <a href="<?php echo BASE_URL_RSB?>blog/" class="tab"><span>Blog</span></a>
            <a href="<?php echo BASE_URL_RSB?>forum/" class="tab"><span>Forum</span></a>
            <a href="<?php echo BASE_URL_RSB?>why/" class="tab"><span>Why Us?</span></a>
            <a href="<?php echo BASE_URL_RSB?>contact/" class="tab"><span>Contact Us</span></a>
        </div>
    </div>
    <div class="headerDivide"></div>
  </div>