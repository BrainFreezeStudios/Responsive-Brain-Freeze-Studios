<!DOCTYPE html>
<?PHP
$page = "Home";
?>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>Brain Freeze Studios -
            <?php echo($page) ?> -</title>
        <script type="text/javascript" src="../JS/jquery-2.0.2.min.js"></script>
        <link rel="stylesheet" href="../CSS/Style.css">
        <script src=""></script>
        <script type="text/javascript" src="JS/dropdownMenu.js"></script>
    </head>
    
    <body>
        <?PHP require_once ('Templates/header_template.php'); ?>
        
        <div id="slide_Section" class="slide_Section">
            <div id="qro_slider" class="qro_slider">
                <ul id="slides" class="slides">
                    <li>
                        <img src="../Slides/"<?PHP echo $page; ?>"slide1.png"/>
                        <p>Welcome to <span class="brain_Freese_Span">Brain Freeze Studios</span></p>
                    </li>
                    
                    <li>
                        <img src="../Slides/"<?PHP echo $page; ?>"slide2.png"/>
                        <p> We believe that online entertaiment should be free, and that's what we will deliver to you. </p>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div id="main Content"></div>
        <footer>
        </footer>
    </body>

</html>