<?php

require_once 'gallery_functions.php';
require_once 'db_conect.php';
require_once 'session.php';


sec_session_start();

if(login_check($mysqli) == true) 
{

    if(isset($_POST['imageid'], $_POST['title'],$_POST['description'],$_POST['url'],$_POST['thumbnail'],$_POST['license'], $_SESSION['user_id']))
    {
        $imageid = $_POST['imageid'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $url = $_POST['url'];
        $thumbnail = $_POST['thumbnail'];
        $license = $_POST['license'];
        $userid = $_SESSION['user_id'];
        
        editImages($imageid, $title, $url, $description, $userid, $license, $thumbnail, $mysqli);
        header('Location: ../MotherBrain/gallery/galleryManagement.php');
    }
    else
    {
        header('Location: ../MotherBrain/gallery/galleryManagement.php?error=1');
    }
}
else
{
    die('<meta http-equiv="Refresh" content="URL=www.brainfreezestudios.com">');
}
?>
