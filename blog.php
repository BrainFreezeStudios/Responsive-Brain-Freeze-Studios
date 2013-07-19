<?PHP
//Set Values for the page
$page_title = "Blog | Brain Freeze Studios -- www.BrainFreezeStudios.com";
$current_page = "blog";

require_once 'php/blog_functions.php';
require_once 'php/db_conect.php';


//require("php/social/facebook.php");
//fb_count();

//include_once 'php/BlogPosts.php;
?>

<!DOCTYPE HTML>
<html>
    <head>
        <?PHP
        //Include Common Head Calls
        include_once('Templates/commonHead.php');
        ?>
        <script type="text/javascript" src="js/twitterpopup.js"></script>

    </head>

    <body>


        <?PHP
        //Load Header
        include_once('Templates/header.php');
        ?>

        <div id="blogslidecontainer">
            <section id="slide">
                <div id="presentation_container" class="pc_container">

                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>
                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>
                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>
                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>
                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>
                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>
                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>
                    <div class="pc_item">
                        <div class="desc">
                            <h1>Description title</h1>
                            You can put your description in here.
                        </div>
                        <img src="images/banner/code/slide1.jpg" alt="slide1" />
                    </div>

                    <!-- ... repeat the previous item -->

                </div>
                <script type="text/javascript">
                presentationCycle.init();
                </script>
            </section>
        </div>

        <div id="outer">
            <div id="wrapper" class="clearfix">

                <section id="content">

                    <!-- Selected blog post section -->
                    <!-- (shows the selected blog post article  ) -->


                    <?PHP
                    if (isset($_GET['blogid']) && !trim($_GET['blogid']) == false) {
                        $blogexists = TRUE;
                        $articles = getBlogById($_GET['blogid'], $mysqli, $blogexists);

                        $date_posted = new DateTime($articles['date_posted']);
                        if (isset($articles['date_updated']) && !trim($articles['date_updated']) === ' ') {
                            $date_updated = new DateTime($articles['date_updated']);
                        }


                        ?>
                        <article id="post">
                            <section id="article_header">
                                <h2>
                                    <a href="blog.php?blogid=<?PHP echo $articles['id']; ?>">
                                        <?PHP echo $articles['title']; ?>
                                    </a>
                                </h2>
                            </section>
                            <section id="article_body" class="clearfix">
                                <div id="info_and_social">
                                    <div id ="date_and_author">
                                        <div id="date_posted_container">
                                            <time id="date_posted" datetime="<?PHP echo date_format($date_posted, 'Y-m-d H:i:s'); ?>">
                                                <span id="date_posted_header">Posted</span>
                                                <span id="day">
                                                    <?PHP
                                                    echo date_format($date_posted, 'd');
                                                    #output: 2012-03-24 17:45:12
                                                    ?>
                                                </span>
                                                <span id="month">
                                                    <?PHP
                                                    echo date_format($date_posted, 'M');
                                                    #output: 2012-03-24 17:45:12
                                                    ?>
                                                </span>
                                            </time>
                                        </div>
                                        <?PHP
                                        if (isset($date_updated)) {
                                            ?>
                                            <div id="date_updated_container">
                                                <time id="date_updated" datetime="<?PHP echo date_format($date_updated, 'Y-m-d H:i:s'); ?>">
                                                    <span id="date_updated_header">Updated</span>
                                                    <span id="day">
        <?PHP
        echo date_format($date_updated, 'd');
        #output: 2012-03-24 17:45:12
        ?>
                                                    </span>
                                                    <span id="month">
        <?PHP
        echo date_format($date_updated, 'M');
        #output: 2012-03-24 17:45:12
        ?>
                                                    </span>
                                                </time>
                                            </div>
        <?PHP
    }
    ?>
                                        <div id="author">
                                            <span><?php echo $articles['first_name'] ?></span>
                                            <span><?php echo $articles['last_name'] ?></span>
                                            <span>(<?php echo $articles['nickname'] ?>)</span>
                                        </div>

                                    </div>


                                    <div id="social">

                                        <ul>
                                            <li>
                                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.BrainFreezeStudios.com/blog.php?blogid=<?PHP echo $articles['id']; ?>" data-counturl="http://www.BrainFreezestudios.com/blog.php?blogid=<?PHP echo $articles['id']; ?>" data-lang="en" data-count="vertical">Tweet</a>
                                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                            </li>
                                            <li>
                                                <script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"> reddit_url='http://www.BrainFreezeStudios.com/blog.php?blogid=<?PHP echo $articles['id']; ?>'</script>
                                            </li>
                                            <li>
                                                <a href="https://plus.google.com/share?url=http://www.BrainFreezeStudios.com/blog.php?blogid=<?PHP echo $articles['id']; ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img src="https://www.gstatic.com/images/icons/gplus-64.png" alt="Share on Google+"/></a>
                                            </li>
                                            <li>
                                                <?php
    $title=urlencode($articles['title']);
    $url=urlencode("http://www.BrainFreezeStudios.com/blog.php?blogid=".$articles['id']);
    $summary=urlencode($articles['description']);
    $image=urlencode("http://www.BrainFreezeStudios.com/images/facebookpreviewicon.png");
    ?>
    <a onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', 'toolbar=0,status=0,width=620,height=280');" href="javascript: void(0)">
            <img src="images/facebook-icon.png" alt="Share on Facebook"/>
    </a>
                                            </li>
                                            <li>
                                                <a id="twitterbutton" href="http://twitter.com/share"><img src="images/twitter-icon.png" alt="tweet this"/></a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div id ="article_content">
    <?PHP echo $articles['post']; ?>
                                </div>
                            </section>
                            <section id="tags">
    <?PHP
    $tags = getBlogTags($articles['id'], $mysqli);

    foreach ($tags as $value) {
        ?>
                                    <a href="blog.php?tagid=<?PHP echo $value['tag_id']; ?>">
                                    <?PHP echo $value['name'] ?>
                                    </a>
                                        <?PHP
                                    }
                                    ?>
                            </section>

                        </article>
                    <?PHP
                    if ($blogexists === TRUE)
                    {
                    ?>
                        <section id ="comments">
                            <div id="disqus_thread"></div>
                            <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                            var disqus_shortname = 'brainfreezestudios'; // required: replace example with your forum shortname

                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
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

                        <!-- Per tag section -->
                        <!-- (list all blogpost based off the selected tag)
                        shows date and time of crreation, date and time of
                        modification, and description for each blogpost tagged
                        as the selected tag -->

    <?PHP
} elseif (isset($_GET['tagid']) && !trim($_GET['tagid']) === '') {

    $tagid = $_GET['tagid'];
    $blogpostspertag = getBlogsPerTag($tagid, $mysqli);
    $date_posted = new DateTime($articles['date_posted']);
    if (isset($articles['date_updated']) && !trim($articles['date_updated']) === ' ') {
        $date_updated = new DateTime($articles['date_updated']);
    }

    foreach ($blogpostspertag as $articles) {
        ?>
                            <article id="post">
                                <section id="article_header">
                                    <h2>
                                        <a href="blog.php?blogid=<?PHP echo $articles['id']; ?>">
        <?PHP echo $articles['title']; ?>
                                        </a>
                                    </h2>
                                </section>
                                <section id="article_body">
                                    <div id="info_and_social">
                                        <div id ="date_and_author">
                                            <div id="date_posted_container">
                                                <time id="date_posted" datetime="<?PHP echo date_format($articles['date_posted'], 'Y-m-d H:i:s'); ?>">
                                                    <span id="date_posted_header">Posted</span>
                                                    <span id="day">
        <?PHP
        echo date_format($articles['date_posted'], 'd');
        #output: 2012-03-24 17:45:12
        ?>
                                                    </span>
                                                    <span id="month">
                                                        <?PHP
                                                        echo date_format($articles['date_posted'], 'M');
                                                        #output: 2012-03-24 17:45:12
                                                        ?>
                                                    </span>
                                                </time>
                                            </div>
        <?PHP
        if (isset($date_updated)) {
            ?>
                                                <div id="date_updated_container">
                                                    <time id="date_updated" datetime="<?PHP echo date_format($articles['date_updated'], 'Y-m-d H:i:s'); ?>">
                                                        <span id="date_updated_header">Updated</span>
                                                        <span id="day">
            <?PHP
            echo date_format($articles['date_updated'], 'd');
            #output: 2012-03-24 17:45:12
            ?>
                                                        </span>
                                                        <span id="month">
                                                            <?PHP
                                                            echo date_format($articles['date_updated'], 'M');
                                                            #output: 2012-03-24 17:45:12
                                                            ?>
                                                        </span>
                                                    </time>
                                                </div>
                                                            <?PHP
                                                        }
                                                        ?>
                                            <div id="author">
                                                <span><?php echo $articles['first_name'] ?></span>
                                                <span><?php echo $articles['last_name'] ?></span>
                                                <span>(<?php echo $articles['nickname'] ?>)</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="article_description">
        <?PHP echo $articles['description']; ?>
                                    </div>

                                </section>
                                <section id="tags">

        <?PHP
        $tags = getBlogTags($articles['id'], $mysqli);
        foreach ($tags as $value) {
            ?>
                                        <a href="blog.php?tagid=<?PHP echo $value['tag_id']; ?>">
                                        <?PHP echo $value['name'] ?>
                                        </a>
                                        <?PHP
                                    }
                                    ?>


                                </section>
                            </article>
        <?PHP
    }
} else {
    ?>

                        <!-- Main section -->
                        <!-- (a list of all the blog post),
                        shows date and time of crreation, date and time of
                        modification, and description for each blogpost -->

                        <h1>Welcome to our blog</h1>

    <?PHP
    $blogposts = getBlogPosts($mysqli);

    foreach ($blogposts as $articles) {
        $date_posted = new DateTime($articles['date_posted']);
        if (isset($articles['date_updated']) && !trim($articles['date_updated']) === ' ') {
            $date_updated = new DateTime($articles['date_updated']);
        }
        ?>
                            <article id="post">
                                <section id="article_header">
                                    <h2>
                                        <a href="blog.php?blogid=<?PHP echo $articles['id']; ?>">
                            <?PHP echo $articles['title']; ?>
                                        </a>
                                    </h2>
                                </section>
                                <section id="article_body" class="clearfix">
                                    <div id="info_and_social" class="clearfix">
                                        <div id ="date_and_author">
                                            <div id="date_posted_container">
                                                <time id="date_posted" datetime="<?PHP echo date_format($date_posted, 'Y-m-d H:i:s'); ?>">
                                                    <span id="date_posted_header">Posted</span>
                                                    <span id="day">
        <?PHP
        echo date_format($date_posted, 'd');
        #output: 2012-03-24 17:45:12
        ?>
                                                    </span>
                                                    <span id="month">
                                                        <?PHP
                                                        echo date_format($date_posted, 'M');
                                                        #output: 2012-03-24 17:45:12
                                                        ?>
                                                    </span>
                                                </time>
                                            </div>
                                                        <?PHP
                                                        if (isset($date_updated)) {
                                                            ?>
                                                <div id="date_updated_container">
                                                    <time id="date_updated" datetime="<?PHP echo date_format($date_updated, 'Y-m-d H:i:s'); ?>">
                                                        <span id="date_updated_header">Updated</span>
                                                        <span id="day">
                                                <?PHP
                                                echo date_format($date_updated, 'd');
                                                #output: 2012-03-24 17:45:12
                                                ?>
                                                        </span>
                                                        <span id="month">
                                                            <?PHP
                                                            echo date_format($date_updated, 'M');
                                                            #output: 2012-03-24 17:45:12
                                                            ?>
                                                        </span>
                                                    </time>
                                                </div>
                                                            <?PHP
                                                        }
                                                        ?>
                                            <div id="author">
                                                <span><?php echo $articles['first_name'] ?></span>
                                                <span><?php echo $articles['last_name'] ?></span>
                                                <span>(<?php echo $articles['nickname'] ?>)</span>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="article_description">
        <?PHP echo $articles['description']; ?>
                                    </div>
                                </section>
                                <section id="tags">

                                        <?PHP
                                        if (isset($articles['id'])) {
                                            $tags = getBlogTags($articles['id'], $mysqli);
                                            foreach ($tags as $value) {
                                                ?>
                                            <a href="blog.php?tagid=<?PHP echo $value['tag_id']; ?>">
                                            <?PHP echo $value['name'] ?>
                                            </a>
                                            <?PHP
                                        }
                                    }
                                    ?>

                                </section>
                            </article>
                                    <?PHP
                                }
                            }
                            ?>
                </section>

                    <?PHP
                    //Include sidebar
                    require_once('Templates/sidebar.php');
                    ?>

                <!-- end wrapper -->
            </div>
        </div>
                <?PHP
                //Include Footer
                require_once('Templates/footer.php');
                ?>
    </body>

</html>
