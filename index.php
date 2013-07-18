<!DOCTYPE html>
<?PHP $page="Home" ; ?>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>Brain Freeze Studios - <?PHP echo($page); ?> -</title>
        <script type="text/javascript" src="../JS/jquery-2.0.2.min.js"></script>
        <link type="text/css" href="CSS/Reset.css"/>
        <link rel="stylesheet" href="CSS/Style.css" />
        <link rel="stylesheet" href="CSS/QroSliderStyle.css" />
        <script type="text/javascript" src="JS/dropdownMenu.js"></script>
        <script type="text/javascript" src="JS/QroSlider.js"></script>
        <script type="text/javascript">
            $(function() {
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
               <img class="slide" src="http://markwilcox.files.wordpress.com/2011/01/shutterstock_9779500.jpg"/>
                <img class="slide" src="http://markwilcox.files.wordpress.com/2011/01/shutterstock_9779500.jpg"/>
                <img class="slide" src="http://grandpill.files.wordpress.com/2012/11/frozen-michigan-pier_30737_990x742.jpg"/>
                <div class="qroSlider_controls">                    
                    <div class="page prev" data-target="prev">&lsaquo;</div>
                    <div class="page next" data-target="next">&rsaquo;</div>
                    <ul class="pager_list"></ul>
                </div>
            </div>
        </div>
        <div id="main Content"></div>
        <footer></footer>
    </body>

</html>