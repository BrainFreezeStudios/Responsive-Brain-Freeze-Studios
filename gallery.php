<?PHP require_once ( 'PHP/DB_Conect.php');
require_once ( 'PHP/gallery_functions.php.php');
$page = "Gallery";
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

        <div id="<?PHP echo($page); ?>_Slide_Section" class="slide_Section span_8_of_8 wrapper">
            <div class="wrapper">
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
        </div>

        <div id="main_Content_Container" class="main_Content_Container clearfix">
            <div id="main_Content_Wrapper" class="main_Content_Wrapper clearfix">
                <section id="main_Content" class="main_Content information_Container span_6_of_8">
                    <h1>Welcome to Brain Freeze Studios Image Gallery</h1>
                    <hr/>
                    <?PHP
                    
                        $gallery = getGallery($connection);
                    
                    ?>
                    
                    <div class="gallery_Row">
                        
                        <div class="gallery_Column">
                            
                        </div>
                        
                    </div>
                    
                </section>
                
                <?PHP require_once ( 'Templates/sidebar_template.php'); ?>
                
            </div>
        </div>
    </body>
        
    <?PHP require_once('./Templates/footer_Template.php'); ?>
        
</html>