<?php
require_once 'steam_functions.php';
require_once 'db_conect.php';
require_once 'session.php';


sec_session_start();

if(login_check($mysqli) == true) 
{

    if(isset($_POST['id'],$_SESSION['user_id']))
    {
        $workshop = $_POST['id'];

        deleteWorkshop($workshop, $mysqli);

        header('Location: ../MotherBrain/steam/steamManagement.php');
    }
    else
    {
        header('Location: ../MotherBrain/steam/deleteWorkshop.php?error=1');
    }
}
else
{
    die('<meta http-equiv="Refresh" content="URL=www.brainfreezestudios.com">');
}
?>
