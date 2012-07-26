<?php
/******************************************************
 * Created by: Randy Baker
 * Created on: 23-JUL-2012
 * ----------------------------------------------------
 * Home Page (index.php)
 ******************************************************/

/************************************
 * Environment setup...
 ************************************/
require ('includes/application.php');

/************************************
 * Get the news headlines...
 ************************************/
$arrHeadlines = getNewsHeadlines(5, false);

/************************************
 * Include the HTML header...
 ************************************/
include ('include/public_header.php');
?>
  <!-- BEGIN: Top Content -->
  <div class="content ">

    <div class="one eCom">
      <div class="eComContainer">
        <div class="popularPackage">
        </div>
        <div class="splitCallout clearfix">
         
         
         <div class="two">
            <div class="splitContainer listBullet">
              <h3 class="cornered boxShadowSmall">Create Your Account Today!</h3>
              <p style="text-align: right;"><a href="<?php echo BASE_URL_RSB?>"></a></p>
              <div class="quotes">
                <p><a href="<?php echo BASE_URL_RSB?>signup/" title="Create your account today!"><img src="<?php echo BASE_URL_RSB?>images/signup.png" style="border: 0px solid #FFFFFF;" width="358px" border="0px"></a></p>
              </div>
            </div>
          </div>
        </div>
        <br clear="all">
         <div class="extraLinks">
          <h3 class="cornered boxShadowSmall"><a href="<?php echo BASE_URL_RSB?>blog/">Recent Blog Posts</a></h3>
          <ul>
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>blog/07/21/2012/home/">Home</a></li> 
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>blog/07/22/2012/hello-world/">Hello world!</a></li> 
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>blog/07/23/2012/sample-page/">Sample Page</a></li> 
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>blog/">View All Blog Posts</a></li> 
          </ul>
        </div>
        
         <div class="extraLinks">
          <h3 class="cornered boxShadowSmall"><a href="<?php echo BASE_URL_RSB?>forum/">Recent Forum Discussions</a></h3>
          <ul>
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>forum/topic/which-cable-news-network-do-you-consider-to-prefer">Which cable news network do you prefer?</a></li> 
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>forum/">View All Forums</a></li> 
          </ul>
        </div>
        <div class="extraLinks">
          <h3 class="cornered boxShadowSmall"><a href="<?php echo BASE_URL_RSB?>news/">News Headline Archive & Directory</a></h3>
          <ul>
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>news/<?php echo date('Y')?>/<?php echo date('m')?>/<?php echo date('d')?>/" style="font-size:12px;">Today's Headlines</a></li>
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>news/<?php echo date('Y')?>/<?php echo date('m')?>/" style="font-size:12px;">This Month's Headlines</a></li>
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>news/<?php echo date('Y')?>/" style="font-size:12px;">This Year's Headlines</a></li>
            <li>&#187; <a href="<?php echo BASE_URL_RSB?>news/featured/" style="font-size:12px;">Featured Headlines</a></li>
          </ul>
          <div>
         </div>
        </div>
      </div>
    </div>

    <div class="two">
      <div style="width:578px;">
      <h3 style="margin-top:6px;" class="cornered boxShadowSmall">Most Recent News Headlines</h3>
<?php 
foreach ($arrHeadlines as $key => $val)
{
	$objHeadline = arrayToObject($arrHeadlines[$key]);
	?>
<!-- SET: <?php echo $objHeadline->id?> -->
<div class="newsArticle clearfix" style="min-height:80px; max-height:200px; height:auto;">
 <div class="two" style="border:0px; width:450px;">
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

       <a style="float:right; padding-right:50px; font-weight:bold;" href="<?php echo BASE_URL_RSB?>news/" title="Click here to view more headlines">View more headlines...</a>
      </div>
    </div>
  </div>
  <!-- END: Top Content -->
  <br clear="all">
<?php 
/************************************
 * Include the HTML footer...
 ************************************/
include ('include/public_footer.php');
?>