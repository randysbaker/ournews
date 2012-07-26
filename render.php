<?php
/******************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ----------------------------------------------------
 * IFRAME Rendering Page (render.php)
 ******************************************************/

/************************************
 * Environment setup...
 ************************************/
require ('includes/application.php');

/************************************
 * Get the news headline data...
************************************/
$objHeadline = arrayToObject(getNewsHeadlineData($intRenderID));
echo $objHeadline->news_body;
?>