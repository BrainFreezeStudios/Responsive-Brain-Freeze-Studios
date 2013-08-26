<?php
require_once 'gallery_functions.php';
require_once 'db_conect.php';
require_once 'session.php';


sec_session_start();

if(login_check($mysqli) == true) 
{

    if(isset($_POST['id'],$_SESSION['user_id']))
    {
        $imagesid = $_POST['id'];

        deleteImages($imagesid, $mysqli);

        header('Location: ../MotherBrain/gallery/galleryManagement.php');
    }
    else
    {
        header('Location: ../MotherBrain/gallery/deleteImage.php?error=1');
    }
}
else
{
    die('<meta http-equiv="Refresh" content="URL=www.brainfreezestudios.com">');
}
?>
