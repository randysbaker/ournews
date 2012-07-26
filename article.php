<?php
/******************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ----------------------------------------------------
 * News Article Page (article.php)
 ******************************************************/

/************************************
 * Environment setup...
 ************************************/
require ('includes/application.php');

/************************************ 
 * Get the news headline data...
 ************************************/
$intArticleID = getHeadlineID($strModifierClean);
$objHeadline = arrayToObject(getNewsHeadlineData($intArticleID));
$strPageTitle = $objHeadline->news_title;
$strPageDescription = $objHeadline->news_summary;
$strPageKeywords = $objHeadline->news_tags;

/************************************
 * Get the previous/next headline...
 ************************************/
$objPrevURL = arrayToObject(getPrevNextArticle($objHeadline->id, 'prev'));
$objNextURL = arrayToObject(getPrevNextArticle($objHeadline->id, 'next'));

/************************************
 * Include the HTML header...
 ************************************/
include ('include/public_header.php');
?>
<!-- BEGIN: PREV / NEXT -->
<div class="divPrevNext" style="width:99%; height:25px; margin-top:5px;">
<?php 
if (!empty($objNextURL->url))
{
	?>
	<div id="btnNext" class="boxShadowSmall" title="<?php echo $objNextURL->url?>" onclick="location.href='<?php echo BASE_URL_RSB?>news/topic/<?php echo generateSEOURL($objNextURL->url)?>.html';">NEXT <span>&#187;</span></div>
	<?php 
}
 
if (!empty($objPrevURL->url))
{
	?>
	<div id="btnPrev" class="boxShadowSmall" title="<?php echo $objPrevURL->url?>" onclick="location.href='<?php echo BASE_URL_RSB?>news/topic/<?php echo generateSEOURL($objPrevURL->url)?>.html';"><span>&#171;</span> PREV</div>
	<?php 
}
?>
</div>

<!-- BEGIN: Top Content -->
<div style="font-size:10px; width:98%;">
 <table cellpadding="2px" cellspacing="0px" width="95%" align="center" border="0px">
  <tbody>
   <tr>
    <td valign="top">
     <h3 class="cornered boxShadow" style="margin-top:5px; text-transform:uppercase; text-align:center; height:22px; font-size:17px;"><?php echo $objHeadline->news_title?></h3>

     <h3 class="cornered boxShadowSmall" style="margin-top:10px; width:150px;">News Article Summary</h3>
     <p valign="top" style="text-align:left; min-height:30px; height:auto; padding-left:5px; font-size:12px;"><?php echo $objHeadline->news_summary?></p>

     <!-- BEGIN: CONTACT TABLE -->
     <h3 class="cornered boxShadowSmall" style="margin-top:5px; width:150px;">Contact Information</h3>
     <table cellpadding="0px" cellspacing="0px" width="100%" align="center" border="0px">
      <tbody>
       <tr>
        <td valign="top" style="text-align:left; width:300px; height:30px; padding-left:5px;">
         <?php echo $objHeadline->news_author?>
        </td>
       </tr>
      </tbody>
     </table>
     <!-- END: CONTACT TABLE -->
     
     <div id="newsContentDiv">
      <iframe src="<?php echo BASE_URL_RSB?>render.php?rid=<?php echo $objHeadline->id?>"></iframe>
     </div>
   </td>
   <td style="border-left:0px; padding-left:5px;" valign="top" width="1px" align="left">
    &nbsp;
   </td>
  </tr>
 </tbody>
</table>
<script type="text/javascript">
 window.scrollTo(0,0);
</script>
</div>
  <!-- END: Top Content -->
  <br clear="all">
<?php 
/************************************
 * Include the HTML footer...
 ************************************/
include ('include/public_footer.php');
?>