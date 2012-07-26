<?php
/******************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ----------------------------------------------------
 * News Headlines Page (headlines.php)
 ******************************************************/

/************************************
 * Environment setup...
 ************************************/
require ('includes/application.php');

/************************************
 * Initialize page variables...
 ************************************/
$pages = new Pager;
$pages->items_total = $intSumP = countNewsHeadlines();
$pages->mid_range = 9;
$pages->paginate();
$cnt1 = $pages->items_per_page * ($pages->current_page - 1) + 1;
$arrHeadlines = getNewsHeadlines($pages->limit, true);

/************************************
 * Include the HTML header...
 ************************************/
include ('include/public_header.php');
?>
<!-- BEGIN: Top Content -->
  <div style="font-size:10px; width:98%;">
  <table cellpadding="0px" cellspacing="1px" width="100%" align="center" border="0px">
  <tbody><tr>
    <td style="font-size:11px; text-align:center;" valign="top">
    <div style="width:200px;">
    <form style="padding-left: 13px;" name="frmPRDDL" id="frmPRDDL" method="post" action="<?php echo BASE_URL_RSB?>">
    <br /><span style="font-size:16px; font-weight:bold; margin-left:-10px;">Select Date Range:</span><br />
     <select name="q[]" id="q_categories" multiple="multiple" size="5" style="width:155px;">
      <option value="0" selected="selected">Show All</option>
      <option value="1">Day</option>
	  <option value="2">Month</option>
	  <option value="3">Year</option>
	  <option value="4">Custom</option>
	 </select>
     <br />
    <input name="btnsubmit" id="btnsubmit" value="Search!" style="background-color:rgb(52, 102, 140); color:#FFFFFF; font-weight:bold; width:155px;" type="submit" onclick="return false;" />
    <br />
     &nbsp;<span style="font-weight:bold; color:#FF0000;">* Hold down CTRL key and click to select more than one entry.</span>
    </form>
    </div>
    </td>
    
    <td style="width:530px; font-size:11px; text-align:center;">
     <img src="<?php echo BASE_URL_RSB?>images/globe.png" style="border:0px;" alt="globe" />
    </td>
    <td style="font-size:11px; text-align:center;">
    <div style="width:200px; margin-right:35px;">
    <form style="padding-left:13px;" name="frmPRDDL" id="frmPRDDL" method="post" action="<?php echo BASE_URL_RSB?>">
     <br /><span style="font-size:16px; font-weight: bold;">Select News Source:</span><br />
     <select name="q[]" id="q_countries" multiple="multiple" size="5" style="width:155px;">
      <option value="0" selected="selected">Show All</option>
      <option value="1">CNN</option>
	  <option value="2">MSN</option>
	  <option value="3">YAHOO</option>
	 </select>
     <br />
     <input name="btnSubmitCountry" id="btnSubmitCountry" style="background-color:rgb(52, 102, 140); color:#FFFFFF; font-weight:bold; width:155px;" value="Search!" type="submit" onclick="return false;" />
     <br />
     &nbsp;<span style="font-weight:bold; color:#FF0000;">* Hold down CTRL key and click to select more than one source.</span>
    </form>
    </div>
   </td>
   </tr>
   <tr>
   <td style="width:960px;" colspan="3" valign="top">

<br />
<!-- BEGIN: moduleGroup -->
<div class="moduleGroup" style="width:960px;">
 <div class="moduleContainer">
  <div class="epi-chromeBorder">
   <div class="epi-chromeBG">
    <div class="two" style="float:none; width:950px;">
     <div style="width:950px;">
      <h3 style="margin-top:6px;" class="cornered boxShadowSmall">News Headline Archives</h3>
<?php 
foreach ($arrHeadlines as $key => $val)
{
	$objHeadline = arrayToObject($arrHeadlines[$key]);
	?>
<!-- SET: <?php echo $objHeadline->id?> -->
<div class="newsArticle clearfix" style="min-height:80px; max-height:200px; height:auto; border-bottom:1px dotted #CCCCCC;">
 <div class="two" style="border:0px; width:750px;">
  <div>
   <span class="date"><?php echo generateDateString($objHeadline->news_post_month, $objHeadline->news_post_day, $objHeadline->news_post_year)?></span><br />
   <a href="<?php echo BASE_URL_RSB?>news/topic/<?php echo generateSEOURL($objHeadline->news_title)?>.html" style="font-size:12px;"><?php echo $objHeadline->news_title?></a><br />                                	
   <?php echo $objHeadline->news_summary?>...
  </div>
 </div>
 <img class="newsThumbnail" src="<?php echo BASE_URL_RSB?>images/<?php echo $arrNewsSources[$objHeadline->news_source]?>" />
</div>
<!--EORL-->
	<?php 
}
?>
       <a style="float:right; padding-right:50px; font-weight:bold; display:none;" href="<?php echo BASE_URL_RSB?>news/">View more headlines...</a>
      </div>
     </div>
    </div>
   </div>
  </div>
  <!-- end moduleContainer -->
 </div>
   <!-- END moduleGroup -->
   </td>
   <td valign="top" width="1px" align="left">
   </td>
  </tr>
 </tbody>
</table>
	  </div>
  <!-- END: Top Content -->
  <br clear="all">
  
<!-- BEGIN: Pagination -->
<div style="height:40px; text-align:center;">
<span class="coolBlue">Page</span> <?php echo $pages->display_pages()?> 
<div class="clear7"></div>
<span class="bold">Displaying <?php echo ($pages->items_per_page * ($pages->current_page - 1) + 1)?> - <?php echo (($_GET['ipp'] == 'All') ? ($intSumpP) : (($pages->items_per_page * ($pages->current_page))))?> of <?php echo $intSumP?> headlines</span>
</div>
<!-- END: Pagination -->
<?php 
/************************************
 * Include the HTML footer...
 ************************************/
include ('include/public_footer.php');
?>