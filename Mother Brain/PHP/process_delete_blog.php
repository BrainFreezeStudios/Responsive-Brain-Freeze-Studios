<?php
require_once 'blog_functions.php';
require_once 'db_conect.php';
require_once 'session.php';


sec_session_start();

if(login_check($mysqli) == true) 
{

    if(isset($_POST['id'],$_SESSION['user_id']))
    {
        $blogid = $_POST['id'];

        deleteBlogPost($blogid, $mysqli);

        header('Location: ../MotherBrain/blog/blogManagement.php');
    }
    else
    {
        header('Location: ../MotherBrain/blog/deleteBlog.php?error=1');
    }
}
else
{
    die('<meta http-equiv="Refresh" content="URL=www.brainfreezestudios.com">');
}
?>
