<!DOCTYPE html>
<?PHP require_once ( 'PHP/DB_Conect.php'); require_once ( 'PHP/home_Functions.php'); $page="Home"; include_once('PHP/cache_tweets_auto.php');?>

<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>Brain Freeze Studios -
            <?PHP echo($page); ?>-</title>
        <script src="http://use.edgefonts.net/anonymous-pro:n4,i4,n7,i7:all;quicksand:i4,n3,i7,n7,n4,i3:all.js"></script>
        <script type="text/javascript" src="../JS/jquery-2.0.2.min.js"></script>
        <link type="text/css" href="CSS/Reset.css" />
        <link rel="stylesheet" href="CSS/Style.css" />
        <link rel="stylesheet" href="CSS/QroSliderStyle.css" />
        <script type="text/javascript" src="JS/dropdownMenu.js"></script>
        <script type="text/javascript" src="JS/QroSlider.js"></script>
        <script type="text/javascript" src="JS/Twitter.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#QroSlider').QroSlider({
                    slide_Duration: 4000,
                    fade_Duration: 800,
                    thumbnails: false
                });
            });
        </script>
    </head>
    
    <body>
        <?PHP require_once ( 'Templates/header_template.php'); ?>
        <div id="<?PHP echo($page); ?>_Slide_Section" class="slide_Section span_8_of_8">
            <div id="QroSlider" class="qroSlider">
                <img class="slide" src="http://markwilcox.files.wordpress.com/2011/01/shutterstock_9779500.jpg" />
                <img class="slide" src="http://markwilcox.files.wordpress.com/2011/01/shutterstock_9779500.jpg" />
                <img class="slide" src="http://markwilcox.files.wordpress.com/2011/01/shutterstock_9779500.jpg" />
                <div class="qroSlider_controls">
                    <div class="page prev" data-target="prev">&lsaquo;</div>
                    <div class="page next" data-target="next">&rsaquo;</div>
                    <ul class="pager_list"></ul>
                </div>
            </div>
        </div>
        <div id="main_Content_Container" class="main_Content_Container clearfix">
            <div id="main_Content_Wrapper" class="main_Content_Wrapper clearfix">
                <section id="main_Content" class="main_Content information_Container span_6_of_8">
                    <h1>Welcome to Brain Freeze Studios</h1>
                    <hr/>
                    <div id="home_latest_Blogs" class="latest_Blogs home_Information_Containers">
                        <div class="header blogpost_Header">
                            <h3>Read our latest blogpost</h3>
                        </div>
                        <div class="latest_Container">
                        
                            <ul class="latest_List">
                            <?PHP 
                                $latest_Blogs = populateHomeInfo(4,'blog',$PDO);
                                if($latest_Blogs == false)
                                {
                            ?>       
                                <li> <?PHP echo "AAAAAARRRGGG D: , There are no blog post to be displayed ... yet."; ?> </li>
                            
                            <?PHP
                                } 
                                else
                                {
                                	foreach($latest_Blogs as $blog)
                                	{
                                        //echo var_dump($blog);
                            ?>
                                <li class="list_Item">
                                    <span class="date span_1_of_3"><?PHP echo $blog["date_posted"]; ?></span>
                                    <span class="list_Title span_1_of_3"><?PHP echo $blog["title"]; ?></span>
                                    <span class="author span_1_of_3"><?PHP echo $blog["first_name"]." ".$blog["last_name"]." (".$blog["nickname"].")"; ?></span>
                                </li>
                            <?PHP 
                            		}
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="home_latest_Videos" class="latest_Videos home_Information_Containers">
                        <div class="header videos_Header">
                            <h3>Watch our latest videos</h3>
                        </div>
                        <div class="latest_Container">
                        
                            <ul class="latest_List">
                            <?PHP 
                                $latest_Videos = populateHomeInfo(4,'videos',$PDO);
                                if($latest_Videos == false)
                                {
                            ?>       
                                <li> <?PHP echo "AAAAAARRRGGG D: , There are no videos to be displayed ... yet."; ?> </li>
                            
                            <?PHP
                                } 
                                else
                                {
                                	foreach($latest_Videos as $videos)
                                	{
                            ?>
                                <li class="list_Item">
                                    <span class="date span_1_of_3"><?PHP echo $videos["date_posted"]; ?></span>
                                    <span class="blog_List_Title span_1_of_3"><?PHP echo $videos["title"]; ?></span>
                                    <span class="author span_1_of_3"><?PHP echo $videos["first_name"]." ".$videos["last_name"]." (".$videos["nickname"].")"; ?></span>
                                </li>
                            <?PHP 
                            		}
                            	}
                            ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="home_latest_Images" class="latest_Images home_Information_Containers">
                        <div class="header images_Header">
                            <h3>Watch our latest gallery entries</h3>
                        </div>
                        <div class="latest_Container">
                        
                            <ul class="latest_List">
                            <?PHP 
                                $latest_Images = populateHomeInfo(4,'gallery',$PDO);
                                if($latest_Images == false)
                                {
                            ?>       
                                <li> <?PHP echo "AAAAAARRRGGG D: , There are no images to be displayed ... yet."; ?> </li>
                            
                            <?PHP
                                } 
                                else
                                {
                                	foreach($latest_Images as $image)
                                	{
                            ?>
                                <li>
                                    <span class="date span_1_of_3"><?PHP echo $images["date_created"]; ?></span>
                                    <span class="blog_List_Title span_1_of_3"><?PHP echo $images["title"]; ?></span>
                                    <span class="author span_1_of_3"><?PHP echo $images["first_name"]." ".$images["last_name"]." (".$images["nickname"].")"; ?></span>
                                </li>
                            <?PHP 
                            		}
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="home_latest_Projects" class="latest_projects home_Information_Containers">
                        <div class="header code_Header">
                            <h3>Explore our latest code projects</h3>
                        </div>
                        <div class="latest_Container">
                        
                            <ul class="latest_List">
                            <?PHP 
                                $latest_Code = populateHomeInfo(4,'code',$PDO);
                                if($latest_Code == false)
                                {
                            ?>       
                                <li> <?PHP echo "AAAAAARRRGGG D: , There are no code projects to be displayed ... yet."; ?> </li>
                            
                            <?PHP
                                } 
                                else
                                {
                                	foreach($latest_Code as $code)
                                	{
                            ?>
                                <li>
                                    <span class="date span_1_of_3"><?PHP echo $code["date_created"]; ?></span>
                                    <span class="blog_List_Title span_1_of_3"><?PHP echo $code["title"]; ?></span>
                                    <span class="author span_1_of_3"><?PHP echo $code["first_name"]." ".$code["last_name"]." (".$code["nickname"].")"; ?></span>
                                </li>
                            <?PHP 
                            		}
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="home_latest_Steam" class="latest_steam home_Information_Containers">
                        <div class="header steam_Header">
                            <h3>Buy some of our latest steam submissions</h3>
                        </div>
                        <div class="latest_Container">
                        
                            <ul class="latest_List">
                            <?PHP 
                                $latest_Steam = populateHomeInfo(4,'steam',$PDO);
                                if($latest_Steam == false)
                                {
                            ?>       
                                <li> <?PHP echo "AAAAAARRRGGG D: , There are no steam submitions to be displayed ... yet."; ?> </li>
                            
                            <?PHP
                                } 
                                else
                                {
                                	foreach($latest_Steam as $steam)
                                	{
                            ?>
                                <li>
                                    <span class="date span_1_of_3"><?PHP echo $steam["date_created"]; ?></span>
                                    <span class="blog_List_Title span_1_of_3"><?PHP echo $steam["title"]; ?></span>
                                    <span class="author span_1_of_3"><?PHP echo $steam["first_name"]." ".$steam["last_name"]." (".$steam["nickname"].")"; ?></span>
                                </li>
                            <?PHP 
                            		}
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div id="home_donations" class="donations home_Information_Containers">
                        <div class="header donations_Header">
                            <h3>Help us grow</h3>
                        </div>
                        <div class="latest_Container">
                            <!-- Add donation links here -->
                        </div>
                    </div>
                    
                    
                </section>
                
                <?PHP require_once ( 'Templates/sidebar_template.php'); ?>
               
            </div>
        </div>
        <footer></footer>
    </body>

</html>