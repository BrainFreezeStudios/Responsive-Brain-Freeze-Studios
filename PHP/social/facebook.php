<?php
function fb_count() {
global $fbcount;
$facebook = file_get_contents(curPageURL());
$fbbegin = '<share_count>'; $fbend = '</share_count>';
$fbpage = $facebook;
$fbparts = explode($fbbegin,$fbpage);
$fbpage = $fbparts[1];
$fbparts = explode($fbend,$fbpage);
$fbcount = $fbparts[0];
if($fbcount == '') { $fbcount = '0'; }
}	

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>
