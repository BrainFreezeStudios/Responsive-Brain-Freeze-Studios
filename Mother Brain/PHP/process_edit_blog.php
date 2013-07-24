<?php

require_once 'blog_functions.php';
require_once 'db_conect.php';
require_once 'session.php';


sec_session_start();

if(login_check($mysqli) == true)
{
        
    if(isset($_POST['title'],$_POST['description'],$_POST['content'],$_POST['tags'], $_SESSION['user_id']))
    {
        
        $blogid = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $blog = $_POST['content'];
        $tags = $_POST['tags'];
        $userid = $_SESSION['user_id'];
        
        editBlog($blogid,$title,$description,$blog,$tags,$mysqli);
        header('Location: ../MotherBrain/blog/blogManagement.php');
        exit();
        
    }
    else
    {
        header('Location: ../MotherBrain/blog/editBlog.php?error=1');
    }
}
else
{
    die('<meta http-equiv="Refresh" content="URL=www.brainfreezestudios.com">');
}
?>
