<!DOCTYPE html>
<?PHP require_once ( 'PHP/DB_Conect.php'); require_once ( 'PHP/home_Functions/Blog_Functions.php'); $page="Home" ;?>

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
                <img class="slide" src="http://grandpill.files.wordpress.com/2012/11/frozen-michigan-pier_30737_990x742.jpg" />
                <div class="qroSlider_controls">
                    <div class="page prev" data-target="prev">&lsaquo;</div>
                    <div class="page next" data-target="next">&rsaquo;</div>
                    <ul class="pager_list"></ul>
                </div>
            </div>
        </div>
        <div id="main_Content_Container" class="main_Content_Container clearfix">
            <div id="main_Content_Wrapper" class="main_Content_Wrapper">
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
                                $latest_Blogs = getLatestBlogpost(4,$PDO);
                                if($latest_Blogs == false)
                                {
                            ?>       
                                <li> <?PHP echo "AAAAAARRRGGG D: , There are no blog post to be displayed ... yet."; ?> </li>
                            
                            <?PHP
                                } 
                                else
                                {
                            ?>
                                <li>
                                    <span class="date span_1_of_3">qsdsad</span>
                                    <span class="blog_List_Title span_1_of_3">my carrito loco.</span>
                                    <span class="author span_1_of_3">por andres</span>
                                </li>
                            <?PHP 
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
                            </ul>
                        </div>
                    </div>
                    
                </section>
                <aside id="side_Bar" class="side_Bar span_2_of_8">
                    
                    <div class="header twitter_Header">
                        <h3>Latest Tweets</h3>
                    </div>
                    <div id="twitter_Feed" class="twitter">
                    </div>
                    
                </aside>
            </div>
        </div>
        <footer></footer>
    </body>

</html>