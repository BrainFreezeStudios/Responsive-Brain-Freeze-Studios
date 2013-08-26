<?php

require_once 'steam_functions.php';
require_once 'db_conect.php';
require_once 'session.php';


sec_session_start();

if(login_check($mysqli) == true) 
{

    if(isset($_POST['imageid'], $_POST['title'],$_POST['description'],$_POST['url'],$_POST['thumbnail'], $_SESSION['user_id']))
    {
        $imageid = $_POST['imageid'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $url = $_POST['url'];
        $thumbnail = $_POST['thumbnail'];
        $userid = $_SESSION['user_id'];
        
        editWorkshop($imageid, $title, $url, $description, $userid, $thumbnail, $mysqli);
        header('Location: ../MotherBrain/steam/steamManagement.php');
    }
    else
    {
        header('Location: ../MotherBrain/steam/editWorkshop.php?error=1');
    }
}
else
{
    die('<meta http-equiv="Refresh" content="URL=www.brainfreezestudios.com">');
}
?>
