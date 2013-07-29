<?PHP
/*************
*
* What is this? :PHP Scripts that "automatically" caches tweets from twitter.
* What it does ? :  Checks for the existence of the file cotaining the cached tweets, 
*                   if it does not exist, i will create one, else i'll check to find 
*                   whether the file it's too old and re-caching is needed. This is intended 
*                   as a solution for webserver where cornjobs or any other automatization 
*                   tools are not available.
*
*   By: Andres Mrad (Q-ro).
*   License: Creative-Commons Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0).
*
*************/

$file = "brainfreezenews-tweets.txt"; //location and name of the cached file.
date_default_timezone_set ('America/Bogota'); //set this to the timezone of your webserver

if(file_exists($file))
{
    $date_modified = date ("F d Y H:i:s.", filemtime($file)); //date of modification of the file
    
    $current_time = date("F d Y H:i:s."); //the current time
    
    $refresh_rate = 10;
    
    if(strtotime($current_time) > strtotime($date_modified) + ($refresh_rate*60)) //Is the current time (in seconds) higher than the last date of modifications + refresh_rate (in secconds).
    {
        //echo 'too old, dont like';
        require_once("Twitter/twitter.php");
    }
}
else
{
    //create the file
    //echo "file created";
    require_once("Twitter/twitter.php");
}
?>