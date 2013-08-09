<?PHP require_once ( 'PHP/DB_Conect.php');
require_once ( 'PHP/blog_Functions.php');
$page = "Blog";
include_once('PHP/cache_tweets_auto.php'); ?>
<!DOCTYPE HTML>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Brain Freeze Studios - <?PHP echo($page); ?> -</title>
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
                    <?PHP
                    $blog_list = true;
                    $tag_list = false;
                    $blog_description = true;

                    if (isset($_GET['blogid']) && !trim($_GET['blogid']) == false) {
                        $articles = getBlogById($_GET['blogid'], $PDO);
                        $blog_list = false;
                        $blog_description = false;
                    } elseif (isset($_GET["tagid"]) && !trim($_GET["tagid"]) == false) {
                        $articles = getBlogsByTag($_GET["tagid"], $PDO);
                        $blog_list = false;
                        $tag_list = true;
                    } elseif ($blog_list == true && $tag_list == false) {
                        $articles = getBlogPosts($PDO);
                    }
                    
                    if($blog_list == true || $tag_list == true)
                    {
                        echo "<h1>Welcome to Brain Freeze Studios Blog</h1>
                    <hr/>";
                    }

                    if (($articles != false)) {
                        foreach ($articles as $article) {
                            $date_posted = new DateTime($article['date_posted']);

                            if (isset($article['date_updated']) && !trim($article['date_updated']) === ' ') {
                                $date_updated = new DateTime($articles['date_updated']);
                            }
                            ?>
                            <article id="blog_Post" class="latest_Blogs blog_Information_Containers clearfix">
                                <div class="header blogpost_Header">
                                    <h2>
                                        <a href="blog.php?blogid=<?PHP echo $article['id']; ?>">
                                            <?PHP echo $article['title']; ?>
                                        </a>
                                    </h2>
                                </div>

                                <div class="latest_Container">
                                    <div class="blog_Post_Wrapper clearfix">
                                    <div id ="blog_Info_And_Social" class="blog_Info_And_Social">

                                        <div id ="date_And_Author">
                                            
                                            <div id="post_Author">
                                                
                                                <span id="name">
                                                <?PHP
                                                echo $article["first_name"];
                                                ?>
                                                </span>
                                                </br>
                                                <span id="lastname">
                                                <?PHP
                                                echo $article["last_name"];
                                                ?>
                                                </span>
                                                </br>
                                                <span id="nickname">
                                                (
                                                <?PHP
                                                echo $article["nickname"];
                                                ?>
                                                )
                                                </span>

                                            </div>
                                            
                                            <div id="date_Posted_Container"class="date_Posted_Container time_Container">

                                                <time id="date_Posted" datetime="<?PHP echo date_format($date_posted, 'Y-m-d H:i:s'); ?>">
                                                    <span id="date_Posted_Header" class="time_header">Posted</span></br>

                                                    <span id="post_Month" class="month">
                                                    <?PHP
                                                    echo date_format($date_posted, 'M');
                                                    #output: 2012-03-24 17:45:12
                                                    ?>
                                                    </span>
                                                    </br>
                                                    <span id="post_Day" class="day">
                                                    <?PHP
                                                    echo date_format($date_posted, 'd');
                                                    #output: 2012-03-24 17:45:12
                                                    ?>
                                                    </span>

                                                </time>
                                            </div>
                                            
                                            <?PHP
                                            if (isset($date_updated))
                                            {
                                            ?>
                                            <div id="date_Updated_Container" class="date_Posted_Container time_Container">
                                                <time id="date_Updated" datetime="<?PHP echo date_format($date_updated, 'Y-m-d H:i:s'); ?>">
                                                    <span id="date_Updated_Header" class="time_header"> </br>
                                                        Updated
                                                    </span>
                                                    </br>
                                                    <span id="up_Month" class="month">
                                                        <?PHP
                                                        echo date_format($date_updated, 'M');
                                                        ?>
                                                    </span>
                                                    </br>
                                                    <span id="up_Day" class="day">
                                                        <?PHP
                                                        echo date_format($date_updated, 'd');
                                                        #output: 2012-03-24 17:45:12
                                                        ?>
                                                    </span>

                                                </time>
                                            </div>
                                            <?PHP
                                            }
                                            ?>
                                        </div>
                                        
                                        <div id="" class="">
                                            <ul class="social_Links_List">
                                                
                                                <li class="social_Icon">
                                                    <a class="twitter_popup" href="http://twitter.com/share?text=Liked%20a%20post%20from%20@Brainfreezenews%20http://www.BrainFreezeStudios.com/blog.php?blogid=<?PHP echo $article['id']; ?>">
                                                        <img src="Images/twitter-icon.png" alt="Share on Twitter"/>
                                                    </a>
                                                    
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('.twitter_popup').click(function(event) {
                                                              var width  = 575,
                                                                height = 400,
                                                                left   = ($(window).width()  - width)  / 2,
                                                                top    = ($(window).height() - height) / 2,
                                                                url    = this.href,
                                                                opts   = 'status=1' +
                                                                         ',width='  + width  +
                                                                         ',height=' + height +
                                                                         ',top='    + top    +
                                                                         ',left='   + left;

                                                            window.open(url, 'twitter', opts);

                                                            return false;
                                                            });
                                                          });
                                                    </script>
                                                    
                                                </li>
                                                
                                                <!--<li class="social_Icon">
                                                    <script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"> reddit_url = 'http://www.BrainFreezeStudios.com/blog.php?blogid=<?PHP echo $articles['id']; ?>'</script>
                                                </li>
                                                -->
                                                <li class="social_Icon">
                                                    <a href="https://plus.google.com/share?url=http://www.BrainFreezeStudios.com/blog.php?blogid=<?PHP echo $articles['id']; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                                return false;"><img src="https://www.gstatic.com/images/icons/gplus-64.png" alt="Share on Google+"/></a>
                                                </li>
                                                
                                                <li class="social_Icon">
                                                    <?php
                                                    $title = urlencode($article['title']);
                                                    $url = urlencode("http://www.BrainFreezeStudios.com/blog.php?blogid=" . $article['id']);
                                                    $summary = urlencode($article['description']);
                                                    $image = urlencode("http://www.BrainFreezeStudios.com/images/facebookpreviewicon.png");
                                                    ?>
                                                    <a onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title; ?>&amp;p[summary]=<?php echo $summary; ?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image; ?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript: void(0)">
                                                        <img src="Images/facebook-icon.png" alt="Share on Facebook"/>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>

                                    <div id="article_Container" class="blog_Post_Content">
                                        
                                            <?PHP
                                            if($blog_description == true)
                                            {
                                                echo $article["description"];
                                            }
                                            else
                                            {
                                                echo $article["post"];
                                            }
                                            ?>
                                        
                                    </div>
                                    
                                    </div>
                                    
                                    <div id="tag_Container">
                                        <?PHP
                                            $tags = getBlogTags($article["id"],$PDO);
                                            
                                            if($tags == false)
                                            {
                                                echo "<div class='blog_Tag'><a>no tags to display</a></div>";
                                                //echo "<div class='blog_Tag'><a href='http://www.BrainFreezeStudios.com/blog.php?tagid=1'> tag of testing </a></div> <div class='blog_Tag'><a href='http://www.BrainFreezeStudios.com/blog.php?tagid=1'> tag of testing2 </a></div> ";
                                            }
                                            else
                                            {
                                                foreach ($tags as $tag)
                                                {
                                                    echo "<div class='blog_Tag'><a href='http://www.BrainFreezeStudios.com/blog.php?tagid=".$tag["tag_id"]."'>".$tag["name"]."</a></div>";
                                                }
                                            }
                                        ?>
                                    </div>
                                    
                                </div>
                            </article>
                            <?PHP
                            if ($blog_description == false)
                            {
                            ?>
                            <section id="comment_Section" class="home_Information_Containers">
                                <div id="disqus_thread"></div>
                                <script type="text/javascript">
                                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                                    var disqus_shortname = 'brainfreezestudios'; // required: replace example with your forum shortname

                                    /* * * DON'T EDIT BELOW THIS LINE * * */
                                    (function() {
                                        var dsq = document.createElement('script');
                                        dsq.type = 'text/javascript';
                                        dsq.async = true;
                                        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                    })();
                                </script>
                                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
                            </section>
                            <?PHP
                            }
                            ?>

                            <?PHP
                        } //END FOREACH
                    }//END IF
                    else 
                    {
                        ?>

                        <h1>The blog entry you are searching for does not exist</h1>
                        <hr/>
                        <p class="home_Information_Container"> This blog post may have been moved somewhere else, or the page presented an error, please try again later. In the meantime our army of floating brains will work on solving the issue ASAP.</p>

                        <?PHP
                    }
                    ?>
                </section>
                
                <?PHP require_once ( 'Templates/sidebar_template.php'); ?>
            </div>
        </div>
    </body>
    <footer>
    </footer>